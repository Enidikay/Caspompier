<?php
 function chargerClasse3($classname)
 {
     // Vérifiez d'abord si le fichier de la classe existe
     $class_file = 'classes/' . $classname . '.class.php';
     if (file_exists($class_file)) {
         require $class_file;
     }
 }
 spl_autoload_register('chargerClasse3');