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

    include ('include/sessionadmin.inc.php');

    include ('include/navbar2.inc.php'); ?>
    <div class="flex h-full bg-gray-100">
        <!-- Sidebar -->
        <?php include ('include/sidebaradmin.inc.php') ?>

        <!-- Main Content -->
        <main class="flex-grow p-8">
            <?php

            // Instanciation du TypeEnginManager avec la connexion à la base de données
            $typeEnginManager = new TypeEnginManager($db);

            // Récupération des engins depuis la base de données
            $engins = $typeEnginManager->getTypeEngin();
            ?>

            <div class="bg-red-500 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h1 class="text-white text-4xl font-bold">Liste des engins</h1>
                        <p class="text-white mt-4">Voici la liste des engins de nos casernes</p>
                    </div>
                </div>
            </div>

            <!-- Votre HTML existant -->
            <div class="containerdata p-10 mx-auto mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($engins as $engin): ?>
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <img src="<?php echo '../' . $engin->getImage(); ?>" alt="Image de la carte"
                                class="h-32 w-full object-cover rounded-t">
                            <h3 class="text-lg font-bold mt-4"><?php echo $engin->getLibelle(); ?></h3>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html>