<?php

	class Modelo_Derechohabiente
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}

		function listar_derechohabiente(){
			$sql = "call SP_DERECHOHABIENTE_LISTAR";

			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}

		function listar_familiares_asignados($idtrabajador){
			$sql = "call SP_FAMILIARASIGNADO_HOY('$idtrabajador')";

			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}		

		function eliminar_derechohabiente($idderecho){
			$sql = "call SP_DERECHOHABIENTE_ELIMINAR('$idderecho')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}

		function Registrar_DerechoHabiente($idtrabajador,$idfamiliar,$parentesco){
			$sql = "call SP_DERECHOHABIENTE_REGISTRO('$idtrabajador','$idfamiliar','$parentesco')";
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
