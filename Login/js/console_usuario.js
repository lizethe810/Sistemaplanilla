function VerificarUsuario(){
	var u = $("#txt_usuario").val();
	var p = $("#txt_pass").val();
	var intentos = $("#txtintentos").val();
	if (u.length == 0 || p.length == 0) {
		swal("Campos incompletos!!");
	}
	else{
		$.ajax({
			url:'../controlador/usuario/controlador_usuario_validar.php',
			type:'POST',
			data:{
				user:u,
				pass:p
			}
		})
		.done(function(resp){
			var data = JSON.parse(resp);
			if (resp==0) {
				swal("Usuario y/o contrase\u00f1a no Valido","","error");
			}
			else{
				var fecha2 = data[0][9].split("-");
				var f  = new Date();
				var f1 = new Date(fecha2[0], fecha2[1], fecha2[2]);
				var f2 = new Date(f.getFullYear(), (f.getMonth() +1) , f.getDate());
				if (f1<f2) {
					return swal("Su cuenta no tiene permisos para acceder al sistema","Para mas informacion comuniquese con el administrador","warning");
				}
				$.ajax({
					url:'../controlador/usuario/controlador_iniciar_sesion.php',
					type:'POST',
					data:{
						user:data[0][0],
						pass:data[0][1],
						rol:data[0][3],
						nom:data[0][4],
						apeP:data[0][5],
						apeM:data[0][6],
						iduser:data[0][10]
					}
				})
				.done(function(resp){
					swal({
						title: "Bienvenido",
						text: "Datos Correctos.",
						timer: 1000,
						showConfirmButton: false  
					});
					location.reload(true);
				})
			}
		})
	}
}
function Abrir_modal_recuperar_cuenta(){
	$('#modal_recuperar').modal({backdrop: 'static', keyboard: false})
	$("#modal_recuperar").modal('show');
}
function filtrar_email(){
	var u = $("#txtcorreo").val();
	if (u.length==0) {
		return swal("Falta ingresar el email","","warning");
	}
	if (validar_email(u)) {
	}else{
		return swal("Lo sentimos, formato del email no es valido.","", "error");
	}
	$.ajax({
		url:'../controlador/usuario/controlador_verificar_email.php',
		type:'POST',
		data:{
			buscar:u
		}
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length > 0) {
			EnviarMensajeCorreo(data[0][0],data[0][1],data[0][2]);
		}else{
			swal("Lo sentimos el email ingresado no se encuentra en nuestra data","","warning");
		}
	})
}
function EnviarMensajeCorreo(email,usuario,clave){
	var correo   = $("#txtcorreo").val();
	if (correo.length==0) {
		return swal("Falta ingresar el email","","warning");
	}
	if (validar_email(correo)) {
	}else{
		return swal("Lo sentimos, formato del email no es valido.","", "error");
	}
	$.ajax({
		url:'../controlador/usuario/controlador_enviar_mensaje.php',
		type:'POST',
		data:{
			correo:email,
			usuario:usuario,
			clave:clave
		}
	})
	.done(function(resp){
		$("#txtcorreo").val("");
		
		swal("Informacion enviada!","","success")
		.then ((value) => {
            $("#modal_recuperar").modal("hide");
        });
	})
}
function validar_email(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}