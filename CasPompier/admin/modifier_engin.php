<?php

// Inclure les fichiers requis et initialiser la connexion à la base de données
include ('../include/connexion.inc.php');
include ('../include/entete2.inc.php');
include ('include/entete3.inc.php');

session_start();

include ('include/sessionadmin.inc.php');


// Vérifier si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $libelle = $_POST['libelle'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Déplacer le fichier téléchargé vers le dossier spécifié
    $upload_directory = 'images/storedimage';
    $image_path = $upload_directory . $image;
    move_uploaded_file($image_tmp, $image_path);

    // Créer un objet TypeEngin avec les données du formulaire
    $engin = new TypeEngin([
        'id' => $id,
        'libelle' => $libelle,
        'image' => $image_path
    ]);

    // Appeler la méthode pour modifier l'engin dans la base de données
    $typeEnginManager = new TypeEnginManager($db);
    $typeEnginManager->modifierEngin($engin);
}
?>