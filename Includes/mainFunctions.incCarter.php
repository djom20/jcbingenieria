<?php
// Variable que indica el status de la conexión a la base de datos
$errorDbConexion = false;

include('mainConexion.php');

// Función para extraer el listado de usurios
function consultaCartera($linkDB='', $id=''){

	$salida = '';

	$consulta = $linkDB -> query("SELECT `tbl_cartera`.`id_cartera`,`tbl_cartera`.`id_factura`,`tbl_cartera`.`periodo`,`tbl_cartera`.`fecha`,`tbl_cartera`.`id_contribuyente`,`tbl_contribuyente`.`nomb_contribuyente`,`tbl_cartera`.`valor`,`tbl_cartera`.`abonado`,`tbl_cartera`.`saldo` FROM `tbl_cartera`,`tbl_contribuyente` WHERE `tbl_cartera`.`id_contribuyente` = `tbl_contribuyente`.`id_contribuyente` AND `tbl_cartera`.`id_contribuyente` =".$id);

	if($consulta -> num_rows != 0){

		//Convertimos la información obtenida de la consulta
		while($listadoOK = $consulta -> fetch_assoc())
		{
			$salida .= '
				<tr>
					<td style="text-align:center;">'.$listadoOK['id_factura'].'</td>
					<td style="text-align:center;">'.$listadoOK['periodo'].'</td>
					<td style="text-align:center;">'.$listadoOK['fecha'].'</td>
					<td style="text-align:center;">'.$listadoOK['id_contribuyente'].'</td>
					<td style="text-align:center;">'.$listadoOK['nomb_contribuyente'].'</td>
					<td style="text-align:center;">$'.$listadoOK['valor'].'</td>
					<td style="text-align:center;">$'.$listadoOK['abonado'].'</td>
					<td style="text-align:center;">$'.$listadoOK['saldo'].'</td>
					<td style="text-align:center;"><input type="text" name="abono'.$listadoOK['id_cartera'].'" placeholder="Abonar" /></td>
					<td style="text-align:center;"><a href="'.$listadoOK['id_cartera'].'" class="btn btn-danger btn-mini"><i class="icon-trash icon-white"></i></a></td>
				<tr>
			';
		}

	}
	else{
		$salida = '
			<tr id="sinDatos">
				<td colspan="11" style="text-align: center;">NO HAY REGISTROS EN LA BASE DE DATOS</td>
	   		</tr>
		';
	}

	return $salida;
}

