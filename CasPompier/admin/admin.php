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
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <?php include ('include/sidebaradmin.inc.php') ?>

        <!-- Main Content -->
        <main class="flex-grow p-8">
            <h1 class="text-2xl font-bold mb-4">Tabeau de bord</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-lg font-bold mb-2">Nombre de pompiers</h2>
                    <p class="text-gray-600"><?php $pompierManager = new PompierManager($db);
                    echo $pompierManager->countPompiers(); ?></p>
                </div>

                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-lg font-bold mb-2">Nombre d'engins attribués à une caserne</h2>
                    <p class="text-gray-600"><?php $enginManager = new EnginManager($db);
                    echo $enginManager->countEngins(); ?></p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-lg font-bold mb-2">Nombre de Type d'engins</h2>
                    <p class="text-gray-600"><?php $TypeEnginManager = new TypeEnginManager($db);
                    echo $TypeEnginManager->countTypeEngin(); ?></p>
                    </p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-lg font-bold mb-2">Nombre d'employeurs</h2>
                    <p class="text-gray-600"><?php $EmployeurManager = new EmployeurManager($db);
                    echo $EmployeurManager->countEmployeur(); ?></p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-lg font-bold mb-2">Nombre de Pompier Professionnel</h2>
                    <p class="text-gray-600"><?php $ProfessionnelManager = new ProfessionnelManager($db);
                    echo $ProfessionnelManager->countProfessionnel(); ?></p>
                    </p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-lg font-bold mb-2">Nombre de Pompier Volontaire</h2>
                    <p class="text-gray-600"><?php $VolontaireManager = new VolontaireManager($db);
                    echo $VolontaireManager->countVolontaire(); ?></p>
                </div>
            </div>
        </main>
    </div>
</body>

</html>