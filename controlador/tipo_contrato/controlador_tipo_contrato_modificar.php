<?php
    require_once '../../modelo/modelo_tipocontrato.php';
    $idtipo    = htmlspecialchars($_POST['idtipo'],ENT_QUOTES,'UTF-8');   
	$nombre    = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
	$estatus  = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_TipoContrato();
	$consulta = $MC->Modificar_TipoContrato($idtipo,$nombre,$estatus);
	echo $consulta;
?>
