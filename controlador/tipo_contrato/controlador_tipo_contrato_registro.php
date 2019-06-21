<?php
	require_once '../../modelo/modelo_tipocontrato.php';
	$tipocontrato    = htmlspecialchars($_POST['tipocontrato'],ENT_QUOTES,'UTF-8');
	$estatus  = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_TipoContrato();
	$consulta = $MC->Registrar_TipoContrato($tipocontrato,$estatus);
	echo $consulta;
?>
