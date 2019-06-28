<?php
	include '../../modelo/modelo_planilla.php';
	$id_conceptovariable  =  $_POST["id_conceptovariable"];
	$MC = new Modelo_planilla();
	$consulta = $MC->eliminar_concepto_variable($id_conceptovariable);
	echo $consulta;
?>