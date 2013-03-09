<?php
// Constantes conexión con la base de datos
include('php_lib/config.ini.php');


// Verificar constantes para conexión al servidor
	if(defined('SERVIDOR_MYSQL') && defined('USUARIO_MYSQL') && defined('PASSWORD_MYSQL') && defined('BASE_DATOS'))
	{
		// Conexión con la base de datos

		$mysqli = new mysqli(SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL, BASE_DATOS);

		// Verificamos si hay error al conectar
		if (mysqli_connect_error()) {
		    $errorDbConexion = true;
		}

		// Evitando problemas con acentos
		$mysqli -> query('SET NAMES "utf8"');
	}
?>