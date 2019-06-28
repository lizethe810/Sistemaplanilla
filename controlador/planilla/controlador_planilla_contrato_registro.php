<?php
	include '../../modelo/modelo_planilla.php';
	$id_contrato  =  $_POST["id_contrato"];
	$txt_anio     =  $_POST["txt_anio"];
	$txt_mes      =  $_POST["txt_mes"];
	$MC = new Modelo_planilla();
	$consulta = $MC->registrar_planilla($id_contrato,$txt_anio,$txt_mes);
	echo $consulta;
?>