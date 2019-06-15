<?php
	$id_usuario = $_POST['id_usuario'];
	$usuario = $_POST['usuario'];
	$correo  = $_POST['email'];
	$clave = $_POST['clave'];
	include '../../modelo/modelo_usuario.php';
	$MC = new Modelo_usuario();
	$consulta = $MC->actualizar_clave($id_usuario,$clave);
	if ($consulta==1) {
			$mensaje = "
			  <table border='1' cellspacing='0' cellpadding='5'>
			    <tr>
			      <td colspan='2' style='color:white;background-color:red;text-align:center;'><b>DATOS DE USUARIO DEL TRABAJADOR</b></td>
			    </tr>
			    <tr>
			      <td>E-MAIL: </td><td>$correo</td>
			    </tr>
			    <tr>
			      <td>USUARIO: </td><td>$usuario</td>
			    </tr>
			    <tr>
			      <td>CLAVE: </td><td>$clave</td>
			    </tr>
			  </table>
			";
			$cabeceras = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$cabeceras .= "From: SIS PLANILLA <xxxx@vipexpressperu.com> \r\n";
			$cabeceras .= 'Reply-To:xxxx@vipexpressperu.com'. "\r\n".
			'X-Mailer: PHP/' . phpversion();
			$email_destinario = $correo;
			    mail($email_destinario,utf8_encode("Nueva informacion de su cuenta - Cuenta Reseteada"),utf8_encode($mensaje),$cabeceras);
	}
	echo $consulta;
?>