<?php
	include '../../modelo/modelo_trabajador.php';
	$id_trabajador    =  $_POST["codigo"];
	$dni              =  $_POST["dni"];
	$tipo             =  $_POST["tipo"];
	$MC = new Modelo_trabajador();
	$consulta = $MC->registrar_documento_identidad($id_trabajador,$dni,$tipo);
	echo $consulta;
?>