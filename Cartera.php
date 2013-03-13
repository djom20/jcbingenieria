<?php
require_once ('session.php');

// Omitir errores
ini_set("display_errors", false);

if(isset($_REQUEST['request'])){
	if($_REQUEST['request']=='busqueda'){
		if(isset($_REQUEST['identificacion'])){
			include('Includes/mainFunctions.incCarter.php');

			if($errorDbConexion == false){
				$listCart = consultaCartera($mysqli,$_REQUEST['identificacion']);
			}else{
				// Regresa error en la base de datos
				$listCart = '<tr id="sinDatos">
								<td colspan="11" style="text-align: center;">ERROR AL CONECTAR CON LA BASE DE DATOS</td>
				   			</tr>';
			}
		}
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

					<h2>Cartera</h2>

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

					<div class="full">
						<div class="well">
							<?php
								if(!isset($_REQUEST['request'])){
							?>
							<form id="formcartera" action="Cartera.php" method="POST">
								<input placeholder="Cedula/Nit" type="text" name="identificacion"/>
								<input type="hidden" name="request" value="busqueda" />
								<button type="submit" class="btn btn-inverse" style="margin-bottom: 0.9em;">Constultar</button>
							</form>
							<?php } ?>
						<?php
							if(isset($_REQUEST['request'])){
								if($_REQUEST['request']=='busqueda'){
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
									echo $listCart;
									echo '		</tbody>';

									echo '	</table>';
									echo '</div>';
									echo '<a class="btn btn-inverse" href="Cartera.php"><i class="icon-search icon-white"></i> Buscar</a>';

								}elseif($_REQUEST['request']=='users'){
									echo '<div id="listaCartera">';
									echo '	<table id="listaCarteraM" class="table table-striped table-bordered table-hover table-condensed">';
									echo '		<thead>';
									echo '			<tr>';
									echo '				<th style="text-align:center;">Periodo</th>';
									echo '				<th style="text-align:center;">Valor</th>';
									echo '				<th style="text-align:center;">Abonado</th>';
									echo '				<th style="text-align:center;">Saldo</th>';
									echo '			</tr>';
									echo '		</thead>';

									echo '		<tbody id="listaCategoriasOK">';
									//echo $consultaCartera;
									echo '		</tbody>';

									echo '	</table>';
									echo '</div>';
								}
							}
						?>
							<a class="btn btn-inverse" href="Facturas.php">Facturas</a>
							<a class="btn btn-inverse" href="Cartera.php">Abonar a facturas</a>
						</div>
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