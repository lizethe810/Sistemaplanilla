<?php
	require '../../modelo/modelo_trabajador.php';
	$buscar = $_POST["buscar"];
	$MC = new Modelo_trabajador();
	$consulta = $MC->buscar_documento_identidad($buscar);
	echo json_encode($consulta);
	
?>
