<?php
	include '../../modelo/modelo_trabajador.php';
	$txt_nombre       = htmlspecialchars($_POST['txt_nombre'],ENT_QUOTES,'UTF-8');
	$txt_apepat       = htmlspecialchars($_POST['txt_apepat'],ENT_QUOTES,'UTF-8');
	$txt_apemat       = htmlspecialchars($_POST['txt_apemat'],ENT_QUOTES,'UTF-8');
	$rad_sexo         = htmlspecialchars($_POST['rad_sexo'],ENT_QUOTES,'UTF-8');
	$txt_fechanacimi  = htmlspecialchars($_POST['txt_fechanacimi'],ENT_QUOTES,'UTF-8');
	$MC = new Modelo_trabajador();
	$consulta = $MC->Registrar_datos_trabajador($txt_nombre,$txt_apepat,$txt_apemat,$rad_sexo,$txt_fechanacimi);
	echo $consulta;
?>