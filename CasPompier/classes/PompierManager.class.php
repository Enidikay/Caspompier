<?php
class PompierManager
{
    private $_db;
    private $_gradeManager;


    public function __construct($db)
    {
        $this->setDB($db);
    }

    public function add(Pompier $pompier)
    {
        $q = $this->_db->prepare('INSERT INTO pompier(Matricule, Nom, Prenom, DateNaiss, Tel, Sexe, id) VALUES(:matricule, :nom, :prenom, :ddn, :tel, :sexe, :id)');
        $q->bindValue(':matricule', $pompier->getMatricule());
        $q->bindValue(':nom', $pompier->getNom());
        $q->bindValue(':prenom', $pompier->getPrenom());
        $q->bindValue(':ddn', $pompier->getDdn());
        $q->bindValue(':tel', $pompier->getTel());
        $q->bindValue(':sexe', $pompier->getSexe());
        $q->bindValue(':id', $pompier->getId());
        if (!$q->execute()) {
            // Afficher les erreurs SQL
            print_r($q->errorInfo());
        }
    }

    public function getPompierbyID($id)
    {
        $q = $this->_db->prepare('SELECT * FROM pompier WHERE id = :id');
        $q->bindValue(':id', $id);
        $q->execute();
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function getPompierByMatricule($matricule)
    {
        $q = $this->_db->prepare('SELECT * FROM pompier WHERE Matricule = :matricule');
        $q->bindValue(':matricule', $matricule);
        $q->execute();
        return $q->fetch(PDO::FETCH_ASSOC);
    }



    public function getAllPompiers()
    {
        $q = $this->_db->prepare('SELECT * FROM pompier');
        $q->execute();
        $results = $q->fetchAll(PDO::FETCH_ASSOC);

        $pompiers = [];

        foreach ($results as $result) {
            $pompier = new Pompier($result);
            $pompiers[] = $pompier;
        }

        return $pompiers;
    }


    public function updatePompier(Pompier $pompier)
    {
        $q = $this->_db->prepare('UPDATE pompier SET Nom = :nom, Prenom = :prenom, Tel = :tel WHERE Matricule = :matricule');
        $q->bindValue(':nom', $pompier->getNom());
        $q->bindValue(':prenom', $pompier->getPrenom());
        $q->bindValue(':tel', $pompier->getTel());
        $q->bindValue(':matricule', $pompier->getMatricule());
        if (!$q->execute()) {
            // Afficher les erreurs SQL
            print_r($q->errorInfo());
        }

    }

    public function deletePompier($matricule)
    {
        $q = $this->_db->prepare('DELETE FROM pompier WHERE Matricule = :matricule');
        $q->bindValue(':matricule', $matricule);
        if (!$q->execute()) {
            // Afficher les erreurs SQL
            print_r($q->errorInfo());
        }
    }

    public function getPompierGrade($id, GradeManager $gradeManager)
    {
        // Récupérer les informations du pompier
        $pompierData = $this->getPompierbyID($id);

        // Récupérer le grade du pompier à partir de GradeManager
        $gradeData = $gradeManager->getGradeById($pompierData['id']);

        return $gradeData['libellé'];
    }

    public function countPompiers()
    {
        try {
            // Préparation de la requête de comptage
            $query = $this->_db->prepare('SELECT COUNT(*) AS total FROM pompier');

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
