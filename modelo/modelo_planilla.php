<?php
	class Modelo_planilla
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}
		function listar_planilla_contrato_registro(){
			$sql = "call PA_LISTARPLANILLACONTRATOSREGISTRO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function listar_planilla_contrato($combo_anio,$combo_mes){
			$sql = "call PA_LISTARPLANILLACONTRATOS('$combo_anio','$combo_mes')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function listar_combo_tipo_concepto_variable(){
			$sql = "CALL PA_COMBOTIPOCONCEPTOVARIABLE()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function listar_concepto_variable($id_pagoplanilla){
			$sql = "call PA_LISTARCONCEPTOSVARIABLES('$id_pagoplanilla')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function eliminar_concepto_variable($id_conceptovariable){
			$sql = "call PA_ELIMINARCONCEPTOVARIABLE('$id_conceptovariable')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				$id_retornado = mysqli_insert_id($this->conexion->conexion);
				return 1;
				
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function registrar_concepto_variable($id_pagoplanilla,$id_tipoconcepto,$txt_monto,$text_argumento){
			$sql = "call PA_REGISTRARCONCEPTOVARIABLE('$id_pagoplanilla','$id_tipoconcepto','$txt_monto','$text_argumento')";
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
		function registrar_planilla($id_contrato,$txt_anio,$txt_mes){
			$sql = "call PA_REGISTRARPLANILLA('$id_contrato','$txt_anio','$txt_mes')";
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
		function registrar_planilla_pago($planilla_id,$sueldobase,$sueldobruto){
			$sql = "call PA_REGISTRARPLANILLAPAGO('$planilla_id','$sueldobase','$sueldobruto')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				return 1;
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
	}
?>