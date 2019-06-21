<?php
    require_once '../../modelo/modelo_area.php';
    $idarea    = htmlspecialchars($_POST['idarea'],ENT_QUOTES,'UTF-8');   
	$area    = htmlspecialchars($_POST['area'],ENT_QUOTES,'UTF-8');
	$estatus  = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_Area();
	$consulta = $MC->Modificar_Area($idarea,$area,$estatus);
	echo $consulta;
?>
