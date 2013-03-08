<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Recaudo</title>

	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="CSS/EstiloWEB2.css"/>

	<!--javascript-->
	<script type="text/javascript" src="JS/jquery/jquery-1.8.3.min.js"></script>

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
								if($_SESSION["usr_tipo"]=="Administrador"){
									echo '<li><a href="Pcontribuyentes.php"><span>Registro</span></a></li>';
								}
							}
						?>
						<li><a href="Facturas.php" class="active"><span>Factuaci&oacute;n </span></a></li>
						<li><a href="Consultas.php"><span> Consultas </span></a></li>
						<li><a href="Panel.php"><span>Panel</span></a></li>
						<li><a href="#"><span>Salir </span></a></li>
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

					<div class="full">

						<img src="Imagenes/Guia.jpg" width="954" height="656" alt="Guia" />

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