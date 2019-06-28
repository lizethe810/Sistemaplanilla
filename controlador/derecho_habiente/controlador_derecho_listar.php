<?php
	require '../../modelo/modelo_derechohabiente.php';
	$MC = new Modelo_Derechohabiente();
	$consulta = $MC->listar_derechohabiente();
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
