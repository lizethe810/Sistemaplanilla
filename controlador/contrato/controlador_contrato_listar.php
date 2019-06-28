<?php
	require '../../modelo/modelo_contrato.php';
	$txt_fechainicio  = htmlspecialchars($_POST['txt_fechainicio'],ENT_QUOTES,'UTF-8');
	$txt_fechafinal   = htmlspecialchars($_POST['txt_fechafinal'],ENT_QUOTES,'UTF-8');
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
