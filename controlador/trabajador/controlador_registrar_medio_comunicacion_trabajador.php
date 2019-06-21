<?php
	$cadena_ID     =  $_POST["codigo"];
	$cadena_medio  =  $_POST["medio"];
	$cadena_tipo   =  $_POST["tipo"];
	$cadena_nivel  =  $_POST["nivel"];
	$array_medio   = explode(",",$cadena_medio);
	$array_tipo    = explode(",",$cadena_tipo);
	$array_nivel   = explode(",",$cadena_nivel);
	require '../../modelo/modelo_trabajador.php';
	$MC = new Modelo_trabajador();
	for ($i=0; $i < count($array_medio); $i++) { 
		$consulta = $MC->registrar_medio_comunicacion($cadena_ID,$array_medio[$i],$array_tipo[$i],$array_nivel[$i]);
	}
	echo $consulta;
?>