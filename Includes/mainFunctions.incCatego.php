<?php
// Variable que indica el status de la conexión a la base de datos
$errorDbConexion = false;

// Función para extraer el listado de usurios
function consultaCatego($linkDB){

	$salida = '';

	$consulta = $linkDB -> query("SELECT id_USUARIO_MYSQL,nomb_categoria,sal_categoria
								  FROM tbl_categorias ORDER BY nomb_categoria ASC");

	if($consulta -> num_rows != 0){

		//Convertimos la información obtenida de la consulta
		while($listadoOK = $consulta -> fetch_assoc())
		{
			$salida .= '
				<tr>
					<td>'.$listadoOK['nomb_categoria'].'</td>
					<td>'.$listadoOK['sal_categoria'].'</td>
					<td style="text-align:center;"><a class="btn btn-mini" href="'.$listadoOK['id_USUARIO_MYSQL'].'">Editar</a></td>
					<td style="text-align:center;"><a class="btn btn-danger btn-mini">Eliminar</a></td>
				<tr>
			';
		}

	}
	else{
		$salida = '
			<tr id="sinDatos">
				<td colspan="3" style="text-align: center;">NO HAY REGISTROS EN LA BASE DE DATOS</td>
	   		</tr>
		';
	}

	return $salida;
}


include('mainConexion.php');