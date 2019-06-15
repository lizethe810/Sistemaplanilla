<?php

	class Modelo_usuario
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}
		function buscar_email($buscar){
			$sql = "CALL PA_BUSCAREMAIL('$buscar')";
			
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}
		function Verificar_usuario($usuario,$pass){
			$sql = "call PA_VERIFICARUSUARIO('$usuario','$pass')";
			
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}
		function listar_usuarios($buscar){
			$sql = "call PA_LISTARUSUARIO('%$buscar%')";

			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function listar_trabajadores_sin_usuario($buscar){
			$sql = "call PA_LISTARTRABAJADORES_SINUSUARIO('%$buscar%')";

			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function actualizar_clave($id_usuario,$clave){
			$sql = "call PA_ACTUALIZARCUENTA('$id_usuario','$clave')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function buscar_adminsitrador($buscar){
			$sql = "call PA_BUSCARADMINISTRADOR('$buscar')";	
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}
		function editar_usuario($usuario,$actual,$nueva){
			$sql = "call PA_EDITARUSUARIO('$usuario','$actual','$nueva')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function registrar_usuario($id_trabajador,$usuario,$clave,$fechainicio,$fechafinal,$rol){
			$sql = "call PA_REGISTRARUSUARIO('$id_trabajador','$usuario','$clave','$fechainicio','$fechafinal','$rol')";
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
	}
?>