<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un engin</title>
</head>

<body>
    <?php
    include ('../include/connexion.inc.php');
    include ('../include/entete2.inc.php');
    include ('include/entete3.inc.php');
    
    session_start();

    include ('include/sessionadmin.inc.php');


    include ('include/navbar2.inc.php'); ?>
    <div class="flex h-full bg-gray-100">
        <!-- Sidebar -->
        <?php include ('include/sidebaradmin.inc.php') ?>

        <!-- Main Content -->
        <main class="flex-grow p-8">
            <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
            <?php
            // Récupération des informations de l'engin depuis la base de données
            $typeEnginManager = new TypeEnginManager($db);
            $typeEngins = $typeEnginManager->getTypeEngin();
            ?>
            <div class="container mx-auto px-4 py-8 flex flex-col justify-center items-center h-screen">
                <h1 class="text-3xl font-bold mb-4">Modifier un engin</h1>
                <form id="editForm" enctype="multipart/form-data">
                    <!-- Champ ID (modifiable) -->
                    <div class="mb-4">
                        <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
                        <select id="id" name="id"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                            <option>Selectionnez un engin à modifier</option>
                            <?php foreach ($typeEngins as $engin): ?>
                                <option value="<?php echo $engin->getId(); ?>"><?php echo $engin->getId(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Champ Libellé -->
                    <div class="mb-4">
                        <label for="libelle" class="block text-sm font-medium text-gray-700">Libellé</label>
                        <input type="text" id="libelle" name="libelle"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>
                    <!-- Champ Image -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" id="image" name="image"
                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="flex justify-end gap-3 flex flex-row justify-center items-center">
                        <button type="submit"
                            class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Enregistrer</button>
                        <a href="listEngin.php"
                            class="bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">Annuler</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Fonction pour charger les informations de l'engin sélectionné
        document.getElementById('id').addEventListener('change', function () {
            var selectedId = this.value; // Récupérer la valeur de l'ID sélectionné

            // Effectuer une requête AJAX pour récupérer les informations de l'engin correspondant à l'ID sélectionné
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var engin = JSON.parse(xhr.responseText);

                        // Mettre à jour les champs du formulaire avec les informations de l'engin
                        document.getElementById('libelle').value = engin.libelle;
                        // Vous pouvez mettre à jour d'autres champs ici si nécessaire
                    } else {
                        console.error('Une erreur s\'est produite lors de la récupération des informations de l\'engin');
                    }
                }
            };

            xhr.open('GET', 'get_engin_info.php?id=' + selectedId);
            xhr.send();
        });
        document.getElementById('editForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Empêche la soumission du formulaire par défaut

            var formData = new FormData(this); // Récupère les données du formulaire

            // Envoi des données via AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Engin modifié avec succès !');
                        // Rafraîchir la page après la modification réussie
                        location.reload();
                    } else {
                        console.error('Une erreur s\'est produite lors de la modification de l\'engin');
                    }
                }
            };


            xhr.open('POST', 'modifier_engin.php'); // Définit la méthode et l'URL pour la requête
            xhr.send(formData); // Envoie les données du formulaire
        });


    </script>

</body>

</html>