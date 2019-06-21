<?php
	require '../../modelo/modelo_contrato.php';
	$id_contrato = $_POST["id_contrato"];
	$MC = new Modelo_contrato();
	$consulta = $MC->listar_combo_tipo_concepto_fijo_X_contrato($id_contrato);
	echo json_encode($consulta);
?>
