<?php
	include('php_lib/config.ini.php');
	session_start();

	//Entrada: Datos actuales del sistema
	//Aleta Usuario Moroso
	function AUM(){
		//Variables del sistema
		$fecha_actual = '09/09/2013 06:42 p.m.';
		$usr_id = '1140820188'; //Usuario Actual

		//Buscar datos del Usuario, si es necesario
		$nombre='';

		//Buscar la lista de contribuyentes
		$contribuyentes='';

		//Para cada Contribuyente
		foreach ($variable as $key => $value) {//Buscar Datos
			//buscamos facturas, fecha de las facturas, la fecha de vencimiento o la calculamos
			$factura_id = '';
			$fecha      = '';
			$fecha_venc = '';

			//Si la diferencia entre las fechas es menor o igual a la fecha de vencimiento
			//alerte al usuario.

			//if(($fecha_actual + 3dias) <= $fecha_venc)
				//Alert(Factura a Vencerse);
		}
	}
?>