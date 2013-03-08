<?php

include_once('php_lib/login.class.php'); //incluir las funciones

if (!Login::estoy_logeado()) { // si no estoy logeado
    header('Location: Index.php'); //saltamos a la página de login
    die('Acceso no autorizado'); // por si falla el header (solo se puede mandar las cabeceras si no se muestra nada)
}

//si esta logeado el usuario continua con el script.
?>
