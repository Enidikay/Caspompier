<?php
function GET_ADMIN_ID()
{
    // Vérifier si la session admin est définie et si elle contient l'ID de l'administrateur
    if (isset($_SESSION['admin']) && isset($_SESSION['admin']->idadmin)) {
        return $_SESSION['admin']->idadmin;
    } else {
        // Si l'ID de l'administrateur n'est pas présent dans la session, renvoyer null
        return null;
    }
}

// Appel de la fonction pour récupérer l'ID de l'admin
GET_ADMIN_ID();

// Vous pouvez maintenant utiliser $id_admin dans votre code pour obtenir l'ID de l'administrateur
?>