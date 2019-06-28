<?php
	include '../../modelo/modelo_contrato.php';
	$id_contrato   =  htmlspecialchars($_POST['id_contrato'],ENT_QUOTES,'UTF-8');
	$fecha_inicio  =  htmlspecialchars($_POST['fecha_inicio'],ENT_QUOTES,'UTF-8');
	$fecha_final   =  htmlspecialchars($_POST['fecha_final'],ENT_QUOTES,'UTF-8');
	$terminos      =  htmlspecialchars($_POST['terminos'],ENT_QUOTES,'UTF-8');
	$cbm_tipocont  =  htmlspecialchars($_POST['cbm_tipocont'],ENT_QUOTES,'UTF-8');
	$cbm_area      =  htmlspecialchars($_POST['cbm_area'],ENT_QUOTES,'UTF-8');
	$cbm_seguro    =  htmlspecialchars($_POST['cbm_seguro'],ENT_QUOTES,'UTF-8');
	$cbm_cargo     =  htmlspecialchars($_POST['cbm_cargo'],ENT_QUOTES,'UTF-8');
	$cbm_estado    =  htmlspecialchars($_POST['cbm_estado'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_contrato();
	$consulta = $MC->editar_contrato($id_contrato,$fecha_inicio,$fecha_final,$terminos,$cbm_tipocont,$cbm_area,$cbm_seguro,$cbm_cargo,$cbm_estado);
	echo $consulta;
?>