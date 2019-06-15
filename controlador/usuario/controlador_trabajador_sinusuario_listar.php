<?php
	require '../../modelo/modelo_usuario.php';
	$buscar = $_POST["buscar"];
	$MC = new Modelo_Usuario();
	$consulta = $MC->listar_trabajadores_sin_usuario($buscar);
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
