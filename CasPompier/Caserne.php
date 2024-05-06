<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .tooltip {
            position: absolute;
            background-color: black;
            color: white;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
            z-index: 9999;
        }

        .circle {
            width: 50px;
            height: 50px;
        }

        .circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            /* Rendre l'image circulaire */
        }
    </style>
</head>

<body>
    <?php
    include ('include/navbar.inc.php');
    include ('include/connexion.inc.php');
    include ('include/entete.inc.php');
    ?>
    <div class="bg-red-500 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-white text-4xl font-bold">Liste des caserne</h1>
                <p class="text-white mt-4">Voici la liste de nos casernes</p>
            </div>
        </div>
    </div>
    <div class="container mx-auto h-screen bg-white flex justify-center items-center">
        <div class="grid grid-cols-3 gap-4">
            <?php
            $caserneManager = new CaserneManager($db);
            $enginManager = new EnginManager($db);
            $typeEnginManager = new TypeEnginManager($db);

            // Récupérer les casernes depuis la base de données
            $caserneData = $caserneManager->dynacase();

            // Vérifier si des données ont été récupérées
            if ($caserneData) {
                // Parcourir les données récupérées
                foreach ($caserneData as $caserneInfo) {
                    // Créer un objet Caserne à partir des données récupérées
                    $caserne = new Caserne($caserneInfo);

                    // Extraire les valeurs à afficher dans la carte
                    $nom = $caserne->getNom();
                    $image = $caserne->getImage();
                    $description = $caserne->getDescription();


                    // Afficher les valeurs dans la carte HTML
                    echo '<div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg">';
                    echo '<img src="' . $image . '" alt="Image" class="w-full h-48 object-cover">'; // Utiliser les classes Tailwind CSS pour définir la taille de l'image
                    echo '<div class="p-4">';
                    echo '<h2 class="text-xl font-bold mb-2">' . $nom . '</h2>';
                    echo '<p class="text-gray-700">' . $description . '</p>';
                    echo '<p class="text-gray-700">Voici les Engins attribués à la caserne :</p>';
                    echo '</div>';
                    echo '<div class="flex justify-center items-center bg-gray-200 p-2">';
                    // Ajouter une ligne avec des cercles
                    echo '<div class="flex space-x-4">';

                    // Récupérer les types d'engins depuis la base de données
                    $typeEngins = $typeEnginManager->getTypeEngin();

                    // Vérification si des types d'engin ont été récupérés
                    if ($typeEngins) {
                        // Tableau pour suivre les engins déjà affichés et leur nombre d'occurrences
                        $enginsOccurences = [];

                        // Parcourir les types d'engins
                        foreach ($typeEngins as $typeEngin) {
                            // Récupérer l'ID du type d'engin
                            $typeEnginId = $typeEngin->getId();

                            // Appeler la méthode pour récupérer les détails des engins attribués à cette caserne et ce type d'engin
                            $enginDetails = $enginManager->getEnginDetails($caserne->getId(), $typeEnginId);

                            // Vérifier si des détails d'engin ont été récupérés
                            if ($enginDetails) {
                                // Compter le nombre d'occurrences de cet engin
                                $occurrences = count($enginDetails);

                                // Vérifier si cet engin a déjà été affiché
                                if (!isset($enginsOccurences[$typeEngin->getLibelle()])) {
                                    // Ajouter l'engin au tableau des occurrences
                                    $enginsOccurences[$typeEngin->getLibelle()] = $occurrences;
                                }

                                // Afficher l'image de l'engin avec le nombre d'occurrences dans l'infobulle
                                echo '<div class="bg-gray-400 rounded-full h-12 w-12 flex items-center justify-center circle">';
                                echo '<img src="' . $enginDetails[0]['Image'] . '" alt="' . $typeEngin->getLibelle() . '" class="h-full w-full" data-tooltip="' . $typeEngin->getLibelle() . ' (' . $occurrences . ')">';
                                echo '</div>';
                            }
                        }
                    }

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // Aucune donnée trouvée
                echo "Aucune caserne trouvée.";
            }

            ?>
        </div>


    </div>
    <?php include ('include/footer.inc.php'); ?>


    <script>
        // Sélectionnez tous les éléments img ayant un attribut data-tooltip
        document.querySelectorAll('img[data-tooltip]').forEach(function (img) {
            // Ajoutez un gestionnaire d'événement pour l'événement mouseover
            img.addEventListener('mouseover', function (event) {
                // Créez un élément span pour afficher le texte de l'infobulle
                var tooltip = document.createElement('span');
                tooltip.textContent = img.getAttribute('data-tooltip');
                tooltip.className = 'tooltip'; // Appliquez une classe CSS à l'infobulle

                // Positionnez l'infobulle au-dessus de la souris
                tooltip.style.top = (event.pageY - 20) + 'px';
                tooltip.style.left = (event.pageX + 10) + 'px';

                // Ajoutez l'infobulle au document
                document.body.appendChild(tooltip);

                // Ajoutez un gestionnaire d'événement pour l'événement mouseout
                img.addEventListener('mouseout', function () {
                    // Supprimez l'infobulle lorsque la souris quitte l'image
                    tooltip.remove();
                });
            });
        });
    </script>
</body>

</html>