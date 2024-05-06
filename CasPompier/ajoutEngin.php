<?php
include ('include/navbar.inc.php');
include ('include/connexion.inc.php');
include ('include/entete.inc.php');

// Instancier un objet TypeEnginManager avec la connexion à la base de données
$typeEnginManager = new TypeEnginManager($db);

// Définir le dossier où les images seront stockées
$upload_directory = 'images/storedimage/';

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs du formulaire
    $id = $_POST['id'];
    $libelle = $_POST['label'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name']; // Fichier temporaire téléchargé

    // Vérification si l'ID de l'engin existe déjà dans la base de données
    $existingEngin = $typeEnginManager->getTypeEnginById($id);
    if ($existingEngin) {
        echo "L'engin avec l'ID $id existe déjà dans la base de données.";
    } else {
        // Vérification si le fichier a été téléchargé avec succès
        if (move_uploaded_file($image_tmp, $upload_directory . $image)) {
            // Création d'un nouvel objet TypeEngin avec les valeurs du formulaire
            $nouvelEngin = new TypeEngin([
                'id' => $id,
                'libelle' => $libelle,
                'image' => $upload_directory . $image // Utilisation du chemin de l'image
            ]);

            // Ajout de l'engin à la base de données en utilisant la méthode addTypeEngin
            $typeEnginManager->addTypeEngin($nouvelEngin);
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }
    }
}

?>

<script>
    // Fonction pour afficher un aperçu de l'image
    function previewImage(input) {
        // Sélectionner l'élément img où l'aperçu de l'image sera affiché
        var preview = document.getElementById('imagePreview');

        // Vérifier si un fichier a été sélectionné
        if (input.files && input.files[0]) {
            // Créer un objet FileReader pour lire le contenu du fichier
            var reader = new FileReader();

            // Définir une fonction de rappel pour exécuter lorsque la lecture est terminée
            reader.onload = function (e) {
                // Mettre à jour l'attribut src de l'élément img avec les données de l'image
                preview.src = e.target.result;
            }

            // Lire le contenu du fichier en tant que URL de données
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<div class="bg-red-500 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-white text-4xl font-bold">Ajouter engin</h1>
            <p class="text-white mt-4">Ici vous pouvez ajouter des engins</p>
        </div>
    </div>
</div>

<div class="flex flex-col w-full max-w-sm mx-auto h-screen justify-center">
    <form class="flex flex-col gap-4" method="post" action="#" enctype="multipart/form-data">
        <div class="flex flex-col">
            <label for="id" class="text-sm font-medium">ID:</label>
            <input type="text" id="id" name="id"
                class="text-base border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500">
        </div>

        <div class="flex flex-col">
            <label for="image" class="text-sm font-medium">Image:</label>
            <!-- Champ de téléchargement de fichier avec fonction de prévisualisation -->
            <input type="file" id="image" name="image" onchange="previewImage(this)"
                class="border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500">
            <!-- Conteneur pour l'aperçu de l'image -->
            <img id="imagePreview" class="mt-2" style="max-width: 200px; max-height: 200px;">
        </div>

        <div class="flex flex-col">
            <label for="label" class="text-sm font-medium">Libellé:</label>
            <textarea id="label" name="label" rows="3"
                class="text-base border border-gray-300 rounded-md p-2 resize-none focus:outline-none focus:border-blue-500"></textarea>
        </div>

        <button type="submit"
            class="bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600">Ajouter</button>
    </form>
</div>

<?php include ('include/footer.inc.php'); ?>