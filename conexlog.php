<?php

//$_conextion = mysql_connect ("Localhost", "Admin", "123456");
$_conextion = mysql_connect ("localhost", "root", "");
if ($_conextion) {
	echo ("Error al intentar conectar:".mysql_error());
}

$_db_conextion = mysql_select_db ("Alumbrado_publico",$_conextion);
if ($_db_conextion) {
	echo ("No se encontro la base de datos:".mysql_error());
}

?>