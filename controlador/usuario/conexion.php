<?php 
$mysqli = new mysqli("localhost","vipeicvc_sistema_RRHH","1234567890R","vipeicvc_recursoshumanos"); 	
if(mysqli_connect_errno()){
  echo 'Conexion Fallida : ', mysqli_connect_error();
  exit();
}

function conexion(){
	return mysqli_connect("localhost","vipeicvc_sistema_RRHH","1234567890R","vipeicvc_recursoshumanos"); 	
}
?>