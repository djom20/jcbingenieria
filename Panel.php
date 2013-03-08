<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Recaudo</title>

	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="CSS/EstiloWEB.css"/>
	<link rel="stylesheet" type="text/css" href="CSS/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="CSS/smoothness/jquery-ui-1.8.23.custom.css"/>

	<!--javascript-->
	<script type="text/javascript" src="JS/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="JS/jquery/jquery.js"></script>
	<script type="text/javascript" src="JS/jquery/jquery.color.js"></script>
    
	<!--Manejador del menu información *Star* -->
   	<script type="text/javascript">
	$(document).ready(function(){
		$(".header h2").click(function(){
			$(this).parent().find(".Conextra").animate({ opacity:'toggle' , height: 'toggle' },500);
		});
	});
	</script>
	<!-- Manejador del menu información *End* -->

	<!--Manejador del cambio de color *Star* -->
	<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('div.blog_port').hover(
		function(){
			$(this).stop().animate({backgroundColor: "#EBEBEB"}, 300);
		},
		function(){
			$(this).stop().animate({backgroundColor: "#fff"}, 300);
		});
	});
	</script>
	<!-- Manejador del cambio de color *End* -->

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
						<li><a href="Facturas.php"><span>Factuaci&oacute;n </span></a></li>
						<li><a href="Consultas.php"><span> Consultas </span></a></li>
						<li><a href="#" class="active"><span>Panel</span></a></li>
						<li><a href="#"><span>Salir </span></a></li>
					</ul>
				</div>
				<!-- Menú *End* -->

				<div class="clr"></div>
				<div class="clr"></div>

			</div>

		</div>

		<div class="clr"></div>

		<div class="header_blog2">

		    <div class="header">

					<h2>Panel de Control</h2>

					<div class="Conextra">
						<p>Administrar usuarios, categorias y salario<br />
							Solo para usuarios administrador</p>
					</div>

			</div>

	    	<div class="clr"></div>

		</div>

		<div class="clr"></div>

		<div class="body">

	    	<div class="body_resize">

				<div class="full">
		        	<h2>Paneles de configuraci&oacute;n</h2>
					<p>Dentro de cada uno de estos paneles se encuentra la configuraci&oacute;n de cada uno de los m&oacute;dulos del sistema de se recomienda precauci&oacute;n a la hora de manejarlos y editar la informaci&oacute;n. Podr&aacute; activar o desactivar usuarios adem&aacute;s de ver su registro de entradas al sistema, editar las categor&iacute;as a las que pertenece cada contribuyente y controlar el salario b&aacute;sico que se establece anualmente</p>

					<!--Paneles *Star*-->
					<div class="blog_port">
						<img src="Imagenes/port_1.jpg" alt="picture" width="176" height="235" />
						<div class="clr"></div>
						<p style="font: normal 14px Arial, Helvetica, sans-serif; color:#2a2a2a;">Administrar Usuarios</p>
						<p>Podr&aacute; devengar funciones totales o parciales y verificar el manejo de cada uno de los m&oacute;dulos.</p>
						<p><a href="Pusuarios.php" class="btn"><i class="icon-user"></i> Entrar</a></p>
						<p>&nbsp;</p>
		    	    </div>

					<div class="blog_port">
						<img src="Imagenes/port_2.jpg" alt="picture" width="176" height="235" />
						<div class="clr"></div>
						<p style="font: normal 14px Arial, Helvetica, sans-serif; color:#2a2a2a;">Administrar Categor&iacute;as</p>
						<p>Eliminara, controlara y editara las categor&iacute;as que se ingresen al sistema.</p>
						<p><a href="Pcategorias.php" class="btn"><i class="icon-th-large"></i> Entrar</a></p>
						<p>&nbsp;</p>
			        </div>

					<div class="blog_port">
						<img src="Imagenes/port_3.jpg" alt="picture" width="176" height="235" />
						<div class="clr"></div>
						<p style="font: normal 14px Arial, Helvetica, sans-serif; color:#2a2a2a;">Administrar Salario</p>
						<p>Ingresar el salario que se usara para el cobro del impuesto durante el año vigente.</p>
						<p><a href="Psalario.php" class="btn"><i class="icon-asterisk"></i> Entrar</a></p>
						<p>&nbsp;</p>
	    		    </div>

					<div class="blog_port">
						<img src="Imagenes/port_4.jpg" alt="picture" width="176" height="235" />
						<div class="clr"></div>
						<p style="font: normal 14px Arial, Helvetica, sans-serif; color:#2a2a2a;">Administrar Contribuyentes</p>
						<p>Eliminara, controlara y editara los contribuyentes que se ingresen al sistema.</p>
						<p><a href="Pcontribuyentes.php" class="btn"><i class="icon-briefcase"></i> Entrar</a></p>
						<p>&nbsp;</p>
			        </div>
					<!--Paneles *End*-->

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