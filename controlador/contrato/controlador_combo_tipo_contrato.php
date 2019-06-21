<?php
	require '../../modelo/modelo_contrato.php';
	$MC = new Modelo_contrato();
	$consulta = $MC->listar_combo_tipo_contrato();
	echo json_encode($consulta);
?>