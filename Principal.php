<?php
require_once ('session.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Recaudo</title>

	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="CSS/EstiloWEB2.css"/>

	<!--javascript-->
	<script type="text/javascript" src="JS/jquery/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="JS/jquery/jquery.cycle.all.min.js"></script>

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

	<div class="body"></div>

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