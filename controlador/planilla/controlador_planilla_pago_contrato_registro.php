<?php
	include '../../modelo/modelo_planilla.php';
	$planilla_id  =  $_POST["planilla_id"];
	$sueldobase   =  $_POST["sueldobase"];
	$sueldobruto  =  $_POST["sueldobruto"];
	$MC = new Modelo_planilla();
	$consulta = $MC->registrar_planilla_pago($planilla_id,$sueldobase,$sueldobruto);
	echo $consulta;
?>