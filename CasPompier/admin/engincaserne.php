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
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <?php include ('include/sidebaradmin.inc.php') ?>

        <!-- Main Content -->
        <main class="flex-grow p-8">
            <?php
            ob_start();

            // Vérifie si les données du formulaire ont été soumises via POST
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupère les valeurs du formulaire
                $caserneId = $_POST['caserne_id'];
                $typeEnginId = $_POST['type_engin_id'];

                // Crée un nouvel objet Engin
                $engin = new Engin([
                    'caserneid' => $caserneId,
                    'typeenginid' => $typeEnginId
                ]);

                // Instancie EnginManager avec la connexion à la base de données
                $enginManager = new EnginManager($db);

                // Ajoute l'engin à la base de données
                if ($enginManager->ajoutEngin($engin)) {
                    ob_end_flush();
                    // Redirige vers une page de confirmation ou affiche un message de succès
                    header("Location: engincaserne.php");
                    
                    exit();
                } else {
                    // Gère l'échec de l'ajout d'engin
                    echo "Une erreur est survenue lors de l'ajout de l'engin.";
                }
            }
            ?>
            <div class="bg-red-500 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h1 class="text-white text-4xl font-bold">Formulaire d'attribution d'engin</h1>
                        <p class="text-white mt-4">Ici vous pouvez attributer des engins à des casernes</p>
                    </div>
                </div>
            </div>
            <div class="container mx-auto px-4 py-8 flex flex-col justify-center items-center h-96">

                <form class="flex flex-col" method="POST" action="#">
                    <div class="mb-4">
                        <label for="caserne_id" class="block text-gray-700 mb-1">Caserne</label>
                        <select id="caserne_id" name="caserne_id"
                            class="form-select border border-gray-300 rounded-md w-full">
                            <option value="">Sélectionnez une caserne</option>
                            <?php
                            $casernemanager = new CaserneManager($db);
                            $dynacases = $casernemanager->dynacase();
                            foreach ($dynacases as $dynacase) {
                                echo '<option value="' . $dynacase['id'] . '">' . $dynacase['Nom'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="type_engin_id" class="block text-gray-700 mb-1">Type d'engin</label>
                        <select id="type_engin_id" name="type_engin_id"
                            class="form-select border border-gray-300 rounded-md w-full">
                            <option value="">Sélectionnez un type d'engin</option>
                            <?php
                            // Instanciation du TypeEnginManager avec la connexion à la base de données
                            $typeEnginManager = new TypeEnginManager($db);

                            // Récupération des types d'engin depuis la base de données
                            $typeEngins = $typeEnginManager->getTypeEngin();

                            // Vérification si des types d'engin ont été récupérés
                            if ($typeEngins) {
                                // Parcourir les types d'engin et afficher les options du menu déroulant
                                foreach ($typeEngins as $typeEngin) {
                                    echo '<option value="' . $typeEngin->getId() . '">' . $typeEngin->getLibelle() . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>



                    <button type="submit"
                        class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Soumettre</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>