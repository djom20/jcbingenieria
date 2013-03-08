<?php
include ("config.php");
	$Con = new Buscador;
	$Con-> Conectar();
	$Textbusca = $_GET['Textbusca'];
	if ($Textbusca==null) {
		print 'Ingrese contribuyente a buscar';
	} else {
		$Con->Buscar($Textbusca);
	}
?>