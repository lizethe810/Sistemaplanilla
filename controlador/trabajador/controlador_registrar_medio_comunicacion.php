<?php
	include '../../modelo/modelo_trabajador.php';
	$id_trabajador    =  $_POST["codigo"];
	$medio            =  $_POST["medio"];
	$tipo             =  $_POST["tipo"];
	$nivel            =  $_POST["nivel"];
	$MC = new Modelo_trabajador();
	$consulta = $MC->registrar_medio_comunicacion($id_trabajador,$medio,$tipo,$nivel);
	echo $consulta;
?>