<?php
	include '../../modelo/modelo_usuario.php';
	$id_trabajador    =  $_POST["id_trabajador"];
	$usuario          =  $_POST["usuario"];
	$clave            =  $_POST["clave"];
	$fechainicio      = date("Y/m/d", strtotime($_POST["fechainicio"]));
	$fechafinal       = date("Y/m/d", strtotime($_POST["fechafinal"]));
	$rol              =  $_POST["rol"];
	$MC = new Modelo_usuario();
	$consulta = $MC->registrar_usuario($id_trabajador,$usuario,$clave,$fechainicio,$fechafinal,$rol);
	echo $consulta;
?>