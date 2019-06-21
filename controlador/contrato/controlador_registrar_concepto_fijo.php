<?php
	include '../../modelo/modelo_contrato.php';
	$id_contrato      =  $_POST["id_contrato"];
	$concepto_id      =  $_POST["cod_concepto"];
	$cadena_monto     =  $_POST["monto"];
	
	$array_concepto   = explode(",",$concepto_id);
	$array_monto      = explode(",",$cadena_monto);
	$MC = new Modelo_contrato();
	for ($i=0; $i < count($array_concepto); $i++) { 
		$consulta = $MC->registrar_concepto_fijo($array_monto[$i],$id_contrato,$array_concepto[$i]);
	}
	echo $consulta;
?>