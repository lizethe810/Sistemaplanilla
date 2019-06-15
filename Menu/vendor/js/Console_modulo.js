
function VerificarUsuario(control){
			if (control=="Jefe de Contabilidad") {
			location.href='../SistemaContable/Vista/_Plantilla/home.php';
			}else{
			swal({
				  title: "Lo Sentimos",
				  text: "No tiene permisos para entrar a este modulo.",
				  icon: "error",
				  timer: 1000,
				  buttons: false // There won't be any cancel button
				  
				});	
			}
		
}
function Mensaje(){
			swal({
				  title: "Bienvenido",
				  text: "Bienvenido al modulo Contable!.",
				  icon: "success",
				  timer: 2000,
				  buttons: false // There won't be any cancel button
				  
				});	
}