<?php

// Constantes conexión con la base de datos
define("server", 'localhost');
//define("user", 'Admin');
define("user", 'root');
//define("pass", '123456');
define("pass", '');
define("mainDataBase", 'Alumbrado_publico');

// Variable que indica el status de la conexión a la base de datos
$errorDbConexion = false;

// Función para extraer el listado de usurios
function consultaCatego($linkDB){

	$salida = '';

	$consulta = $linkDB -> query("SELECT id_user,nomb_categoria,sal_categoria
								  FROM tbl_categorias ORDER BY nomb_categoria ASC");

	if($consulta -> num_rows != 0){
		
		//Convertimos la información obtenida de la consulta
		while($listadoOK = $consulta -> fetch_assoc())
		{
			$salida .= '
				<tr>
					<td>'.$listadoOK['nomb_categoria'].'</td>
					<td>'.$listadoOK['sal_categoria'].'</td>
					<td style="text-align:center;"><a class="btn btn-mini" href="'.$listadoOK['id_user'].'">Editar</a></td>
					<td style="text-align:center;"><a class="btn btn-danger btn-mini">Eliminar</a></td>
				<tr>
			';
		}

	}
	else{
		$salida = '
			<tr id="sinDatos">
				<td colspan="2" style="text-align: center;">NO HAY REGISTROS EN LA BASE DE DATOS</td>
	   		</tr>
		';
	}

	return $salida;
}

// Verificar constantes para conexión al servidor
if(defined('server') && defined('user') && defined('pass') && defined('mainDataBase'))
{
	// Conexión con la base de datos
	
	$mysqli = new mysqli(server, user, pass, mainDataBase);
	
	// Verificamos si hay error al conectar
	if (mysqli_connect_error()) {
	    $errorDbConexion = true;
	}

	// Evitando problemas con acentos
	$mysqli -> query('SET NAMES "utf8"');
}