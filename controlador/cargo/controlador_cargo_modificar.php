<?php
	require_once '../../modelo/modelo_cargo.php';
	$idcargo    = htmlspecialchars($_POST['idcargo'],ENT_QUOTES,'UTF-8');
	$cargo    = htmlspecialchars($_POST['cargo'],ENT_QUOTES,'UTF-8');
	$estatus  = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_Cargo();
	$consulta = $MC->Modificar_cargo($idcargo,$cargo,$estatus);
	echo $consulta;
?>
