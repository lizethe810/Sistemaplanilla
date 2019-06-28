<?php
	require_once '../../modelo/modelo_derechohabiente.php';
	$idtrabajador    = htmlspecialchars($_POST['idtrabajador'],ENT_QUOTES,'UTF-8');
	$idfamiliar  = htmlspecialchars($_POST['idfamiliar'],ENT_QUOTES,'UTF-8');
    $parentesco    = htmlspecialchars($_POST['parentesco'],ENT_QUOTES,'UTF-8');
    $MC = new Modelo_Derechohabiente();
	$consulta = $MC->Registrar_DerechoHabiente($idtrabajador,$idfamiliar,$parentesco);
	echo $consulta;
?>
