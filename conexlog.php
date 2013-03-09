<?php

include('php_lib/config.ini.php');

$_conextion = mysql_connect (SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL);
if ($_conextion) {
	echo ("Error al intentar conectar:".mysql_error());
}

$_db_conextion = mysql_select_db (BASE_DATOS, $_conextion);
if ($_db_conextion) {
	echo ("No se encontro la base de datos:".mysql_error());
}

?>