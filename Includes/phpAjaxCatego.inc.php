<?php
// Script para ejecutar AJAX

// Insertar y actualizar tabla de Categorias
sleep(3);

// Inicializamos variables de mensajes y JSON
$respuestaOK = false;
$mensajeError = "No se puede ejecutar la aplicación";
$contenidoOK = "";

// Incluimos el archivo de funciones y conexión a la base de datos
include('mainFunctions.incCatego.php');

// Validar conexión con la base de datos
if($errorDbConexion == false){
	// Validamos qe existan las variables post
	if(isset($_POST) && !empty($_POST)){
		// Verificamos las variables de acción
		switch ($_POST['accion']) {
			case 'addCatego':
				// Armamos el query
				$query = sprintf("INSERT INTO tbl_categorias
								 SET nomb_categoria='%s', sal_categoria='%s'",
								 $_POST['nomb_categoria'],$_POST['sal_categoria']);

				// Ejecutamos el query
				$resultadoQuery = $mysqli -> query($query);


				// Obtenemos el id de categoría para edición
				$id_userOK = $mysqli -> insert_id;

				if($resultadoQuery == true){
					$respuestaOK = true;
					$mensajeError = "Se ha agregado el registro correctamente";
					$contenidoOK = '
						<tr>
							<td>'.$_POST['nomb_categoria'].'</td>
							<td>'.$_POST['sal_categoria'].'</td>
							<td style="text-align:center;"><a class="btn btn-mini" href="'.$id_userOK.'">Editar</a></td>
							<td style="text-align:center;"><a class="btn btn-danger btn-mini">Eliminar</a></td>
						</tr>
					';

				}
				else{
					$mensajeError = "No se puede guardar el registro en la base de datos";
				}

			break;
			
			case 'editCatego':
				// Armamos el query
				$query = sprintf("UPDATE tbl_categorias
								 SET nomb_categoria='%s', sal_categoria='%s'
								 WHERE id_user=%d LIMIT 1",
							 $_POST['nomb_categoria'],$_POST['sal_categoria'],$_POST['id_user']);

				// Ejecutamos el query
				$resultadoQuery = $mysqli -> query($query);

				// Validamos que se haya actualizado el registro
				if($mysqli -> affected_rows == 1){
					$respuestaOK = true;
					$mensajeError = 'Se ha actualizado el registro correctamente';

					$contenidoOK = consultaCatego($mysqli);

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