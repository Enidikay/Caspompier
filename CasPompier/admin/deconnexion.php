<?php
// Détruire la session en cours
session_start();
session_destroy();

// Redirection vers une page de confirmation ou une autre page de votre choix
header("Location: ../index.php");
exit();
?>