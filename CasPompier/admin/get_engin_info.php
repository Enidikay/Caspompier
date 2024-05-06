<?php
// Inclure les fichiers nécessaires
include ('../include/connexion.inc.php');
include ('../include/entete2.inc.php');
session_start();
include ('include/sessionadmin.inc.php');


// Vérifier si l'ID de l'engin est passé dans la requête GET
if (isset($_GET['id'])) {
    // Récupérer l'ID de l'engin depuis la requête
    $enginId = $_GET['id'];

    // Initialiser le gestionnaire d'engins
    $typeEnginManager = new TypeEnginManager($db);

    // Récupérer les informations de l'engin correspondant à l'ID
    $engin = $typeEnginManager->getTypeEnginById($enginId);

    // Vérifier si l'engin existe
    if ($engin) {
        // Créer un tableau associatif avec les informations de l'engin
        $enginInfo = array(
            'id' => $engin->getId(),
            'libelle' => $engin->getLibelle(),
            // Ajouter d'autres informations si nécessaire
        );

        // Convertir le tableau associatif en format JSON et l'afficher
        echo json_encode($enginInfo);
    } else {
        // L'engin avec l'ID spécifié n'a pas été trouvé
        echo json_encode(array('error' => 'L\'engin avec l\'ID spécifié n\'a pas été trouvé'));
    }
} else {
    // L'ID de l'engin n'est pas spécifié dans la requête GET
    echo json_encode(array('error' => 'L\'ID de l\'engin n\'est pas spécifié'));
}
?>