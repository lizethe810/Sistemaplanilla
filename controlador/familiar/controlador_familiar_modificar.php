<?php
    require_once '../../modelo/modelo_familiar.php';
    $idfamiliar    = htmlspecialchars($_POST['idfamiliar'],ENT_QUOTES,'UTF-8');   
	$nombre    = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
	$apepat  = htmlspecialchars($_POST['apepat'],ENT_QUOTES,'UTF-8');
    $apemat    = htmlspecialchars($_POST['apemat'],ENT_QUOTES,'UTF-8');
    $nrodocumento  = htmlspecialchars($_POST['nrodocumento'],ENT_QUOTES,'UTF-8');   
	$tipodocumento  = htmlspecialchars($_POST['tipodocumento'],ENT_QUOTES,'UTF-8');     
    $fechanacimiento  = htmlspecialchars($_POST['fechanacimiento'],ENT_QUOTES,'UTF-8');
    $estatus    = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8'); 
    $MC = new Modelo_Familiar();
	$consulta = $MC->Modificar_Familiar($idfamiliar,$nombre,$apepat,$apemat,$nrodocumento,$tipodocumento,$fechanacimiento,$estatus);
	echo $consulta;
?>
