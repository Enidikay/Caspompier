<?php
class TypeEnginManager
{

    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function addTypeEngin(TypeEngin $typeEngin)
    {
        // Préparation de la requête d'insertion
        $query = $this->_db->prepare('INSERT INTO type_engin(id, libelle, image) VALUES(:id, :libelle, :image)');

        // Assignation des valeurs aux paramètres de la requête
        $query->bindValue(':id', $typeEngin->getId());
        $query->bindValue(':libelle', $typeEngin->getLibelle());
        $query->bindValue(':image', $typeEngin->getImage());

        // Exécution de la requête
        if (!$query->execute()) {
            // Afficher les erreurs SQL
            print_r($query->errorInfo());
        }
    }

    public function getTypeEngin()
    {
        try {
            // Préparation de la requête de sélection avec des paramètres
            $query = $this->_db->prepare('SELECT * FROM type_engin');

            // Exécution de la requête
            $query->execute();

            // Récupération de tous les résultats sous forme d'un tableau associatif
            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            // Si aucun résultat n'est trouvé, retourner null
            if (!$data) {
                return null;
            }

            // Création et retour d'un tableau d'objets TypeEngin à partir des données récupérées
            $typeEngins = [];
            foreach ($data as $row) {
                $typeEngins[] = new TypeEngin($row);
            }
            return $typeEngins;
        } catch (PDOException $e) {
            // Gérer l'erreur PDO ici (par exemple, journalisation, affichage d'un message d'erreur, etc.)
            // Vous pouvez également lever une nouvelle exception ou simplement retourner null selon vos besoins
            return null;
        }
    }


    public function getTypeEnginById($id)
    {
        // Préparation de la requête de sélection avec une clause WHERE pour filtrer par ID
        $query = $this->_db->prepare('SELECT * FROM type_engin WHERE id = :id');

        // Assignation de la valeur du paramètre
        $query->bindValue(':id', $id);

        // Exécution de la requête
        $query->execute();

        // Récupération du résultat sous forme d'un tableau associatif
        $data = $query->fetch(PDO::FETCH_ASSOC);

        // Si aucun résultat n'est trouvé, retourner null
        if (!$data) {
            return null;
        }

        // Création et retour de l'objet TypeEngin à partir des données récupérées
        return new TypeEngin($data);
    }

    public function deleteTypeEnginById($id)
    {
        // Préparation de la requête de suppression avec une clause WHERE pour filtrer par ID
        $query = $this->_db->prepare('DELETE FROM type_engin WHERE id = :id');

        // Assignation de la valeur du paramètre
        $query->bindValue(':id', $id);

        // Exécution de la requête
        $query->execute();

        // Pas d'appel de procédure stockée pour enregistrer les logs de suppression (utilisation d'un trigger)

        // Vérification du nombre de lignes affectées pour déterminer si la suppression a réussi
        if ($query->rowCount() > 0) {
            // La suppression a réussi
            return true;
        } else {
            // La suppression a échoué
            return false;
        }
    }

    public function modifierEngin(TypeEngin $engin)
    {
        // Préparation de la requête de mise à jour
        $query = $this->_db->prepare('UPDATE type_engin SET libelle = :libelle, image = :image WHERE id = :id');

        // Assignation des valeurs aux paramètres de la requête
        $query->bindValue(':libelle', $engin->getLibelle());
        $query->bindValue(':image', $engin->getImage());
        $query->bindValue(':id', $engin->getId());

        // Exécution de la requête
        $query->execute();

        // Pas d'appel de procédure stockée pour enregistrer les logs de modification (utilisation d'un trigger)
    }

    public function countTypeEngin()
    {
        try {
            // Préparation de la requête de comptage
            $query = $this->_db->prepare('SELECT COUNT(*) AS total FROM type_engin');

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



}
