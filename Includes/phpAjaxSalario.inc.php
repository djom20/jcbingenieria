<?php
// Script para ejecutar AJAX

// Insertar y actualizar tabla de Salarios
sleep(3);

// Inicializamos variables de mensajes y JSON
$respuestaOK = false;
$mensajeError = "No se puede ejecutar la aplicación";
$contenidoOK = "";

// Incluimos el archivo de funciones y conexión a la base de datos
include('mainFunctions.incSalario.php');

// Validar conexión con la base de datos
if($errorDbConexion == false){
	// Validamos qe existan las variables post
	if(isset($_POST) && !empty($_POST)){
		// Verificamos las variables de acción
		switch ($_POST['accion']) {
			case 'addSalario':
				// Armamos el query
				$query = sprintf("INSERT INTO tbl_salario
								 SET año_sal='%s', valor_sal='%s'",
								 $_POST['año_sal'],$_POST['valor_sal']);

				// Ejecutamos el query
				$resultadoQuery = $mysqli -> query($query);


				// Obtenemos el id de salario para edición
				$id_userOK = $mysqli -> insert_id;

				if($resultadoQuery == true){
					$respuestaOK = true;
					$mensajeError = "Se ha agregado el registro correctamente";
					$contenidoOK = '
						<tr>
							<td>'.$_POST['año_sal'].'</td>
							<td>'.$_POST['valor_sal'].'</td>
							<td style="text-align:center;"><a class="btn btn-mini" href="'.$id_userOK.'">Editar</a></td>
							<td style="text-align:center;"><a class="btn btn-danger btn-mini">Eliminar</a></td>
						</tr>
					';

				}
				else{
					$mensajeError = "No se puede guardar el registro en la base de datos";
				}

			break;
			
			case 'editSalario':
				// Armamos el query
				$query = sprintf("UPDATE tbl_salario
								 SET año_sal='%s', valor_sal='%s'
								 WHERE id_user=%d LIMIT 1",
							 $_POST['año_sal'],$_POST['valor_sal'],$_POST['id_user']);

				// Ejecutamos el query
				$resultadoQuery = $mysqli -> query($query);

				// Validamos que se haya actualizado el registro
				if($mysqli -> affected_rows == 1){
					$respuestaOK = true;
					$mensajeError = 'Se ha actualizado el registro correctamente';

					$contenidoOK = consultaSalario($mysqli);

				}else{
					$mensajeError = 'No se ha actualizado el registro';
				}


			break;

			default:
				$mensajeError = 'Esta acción no se encuentra disponible';
			break;
		}
	}
	else{
		$mensajeError = 'No se puede ejecutar la aplicación';
	}


}
else{
	$mensajeError = 'No se puede establecer conexión con la base de datos';
}

// Armamos array para convertir a JSON
$salidaJson = array("respuesta" => $respuestaOK,
					"mensaje" => $mensajeError,
					"contenido" => $contenidoOK);

echo json_encode($salidaJson);
?>