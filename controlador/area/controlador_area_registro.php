<?php
	require_once '../../modelo/modelo_area.php';
	$area    = htmlspecialchars($_POST['area'],ENT_QUOTES,'UTF-8');
	$estatus  = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_Area();
	$consulta = $MC->Registrar_Area($area,$estatus);
	echo $consulta;
?>
