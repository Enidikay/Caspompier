<?php
class VolontaireManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }

    public function ajouterVolontaire(Volontaire $volontaire)
    {
        $query = "INSERT INTO volontaire (Matricule,id,Bip) VALUES (:matricule,:id,:bip)";
        $stmt = $this->_db->prepare($query);

        // Liaison des paramètres
        $stmt->bindValue(':matricule', $volontaire->getMatricule());
        $stmt->bindValue(':id', $volontaire->getId());
        $stmt->bindValue(':bip', $volontaire->getBip());

        // Exécution de la requête
        $stmt->execute();
    }

    public function supprimerVolontaire($id)
    {
        $query = "DELETE FROM volontaire WHERE id = :id";
        $stmt = $this->_db->prepare($query);

        // Liaison du paramètre
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();
    }

    public function modifierVolontaire($id, $nouveauMatricule, $nouveauBip)
    {
        $query = "UPDATE volontaire SET Matricule = :matricule, Bip = :bip WHERE id = :id";
        $stmt = $this->_db->prepare($query);

        // Liaison des paramètres
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':matricule', $nouveauMatricule, PDO::PARAM_STR);
        $stmt->bindParam(':bip', $nouveauBip, PDO::PARAM_STR);

        // Exécution de la requête
        $stmt->execute();
    }

    public function getVolontaires()
    {
        $query = "SELECT * FROM volontaire";
        $stmt = $this->_db->query($query);

        // Récupération des résultats
        $volontaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $volontaires;
    }

    public function getVolontaireById($id)
    {
        $query = "SELECT * FROM volontaire WHERE id = :id";
        $stmt = $this->_db->prepare($query);

        // Liaison du paramètre
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Récupération du résultat
        $volontaire = $stmt->fetch(PDO::FETCH_ASSOC);

        return $volontaire;
    }

    public function getRoleVolontaire()
    {
        try {
            // Préparation de la requête SQL
            $query = "SELECT Matricule FROM Pompier WHERE Matricule IN (SELECT Matricule FROM Volontaire)";

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

    public function countVolontaire()
    {
        try {
            // Préparation de la requête de comptage
            $query = $this->_db->prepare('SELECT COUNT(*) AS total FROM volontaire');

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

    public function setDB(PDO $db)
    {
        $this->_db = $db;
    }
}

?>