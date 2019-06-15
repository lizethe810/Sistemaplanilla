<?php
$correo       = $_POST["correo"];
$usuario      = $_POST["usuario"];
$clave        = $_POST["clave"];

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
     mail($email_destinario,"Informacion de su Cuenta",utf8_encode($mensaje),$cabeceras);
    echo $correo;
?>