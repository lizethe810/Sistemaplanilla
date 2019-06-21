<?php

	class Modelo_TipoContrato
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}

		function listar_tipocontrato(){
			$sql = "call SP_TIPOCONTRATO_LISTAR";

			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

		function Modificar_TipoContrato($idtipo,$nombre,$estatus){
			$sql = "call SP_TIPOCONTRATO_MODIFICAR('$idtipo','$nombre','$estatus')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}

		function Registrar_TipoContrato($tipocontrato,$estatus){
			$sql = "call SP_TIPOCONTRATO_REGISTRO('$tipocontrato','$estatus')";
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
