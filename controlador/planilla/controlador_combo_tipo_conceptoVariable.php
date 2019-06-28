<?php
	require '../../modelo/modelo_planilla.php';
	$MC = new Modelo_planilla();
	$consulta = $MC->listar_combo_tipo_concepto_variable();
	echo json_encode($consulta);
?>
