<?php
	require '../../modelo/modelo_trabajador.php';
	$buscar = $_POST["buscar"];
	$MC = new Modelo_trabajador();
	$consulta = $MC->listar_trabajador($buscar);
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
