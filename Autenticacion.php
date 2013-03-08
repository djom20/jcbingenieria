<?php

require_once ("conexlog.php");

session_start ();

$_SESSION["usr_id"]="anomino";
$_SESSION["valido"];


if(isset($_POST['usr_id']) && isset($_POST['usr_pass'])) {
	$_cadena = "@#4178AHUUFF()UHGF475!!POL00??";
	$_usr_pass = $_POST['usr_pass'];
	$_hash = $_cadena.sha1($usr_pass);
	$_cedula = split(" ",trim($_POST['usr_id']));

	$_SESSION["usr_id"]=$_cedula[0];
	$_resultante = mysql_query ("SELECT usr_pass, usr_tipo FROM tbl_usuarios WHERE usr_id='".$_SESSION['usr_id']."'");

	if (mysql_num_rows($_resultante)==1) {
		$_row = mysql_fetch_row($_resultante);
		if ($_usr_pass==$_row[0]){$_SESSION["valido"]=1; $_SESSION["usr_tipo"]=$_row[1]; }
	}
}

header ("Location: Principal.php");

?>