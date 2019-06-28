<?php
	require '../../modelo/modelo_planilla.php';
	$MC = new Modelo_planilla();
	$consulta = $MC->listar_planilla_contrato_registro();
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
