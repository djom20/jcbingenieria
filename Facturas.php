<?php
require_once ('session.php');

// Omitir errores
ini_set("display_errors", false);

include('Includes/mainFunctions.incContri.php');

if($errorDbConexion == false){
	//$consultaFactura = reporteContri($mysqli);
	$listContri = listaContri($mysqli);
}else{
	// Regresa error en la base de datos
	$consultaFactura = '<option value="">ERROR AL CONECTAR CON LA BASE DE DATOS</option>';
}

if(isset($_REQUEST['request'])){
	if($_REQUEST['request']=='factura'){

	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Recaudo</title>

	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="CSS/EstiloWEB2.css"/>
	<link rel="stylesheet" type="text/css" href="CSS/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="CSS/smoothness/jquery-ui-1.8.23.custom.css"/>

	<!--javascript-->
	<script type="text/javascript" src="JS/jquery/jquery-1.8.3.min.js"></script>
	<script type="text/javascript">
		function Confirmar($user){
			alert('¿Realmente desea eliminar este registro?');
		}
	</script>
	<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>

	<script type="text/javascript" src="js/jquery-validation-1.10.0/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/jquery-validation-1.10.0/lib/jquery.metadata.js"></script>
	<script type="text/javascript" src="js/jquery-validation-1.10.0/localization/messages_es.js"></script>

	<!--Manejador del menu información *Star* -->
   	<script type="text/javascript">
		$(document).ready(function(){
			$(".header h2").click(function(){
				$(this).parent().find(".Conextra").animate({ opacity:'toggle' , height: 'toggle' },500);
			});
			$("#submit").click(function(e){
				e.preventDefault();
				$("#cartera").submit();
			});
			$("#submit2").click(function(e){
				e.preventDefault();
				$("#reportes").submit();
			});
		});
	</script>
	<!-- Manejador del menu información *End* -->

</head>

<body>

	<div class="main">

		<div class="header_resize">

			<div class="header">

				<!--Imagen logo provisioanl *Star* -->
				<div class="logo">
					<a href="Principal.php"><img src="Imagenes/logo.gif" width="338" height="70" border="0" alt="logo" /></a>
				</div>
				<!-- Imagen logo provisioanl *End* -->

				<!--Menú *Star* -->
				<div class="menu">
					<ul>
						<?php
							if(isset($_SESSION["usr_tipo"])){
								if($_SESSION["usr_tipo"]=="Administrador" || $_SESSION["usr_tipo"]=="SuperAdministrador"){
									echo '<li><a href="Pcontribuyentes.php"><span>Registro</span></a></li>';
								}
							}
						?>
						<li><a href="Facturas.php" class="active"><span>Factuaci&oacute;n</span></a></li>
						<li><a href="Consultas.php"><span>Consultas</span></a></li>
						<li><a href="Panel.php"><span>Panel</span></a></li>
						<li><a href="Logout.php"><span>Salir</span></a></li>
					</ul>
				</div>
				<!-- Menú *End* -->

				<div class="clr"></div>
				<div class="clr"></div>

			</div>

			<div class="clr"></div>

			<div class="header_blog2">

				<div class="header">

					<h2>Facturaci&oacute;n</h2>

					<div class="Conextra">
                    	<p>Generar, Anular o Reemplazar. <br />
						En caso de dudas verificar en <a href="#">consultas.</a></p>
					</div>

				</div>

				<div class="clr"></div>

			</div>

			<div class="clr"></div>

			<div class="body">

				<div class="body_resize">

					<div class="full" style="text-align: center;">
						<?php
							if(!isset($_REQUEST['request'])){
						?>
								<!-- <img src="Imagenes/Guia.jpg" width="954" height="656" alt="Guia" /> -->
								<div id="facturacion" style="text-align:center;">
									<table class="table table-striped table-bordered table-hover table-condensed">
										<tr>
											<td><strong>Nota:</strong> Tenga en cuenta que al generar la facturación de un periodo no podrá volver a ser generada nuevamente.</td>
										</tr>
										<tr>
											<td><label>Usuario:</label>
												<select name="Listacontri" id="Listacontri">
													<option value="">Todos</option>
													<?php if(isset($listContri)) echo $listContri; ?>
												</select>
											</td>
										</tr>
										<tr>
											<td>Periodo a facturar:</td>
										</tr>
										<tr>
											<td><input class="span2" type="text" name="" id="" placeholder="Año" value="<?php echo date("Y"); ?>" style="text-align: center;" /> <input class="span2" type="number" name="periodo" value="<?php echo date("n"); ?>" min="1" max="12"  style="text-align: center;"></td>
										</tr>
										<tr>
											<td style="padding: 2em;">
												<form id="reportes" action="Facturas.php" method="POST" class="span3">
													<a id="submit2" class="btn btn-inverse">Generar Facturas</a>
													<input  type="hidden" name="request" value="factura">
												</form>

												<form id="cartera" action="Cartera.php" method="POST" class="span3">
													<a id="submit" class="btn btn-inverse">Cartera</a>

													<!--
													<input type="hidden" name="request" value="contribuyentes">
													<input type="hidden" name="user" value="">
													-->
												</form>
											</td>
										</tr>
									</table>
								</div>
							<?php
							}else{
								if($_REQUEST['request']=='cartera'){
									echo '<div id="listaCartera">';
									echo '	<table id="listaCarteraM" class="table table-striped table-bordered table-hover table-condensed">';
									echo '		<thead>';
									echo '			<tr>';
									echo '				<th style="text-align:center;">Factura</th>';
									echo '				<th style="text-align:center;">Periodo</th>';
									echo '				<th style="text-align:center;">Fecha</th>';
									echo '				<th style="text-align:center;">Nit/Cedula</th>';
									echo '				<th style="text-align:center;">Nombre</th>';
									echo '				<th style="text-align:center;">Valor</th>';
									echo '				<th style="text-align:center;">Abonado</th>';
									echo '				<th style="text-align:center;">Saldo</th>';
									echo '				<th style="text-align:center;">Abonar</th>';
									echo '				<th style="text-align:center;"></th>';
									echo '			</tr>';
									echo '		</thead>';
									echo '		<tbody id="listaCategoriasOK">';
									echo $consultaCartera;
									echo '		</tbody>';
									echo '	</table>';
									echo '</div>';
								}elseif($_REQUEST['request']=='factura'){
									include('pdf/convertToPdf.php');
									$var = doPDF($consultaFactura);

									echo 'Para <strong>ver</strong> el factura por favor haga click <a target="_blank" href="pdf/reportes/'.$var.'">aqui</a>.<br><br>';
									echo 'Para <strong>descargar</strong> el factura por favor haga click <a blank="_" href="pdf/download.php?f='.$var.'">aqui</a>.<br><br>';
									echo '<script type="text/javascript">alert("La factura se genero con exito.");</script>';

								}
							}
						?>
						<div class="clr"></div>
						<div class="clr"></div>

					</div>

				</div>

		</div>

		<div class="clr"></div>

			<!-- Footer *Star* -->
			<div class="footer">
				<?php
					include ('pie de pagina.php');
				?>
			</div>
			<!-- Footer *End* -->

			<div class="clr"></div>

		</div>

	</div>

</body>
</html>