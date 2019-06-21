<?php
	include '../../modelo/modelo_contrato.php';
	$id_contrato  =  $_POST["id_contrato"];
	$id_concepto  =  $_POST["id_concepto"];
	$sueldo       =  $_POST["sueldo"];
	$MC = new Modelo_contrato();
	$consulta = $MC->registrar_concepto_fijo($sueldo,$id_contrato,$id_concepto);
	echo $consulta;
?>