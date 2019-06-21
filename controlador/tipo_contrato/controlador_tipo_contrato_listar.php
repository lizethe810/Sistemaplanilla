<?php
	require '../../modelo/modelo_tipocontrato.php';
	$MC = new Modelo_TipoContrato();
	$consulta = $MC->listar_tipocontrato();
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
