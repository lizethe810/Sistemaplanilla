<?php
	include '../../modelo/modelo_trabajador.php';
	$id_medio    =  $_POST["id_medio"];
	$MC = new Modelo_trabajador();
	$consulta = $MC->eliminar_medio_comunicacion($id_medio);
	echo $consulta;
?>