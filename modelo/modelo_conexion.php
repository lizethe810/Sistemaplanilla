<?php
	class conexion{
		private $servidor;
		private $usuario;
		private $contraseña;
		private $basedatos;
		public $conexion;
		public function __construct(){
			$this->servidor = "localhost";
			$this->usuario = "vipeicvc_sistema_RRHH";
			$this->contrasena = "1234567890R";
			$this->basedatos = "vipeicvc_recursoshumanos";
		}
		function conectar(){
			$this->conexion = new mysqli($this->servidor,$this->usuario,$this->contrasena,$this->basedatos);
			//ñ´s y tildes...
			$this->conexion->set_charset("utf8");
		}
		function cerrar(){
			$this->conexion->close();	
		}
	}
?> 

