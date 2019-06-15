<?php
	$usuarios = $_POST['user'];
	$intentos = $_POST['inten'];
	include '../../modelo/modelo_usuario.php';
	$MC = new Modelo_usuario();
	$consulta = $MC->actualizar_usuario($usuarios,$intentos);
	echo $consulta;
?>