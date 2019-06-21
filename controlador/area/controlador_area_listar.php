<?php
	require '../../modelo/modelo_area.php';
	$MC = new Modelo_Area();
	$consulta = $MC->listar_area();
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
