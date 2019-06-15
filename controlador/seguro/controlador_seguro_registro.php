<?php
	require_once '../../modelo/modelo_seguro.php';
	$seguro    = htmlspecialchars($_POST['seguro'],ENT_QUOTES,'UTF-8');
	$estatus  = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_Seguro();
	$consulta = $MC->Registrar_seguro($seguro,$estatus);
	echo $consulta;
?>
