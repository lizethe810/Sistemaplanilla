<?php
	require '../../modelo/modelo_cargo.php';
	$MC = new Modelo_Cargo();
	$consulta = $MC->listar_cargo();
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
