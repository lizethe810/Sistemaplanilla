<?php
	require '../../modelo/modelo_seguro.php';
	$MC = new Modelo_Seguro();
	$consulta = $MC->listar_seguro();
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
