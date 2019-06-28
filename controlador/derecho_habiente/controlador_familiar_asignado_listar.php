<?php
    require '../../modelo/modelo_derechohabiente.php';
    $idtrabajador    = htmlspecialchars($_POST['idtrabajador'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_Derechohabiente();
	$consulta = $MC->listar_familiares_asignados($idtrabajador);
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
