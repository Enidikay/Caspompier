<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .valid-input {
        background-color: #d1f5be;
        /* Vert clair */
    }

    .invalid-input {
        background-color: #f5b7b1;
        /* Rouge clair */
    }

    #employeurFieldset {
        display: none;
    }
</style>

<body>
    <?php

    include ('../include/connexion.inc.php');
    include ('../include/entete2.inc.php');
    include ('include/entete3.inc.php');

    session_start();
    include ('include/sessionadmin.inc.php');
    // Vérifier si la session admin n'est pas définie
    if (!isset($_SESSION['admin'])) {
        // Redirection vers l'index
        header("Location: ../index.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    }


    include ('include/navbar2.inc.php'); ?>
    <div class="flex h-full bg-gray-100">
        <!-- Sidebar -->
        <?php include ('include/sidebaradmin.inc.php') ?>

        <!-- Main Content -->
        <main class="flex-grow p-8">
            <div class="bg-red-500 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h1 class="text-white text-4xl font-bold">Ajout Pompier</h1>
                        <p class="text-white mt-4">Ici vous pouvez ajouter des pompier à des casernes</p>
                    </div>
                </div>
            </div>
            <div>
                <?php

                $manager = new PompierManager($db);
                $affectationManager = new AffectationManager($db);

                if (isset($_POST['submit'])) {
                    // Sécurisation : filtrage des données avant ajout dans la base de données
                    $matricule = intval($_POST['matricule']); // Convertit la valeur en entier
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $ddn = $_POST['date_naissance'];
                    $tel = $_POST['telephone'];
                    $sexe = $_POST['sexe'];
                    $id_grade = $_POST['grade'];
                    $id_caserne = $_POST['caserne'];

                    // Crée un nouvel objet Pompier avec les données filtrées
                    $pompier = new Pompier(['Matricule' => $matricule, 'Nom' => $nom, 'Prenom' => $prenom, 'Ddn' => $ddn, 'Tel' => $tel, 'Sexe' => $sexe, 'Id' => $id_grade]);
                    $manager->add($pompier);
                    // Affiche le pompier pour vérification
                    echo '<tr><td colspan="6"><pre>';
                    var_dump($pompier);
                    echo '</pre></td></tr>';

                    // Vérifie quelle option a été sélectionnée
                    if ($_POST['type_pompier'] === 'professionnel') {
                        // Si c'est un professionnel, créer un nouvel objet Professionnel
                        $date_embauche = $_POST['date_embauche'];
                        $professionnel = new Professionnel(['Matricule' => $matricule, 'DateEmbauche' => $date_embauche]);

                        // Ajoute le professionnel à la base de données via le gestionnaire ProfessionnelManager
                        $professionnelManager = new ProfessionnelManager($db);
                        $professionnelManager->add($professionnel);
                    } elseif ($_POST['type_pompier'] === 'volontaire') {
                        // Si c'est un volontaire, créer un nouvel objet Volontaire
                        $employeur = intval($_POST['employeur']);
                        $bip = $_POST['bip'];
                        $volontaire = new Volontaire(['Matricule' => $matricule, 'Id' => $employeur, 'Bip' => $bip]);

                        // Ajoute le volontaire à la base de données via le gestionnaire VolontaireManager
                        $volontaireManager = new VolontaireManager($db);
                        $volontaireManager->ajouterVolontaire($volontaire);
                    }

                    // Crée un nouvel objet Affectation avec les données filtrées
                    $affectation = new Affectation(['Matricule' => $matricule, 'Id' => $id_caserne]);

                    // Ajoute l'affectation à la base de données
                    $affectationManager->addAffectation($affectation);

                    echo '<tr><td colspan="6"><pre>';
                    var_dump($affectation);
                    echo '</pre></td></tr>';
                }
                ?>



                <div class="container mx-auto mt-10 w-full max-w-lg pb-10">
                    <form method="post" action="#" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="matricule"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Matricule</label>
                            <input type="text" id="matricule" name="matricule"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="date_naissance"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date
                                de naissance</label>
                            <input type="date" id="date_naissance" name="date_naissance"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                required>
                        </div>


                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="nom"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nom</label>
                                <input type="text" id="nom" name="nom"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    required>
                            </div>
                            <div>
                                <label for="prenom"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Prénom</label>
                                <input type="text" id="prenom" name="prenom"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <fieldset class="flex flex-row">
                                <legend class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sexe
                                </legend>
                                <div class="flex items-center pr-5">
                                    <input type="radio" id="homme" name="sexe" value="homme"
                                        class="mr-2 text-blue-500 focus:ring-blue-500 dark:text-blue-400 dark:focus:ring-blue-400">
                                    <label for="homme" class="text-sm text-gray-900 dark:text-gray-300">Homme</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="femme" name="sexe" value="femme"
                                        class="mr-2 text-pink-500 focus:ring-pink-500 dark:text-pink-400 dark:focus:ring-pink-400">
                                    <label for="femme" class="text-sm text-gray-900 dark:text-gray-300">Femme</label>
                                </div>
                            </fieldset>
                        </div>

                        <div class="mb-4">
                            <label for="grade"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Grade</label>
                            <select id="grade" name="grade"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                required>
                                <option value="">Choisissez un grade</option>
                                <?php
                                $grademanager = new GradeManager($db);
                                $dynagrades = $grademanager->dynagrade();
                                foreach ($dynagrades as $dynagrade) {
                                    echo '<option value="' . $dynagrade['id'] . '">' . $dynagrade['libellé'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="telephone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Numéro de
                                téléphone</label>
                            <input type="tel" id="telephone" name="telephone"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="caserne"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Caserne</label>
                            <select id="caserne" name="caserne"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                required>
                                <option value="">Choisissez une caserne</option>
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
                            <fieldset class="flex flex-row">
                                <legend class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Type
                                    de pompier
                                </legend>
                                <div class="flex items-center pr-5">
                                    <input type="radio" id="professionnel" name="type_pompier" value="professionnel"
                                        class="mr-2 text-blue-500 focus:ring-blue-500 dark:text-blue-400 dark:focus:ring-blue-400">
                                    <label for="professionnel"
                                        class="text-sm text-gray-900 dark:text-gray-300">Professionnel</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="volontaire" name="type_pompier" value="volontaire"
                                        class="mr-2 text-pink-500 focus:ring-pink-500 dark:text-pink-400 dark:focus:ring-pink-400">
                                    <label for="volontaire"
                                        class="text-sm text-gray-900 dark:text-gray-300">Volontaire</label>
                                </div>
                            </fieldset>
                        </div>

                        <fieldset id="employeurFieldset" style="display: none;">
                            <div class="mb-4">
                                <label for="employeur"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Employeur</label>
                                <select id="employeur_select" name="employeur" value="employeur"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                    <option value="">Choisissez un employeur</option>
                                    <?php
                                    $employeurManager = new EmployeurManager($db);
                                    $employeurs = $employeurManager->getEmployeurs();

                                    foreach ($employeurs as $employeur) {
                                        echo '<option value="' . $employeur['id'] . '">' . $employeur['Nom'] . ' ' . $employeur['Prenom'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="bip"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bip</label>
                                <input type="text" id="bip" name="bip"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            </div>
                        </fieldset>

                        <fieldset id="dateEmbaucheField" style="display: none;">
                            <div class="mb-4">
                                <label for="date_embauche"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date
                                    d'embauche</label>
                                <input type="date" id="date_embauche" name="date_embauche"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            </div>
                        </fieldset>

                        <button type="submit" name="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:ring-blue-500 focus:ring-offset-blue-200">Valider
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const volontaireRadio = document.getElementById('volontaire');
        const employeurFieldset = document.getElementById('employeurFieldset');
        const dateEmbaucheField = document.getElementById('dateEmbaucheField');

        volontaireRadio.addEventListener('change', function () {
            if (volontaireRadio.checked) {
                employeurFieldset.style.display = 'block';
                dateEmbaucheField.style.display = 'none';
            } else {
                employeurFieldset.style.display = 'none';
                dateEmbaucheField.style.display = 'block';
            }
        });

        const professionnelRadio = document.getElementById('professionnel');

        professionnelRadio.addEventListener('change', function () {
            if (professionnelRadio.checked) {
                employeurFieldset.style.display = 'none';
                dateEmbaucheField.style.display = 'block';
            } else {
                employeurFieldset.style.display = 'block';
                dateEmbaucheField.style.display = 'none';
            }
        });
    });
</script>

</html>