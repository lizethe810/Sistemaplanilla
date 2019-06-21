<?php
	include '../../modelo/modelo_contrato.php';
	$fecha_inicio  = date("Y/m/d", strtotime($_POST["fecha_inicio"]));
	$fecha_final   = date("Y/m/d", strtotime($_POST["fecha_final"]));
	$terminos      =  $_POST["terminos"];
	$cbm_tipocont  =  $_POST["cbm_tipocont"];
	$cbm_area      =  $_POST["cbm_area"];
	$cbm_seguro    =  $_POST["cbm_seguro"];
	$cbm_cargo     =  $_POST["cbm_cargo"];
	$txt_sueldo    =  $_POST["txt_sueldo"];
	$id_trabajador =  $_POST["id_trabajador"];
	$MC = new Modelo_contrato();
	$consulta = $MC->registrar_contrato($fecha_inicio,$fecha_final,$terminos,$cbm_tipocont,$cbm_area,$cbm_seguro,$cbm_cargo,$txt_sueldo,$id_trabajador);
	echo $consulta;
?>