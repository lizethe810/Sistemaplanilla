<?php
	require '../../modelo/modelo_planilla.php';
	$id_pagoplanilla  = $_POST["id_pagoplanilla"];
	$MC = new Modelo_planilla();
	$consulta = $MC->listar_concepto_variable($id_pagoplanilla);
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
