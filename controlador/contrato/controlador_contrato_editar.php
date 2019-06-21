<?php
	include '../../modelo/modelo_contrato.php';
	$id_contrato   =  $_POST["id_contrato"];
	$fecha_inicio  = date("Y/m/d", strtotime($_POST["fecha_inicio"]));
	$fecha_final   = date("Y/m/d", strtotime($_POST["fecha_final"]));
	$terminos      =  $_POST["terminos"];
	$cbm_tipocont  =  $_POST["cbm_tipocont"];
	$cbm_area      =  $_POST["cbm_area"];
	$cbm_seguro    =  $_POST["cbm_seguro"];
	$cbm_cargo     =  $_POST["cbm_cargo"];
	$cbm_estado    =  $_POST["cbm_estado"];
	$MC = new Modelo_contrato();
	$consulta = $MC->editar_contrato($id_contrato,$fecha_inicio,$fecha_final,$terminos,$cbm_tipocont,$cbm_area,$cbm_seguro,$cbm_cargo,$cbm_estado);
	echo $consulta;
?>