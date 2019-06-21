<?php
	require '../../modelo/modelo_contrato.php';
	$txt_fechainicio  = date("Y/m/d", strtotime($_POST["txt_fechainicio"]));
	$txt_fechafinal   = date("Y/m/d", strtotime($_POST["txt_fechafinal"]));
	$MC = new Modelo_contrato();
	$consulta = $MC->listar_contrato($txt_fechainicio,$txt_fechafinal);
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
