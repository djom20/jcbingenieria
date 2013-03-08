<?php

// Constantes conexión con la base de datos
define("server", 'localhost');
//define("user", 'Admin');
define("user", 'root');
//define("pass", '123456');
define("pass", '');
define("mainDataBase", 'Alumbrado_publico');

mysql_connect("localhost","root","");
//mysql_connect("localhost","Admin","123456");
mysql_select_db("Alumbrado_publico");

// Variable que indica el status de la conexión a la base de datos
$errorDbConexion = false;

// Función para extraer el listado de Contribuyentes
function consultaContri($linkDB){

	$salida = '';

	$consulta = $linkDB -> query("SELECT id_user,id_contribuyente,nomb_contribuyente,categ_contribuyente,dir_contribuyente,ciud_contribuyente
								  FROM tbl_contribuyente ORDER BY nomb_contribuyente ASC");

	if($consulta -> num_rows != 0){

		//Convertimos la información obtenida de la consulta
		while($listadoOK = $consulta -> fetch_assoc())
		{
			$salida .= '
				<tr>
					<td>'.$listadoOK['id_contribuyente'].'</td>
					<td>'.$listadoOK['nomb_contribuyente'].'</td>
					<td>'.$listadoOK['categ_contribuyente'].'</td>
					<td>'.$listadoOK['dir_contribuyente'].'</td>
					<td>'.$listadoOK['ciud_contribuyente'].'</td>
					<td style="text-align:center;"><a class="btn btn-mini" href="'.$listadoOK['id_user'].'">Editar</a></td>
					<td style="text-align:center;"><a class="btn btn-danger btn-mini" onclick="Confirmar('.$listadoOK['id_user'].');">Eliminar</a></td>
				<tr>
			';
		}

	}
	else{
		$salida = '
			<tr id="sinDatos">
				<td colspan="6" style="text-align: center;">NO HAY REGISTROS EN LA BASE DE DATOS</td>
	   		</tr>
		';
	}

	return $salida;
}

// Función para extraer el listado de Contribuyentes con limites
function consultaContri_limit($linkDB, $primer_registro, $limit){

	$salida = '';

	$consulta = $linkDB -> query("SELECT id_user,id_contribuyente,nomb_contribuyente,categ_contribuyente,dir_contribuyente,ciud_contribuyente
								  FROM tbl_contribuyente ORDER BY nomb_contribuyente ASC limit ".$primer_registro.", ".$limit);

	if($consulta -> num_rows != 0){

		//Convertimos la información obtenida de la consulta
		while($listadoOK = $consulta -> fetch_assoc())
		{
			$salida .= '
				<tr>
					<td>'.$listadoOK['id_contribuyente'].'</td>
					<td>'.$listadoOK['nomb_contribuyente'].'</td>
					<td>'.$listadoOK['categ_contribuyente'].'</td>
					<td>'.$listadoOK['dir_contribuyente'].'</td>
					<td>'.$listadoOK['ciud_contribuyente'].'</td>
					<td style="text-align:center;"><a class="btn btn-mini" href="'.$listadoOK['id_user'].'">Editar</a></td>
					<td style="text-align:center;"><a class="btn btn-danger btn-mini" onclick="Confirmar('.$listadoOK['id_user'].');">Eliminar</a></td>
				<tr>
			';
		}

	}
	else{
		$salida = '
			<tr id="sinDatos">
				<td colspan="6" style="text-align: center;">NO HAY REGISTROS EN LA BASE DE DATOS</td>
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