function listar_usuario_empresa(buscar){
	var table = $("#tabla_empresa").DataTable({
		"searching":false,
		"bLengthChange":false,
		"ordering":false,
		"pageLength":10,
		"destroy":true,
		"select":true,
		"ajax":{
			"method":"POST",
			"url":"../controlador/usuario/controlador_usuario_listar.php",
			data:{
				buscar:buscar
			}
		},
		"columns":[
				{"data":"posicion"},
				{"data":"usu_codigo","visible": false},
				{"data":"empleado"},
				{"data":"trab_email"},
				{"data":"usu_email"},
				{"data":"usu_clave"},
				{"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-danger'><span class='fa fa-edit'></span>&nbsp;&nbsp;<b>RESETEAR</b></button>"}
		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
	        $($(nRow).find("td")[0]).css('text-align', 'center' );
	        $($(nRow).find("td")[3]).css('text-align', 'center' );
	        $($(nRow).find("td")[4]).css('text-align', 'center' );
	        $($(nRow).find("td")[4]).css('font-weight', 'bold' );
	        $($(nRow).find("td")[4]).css('color', '#9B0000' );
	    },
		"language":idioma_espanol
	});
	obtener_dato_editar_usuario("#tabla_empresa tbody",table);
}
var obtener_dato_editar_usuario = function(tbody, table){
  	$(tbody).on("click", "button.editar", function(){
		var data       = table.row( $(this).parents("tr")).data();
		var caracteres = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9'];
		var cadena = "";
		for (var i = 0; i < 10; i++) {
			cadena += caracteres[Math.round(Math.random()*26)]+'';
		}
		ResetearClave(data.usu_codigo,data.empleado,cadena,data.trab_email,data.usu_email);
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
function ResetearClave(codigo,empleado,clave,email,usuario){
	swal({
	  title: "¿Seguro que deseas Resetear la clave de usuario del trabajador "+empleado+"?",
	  text: "",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	    $.ajax({
	  		url:'../controlador/usuario/controlador_actualizar_clave.php',
	  		type:'POST',
	  		data:{
	  			id_usuario:codigo,
	  			usuario:usuario,
	  			email:email,
	  			clave:clave
	  		}
	  	})
	  	.done(function(resp){
	  		$("#contenido_principal").load("usuario/vista_usuario_listar.php");
	  		if (resp>0) {
	  			swal("Clave de la cuenta del trabajador fue reseteado con exito","", {
				    icon: "success",
				});
	  		}else{
	  			swal("No se pudo resetear la cuenta del trabajador","","error");
	  		}
	  	})
	  } else {
	    swal("Proceso Cancelado!","","info");
	  }
	});
}
function listar_trabajador(buscar){
	var cadena_principal ="";
	cadena_principal +='<table table id="tabla_trabajador" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
              '<thead >'+
               ' <tr role="row" class="odd">'+
                '  <th style="text-align: center;width: 80px;word-wrap: break-word;">Nro</th>'+
                 ' <th style="text-align: left;width: 300px;word-wrap: break-word;">TRABAJADOR</th>'+
                 ' <th style="text-align: center;width: 80px;word-wrap: break-word;">SEXO</th>'+
                 ' <th style="text-align: center;width: 150px;word-wrap: break-word;">FECHA NACI.</th>'+
                  '<th style="text-align: left;width: 100px;word-wrap: break-word;">E-MAIL PRINCIPAL</th>'+
                  '<th style="text-align: left;width: 100px;word-wrap: break-word;">TELEFONO PRINCIPAL</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">MEDIOS DE COMUNICACIÓN</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">DOCUMENTOS DE IDENTIDAD</th>'+
                  '<th style="text-align: center;width: 80px;word-wrap: break-word;">ACCI&Oacute;N</th>'+
                '</tr>'+
              '</thead>'+
            '</table>';
           $("#div_tabla_trabajador").html(cadena_principal);
	var table = $("#tabla_trabajador").DataTable({
		"searching":false,
		"bLengthChange":false,
		"ordering":false,
		"pageLength":10,
		"destroy":true,
		"select":true,
		"ajax":{
			"method":"POST",
			"url":"../controlador/trabajador/controlador_trabajador_listar.php",
			data:{
				buscar:buscar
			}
		},
		"columns":[
				{"data":"posicion"},
				{"data":"empleado"},
				{"data":"trab_sexo"},
				{"data":"trab_fechanacimiento"},
				{"data":"trab_email"},
				{"data":"trab_telefono"},
				{"defaultContent": "<button style='font-size:13px;' type='button' class='editar_mediocomunicacion btn btn-success'><span class='fa fa-edit'></span></button>"},
				{"defaultContent": "<button style='font-size:13px;' type='button' class='editar_documentoidentidad btn btn-primary'><span class='fa fa-edit'></span></button>"},
				{"defaultContent": "<button style='font-size:13px;' type='button' class='editar_datostrabajador btn btn-danger'><span class='fa fa-edit'></span></button>"},
		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
	        $($(nRow).find("td")[0]).css('text-align', 'center' );
	        $($(nRow).find("td")[2]).css('text-align', 'center' );
	        $($(nRow).find("td")[3]).css('text-align', 'center' );
	        $($(nRow).find("td")[5]).css('text-align', 'center' );
	        $($(nRow).find("td")[6]).css('text-align', 'center' );
	        $($(nRow).find("td")[7]).css('text-align', 'center' );
	        $($(nRow).find("td")[8]).css('text-align', 'center' );
	        $($(nRow).find("td")[4]).css('font-weight', 'bold' );
	        $($(nRow).find("td")[5]).css('font-weight', 'bold' );
	    },
		"language":idioma_espanol
	});
	obtener_dato_editar_medio_comunicacion("#tabla_trabajador tbody",table);
	obtener_dato_editar_documento_identidad("#tabla_trabajador tbody",table);
	obtener_dato_editar_datos_trabajador("#tabla_trabajador tbody",table);
}
var obtener_dato_editar_medio_comunicacion = function(tbody, table){
  	$(tbody).on("click", "button.editar_mediocomunicacion", function(){
		var data       = table.row( $(this).parents("tr")).data();
		$('#lb_trabajador1').html(data.empleado);
		Editar_medio_comunicacion(data.trabajador_cod);
	});
}
var obtener_dato_editar_documento_identidad = function(tbody, table){
  	$(tbody).on("click", "button.editar_documentoidentidad", function(){
		var data       = table.row( $(this).parents("tr")).data();
		$('#lb_trabajador2').html(data.empleado);
		Editar_documento_identidad(data.trabajador_cod);
	});
}
var obtener_dato_editar_datos_trabajador = function(tbody, table){
  	$(tbody).on("click", "button.editar_datostrabajador", function(){
		var data       = table.row( $(this).parents("tr")).data();
		$('#lb_trabajador3').html(data.empleado);
		$('#txttrabajador3').val(data.trabajador_cod);
		$('#txtnombre').val(data.trab_nombre);
		$('#txtapepat').val(data.trab_apellidopate);
		$('#txtapemat').val(data.trab_apellidomate);
		if (data.trab_sexo=="F") {
			$(".sexF"). iCheck ('check');
		}else{
			$(".sexM"). iCheck ('check');
		}
		$('#txtfecha_nacimiento').val(data.trab_fechanacimiento);
		$('#txtemail').val(data.trab_email);
		$('#txttelefono').val(data.trab_telefono);
		$('#modal_ver_datos_trabajador').modal({backdrop: 'static', keyboard: false})
		$("#modal_ver_datos_trabajador").modal("show");
	});
}
function Editar_medio_comunicacion(trabajador_cod) {
	$('#txttrabajador1').val(trabajador_cod);
	$('#modal_ver_medios_comunicacion').modal({backdrop: 'static', keyboard: false})
	$("#modal_ver_medios_comunicacion").modal("show");
	$.ajax({
		url:'../controlador/trabajador/controlador_listar_medio_comunicacion.php',
		type:'POST',
		data:{
			buscar:trabajador_cod
		}
	})
	.done(function(resp){
		var data = JSON.parse(resp);
	    if (data.length > 0) {
	    	var cadena ="";
	      	for (var i = 0; i < data.length; i++) {
	      		cadena += "<tr>";
					cadena += "<td style = 'font-weight:bold;width: 80px;word-wrap: break-word;vertical-align:middle;color:#9B0000;text-align:center'>"+data[i][0]+"</td>";		
					cadena += "<td style = 'width: 300px;word-wrap: break-word;vertical-align:middle;'>"+data[i][2]+"</td>";		
					cadena += "<td style = 'width: 80px;word-wrap: break-word;vertical-align:middle;'>"+data[i][3]+"</td>";
					cadena += "<td style = 'width: 80px;word-wrap: break-word;vertical-align:middle;text-align:center'>"+data[i][6]+"</td>";
					cadena += "<td style = 'width: 80px;word-wrap: break-word;vertical-align:middle;text-align:center'><button class='btn btn-danger' name='"+data[i][1]+"*"+data[i][4]+"' onclick='eliminar_medio_comunicacion(this)'><i class='fa fa-trash' height='10px;'></i></button></td></td>";

				cadena += "</tr>";
				/*if (data[i][5]=="Correo") {
					if (data[i][6]=="P") {
						arreglo_nivel[i]=data[i][6];
					}
				}*/
	      	}
	      	$("#tbody_tabla_medio_comunicacion").html(cadena);
	    }else{
	    	$("#tbody_tabla_medio_comunicacion").html("<tr><td colspan='5' style='text-align:center'><b>No se encontraron registros</b></td></tr>");
	    }
	})
}
function registrar_medio_comunicacion(){
	var trabajador_cod = $("#txttrabajador1").val();
	var medio = $("#txtrazonsocial").val();
	var tipo  = $("#cbm_tipo").val();
	var nivel    = "";
	var pornivel=document.getElementsByName("pr1");
    for(var i=0;i<pornivel.length;i++){
        if(pornivel[i].checked)
            nivel=pornivel[i].value;
    }
    if (medio.length==0) {
    	return swal("Falta llenar el medio de comunicacion","","info");
    }
    if (tipo=="Correo") {
	    if (validar_email(medio)) {
		}else{
			return swal("Lo sentimos, formato de email del remitente no es valido.","", "error");
		}
	}
    var arreglo_nivel = new Array();
	var arreglo_tipo = new Array();
	$("#tabla_mediocomunicacion tbody#tbody_tabla_medio_comunicacion tr").each(function(){
	 	arreglo_tipo.push($(this).find('td').eq(2).text());
	 	arreglo_nivel.push($(this).find('td').eq(3).text());
 	})
 	var cont_correo = 0;
 	var cont_telefono = 0;
 	for (var i = 0; i < arreglo_nivel.length; i++) {
 		if(arreglo_tipo[i] == "Correo"){
 			if (arreglo_nivel[i]=="P") {
 				cont_correo=1;
 			}
 		}
 		if(arreglo_tipo[i] == "Telefono"){
 			if (arreglo_nivel[i]=="P") {
 				cont_telefono=1;
 			}
 		}
 	}
 	if (tipo=="Correo") {
 		if (nivel=="P") {
 			if (cont_correo==1) {
 				return swal("Lo sentimos ya fue definido un correo principal","","warning");
 			}
 		}
 	}
 	if (tipo=="Telefono") {
 		if (nivel=="P") {
 			if (cont_telefono==1) {
 				return swal("Lo sentimos ya fue definido un Telefono principal","","warning");
 			}
 		}
 	}
 	$.ajax({
		url:'../controlador/trabajador/controlador_registrar_medio_comunicacion.php',
		type:'POST',
		data:{
			codigo:trabajador_cod,
			medio:medio,
			tipo:tipo,
			nivel:nivel
		}
	})
	.done(function(resp){
	    if (resp==1) {
	    	var dato_buscar = $("#txtbuscar").val();
			var table = $('#tabla_trabajador').DataTable();
			table.destroy();
	  		listar_trabajador(dato_buscar);
			Editar_medio_comunicacion(trabajador_cod);
			$("#txtrazonsocial").val("");
			swal("El "+tipo+"fue  registrado con exito","","success");
		}else{
			if (resp==2)  {
				swal("El "+ tipo +" ingresado ya se encuentra registrado en nuestra data","","error");
			}else{
				swal("No se pudo registrar el nuevo "+tipo,"","error");
			}
		}
	})
}
function validar_email(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}
function eliminar_medio_comunicacion(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	swal({
	  title: "¿Seguro que deseas eliminar el medio de comunicacion?",
	  text: "",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	    $.ajax({
	  		url:'../controlador/trabajador/controlador_eliminar_medio_comunicacion.php',
	  		type:'POST',
	  		data:{
	  			id_medio:datos_split[0]
	  		}
	  	})
	  	.done(function(resp){
	  		var dato_buscar = $("#txtbuscar").val();
  			listar_trabajador(dato_buscar);
	  		Editar_medio_comunicacion(datos_split[1]);
	  		if (resp>0) {
	  			swal("El medio de comunicacion fue eliminado con exito","", {
				    icon: "success",
				});
	  		}else{
	  			swal("Lo sentimos no se puede eliminar el medio de comunicacion","","error");
	  		}
	  	})
	  }
	});
}
function Editar_documento_identidad(trabajador_cod) {
	$('#txttrabajador2').val(trabajador_cod);
	$('#modal_ver_documento_identidad').modal({backdrop: 'static', keyboard: false})
	$("#modal_ver_documento_identidad").modal("show");
	$.ajax({
		url:'../controlador/trabajador/controlador_listar_documento_identidad.php',
		type:'POST',
		data:{
			buscar:trabajador_cod
		}
	})
	.done(function(resp){
		var data = JSON.parse(resp);
	    if (data.length > 0) {
	    	var cadena ="";
	      	for (var i = 0; i < data.length; i++) {
	      		cadena += "<tr>";
					cadena += "<td style = 'font-weight:bold;width: 80px;word-wrap: break-word;vertical-align:middle;color:#9B0000;text-align:center'>"+data[i][0]+"</td>";		
					cadena += "<td style = 'width: 300px;word-wrap: break-word;vertical-align:middle;'>"+data[i][3]+"</td>";		
					cadena += "<td style = 'width: 80px;word-wrap: break-word;vertical-align:middle;'>"+data[i][2]+"</td>";
					cadena += "<td style = 'width: 80px;word-wrap: break-word;vertical-align:middle;text-align:center'><button class='btn btn-danger' name='"+data[i][1]+"*"+data[i][4]+"' onclick='eliminar_documento_identidad(this)'><i class='fa fa-trash' height='10px;'></i></button></td></td>";
				cadena += "</tr>";
	      	}
	      	$("#tbody_tabla_documentoidentidad").html(cadena);
	    }else{
	    	$("#tbody_tabla_documentoidentidad").html("<tr><td colspan='4' style='text-align:center'><b>No se encontraron registros</b></td></tr>");
	    }
	})
}
function eliminar_documento_identidad(control){
	var datos = control.name;
	var datos_split = datos.split("*");
	swal({
	  title: "¿Seguro que deseas eliminar el medio de comunicacion?",
	  text: "",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	    $.ajax({
	  		url:'../controlador/trabajador/controlador_eliminar_documento_identidad.php',
	  		type:'POST',
	  		data:{
	  			id_documento:datos_split[0]
	  		}
	  	})
	  	.done(function(resp){
	  		var dato_buscar = $("#txtbuscar").val();
	  		Editar_documento_identidad(datos_split[1]);
	  		if (resp>0) {
	  			swal("El documento de identidad fue eliminado con exito","", {
				    icon: "success",
				});
	  		}else{
	  			swal("Lo sentimos no se puede eliminar el documento de identidad","","error");
	  		}
	  	})
	  }
	});
}
function registrar_documento_identidad(){
	var trabajador_cod = $("#txttrabajador2").val();
	var dni   = $("#txtdni").val();
	var tipo  = $("#cbm_tipo_documento").val();
    if (dni.length==0) {
    	return swal("Falta llenar el nro de documento","","info");
    }
	var arreglo_tipo = new Array();
	$("#tabla_documentoidentidad tbody#tbody_tabla_documentoidentidad tr").each(function(){
	 	arreglo_tipo.push($(this).find('td').eq(2).text());
 	})
 	var cont_tipo = 0;
 	for (var i = 0; i < arreglo_tipo.length; i++) {
 		if (tipo ==arreglo_tipo[i]) {
 			return swal("Lo sentimos el tipo de documento "+ tipo +" ya fue registrado para el trabajador","","warning");
 		}
 	}
 	$.ajax({
		url:'../controlador/trabajador/controlador_registrar_documento_identidad.php',
		type:'POST',
		data:{
			codigo:trabajador_cod,
			dni:dni,
			tipo:tipo
		}
	})
	.done(function(resp){
	    if (resp==1) {
	    	var dato_buscar = $("#txtbuscar").val();
	  		listar_trabajador(dato_buscar);
			Editar_documento_identidad(trabajador_cod);
			$("#txtdni").val("");
			swal("Documento de identidad registrado con exito!","","success");
		}else{
			if (resp==2)  {
				swal("El Documento de identidad ya se encuentra registrado en nuestra data","","error");
			}else{
				swal("No se pudo registrar el Documento de identidad !","","error");
			}
		}
	})
}
function Editar_datos_trabajador(){
	var txt_idtrabajador = $('#txttrabajador3').val();
	var txt_nombre       = $('#txtnombre').val();
	var txt_apepat       = $('#txtapepat').val();
	var txt_apemat       = $('#txtapemat').val();
	var rad_sexo ="";
	var porsexo=document.getElementsByName("sex");
    for(var i=0;i<porsexo.length;i++){
        if(porsexo[i].checked)
            rad_sexo=porsexo[i].value;
    }
	var txt_fechanacimi  = $('#txtfecha_nacimiento').val();
	$.ajax({
		url:'../controlador/trabajador/controlador_editar_datos_trabajador.php',
		type:'POST',
		data:{
			txt_idtrabajador:txt_idtrabajador,
			txt_nombre:txt_nombre,
			txt_apepat:txt_apepat,
			txt_apemat:txt_apemat,
			rad_sexo:rad_sexo,
			txt_fechanacimi:txt_fechanacimi
		}
	})
	.done(function(resp){
		var dato_buscar = $("#txtbuscar").val();
		var table = $('#tabla_trabajador').DataTable();
		table.destroy();
		$("#modal_ver_datos_trabajador").modal("hide");
  		listar_trabajador(dato_buscar);
	    if (resp > 0) {
	      	swal("Datos actualizados con exito","","success");
	    }else{
	    	swal("No se pudo actualizar los datos","","error");
	    }
	})
}
function agregar_medio_comunicacion(){
	var medio = $("#txtrazonsocial").val();
	var tipo  = $("#cbm_tipo").val();
	var nivel    = "";
	var pornivel=document.getElementsByName("pr1");
    for(var i=0;i<pornivel.length;i++){
        if(pornivel[i].checked)
            nivel=pornivel[i].value;
    }
    if (medio.length==0) {
    	return swal("Falta llenar el medio de comunicacion","","info");
    }
    if (tipo=="Correo") {
	    if (validar_email(medio)) {
		}else{
			return swal("Lo sentimos, formato de email del remitente no es valido.","", "error");
		}
	}
    var arreglo_nivel = new Array();
	var arreglo_tipo = new Array();
	$("#tabla_mediocomunicacion tbody#tbody_tabla_medio_comunicacion tr").each(function(){
	 	arreglo_tipo.push($(this).find('td').eq(1).text());
	 	arreglo_nivel.push($(this).find('td').eq(2).text());
 	})
 	var cont_correo = 0;
 	var cont_telefono = 0;
 	for (var i = 0; i < arreglo_nivel.length; i++) {
 		if(arreglo_tipo[i] == "Correo"){
 			if (arreglo_nivel[i]=="P") {
 				cont_correo=1;
 			}
 		}
 		if(arreglo_tipo[i] == "Telefono"){
 			if (arreglo_nivel[i]=="P") {
 				cont_telefono=1;
 			}
 		}
 	}
 	if (tipo=="Correo") {
 		if (nivel=="P") {
 			if (cont_correo==1) {
 				return swal("Lo sentimos ya fue definido un correo principal","","warning");
 			}
 		}
 	}
 	if (tipo=="Telefono") {
 		if (nivel=="P") {
 			if (cont_telefono==1) {
 				return swal("Lo sentimos ya fue definido un Telefono principal","","warning");
 			}
 		}
 	}
	var cadena_agregar = "<tr>";
		cadena_agregar += "<td style = 'width: 300px;word-wrap: break-word;'>"+medio+"</td>";
		cadena_agregar += "<td style = 'width: 100px;word-wrap: break-word;'>"+tipo+"</td>";
		cadena_agregar += "<td style = 'text-align: center;width: 100px;word-wrap: break-word;'>"+nivel+"</td>";
		cadena_agregar += '<td style = "text-align: center;width: 50px;word-wrap: break-word;"><button class="btn btn-danger" onclick="remove(this)">';
		cadena_agregar += "<i class='fa fa-close'></i><b> </b></button></td>";
		cadena_agregar += "</tr>";
		$("#tbody_tabla_medio_comunicacion").append(cadena_agregar);
	    $("#txtrazonsocial").val("");
}
function remove(t){
    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
}
function agregar_documento_identidad(){
	var dni   = $("#txtdni").val();
	var tipo  = $("#cbm_tipo_documento").val();
    if (dni.length==0) {
    	return swal("Falta llenar el nro de documento","","info");
    }
	var arreglo_tipo = new Array();
	$("#tabla_documentoidentidad tbody#tbody_tabla_documentoidentidad tr").each(function(){
	 	arreglo_tipo.push($(this).find('td').eq(2).text());
 	})
 	var cont_tipo = 0;
 	for (var i = 0; i < arreglo_tipo.length; i++) {
 		if (tipo ==arreglo_tipo[i]) {
 			return swal("Lo sentimos el tipo de documento "+ tipo +" ya fue asignado para el trabajador","","warning");
 		}
 	}
 	$.ajax({
		url:'../controlador/trabajador/controlador_buscar_documento_identidad.php',
		type:'POST',
		data:{
			buscar:dni
		}
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length>0) {
			swal("El Documento de identidad ya se encuentra registrado en nuestra data","","warning");
		}else{
			var cadena_agregar = "<tr>";
			cadena_agregar += "<td style = 'width: 300px;word-wrap: break-word;'>"+dni+"</td>";
			cadena_agregar += "<td style = 'text-align: center;width: 100px;word-wrap: break-word;'>"+tipo+"</td>";
			cadena_agregar += '<td style = "text-align: center;width: 50px;word-wrap: break-word;"><button class="btn btn-danger" onclick="remove(this)">';
			cadena_agregar += "<i class='fa fa-close'></i><b> </b></button></td>";
			cadena_agregar += "</tr>";
			$("#tbody_tabla_documentoidentidad").append(cadena_agregar);
		}
		$("#txtdni").val("");
	})
}
function Registrar_trabajador(){
	var txt_nombre       = $('#txtnombre').val();
	var txt_apepat       = $('#txtapepat').val();
	var txt_apemat       = $('#txtapemat').val();
	var rad_sexo ="";
	var porsexo=document.getElementsByName("sex");
    for(var i=0;i<porsexo.length;i++){
        if(porsexo[i].checked)
            rad_sexo=porsexo[i].value;
    }
	var txt_fechanacimi  = $('#txtfecha_nacimiento').val();
	$.ajax({
		url:'../controlador/trabajador/controlador_registrar_datos_trabajador.php',
		type:'POST',
		data:{
			txt_nombre:txt_nombre,
			txt_apepat:txt_apepat,
			txt_apemat:txt_apemat,
			rad_sexo:rad_sexo,
			txt_fechanacimi:txt_fechanacimi
		}
	})
	.done(function(resp){
	    if (resp == 0) {
	      	swal("No se pudo registrar los datos","","error");
	    }else{
	    	$('#txtnombre').val("");
			$('#txtapepat').val("");
			$('#txtapemat').val("");
			alert(resp);
	    	registrar_medio_comunicacion_trabajador(resp);
	    	registrar_documento_identidad_trabajador(resp);
	      	swal("Trabajador Registrado con exito","","success")
	      	.then ( ( value ) =>  { 
			  $("#contenido_principal").load("trabajador/vista_trabajador_listar.php"); 
			});
	    }
	})
}
function registrar_medio_comunicacion_trabajador(id_trabajador){
	var cod_trabajador = parseInt(id_trabajador);
	var arreglo_medio = new Array();
	var arreglo_tipo  = new Array();
	var arreglo_nivel = new Array();
	$("#tabla_mediocomunicacion tbody#tbody_tabla_medio_comunicacion tr").each(function(){
	 	arreglo_medio.push($(this).find('td').eq(0).text());
	 	arreglo_tipo.push($(this).find('td').eq(1).text());
	 	arreglo_nivel.push($(this).find('td').eq(2).text());
 	})
 	var cadena_medio  = arreglo_medio.toString();
 	var cadena_tipo   = arreglo_tipo.toString();
 	var cadena_nivel  = arreglo_nivel.toString();
	$.ajax({
		url:'../controlador/trabajador/controlador_registrar_medio_comunicacion_trabajador.php',
		type:'POST',
		data:{
			codigo:cod_trabajador,
			medio:cadena_medio,
			tipo:cadena_tipo,
			nivel:cadena_nivel
		}
	})
	.done(function(resp){
		alert(id_trabajador+" - "+ cadena_medio);
	})
}
function registrar_documento_identidad_trabajador(id_trabajador){
	var cod_trabajador = parseInt(id_trabajador);
	var arreglo_documento = new Array();
	var arreglo_tipo      = new Array();
 	$("#tabla_documentoidentidad tbody#tbody_tabla_documentoidentidad tr").each(function(){
	 	arreglo_documento.push($(this).find('td').eq(0).text());
	 	arreglo_tipo.push($(this).find('td').eq(1).text());
 	})
 	var cadena_documento  = arreglo_documento.toString();
 	var cadena_tipo       = arreglo_tipo.toString();
	$.ajax({
		url:'../controlador/trabajador/controlador_registrar_documento_identidad_trabajador.php',
		type:'POST',
		data:{
			codigo:cod_trabajador,
			dni:cadena_documento,
			tipo:cadena_tipo
		}
	})
	.done(function(resp){
	})
}