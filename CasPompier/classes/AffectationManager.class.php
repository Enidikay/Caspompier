<?php
class AffectationManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }

    public function addAffectation(Affectation $affectation)
    {
        // Obtenir la date actuelle au format MySQL
        $date = date("Y-m-d");

        $q = $this->_db->prepare('INSERT INTO affectation(date, Matricule, id) VALUES(:date, :matricule_pompier, :id_caserne)');
        $q->bindValue(':date', $date);
        $q->bindValue(':matricule_pompier', $affectation->getMatricule());
        $q->bindValue(':id_caserne', $affectation->getId());
        if (!$q->execute()) {
            // Afficher les erreurs SQL
            print_r($q->errorInfo());
            return false; // Retourner false en cas d'échec
        }
        return true; // Retourner true si l'insertion a réussi
    }

    public function getCaserneByMatricule($matricule)
    {
        $query = $this->_db->prepare('SELECT caserne.* FROM affectation 
                                      JOIN caserne ON affectation.id = caserne.id
                                      WHERE Matricule = :matricule');
        $query->bindParam(':matricule', $matricule, PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() > 0) {
            $caserneData = $query->fetch(PDO::FETCH_ASSOC);
            return new Caserne($caserneData);
        } else {
            return null; // Retourne null si aucune caserne trouvée pour ce matricule
        }
    }

    public function getAffectationsByCaserneId($caserneId)
    {
        $query = $this->_db->prepare('SELECT * FROM affectation WHERE id = :caserneId');
        $query->bindParam(':caserneId', $caserneId, PDO::PARAM_INT);
        $query->execute();

        $affectations = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $affectations[] = new Affectation($row);
        }

        return $affectations;
    }

    public function getPompierInfoByMatricule($matricule)
    {
        // Préparer la requête SQL avec une jointure entre les tables affectation et pompier
        $query = $this->_db->prepare('SELECT pompier.Nom, pompier.Prenom FROM affectation 
                                      JOIN pompier ON affectation.Matricule = pompier.Matricule
                                      WHERE affectation.Matricule = :matricule');
        $query->bindParam(':matricule', $matricule, PDO::PARAM_INT);
        $query->execute();

        // Vérifier si des résultats ont été trouvés
        if ($query->rowCount() > 0) {
            // Récupérer les données du pompier (nom et prénom)
            return $query->fetch(PDO::FETCH_ASSOC);
        } else {
            // Aucun pompier trouvé avec ce matricule
            return null;
        }
    }








    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}