<?php
	require '../../modelo/modelo_contrato.php';
	$id_contrato  = $_POST["id_contrato"];
	$MC = new Modelo_contrato();
	$consulta = $MC->listar_concepto_fijo($id_contrato);
	if ($consulta) {
		echo json_encode($consulta);
	}else{
		echo '{
		    "sEcho": 1,
		    "iTotalRecords": "0",
		    "iTotalDisplayRecords": "0",
		    "aaData": []
		}';
	}
?>
