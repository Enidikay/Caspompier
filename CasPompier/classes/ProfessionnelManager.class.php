<?php
class ProfessionnelManager
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

    public function add(Professionnel $professionnel)
    {
        $query = "INSERT INTO professionnel (matricule, DateEmbauche) VALUES (:matricule, :date_embauche)";
        $stmt = $this->_db->prepare($query);
        $stmt->bindValue(':matricule', $professionnel->getMatricule());
        $stmt->bindValue(':date_embauche', $professionnel->getDateEmbauche());
        $stmt->execute();
    }

    public function update(Professionnel $professionnel)
    {
        $query = "UPDATE professionnel SET DateEmbauche = :date_embauche WHERE matricule = :matricule";
        $stmt = $this->_db->prepare($query);
        $stmt->bindValue(':date_embauche', $professionnel->getDateEmbauche());
        $stmt->bindValue(':matricule', $professionnel->getMatricule());
        $stmt->execute();
    }

    public function delete(Professionnel $professionnel)
    {
        $query = "DELETE FROM professionnel WHERE matricule = :matricule";
        $stmt = $this->_db->prepare($query);
        $stmt->bindValue(':matricule', $professionnel->getMatricule());
        $stmt->execute();
    }

    public function getProfessionnelById($matricule)
    {
        $query = "SELECT * FROM professionnel WHERE matricule = :matricule";
        $stmt = $this->_db->prepare($query);
        $stmt->bindValue(':matricule', $matricule);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Professionnel($data);
    }

    public function getAllProfessionnels()
    {
        $query = "SELECT * FROM professionnel";
        $stmt = $this->_db->query($query);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $professionnels = [];
        foreach ($data as $row) {
            $professionnels[] = new Professionnel($row);
        }

        return $professionnels;
    }

    public function getRoleProfessionnel()
    {
        try {
            // Préparation de la requête SQL
            $query = "SELECT Matricule FROM Pompier WHERE Matricule IN (SELECT Matricule FROM Professionnel)";

            // Exécution de la requête
            $stmt = $this->_db->prepare($query);
            $stmt->execute();

            // Récupération des résultats
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Retourne les matricules des pompiers professionnels
            return $result;
        } catch (PDOException $e) {
            // Gestion des erreurs si la requête échoue
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function countProfessionnel()
    {
        try {
            // Préparation de la requête de comptage
            $query = $this->_db->prepare('SELECT COUNT(*) AS total FROM professionnel');

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
