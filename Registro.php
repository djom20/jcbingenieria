<?php
require_once ('session.php');

// Omitir errores
ini_set("display_errors", false);

// Incluimos nustro script php de funciones y conexión a la base de datos
include('Includes/mainFunctions.incContri.php');

//Incluir ciudades en el select
$consultaciud="select id_ciudad,nomb_ciudad FROM tbl_ciudades ORDER BY nomb_ciudad ASC";
$resultciud=mysql_query($consultaciud);

//Incluir Categorías en el select
$consultacategoria="select id_user,nomb_categoria FROM tbl_categorias ORDER BY nomb_categoria ASC";
$resultcateg=mysql_query($consultacategoria);

if($errorDbConexion == false){
	// Manda a llamar la función para mostrar la lista de Contribuyentes
	$consultaContribuyentes = consultaContri($mysqli);
}
else
{
	// Regresa error en la base de datos
	$consultaContribuyentes = '
		<tr id="sinDatos">
			<td colspan="6" style="text-align: center;>ERROR AL CONECTAR CON LA BASE DE DATOS</td>
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
	<script type="text/javascript" src="JS/jquery/jquery.cycle.all.min.js"></script>
	<script type="text/javascript" src="js/jquery-validation-1.10.0/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/jquery-validation-1.10.0/lib/jquery.metadata.js"></script>
	<script type="text/javascript" src="js/jquery-validation-1.10.0/localization/messages_es.js"></script>
	<script type="text/javascript" src="JS/mainJavaScriptContri.js"></script>

	<!--Manejador del Slider *Star* -->
	<script type="text/javascript">
	$(document).ready(function(){
		$('#slideshow').cycle({
			fx:     'fade',
			speed:  'slow',
			timeout: 5000,
			pager:  '#slider_nav',
			pagerAnchorBuilder: function(idx, slide) {
				// Se retorna a la imagen inicial
				return '#slider_nav li:eq(' + (idx) + ') a';
			}
		});
	});
	</script>
	<!-- Manejador del Slider *End* -->

</head>

<body>

	<!-- Formulario *Star*-->
	<div class="hide" id="agregarContri" Title="Agregar Contribuyente">

		<form action="" method="post" id="formContri" name="formContri">
			<fieldset id="ocultos">
				<input type="hidden" id="accion" name="accion" class="{required:true}"/>
    			<input type="hidden" id="id_user" name="id_user" class="{required:true}" value="0"/>
			</fieldset>

			<fieldset id="datosContri">
				<p>ID Contribuyente</p>
				<span></span>
				<input type="text" id="id_contribuyente" name="id_contribuyente" placeholder="Nit &oacute; C&eacute;dula" class="{required:true, number:true, rangelength:[8, 20]} span3"/>

				<p>Nombre Contribuyente</p>
				<span></span>
				<input type="text" id="nomb_contribuyente" name="nomb_contribuyente" placeholder="Nombre del contribuyente" class="{required:true, maxlength:35} span3"/>

				<p>Categor&iacute;a</p>
				<span></span>
				<select name="categ_contribuyente" class="{required:true} span3">
					<option value="">Seleccione una categor&iacute;a</option>
					<?php
					while($fila = mysql_fetch_object($resultcateg)){
						echo "<option value='".$fila->nomb_categoria."'>".$fila->nomb_categoria."</option>";
					}
					?>
				</select>

				<p>Direcci&oacute;n</p>
				<span></span>
				<input type="text" id="dir_contribuyente" name="dir_contribuyente" placeholder="Ubicaci&oacute;n de contribuyente" class="{required:true,maxlength:30} span3"/>

				<p>Ciudad</p>
				<span></span>
				<select name="ciud_contribuyente" class="{required:true} span3">
					<option value="">Seleccione una ciudad</option>
					<?php
					while($fila = mysql_fetch_object($resultciud)){
						echo "<option value='".$fila->nomb_ciudad."'>".$fila->nomb_ciudad."</option>";
					}
					?>
				</select>

				<fieldset id="btnAgregar" style="text-align:center;">
					<input type="submit" id="continuar" value="Continuar" />
				</fieldset>

				<fieldset id="ajaxLoader" class="ajaxLoader hide">
					<img src="Imagenes/default-loader.gif">
					<p>Espere un momento...</p>
				</fieldset>

		</form>

	</div>
	<!-- Formulario *End* -->

	<div class="main">

		<div class="header_resize">

			<div class="header">

				<!--Imagen logo provisioanl *Star* -->
				<div class="logo">
					<a href="Registro.php"><img src="Imagenes/logo.gif" width="338" height="70" border="0" alt="logo" /></a>
				</div>
				<!-- Imagen logo provisioanl *End* -->

				<!--Menú *Star* -->
				<div class="menu">
					<ul>
						<?php
							if(isset($_SESSION["usr_tipo"])){
								if($_SESSION["usr_tipo"]=="Administrador"){
									echo '<li><a class="active" href="Pcontribuyentes.php"><span>Registro</span></a></li>';
								}
							}
						?>
						<li><a href="Facturas.php"><span>Factuaci&oacute;n</span></a></li>
						<li><a href="Consultas.php"><span>Consultas</span></a></li>
						<li><a href="#"><span>Informes</span></a></li>
						<li><a href="Panel.php" class="active"><span>Panel</span></a></li>
						<li><a href="Logout.php"><span>Salir</span></a></li>
					</ul>
				</div>
				<!-- Menú *End* -->

				<div class="clr"></div>
				<div class="clr"></div>
        
			</div>

		</div>

		<div class="header_blog">

			<div id="slider">

				<!-- Arranque del Slider -->
				<div id="slideshow">

					<div class="slider-item">
   	        	    	<a href="#"><img src="Imagenes/simple_img_1.jpg" alt="icon" width="960" height="341" border="0" /></a>
					</div>

					<div class="slider-item">
   		        		<a href="#"><img src="Imagenes/simple_img_2.jpg" alt="icon" width="960" height="341" border="0" /></a>
					</div>

			        <div class="slider-item">
   		            	<a href="#"><img src="Imagenes/simple_img_3.jpg" alt="icon" width="960" height="341" border="0" /></a>
					</div>

				</div>
			
				<div class="controls-center">

					<div id="slider_controls">

						<ul id="slider_nav">
							<li><a href="#"></a></li>
							<!-- Slide 1 -->

							<li><a href="#"></a></li>
							<!-- Slide 2 -->

							<li><a href="#"></a></li>
							<!-- Slide 3 -->
						</ul>

					</div>

				</div>
				<!-- Final del Slider -->

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

						<div id="btnAddContri" class="center addContri">

							<button id="goNuevoContri" class="btn btn-inverse btn-small"><i class="icon-plus"></i> Agregar Contribuyente</button>
						</div>

						<!--Titulos de la tabla-->
						<div id="listaOrganizadores">
							<table id="listadoContri" class="table table-striped table-bordered table-hover table-condensed">
								<thead>
									<tr>
										<th>ID Contribuyente</th>
										<th>Nombre Contribuyente</th>
										<th>Categor&iacute;a</th>
										<th>Direcci&oacute;n</th>
										<th>Ciudad</th>
										<th colspan="2" style="text-align:center;">Acciones</th>
									</tr>
								</thead>

								<tbody id="listaContribuyenteOK">
									<?php echo $consultaContribuyentes ?>
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
		<!-- Footer *End* -->

	</div>

</body>
</html>