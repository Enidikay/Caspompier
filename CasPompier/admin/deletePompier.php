<?php
// Inclure le fichier de connexion à la base de données et la classe PompierManager si nécessaire
include ('../include/connexion.inc.php');
include ('../include/entete2.inc.php');

if (isset($_POST['supprimer']) && isset($_POST['matricule_pompier'])) {
    // Récupérer le matricule du pompier depuis le formulaire
    $matricule_pompier = $_POST['matricule_pompier'];

    try {
        // Créer une instance de PompierManager et supprimer le pompier
        $PompierManager = new PompierManager($db); 
        $PompierManager->deletePompier($matricule_pompier);

        // Redirection vers une page appropriée après la suppression
        header("Location: listePompier.php"); 
        exit(); // Terminer le script après la redirection
    } catch (PDOException $e) {
        // Gérer les erreurs PDO ici
        echo "Erreur PDO : " . $e->getMessage();
    }
}
?>