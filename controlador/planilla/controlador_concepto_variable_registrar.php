<?php
	include '../../modelo/modelo_planilla.php';
	$id_pagoplanilla  =  $_POST["id_pagoplanilla"];
	$id_tipoconcepto  =  $_POST["id_tipoconcepto"];
	$txt_monto        =  $_POST["txt_monto"];
	$text_argumento   =  $_POST["text_argumento"];
	$MC = new Modelo_planilla();
	$consulta = $MC->registrar_concepto_variable($id_pagoplanilla,$id_tipoconcepto,$txt_monto,$text_argumento);
	echo $consulta;
?>