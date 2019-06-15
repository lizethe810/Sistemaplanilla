<?php

	class Modelo_Seguro
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}

		function listar_seguro(){
			$sql = "call SP_SEGURO_LISTAR";

			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

		function Modificar_seguro($idseguro,$seguro,$estatus){
			$sql = "call SP_SEGURO_MODIFICAR('$idseguro','$seguro','$estatus')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}

		function Registrar_seguro($seguro,$estatus){
			$sql = "call SP_SEGURO_REGISTRO('$seguro','$estatus')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				if ($resultado=="1") {
					return 1;
				}else{
					if ($row = mysqli_fetch_array($resultado)){
						return $id_usuario = trim($row[0]);
					}
				}
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
	}
?>
