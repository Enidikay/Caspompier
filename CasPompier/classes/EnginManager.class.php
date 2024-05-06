<?php
class EnginManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }

    public function ajoutEngin(Engin $engin)
    {
        // Préparation de la requête d'insertion
        $query = $this->_db->prepare('INSERT INTO engin(caserne_id, type_engin_id) VALUES(:caserne_id, :type_engin_id)');

        // Assignation des valeurs aux paramètres de la requête
        $query->bindValue(':caserne_id', $engin->getCaserneid());
        $query->bindValue(':type_engin_id', $engin->getTypeenginid());

        // Exécution de la requête
        $query->execute();

        // Vérification du nombre de lignes affectées pour déterminer si l'ajout a réussi
        if ($query->rowCount() > 0) {
            // L'ajout a réussi
            return true;
        } else {
            // L'ajout a échoué
            return false;
        }
    }

    public function getAllEngins()
    {
        // Préparation de la requête de sélection
        $query = $this->_db->query('SELECT * FROM engin');

        // Récupération des résultats sous forme d'objets de la classe Engin
        $engins = [];
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            // Création d'un objet Engin avec les données récupérées de la base de données
            $engin = new Engin($data);
            // Ajout de l'objet Engin au tableau
            $engins[] = $engin;
        }
        // Retourne le tableau contenant tous les engins
        return $engins;
    }

    public function getEnginDetails($caserneId, $typeEnginId)
    {
        // Préparation de la requête pour récupérer les détails des engins attribués à une caserne spécifique et à un type d'engin spécifique
        $query = $this->_db->prepare('SELECT type_engin.Image, type_engin.Libelle, caserne.id AS Caserne_id
                                        FROM type_engin
                                        JOIN engin ON type_engin.id = engin.Type_Engin_id
                                        JOIN caserne ON engin.Caserne_id = caserne.id
                                        WHERE caserne.id = :caserne_id AND type_engin.id = :type_engin_id');

        // Assignation des valeurs aux paramètres de la requête
        $query->bindValue(':caserne_id', $caserneId);
        $query->bindValue(':type_engin_id', $typeEnginId);

        // Exécution de la requête
        $query->execute();

        // Récupération de tous les résultats sous forme d'un tableau associatif
        $enginDetails = $query->fetchAll(PDO::FETCH_ASSOC);

        // Retourner les détails des engins
        return $enginDetails;
    }

    public function countEngins()
    {
        try {
            // Préparation de la requête de comptage
            $query = $this->_db->prepare('SELECT COUNT(*) AS total FROM engin');

            // Exécution de la requête
            $query->execute();

            // Récupération du résultat
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Retour du nombre total de pompiers
            return $result['total'];
        } catch (PDOException $e) {
            // Gérer l'erreur PDO ici
            return null;
        }
    }


    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}