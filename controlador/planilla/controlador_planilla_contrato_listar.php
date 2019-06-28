<?php
	require '../../modelo/modelo_planilla.php';
	$combo_anio  = htmlspecialchars($_POST['combo_anio'],ENT_QUOTES,'UTF-8');
	$combo_mes   = htmlspecialchars($_POST['combo_mes'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_planilla();
	$consulta = $MC->listar_planilla_contrato($combo_anio,$combo_mes);
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
