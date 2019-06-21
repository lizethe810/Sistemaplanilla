<?php
	include '../../modelo/modelo_contrato.php';
	$id_conceptofijo  =  $_POST["id_conceptofijo"];
	$MC = new Modelo_contrato();
	$consulta = $MC->eliminar_concepto_fijo($id_conceptofijo);
	echo $consulta;
?>