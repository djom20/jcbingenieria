<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sistema de Recaudo</title>
	<link rel="stylesheet" type="text/css" href="CSS/StyleINX.css"/>
	<script type="text/javascript" src="JS/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="JS/jquery/jquery.clearfield.js"></script>

	<!--[En caso de (IE 6)&(lte IE 8)]>
	<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="selectivizr.js"></script>
	<noscript><link rel="stylesheet" href="fallback.css" /></noscript>
	<![Fin-->

	<!--Control de Campos *Star*-->
	<script type="text/javascript">
	$(document).ready(function() {
		$('.clearField').clearField();
	});
	</script>
	<!--Control de Campos *End*-->

	<!--Validación de Campos *Star*-->
	<script type="text/javascript">
	function justNumbers(e) {
		var keynum = window.event ? window.event.keyCode : e.which;
		if ( keynum == 8 ) return true;
		return /\d/.test(String.fromCharCode(keynum));
		}
	</script>

	<script type="text/javascript">
	function validar(e) {
		tecla = (document.all) ? e.keyCode : e.which;
		if (tecla==8) return true;
		patron =/[A-Za-zñÑ0-9\s]/;
		te = String.fromCharCode(tecla);
		return patron.test(te);
	}
	</script>
	<!--Control de Campos *End*-->

	<!--Verificar Campos *Star*-->
	<script type="text/javascript">
		/*$(document).ready(function(){
		    $("#submit").click(function (e) {
		    	e.preventDefault();

		        if($("#usr_id").val() == '') { alert("Introduzca su Usuario"); $("#usr_id").focus(); return false; }
		        if($("#usr_pass").val() == '') { alert("Introduzca su Password"); $("#usr_pass").focus(); return false; }
				$("#iniciosesion").submit();
			});
		});*/
	</script>
	<!--Verificar Campos *End*-->
</head>

<body>
	<div id="container">
		<form id="iniciosesion" action="Autenticacion.php" method="post">
			<div class="login">Ingreso al Sistema</div>
			<div class="username-text">Nombre de usuario:</div>
			<div class="password-text">Contrase&ntilde;a:</div>

			<div class="username-field">
				<input required="required" type="text" class="clearField" name="usr_id" id="usr_id" placeholder="Digite su cedula" onKeyPress="return justNumbers(event);"/>
			</div>

			<div class="password-field">
				<input required="required" maxlength="8" type="password" class="clearField" name="usr_pass" id="usr_pass" placeholder="*********" onkeypress="return validar(event)"/>
			</div>
			<input type="checkbox" name="rememberme" id="remember-me" /><label for="remember-me">Recordarme</label>
			<div class="forgot-usr-pwd">Olvidaste <a href="#">Usuario</a> o <a href="#">Contrase&ntilde;a</a>?</div>

			<input id="submit" type="submit" name="Entrar" value="Entrar"/>
		</form>
	</div>

	<div id="footer">
		Sistema de Recaudo alumbrado público - <a href="http:/www.jcbingenieria.com">JCB Soluciones de Ingeniería S.A.S</a>
	</div>

</body>
</html>