<?php
	require '../../modelo/modelo_familiar.php';
	$MC = new Modelo_Familiar();
	$consulta = $MC->listar_familiar();
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
