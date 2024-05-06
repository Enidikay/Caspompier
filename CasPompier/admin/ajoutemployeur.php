<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php


    include ('../include/connexion.inc.php');
    include ('../include/entete2.inc.php');
    include ('include/entete3.inc.php');

    session_start();
    include ('include/navbar2.inc.php');
    include ('include/sessionadmin.inc.php');

    ?>

    <div class="flex h-full bg-gray-100">
        <!-- Sidebar -->
        <?php include ('include/sidebaradmin.inc.php') ?>

        <!-- Main Content -->
        <main class="flex-grow p-8">
            <?php
            // Instancier un objet EmployeurManager avec la connexion à la base de données
            $employeurManager = new EmployeurManager($db);

            // Vérification si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupération des valeurs du formulaire
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $tel = $_POST['tel'];

                // Ajout de l'employeur à la base de données
                $employeurManager->ajouterEmployeur($nom, $prenom, $tel);
            }

            ?>

            <div class="bg-red-500 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h1 class="text-white text-4xl font-bold">Ajouter Employeur</h1>
                        <p class="text-white mt-4">Ici vous pouvez ajouter un nouvel employeur</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-full max-w-sm mx-auto h-screen justify-center">
                <form class="flex flex-col gap-4" method="post" action="#">
                    <div class="flex flex-col">
                        <label for="nom" class="text-sm font-medium">Nom:</label>
                        <input type="text" id="nom" name="nom"
                            class="text-base border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="flex flex-col">
                        <label for="prenom" class="text-sm font-medium">Prénom:</label>
                        <input type="text" id="prenom" name="prenom"
                            class="text-base border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="flex flex-col">
                        <label for="tel" class="text-sm font-medium">Téléphone:</label>
                        <input type="tel" id="tel" name="tel"
                            class="text-base border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500">
                    </div>

                    <button type="submit"
                        class="bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600">Ajouter</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>