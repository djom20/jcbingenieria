<?php
require_once ('session.php');

// Omitir errores
ini_set("display_errors", false);

// Incluimos nustro script php de funciones y conexión a la base de datos
include('Includes/mainFunctions.incCatego.php');

if($errorDbConexion == false){
	// Manda a llamar la función para mostrar la lista de categorías
	$consultaCategorias = consultaCatego($mysqli);
}
else
{
	// Regresa error en la base de datos
	$consultaCategorias = '
		<tr id="sinDatos">
			<td colspan="2" style="text-align:center;">ERROR AL CONECTAR CON LA BASE DE DATOS</td>
	   	</tr>
	';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Recaudo</title>

	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="CSS/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="CSS/smoothness/jquery-ui-1.8.23.custom.css"/>
	<link rel="stylesheet" type="text/css" href="CSS/EstiloWEB.css"/>

	<!--javascript-->
	<script type="text/javascript" src="JS/jquery/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/jquery_ui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="js/jquery_ui/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-validation-1.10.0/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/jquery-validation-1.10.0/lib/jquery.metadata.js"></script>
	<script type="text/javascript" src="js/jquery-validation-1.10.0/localization/messages_es.js"></script>
	<script type="text/javascript" src="JS/mainJavaScriptCatego.js"></script>

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

	<!-- Formulario *Star* -->
	<div class="hide" id="agregarCatego" Title="Agregar Categor&iacute;a">

		<form action="" method="post" id="formCatego" name="formCatego">
			<fieldset id="ocultos">
				<input type="hidden" id="accion" name="accion" class="{required:true}"/>
    			<input type="hidden" id="id_user" name="id_user" class="{required:true}" value="0"/>
			</fieldset>

			<fieldset id="datosCatego">
				<p>Nombre de la Categor&iacute;a</p>
				<span></span>
				<input type="text" id="nomb_categoria" name="nomb_categoria" placeholder="Categor&iacute;a" class="{required:true, maxlength:35} span3"/>

				<p>Cantidad de salarios m&iacute;nimos</p>
				<span></span>
				<input type="text" id="sal_categoria" name="sal_categoria" placeholder="Salario" class="{required:true, maxlength:20} span3"/>

				<fieldset id="btnAgregar" style="text-align:center;">
					<input type="submit" id="continuar" value="Continuar" />
				</fieldset>

				<fieldset id="ajaxLoader" class="ajaxLoader hide">
					<img src="Imagenes/default-loader.gif">
					<p>Espere un momento...</p>
				</fieldset>

			</fieldset>
		</form>

	</div>
	<!-- Formulario *End* -->

	<div class="main">

		<div class="header_resize">

			<div class="header">

				<!--Imagen logo provisional *Star* -->
				<div class="logo">
					<a href="Principal.php"><img src="Imagenes/logo.gif" width="338" height="70" border="0" alt="logo" /></a>
				</div>
				<!-- Imagen logo provisioanl *End* -->

				<!--Menú *Star* -->
				<div class="menu">
					<ul>
						<?php
							if(isset($_SESSION["usr_tipo"])){
								if($_SESSION["usr_tipo"]=="Administrador"){
									echo '<li><a href="Pcontribuyentes.php"><span>Registro</span></a></li>';
								}
							}
						?>
						<li><a href="Facturas.php"><span>Factuaci&oacute;n</span></a></li>
						<li><a href="Consultas.php"><span>Consultas</span></a></li>
						<li><a href="Panel.php" class="active"><span>Panel</span></a></li>
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

					<h2>Categor&iacute;as</h2>

					<div class="Conextra">
                    	<p>Agreguar, editar o eliminar categor&iacute;as. <br />
						En caso de dudas verificar en el <a href="Panel.php">Panel.</a></p>
					</div>

				</div>
              
				<div class="clr"></div>

			</div>

			<div class="clr"></div>

			<div class="body">

				<div class="body_resize">

					<div class="full">

						<div id="wraper">
							<section id="content">

								<div id="btnAddCatego" class="center addCatego">

									<button id="goNuevoCatego" class="btn btn-inverse btn-small"><i class="icon-plus"></i> Agregar Categor&iacute;a</button>
								</div>

								<!--Titulos de la tabla-->
								<div id="listaOrganizadores">
									<table id="listadoCatego" class="table table-striped table-bordered table-hover table-condensed">
										<thead>
											<tr>
												<th style="text-align:center;">Nombre de la categor&iacute;a</th>
												<th style="text-align:center;">Cantidad de salarios</th>
												<th colspan="2" style="text-align:center;">Acciones</th>
											</tr>
										</thead>

										<tbody id="listaCategoriasOK">
											<?php echo $consultaCategorias ?>
										</tbody>

									</table>
								</div>
								<!--Titulos de la tabla-->

							</section>
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
		<!-- Footer *Star* -->

	</div>

</body>
</html>