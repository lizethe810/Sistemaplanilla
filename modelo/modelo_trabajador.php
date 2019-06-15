<?php
	class Modelo_trabajador
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}
		function listar_trabajador($buscar){
			$sql = "call PA_LISTARTRABAJADOR('%$buscar%')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function listar_trabajador_medio_comunicacion($buscar){
			$sql = "call PA_LISTARTRABAJADOR_MEDIOCOMUNICACION('$buscar')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function registrar_medio_comunicacion($id_trabajador,$medio,$tipo,$nivel){
			$sql = "call PA_REGISTRARMEDIOCOMUNICACION('$id_trabajador','$medio','$tipo','$nivel')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				$id_retornado = mysqli_insert_id($this->conexion->conexion);
				return 1;
				
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function eliminar_medio_comunicacion($id_medio){
			$sql = "call PA_ELIMINARMEDIOCOMUNICACION('$id_medio')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				$id_retornado = mysqli_insert_id($this->conexion->conexion);
				return 1;
				
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function registrar_documento_identidad($id_trabajador,$dni,$tipo){
			$sql = "call PA_REGISTRARDOCUMENTOIDENTIDAD('$id_trabajador','$dni','$tipo')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				$id_retornado = mysqli_insert_id($this->conexion->conexion);
				if ($row = mysqli_fetch_array($resultado)){
				return $id_usuario = trim($row[0]);
				}
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function listar_trabajador_documento_identidad($buscar){
			$sql = "call PA_LISTARTRABAJADOR_DOCUMENTOIDENTIDAD('$buscar')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function eliminar_documento_identidad($id_documento){
			$sql = "call PA_ELIMINARDOCUMENTOIDENTIDAD('$id_documento')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				$id_retornado = mysqli_insert_id($this->conexion->conexion);
				return 1;
				
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}

	}
?>