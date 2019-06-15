<?php
session_start();
  if (isset($_SESSION['usuario'])) {
    header('Location: ../vista/index.php');
  } 
?>
<!DOCTYPE HTML>
<html lang="zxx">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>SISPLANILLA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="keywords" content="Full Screen Enroll Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link rel="stylesheet" href="_plantilla/css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="_plantilla/css/fontawesome-all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="_plantilla/js/sweetalert.css">
</head>
<body>
	<div class="main-w3ls">
		<div class="left-content" style="text-align: center;" align="center">
			<div class="copyright">
			</div>
		</div>
		<div class="right-form-agile">
			<div class="sub-main-w3">
				<br>
				<br>
				<br>				
				<br>					
				<h3>LOGIN - PLANILLA </h3>
				<br>
				<div class="form-style-agile">
					<label style="color:#000000;">Username</label>
					<br>							
					<div class="input-group mb-3">
					    <div class="input-group-prepend" >
					    <span class="input-group-text" id="basic-addon1" style="background-color: white"><span style="color:#e84601" class="fas fa-user"></span></span>
				        </div>
						<input type="text" class="form-control" placeholder="Username" id="txt_usuario">
					</div>
				</div>
				<div class="form-style-agile">
					<label style="color:#000000;">Password</label>
					<br>	
					<div class="input-group mb-3">
					    <div class="input-group-prepend" >
					  	    <br>
					        <span class="input-group-text" id="basic-addon1" style="background-color: white"><span style="color:#e84601" class="fa  fa-unlock-alt"></span></span>
					    </div>
						<input type="password" class="form-control" placeholder="Password" aria-label="Password" id="txt_pass">
					</div>
				</div>
				<button onclick="VerificarUsuario()" style="background: #e84601;border-top-color: rgb(232, 70, 1);border-bottom-color:rgb(232, 70, 1);border-left-color:rgb(232, 70, 1);border-right-color:rgb(232, 70, 1);color: white;" class="btn btn-warning btn-block btn-lg" >Entrar</button>

				<div class="m-t-10 text-inverse" align="center" ><br>
                    <table border="0" style="text-align:center; width:100%;font-size: 14px;font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;line-height: 1.42857143;" >
                        <tr >
                            <td></td>
                            <td></td>
                            <td>Recuperar <a href="#" onclick="Abrir_modal_recuperar_cuenta()" style="color:#00acac">Contrase&ntilde;a</a> </td>
                        </tr>
                    </table>     
                </div>
			</div>
		</div>
	</div>
</body>

<script src="../vista/Plantilla/boostrap/jquery/dist/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/console_usuario.js"></script>
<script src="_plantilla/js/sweetalert.min.js"></script>

</html>
<div class="modal fade bs-example-modal-lg" id="modal_recuperar"  role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	        <div class="modal-header"  style="padding: 12px 15px;" >
	                <h5 class="modal-title" style="font-size: 14px;font-family: inherit;font-weight: 600;color: #242a30;">Enviar Informaci&oacute;n:  </h5> 
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	        </div>
	        <div class="modal-body" style="font-size: 14px;padding: 15px;" >
	            <div class="form-group">
		            <label for="recipient-name" class="form-control-label"><b>Ingrese su correo electronico registrado para recibir la información:</b></label>
		            <div class="input-group">
		              	<div class="input-group-prepend" >
					  	    <br>
					        <span class="input-group-text" id="basic-addon1" style="background-color: white">@</span>
					    </div>
		              	<input type="text" class="form-control"   style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtcorreo" maxlength="300" placeholder="Ingresar correo">
		            </div>
		        </div>
	        </div> 
	        <div class="modal-footer">
	            <button type="button" style="font-weight: 600;line-height: 20px;padding: 6px 12px;transition: all .1s ease-in-out;box-shadow: none !important;font-size: 12px;" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-minus-sign"></span>&nbsp;<b>Cancelar</b></button>
		        <button type="button" onclick="filtrar_email();" class="btn btn-success"><b>Enviar</b></button>
	        </div> 
	    </div>
	  </div> 
</div>