<?php
include ('../include/connexion.inc.php');
include ('../include/entete2.inc.php');
include ('include/entete3.inc.php');
session_start();
include ('include/sessionadmin.inc.php');

include ('include/navbar2.inc.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricule = $_POST['matricule_pompier'];

    // Instanciation de PompierManager pour récupérer les informations du pompier par son matricule
    $pompierManager = new PompierManager($db);
    $pompier = $pompierManager->getPompierByMatricule($matricule);
}

?>

<div class="bg-red-500 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-white text-4xl font-bold">Modifier Pompier</h1>
            <p class="text-white mt-4">Ici vous pouvez modifier les informations d'un pompier</p>
        </div>
    </div>
</div>
<main class="container mx-auto px-4 py-12">
    <form method="post" action="">
        <input type="hidden" name="matricule_pompier" value="<?php echo $pompier->getMatricule(); ?>">
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom" value="<?php echo $pompier->getNom(); ?>"><br>
        <label for="prenom">Prénom:</label><br>
        <input type="text" id="prenom" name="prenom" value="<?php echo $pompier->getPrenom(); ?>"><br>
        <label for="tel">Téléphone:</label><br>
        <input type="text" id="tel" name="tel" value="<?php echo $pompier->getTel(); ?>"><br><br>
        <input type="submit" value="Modifier">
    </form>
</main>