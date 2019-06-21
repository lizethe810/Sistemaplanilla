<?php
	include '../../modelo/modelo_trabajador.php';
	$id_trabajador    =  $_POST["txt_idtrabajador"];
	$txt_nombre       =  $_POST["txt_nombre"];
	$txt_apepat       =  $_POST["txt_apepat"];
	$txt_apemat       =  $_POST["txt_apemat"];
	$rad_sexo         =  $_POST["rad_sexo"];
	$txt_fechanacimi  = date("Y/m/d", strtotime($_POST["txt_fechanacimi"]));
	$MC = new Modelo_trabajador();
	$consulta = $MC->Editar_datos_trabajador($id_trabajador,$txt_nombre,$txt_apepat,$txt_apemat,$rad_sexo,$txt_fechanacimi);
	echo $consulta;
?>