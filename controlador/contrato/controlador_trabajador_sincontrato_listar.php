<?php
	require '../../modelo/modelo_contrato.php';
	$buscar = $_POST["buscar"];
	$MC = new Modelo_contrato();
	$consulta = $MC->listar_trabajador_sincontrato($buscar);
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
