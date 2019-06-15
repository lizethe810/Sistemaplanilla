function abrirModalusuario(){
    traer_administrador();
	$('#modal_cuenta').modal({backdrop: 'static', keyboard: false})
	$("#modal_cuenta").modal("show");
}
function Editar_cuenta(){
	var usuario = $("#txtusuario").val();
	var actual  = $("#txtactual").val();
	var nueva   = $("#txtnueva").val();
	var repetir = $("#txtrepetir").val();
	var original= $("#txtoriginal").val();
	if (original!=actual) {
			return swal("La clave no coincide con la actual","clave incorrecta","error");
	}
	if (nueva!=repetir) {
		return swal("Debes ingresar la misma clave dos veces para confirmar","","warning");
	}
	$.ajax({
		type:'POST',
		url:'../controlador/usuario/controlador_cuenta_actualizar.php',
		data:{
			_usuario:usuario,
			_actual:actual,
			_nueva:nueva
		}
	})
	.done(function(resp){
		Limpiar_POST_cuenta();
		$("#modal_cuenta").modal("hide");
		if (resp>0) {
			swal("Su cuenta fue Actualizada con Exito!!!","","success");
		}else{
			swal("No se pudo Actualizar su Cuenta!!!","","error");
		}
	})
}
function Limpiar_POST_cuenta(){
	$("#txtactual").val("");
	$("#txtnueva").val("");
	$("#txtrepetir").val("");
	traer_administrador();
}
function traer_administrador(){
	var codigo_personal = $("#txtcodigo_principal_usuario").val();
	$.ajax({
		url:'../controlador/usuario/controlador_administrador_buscar.php',
		type:'POST',
		data:{
			buscar:codigo_personal
		}
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length > 0) {
			$("#txtoriginal").val(data[0][5]);
			$("#txtnombre_usuario1").html(data[0][0]+" "+data[0][1]+" "+data[0][2]);
		}
	})
}
function AbrirModalTrabajador(){
	listar_trabajador('');
	$('#modal_ver_trabajadores').modal({backdrop: 'static', keyboard: false})
	$("#modal_ver_trabajadores").modal("show");
}
function listar_trabajador(buscar){
	var cadena = '<table table id="tabla_trabajador" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
                 '<thead >'+
                    '<tr role="row" class="odd">'+
                      '<th hidden="true">ID</th>'+
                      '<th style="text-align: left;width: 150px;word-wrap: break-word;">NOMBRE</th>'+
                      '<th style="text-align: left;width: 150px;word-wrap: break-word;">APELLIDO PATERNO</th>'+
                      '<th style="text-align: left;width: 150px;word-wrap: break-word;">APELLIDO MATERNO</th>'+
                      '<th style="text-align: center;width: 150px;word-wrap: break-word;">FECHA NACIMIENTO</th>'+
                      '<th style="text-align: left;width: 50px;word-wrap: break-word;">ACCI&Oacute;N</th>'+
                    '</tr>'+
                  '</thead>'+
                '</table>';
     $("#div_tabla_trabajador").html(cadena);
	var table = $("#tabla_trabajador").DataTable({
		"searching":false,
		"bLengthChange":false,
		"ordering":false,
		"pageLength":10,
		"destroy":true,
		"select":true,
		"ajax":{
			"method":"POST",
			"url":"../controlador/usuario/controlador_trabajador_sinusuario_listar.php",
			data:{
				buscar:buscar
			}
		},
		"columns":[
				{"data":"trabajador_cod","visible":false},
				{"data":"trab_nombre"},
				{"data":"trab_apellidopate"},
				{"data":"trab_apellidomate"},
				{"data":"trab_fechanacimiento"},
				{"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-success'><span class='fa fa-edit'></span>&nbsp;&nbsp;<b>ENVIAR</b></button>"}
		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
	        $($(nRow).find("td")[3]).css('text-align', 'center' );
	    },
		"language":idioma_espanol
	});
	obtener_dato_enviar("#tabla_trabajador tbody",table);
}
var obtener_dato_enviar = function(tbody, table){
  	$(tbody).on("click", "button.editar", function(){
		var data       = table.row( $(this).parents("tr")).data();
		EnviarDatosTrabajador(data.trabajador_cod,data.trab_nombre,data.trab_apellidopate,data.trab_apellidomate);
	});
}
var idioma_espanol = {
	"sProcessing":     "Procesando...",
	"sLengthMenu":     "Mostrar _MENU_ registros",
	"sZeroRecords":    "No se encontraron resultados",
	"sEmptyTable":     "Ningún dato disponible en esta tabla",
	"sInfo":           "Registros del (_START_ al _END_) total de _TOTAL_ registros",
	"sInfoEmpty":      "Registros del (0 al 0) total de 0 registros",
	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	"sInfoPostFix":    "",
	"sSearch":         "Buscar:",
	"sUrl":            "",
	"sInfoThousands":  ",",
	"sLoadingRecords": "<b>No se encontraron datos</b>",
	"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
	},
	"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
	}
}
function EnviarDatosTrabajador(id,nombre,apepat,apemat){
	$("#txt_idtrabajador").val(id);
	$("#txt_datostrabajador").val(nombre+" "+apepat+" "+apemat);
	$("#modal_ver_trabajadores").modal("hide");
}
function RegistrarUsuario(){
	var usuario       = $("#txtusuario").val();
	var clave		  = $("#txtcontra1").val();
	var id_trabajador = $("#txt_idtrabajador").val();
	var fechainicio   = $("#txtfecha_inicio").val();
	var fechafinal	  = $("#txtfecha_final").val();
	var rol 		  = $("#cmb_rol").val();
	if (id_trabajador.length==0) {
		return swal("Falta seleccionar un trabajador sin usuario","","info");
	}
	if (usuario.length==0) {
		return swal("Falta ingresar un usuario","","info");
	}
	if (clave.length==0) {
		return swal("Falta ingresar una clave para el usuario","","info");
	}
	if (fechainicio.length==0) {
		return swal("Falta Ingresar una fecha inicio para darle permisos al usuario","","info");
	}
	if (fechafinal.length==0) {
		return swal("Falta Ingresar una fecha final para darle permisos al usuario","","info");
	}

	$.ajax({
		url:'../controlador/usuario/controlador_registrar_usuario.php',
		type:'POST',
		data:{
			id_trabajador:id_trabajador,
			usuario:usuario,
			clave:clave,
			fechainicio:fechainicio,
			fechafinal:fechafinal,
			rol:rol
		}
	})
	.done(function(resp){
		if (resp==1) {
			listar_trabajador('');
			$("#txtusuario").val("");
			$("#txtcontra1").val("");
			$("#txt_idtrabajador").val("");
			$("#txt_datostrabajador").val("");
			$("#txtfecha_inicio").val("");
			$("#txtfecha_final").val("");
			swal("Usuario registrado con exito!","","success");
		}else{
			if (resp==2)  {
				swal("El nombre de usuario ya se encuentra registrado en nuestra data","","error");
			}else{
				swal("No se pudo registrar el Usuario!","","error");
			}
		}
	})
}