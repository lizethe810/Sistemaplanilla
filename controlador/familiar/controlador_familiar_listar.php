<?php
	require '../../modelo/modelo_familiar.php';
	$buscar = $_POST["buscar"];
	$MC = new Modelo_Familiar();
	$consulta = $MC->listar_familiar($buscar);
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
