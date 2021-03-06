<?php
// Variable que indica el status de la conexión a la base de datos
$errorDbConexion = false;

// Función para extraer el listado de usurios
function consultaSalario($linkDB){

	$salida = '';

	$consulta = $linkDB -> query("SELECT año_sal,valor_sal
								  FROM tbl_salario ORDER BY año_sal ASC");

	if($consulta -> num_rows != 0){

		//Convertimos la información obtenida de la consulta
		while($listadoOK = $consulta -> fetch_assoc())
		{
			$salida .= '
				<tr>
					<td style="text-align:center;">'.$listadoOK['año_sal'].'</td>
					<td style="text-align:center;">'.$listadoOK['valor_sal'].'</td>
					<td style="text-align:center;"><a class="btn btn-mini" href="">Editar</a></td>
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