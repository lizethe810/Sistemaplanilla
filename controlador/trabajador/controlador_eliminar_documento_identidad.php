<?php
	include '../../modelo/modelo_trabajador.php';
	$id_documento    =  $_POST["id_documento"];
	$MC = new Modelo_trabajador();
	$consulta = $MC->eliminar_documento_identidad($id_documento);
	echo $consulta;
?>