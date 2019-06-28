<?php
    require '../../modelo/modelo_derechohabiente.php';
    $idderecho    = htmlspecialchars($_POST['idderecho'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_Derechohabiente();
	$consulta = $MC->eliminar_derechohabiente($idderecho);
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
