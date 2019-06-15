<?php
	require_once '../../modelo/modelo_cargo.php';
	$cargo    = htmlspecialchars($_POST['cargo'],ENT_QUOTES,'UTF-8');
	$estatus  = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_Cargo();
	$consulta = $MC->Registrar_cargo($cargo,$estatus);
	echo $consulta;
?>
