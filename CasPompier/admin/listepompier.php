<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="h-full">
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

            // Instancier PompierManager avec GradeManager
            $PompierManager = new PompierManager($db);

            $gradeManager = new GradeManager($db);

            // Instancier ProfessionnelManager
            $professionnelManager = new ProfessionnelManager($db);

            // Instancier VolontaireManager
            $volontaireManager = new VolontaireManager($db);

            // Instancier AffectationManager
            $affectationManager = new AffectationManager($db);

            // Obtenir tous les pompiers
            $pompiers = $PompierManager->getAllPompiers();

            ?>
            <div class="bg-red-500 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h1 class="text-white text-4xl font-bold">Liste Pompier</h1>
                        <p class="text-white mt-4">Ici vous pouvez regarder les différents pompiers</p>
                    </div>
                </div>
            </div>
            <main class="container mx-auto px-4 py-12">
                <div class="mt-8">
                    <div class="mt-8">
                        <table class="bg-white rounded shadow w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800 font-bold">Matricule</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800 font-bold">Nom</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800 font-bold">Prénom</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800 font-bold">Téléphone</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800 font-bold">Grade</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800 font-bold">Caserne</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800 font-bold">Type de pompier</th>
                                    <th class="px-4 py-2 bg-gray-200 text-gray-800 font-bold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Vérifier si des pompiers sont trouvés
                                if (!empty($pompiers)) {
                                    foreach ($pompiers as $pompier) {
                                        // Obtenir le grade du pompier en utilisant la méthode getPompierGrade
                                        $grade = $PompierManager->getPompierGrade($pompier->getId(), $gradeManager);

                                        // Obtenir la caserne du pompier en utilisant son matricule
                                        $caserne = $affectationManager->getCaserneByMatricule($pompier->getMatricule());

                                        // Vérifier le rôle du pompier
                                        $role = 'Non affecté';
                                        if (in_array($pompier->getMatricule(), $professionnelManager->getRoleProfessionnel())) {
                                            $role = 'Professionnel';
                                        } elseif (in_array($pompier->getMatricule(), $volontaireManager->getRoleVolontaire())) {
                                            $role = 'Volontaire';
                                        }

                                        // Afficher les détails du pompier dans une ligne de tableau HTML
                                        echo '<tr>
                                        <td class="px-4 py-2">' . $pompier->getMatricule() . '</td>
                                        <td class="px-4 py-2">' . $pompier->getNom() . '</td>
                                        <td class="px-4 py-2">' . $pompier->getPrenom() . '</td>
                                        <td class="px-4 py-2">' . $pompier->getTel() . '</td>
                                        <td class="px-4 py-2">' . $grade . '</td>
                                        <td class="px-4 py-2">' . ($caserne ? $caserne->getNom() : 'Non affecté') . '</td>
                                        <td class="px-4 py-2">' . $role . '</td>
                                        <td class="px-4 py-2 flex space-x-2"> <!-- Utilisez flex pour aligner les boutons -->
                                            <form action="deletePompier.php" method="post">
                                                <input type="hidden" name="matricule_pompier" value="' . $pompier->getMatricule() . '">
                                                <button type="submit" name="supprimer" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>';
                                    }
                                } else {
                                    // Afficher un message si aucun pompier n'est trouvé
                                    echo "Pas de pompier trouvés";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </main>
    </div>
</body>

</html>