<?php
// Script para ejecutar AJAX

// Insertar y actualizar tabla de usuarios
sleep(2);

// Inicializamos variables de mensajes y JSON
$respuestaOK = false;
$mensajeError = "No se puede ejecutar la aplicación";
$contenidoOK = "";

// Incluimos el archivo de funciones y conexión a la base de datos
include('mainFunctions.incUsers.php');

$userTipoOK = array("Administrador" => "btn-inverse",
					  "Usuario" => "btn-info");

$estadoTipoOK = array("Activo" => "btn-success",
					  "Suspendido" => "btn-warning");

// Validar conexión con la base de datos
if($errorDbConexion == false){
	// Validamos qe existan las variables post
	if(isset($_POST) && !empty($_POST)){
		// Verificamos las variables de acción
		switch ($_POST['accion']) {
			case 'addUser':
				// Armamos el query
				$query = sprintf("INSERT INTO tbl_usuarios
								 SET usr_id='%s', usr_nombre='%s', usr_pass='%s', usr_tipo='%s', usr_estado='%s'",
								 $_POST['usr_id'],$_POST['usr_nombre'],$_POST['usr_tipo'],$_POST['usr_estado']);

				// Ejecutamos el query
				$resultadoQuery = $mysqli -> query($query);


				// Obtenemos el id de user para edición
				$id_userOK = $mysqli -> insert_id;

				if($resultadoQuery == true){
					$respuestaOK = true;
					$mensajeError = "Se ha agregado el registro correctamente";
					$contenidoOK = '
						<tr>
							<td>'.$_POST['usr_id'].'</td>
							<td>'.$_POST['usr_nombre'].'</td>
							<td>'.$_POST['usr_pass'].'</td>
				<td style="text-align:center;"><span class="btn btn-mini '.$userTipoOK[$_POST['usr_tipo']].'">'.$_POST['usr_tipo'].'</span></td>
				<td style="text-align:center;"><span class="btn btn-mini '.$estadoTipoOK[$_POST['usr_estado']].'">'.$_POST['usr_estado'].'</span></td>
							<td style="text-align:center;"><a class="btn btn-mini" href="'.$id_userOK.'">Editar</a></td>
							<td style="text-align:center;"><a class="btn btn-danger btn-mini">Eliminar</a></td>
						</tr>
					';

				}
				else{
					$mensajeError = "No se puede guardar el registro en la base de datos";
				}

			break;
			
			case 'editUser':
				// Armamos el query
				$query = sprintf("UPDATE tbl_usuarios
								 SET usr_id='%s', usr_nombre='%s', usr_pass='%s', usr_tipo='%s', usr_estado='%s'
								 WHERE id_user=%d LIMIT 1",
							 $_POST['usr_id'],$_POST['usr_nombre'],$_POST['usr_pass'],$_POST['usr_tipo'],$_POST['usr_estado'],$_POST['id_user']);

				// Ejecutamos el query
				$resultadoQuery = $mysqli -> query($query);

				// Validamos que se haya actualizado el registro
				if($mysqli -> affected_rows == 1){
					$respuestaOK = true;
					$mensajeError = 'Se ha actualizado el registro correctamente';

					$contenidoOK = consultaUsers($mysqli);

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