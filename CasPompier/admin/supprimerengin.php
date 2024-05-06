<?php
include ('../include/connexion.inc.php');
include ('../include/entete2.inc.php');
include ('include/entete3.inc.php');

session_start();

include ('include/navbar2.inc.php');
// Vérifier si la session admin n'est pas définie
include ('include/sessionadmin.inc.php');

$typeEnginManager = new TypeEnginManager($db);
$typeEngins = $typeEnginManager->getTypeEngin(); // Récupérer tous les types d'engins

// Vérifier si le formulaire a été soumis et si l'ID de l'engin à supprimer est défini
if (isset($_POST['confirm_delete']) && !empty($_POST['engin_id'])) {
    $enginId = $_POST['engin_id'];
    // Utiliser la méthode pour supprimer l'engin
    $success = $typeEnginManager->deleteTypeEnginById($enginId);
    if ($success) {
        // Afficher un message de réussite
        echo "<script>alert('L\'engin a été supprimé avec succès');</script>";
    } else {
        // Afficher un message d'erreur
        echo "<script>alert('Une erreur s\'est produite lors de la suppression de l\'engin');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'Engin</title>
    <!-- Ajoutez le lien vers le CDN de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <?php include ('include/sidebaradmin.inc.php'); ?>
        <!-- Main Content -->
        <main class="flex-grow p-8">
            <div class="bg-red-500 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h1 class="text-white text-4xl font-bold">Suppression d'Engin</h1>
                        <p class="text-white mt-4">Ici vous pouvez supprimer des engins</p>
                    </div>
                </div>
            </div>
            <form method="post" class="max-w-md mx-auto">
                <div class="mb-4">
                    <label for="engin_id" class="block text-gray-700 text-sm font-bold mb-2">Sélectionnez l'ID de
                        l'engin à supprimer :</label>
                    <select name="engin_id" id="engin_id"
                        class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:border-indigo-500 rounded-md">
                        <!-- Afficher les options avec les ID des engins -->
                        <option>Selectionnez un engin à supprimer</option>
                        <?php foreach ($typeEngins as $typeEngin): ?>
                            <option value="<?php echo $typeEngin->getId(); ?>"><?php echo $typeEngin->getId(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex justify-center">
                    <button type="submit" name="confirm_delete"
                        class="bg-red-500 text-white font-bold py-2 px-4 rounded mr-4">Supprimer</button>

                </div>
            </form>
        </main>
    </div>
</body>

</html>