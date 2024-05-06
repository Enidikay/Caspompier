<?php
class EmployeurManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDB($db);
    }

    public function ajouterEmployeur(Employeur $nom, $prenom, $tel)
    {
        $query = "INSERT INTO employeur (Nom, Prenom, Tel) VALUES (:nom, :prenom, :tel)";
        $stmt = $this->_db->prepare($query);

        // Liaison des paramètres
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);

        // Exécution de la requête
        $stmt->execute();
    }

    // Méthode pour supprimer un employeur
    public function supprimerEmployeur($id)
    {
        // Préparation de la requête de suppression
        $query = "DELETE FROM employeur WHERE id = :id";
        $stmt = $this->_db->prepare($query);

        // Liaison du paramètre
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();
    }

    // Méthode pour modifier les détails d'un employeur
    public function modifierEmployeur($id, $nouveauNom, $nouveauPrenom, $nouveauTel)
    {
        // Préparation de la requête de mise à jour
        $query = "UPDATE employeur SET Nom = :nom, Prenom = :prenom, Tel = :tel WHERE id = :id";
        $stmt = $this->_db->prepare($query);

        // Liaison des paramètres
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nouveauNom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $nouveauPrenom, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $nouveauTel, PDO::PARAM_STR);

        // Exécution de la requête
        $stmt->execute();
    }

    // Méthode pour récupérer tous les employeurs
    public function getEmployeurs()
    {
        // Préparation de la requête de sélection
        $query = "SELECT * FROM employeur";
        $stmt = $this->_db->query($query);

        // Récupération des résultats
        $employeurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $employeurs;
    }

    // Méthode pour récupérer un employeur par son identifiant
    public function getEmployeurById($id)
    {
        // Préparation de la requête de sélection
        $query = "SELECT * FROM employeur WHERE id = :id";
        $stmt = $this->_db->prepare($query);

        // Liaison du paramètre
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Récupération du résultat
        $employeur = $stmt->fetch(PDO::FETCH_ASSOC);

        return $employeur;
    }
    public function countEmployeur()
    {
        try {
            // Préparation de la requête de comptage
            $query = $this->_db->prepare('SELECT COUNT(*) AS total FROM employeur');

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