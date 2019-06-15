<?php
	require_once '../../modelo/modelo_seguro.php';
	$idseguro    = htmlspecialchars($_POST['idseguro'],ENT_QUOTES,'UTF-8');
	$seguro    = htmlspecialchars($_POST['seguro'],ENT_QUOTES,'UTF-8');
	$estatus  = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_Seguro();
	$consulta = $MC->Modificar_seguro($idseguro,$seguro,$estatus);
	echo $consulta;
?>
