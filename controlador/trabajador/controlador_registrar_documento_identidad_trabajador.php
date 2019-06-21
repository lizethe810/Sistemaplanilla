<?php
	include '../../modelo/modelo_trabajador.php';
	$cadena_ID        =  $_POST["codigo"];
	$cadena_dni       =  $_POST["dni"];
	$cadena_tipo      =  $_POST["tipo"];
	$array_dni     = explode(",",$cadena_dni);
	$array_tipo    = explode(",",$cadena_tipo);
	require '../../modelo/modelo_trabajador.php';
	$MC = new Modelo_trabajador();
	for ($i=0; $i < count($array_dni); $i++) { 
		$consulta = $MC->registrar_documento_identidad($cadena_ID,$array_dni[$i],$array_tipo[$i]);
	}
	echo $consulta;
?>