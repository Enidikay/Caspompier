<?php
// Démarrage de la session
session_start();

// Vérification de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Inclusion de la classe Admin et AdminManager
    include ('admin/classes/admin.class.php');
    include ('admin/classes/adminManager.class.php');

    // Connexion à la base de données
    include ('include/connexion.inc.php');

    // Création d'un objet AdminManager avec la connexion PDO
    $adminManager = new AdminManager($db);

    // Récupération de tous les administrateurs
    $admins = $adminManager->getAllAdmins();

    $authenticated = false;

    // Vérification des identifiants
    foreach ($admins as $admin) {
        if ($username == $admin->getUsername() && md5($password) == $admin->getPassword()) {
            // Authentification réussie
            $_SESSION['admin'] = $admin;
            header("Location: admin/admin.php");
            exit();
        }
    }
    if (!$authenticated) {
        sleep(5);
    }
    // Identifiants incorrects
    $erreur = "<p style='color: red;'>Nom d'utilisateur ou mot de passe incorrect.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <?php include ('include/navbar.inc.php'); ?>
    <section class="flex items-center justify-center h-screen bg-gray-100">
        <div class="max-w-md w-full bg-white rounded shadow-lg">
            <div class="px-6 py-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Connexion</h2>
                <form method="post" onsubmit="return validateForm()">
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                        <input type="text" id="username" name="username"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            placeholder="Nom d'utilisateur">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
                        <input type="password" id="password" name="password"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            placeholder="Votre mot de passe">
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">Se
                        connecter</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            // Vérification si les champs contiennent des caractères spéciaux
            var usernameRegex = /^[a-zA-Z0-9\s]+$/;
            var passwordRegex = /^(?=.*[a-zA-Z])(?=.*[0-9!@#$%^&*])[a-zA-Z0-9!@#$%^&*]+$/;

            if (!usernameRegex.test(username)) {
                alert("Les caractères spéciaux ne sont pas autorisés dans le nom d'utilisateur.");
                return false;
            }

            
            return true;
        }

    </script>
</body>

</html>