<?php
	class Modelo_contrato
	{
		private $conexion;
		function __construct()
		{
			require_once('modelo_conexion.php');
			$this->conexion = new conexion();
			$this->conexion->conectar();
		}
		function listar_contrato($txt_fechainicio,$txt_fechafinal){
			$sql = "call PA_LISTARCONTRATOS('$txt_fechainicio','$txt_fechafinal')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function listar_combo_tipo_concepto_fijo_X_contrato($id_contrato){
			$sql = "CALL PA_COMBOTIPOCONCEPTOFIJOCONTRATO('$id_contrato')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function listar_combo_tipo_concepto_fijo(){
			$sql = "CALL PA_COMBOTIPOCONCEPTOFIJO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function listar_concepto_fijo($id_contrato){
			$sql = "call PA_LISTARCONCEPTOSFIJOS('$id_contrato')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function eliminar_concepto_fijo($id_conceptofijo){
			$sql = "call PA_ELIMINARCONCEPTOFIJO('$id_conceptofijo')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				$id_retornado = mysqli_insert_id($this->conexion->conexion);
				return 1;
				
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function registrar_concepto_fijo($sueldo,$id_contrato,$id_concepto){
			$sql = "call PA_REGISTRARCONCEPTOFIJO('$sueldo','$id_contrato','$id_concepto')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				$id_retornado = mysqli_insert_id($this->conexion->conexion);
				return 1;
				
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function listar_combo_area(){
			$sql = "CALL PA_COMBOAREA()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function listar_combo_tipo_contrato(){
			$sql = "CALL PA_COMBOTIPOCONTRATO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function listar_combo_seguro(){
			$sql = "CALL PA_COMBOSEGURO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function listar_combo_cargo(){
			$sql = "CALL PA_COMBOCARGO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function editar_contrato($id_contrato,$fecha_inicio,$fecha_final,$terminos,$cbm_tipocont,$cbm_area,$cbm_seguro,$cbm_cargo,$cbm_estado){
			$sql = "call PA_EDITARCONTRATO('$id_contrato','$fecha_inicio','$fecha_final','$terminos','$cbm_tipocont','$cbm_area','$cbm_seguro','$cbm_cargo','$cbm_estado')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				$id_retornado = mysqli_insert_id($this->conexion->conexion);
				return 1;
				
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
		function listar_trabajador_sincontrato($buscar){
			$sql = "call PA_LISTARTRABAJADOR_SINCONTRATO('%$buscar%')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
					$arreglo["data"][] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
		}
		function registrar_contrato($fecha_inicio,$fecha_final,$terminos,$cbm_tipocont,$cbm_area,$cbm_seguro,$cbm_cargo,$txt_sueldo,$id_trabajador){
			$sql = "call PA_REGISTRARCONTRATO('$fecha_inicio','$fecha_final','$terminos','$cbm_tipocont','$cbm_area','$cbm_seguro','$cbm_cargo','$txt_sueldo','$id_trabajador')";
			if ($resultado = $this->conexion->conexion->query($sql)){
				$id_retornado = mysqli_insert_id($this->conexion->conexion);
				if ($row = mysqli_fetch_array($resultado)){
					return $id = trim($row[0]);
				}
			}
			else{
				return 0;
			}
			$this->conexion->Cerrar_Conexion();
		}
	}
?>