<?php
include('php_lib/config.ini.php');
session_start();

class Buscador {

	//Se prueba nuevo metodo de conexión. Se declaran las varibles
	var $host=SERVIDOR_MYSQL,
		$user=USUARIO_MYSQL,
		$pass=PASSWORD_MYSQL,
		$db=BASE_DATOS,
		$correct_server='Se Conecto Con el servidor Correctamente',
		$fail_server='No se pudo conectar con el servidor',
		$correct_db='Se selecciono correctamente la db',
		$fail_db='No existe esta db';

	//Funciones para conectar
	function Conectar() {
		if (!@mysql_connect($this->host,$this->user,$this->pass)) {
			print $this->fail_server;

			} else {
				if(!@mysql_select_db($this->db)) {
					print $this->fail_db;
				}
			}
		}

	//Función para buscar
	function Buscar ($Textbusca) {
		$query = mysql_query("SELECT * FROM tbl_contribuyente WHERE id_contribuyente LIKE '%$Textbusca%'");
		if (mysql_num_rows($query)<=0) {
			print 'NO EXISTE O NO SE ENCONTRO NINGUN RESULTADO';

			} else {
				$id='';
				print '<table class="table table-striped table-bordered table-hover table-condensed">
							<thead>
								<tr>
									<th>ID Contribuyente</th>
									<th>Nombre Contribuyente</th>
									<th>Categor&iacute;a</th>
									<th>Direcci&oacute;n</th>
									<th>Ciudad</th>';
									if(isset($_SESSION["usr_tipo"])){
										if($_SESSION["usr_tipo"]=="Administrador" || $_SESSION["usr_tipo"]=="SuperAdministrador"){
											print '<th colspan="2" style="text-align:center;">Acciones</th>';
										}
									}
				print '</tr>
							</thead>';
				while ($row = mysql_fetch_assoc($query)) {
					$id=$row['id_contribuyente'];
					print '<tbody>
								<tr>
									<td>'.$row['id_contribuyente'].'</td>
									<td>'.$row['nomb_contribuyente'].'</td>
									<td>'.$row['categ_contribuyente'].'</td>
									<td>'.$row['dir_contribuyente'].'</td>
									<td>'.$row['ciud_contribuyente'].'</td>';

									if(isset($_SESSION["usr_tipo"])){
										if($_SESSION["usr_tipo"]=="Administrador" || $_SESSION["usr_tipo"]=="SuperAdministrador"){
											print '<td style="text-align:center;">';
											print '<form id="formcartera" action="Cartera.php" method="POST">';
											print '<a id="submitcartera" class="btn btn-mini">Cartera</a>';
											print '<input type="hidden" name="request" value="users">';
											print '<input type="hidden" name="user" value="'.$row['id_user'].'">';
											print '</form>';
											print '</td>';

											print '<td style="text-align:center;"><a class="btn btn-mini" href="'.$row['id_user'].'">Editar</a></td>';
											print '<td style="text-align:center;"><a class="btn btn-danger btn-mini">Eliminar</a></td>';
										}
									}
					print '		<tr>
							</tbody>';
				}
				print '</table>';
				print '<form action="">';
				print '<button class="btn btn-inverse" >Cartera Recaudada</button>';
				print '<input type="hidden" name="cartera" value="'.$id.'" />';
				print '</form>';
			}
		}

	}
?>