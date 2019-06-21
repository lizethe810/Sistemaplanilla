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
function listar_contratos(){
	var cadena_principal ="";
	cadena_principal +='<table table id="tabla_contrato_principal" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
              '<thead >'+
               ' <tr role="row" class="odd">'+
                '  <th style="text-align: center;width: 50px;word-wrap: break-word;">Nro</th>'+
                 ' <th style="text-align: left;width: 200px;word-wrap: break-word;">TRABAJADOR</th>'+
                 ' <th style="text-align: center;width: 120px;word-wrap: break-word;">INICIO CONTRATO</th>'+
                 ' <th style="text-align: center;width: 120px;word-wrap: break-word;">FIN CONTRATO</th>'+
                  '<th style="text-align: center;width: 80px;word-wrap: break-word;">T&Eacute;RMINOS</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">SUELDO</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">TIPO CONTRATO</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">CARGO</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">ÁREA</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">SEGURO</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">CONCEPTOS FIJOS</th>'+
                  '<th style="text-align: center;width: 80px;word-wrap: break-word;">ACCI&Oacute;N</th>'+
                '</tr>'+
              '</thead>'+
            '</table>';
           $("#div_tabla_contrato").html(cadena_principal);
    var txt_fechainicio = $("#txt_fechainicio").val();
    var txt_fechafinal  = $("#txt_fechafinal").val();
	var table = $("#tabla_contrato_principal").DataTable({
		"searching":false,
		"bLengthChange":false,
		"ordering":false,
		"pageLength":10,
		"destroy":true,
		"select":true,
		"ajax":{
			"method":"POST",
			"url":"../controlador/contrato/controlador_contrato_listar.php",
			data:{
				txt_fechainicio:txt_fechainicio,
				txt_fechafinal:txt_fechafinal
			}
		},
		"columns":[
				{"data":"posicion"},
				{"data":"trabajador"},
				{"data":"contrato_fecinicio"},
				{"data":"contrato_fecterm"},
				{"defaultContent": "<button style='font-size:13px;' type='button' class='editar_terminos btn btn-warning'><span class='fa fa-folder-open'></span></button>"},
				{"data":"contrato_sueldo"},
				{"data":"tipocon_descripcion"},
				{"data":"cargo_descripcion"},
				{"data":"area_descripcion"},
				{"data":"seguro_descripcion"},
				{"defaultContent": "<button style='font-size:13px;' type='button' class='editar_datosconceptofijos btn btn-primary'><span class='fa fa-folder-open'></span></button>"},
				{"defaultContent": "<button style='font-size:13px;' type='button' class='editar_datoscontrato btn btn-danger'><span class='fa fa-edit'></span></button>"},

		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
	        $($(nRow).find("td")[0]).css('text-align', 'center' );
	        $($(nRow).find("td")[2]).css('text-align', 'center' );
	        $($(nRow).find("td")[3]).css('text-align', 'center' );
	        $($(nRow).find("td")[4]).css('text-align', 'center' );
	        $($(nRow).find("td")[5]).css('text-align', 'center' );
	        $($(nRow).find("td")[5]).css('font-weight', 'bold' );
	        $($(nRow).find("td")[6]).css('text-align', 'center' );
	        $($(nRow).find("td")[7]).css('text-align', 'center' );
	        $($(nRow).find("td")[8]).css('text-align', 'center' );
	        $($(nRow).find("td")[9]).css('text-align', 'center' );
	        $($(nRow).find("td")[10]).css('text-align', 'center' );
	        $($(nRow).find("td")[11]).css('text-align', 'center' );
	        if (aData["contrato_estatus"] == "Anulado" ){
		        $('td', nRow).css('background-color', '#f8d7da' );
		        $('td', nRow).css('font-weight','bold');
		    }
	    },
		"language":idioma_espanol
	});
	obtener_dato_ver_terminos("#tabla_contrato_principal tbody",table);
	obtener_dato_editar_conceptos_fijos("#tabla_contrato_principal tbody",table);
	obtener_dato_editar_datos_contrato("#tabla_contrato_principal tbody",table);
}
var obtener_dato_ver_terminos = function(tbody, table){
  	$(tbody).on("click", "button.editar_terminos", function(){
		var data       = table.row( $(this).parents("tr")).data();
		$('#lb_trabajador1').html(data.trabajador);
		$('#modal_ver_terminos').modal({backdrop: 'static', keyboard: false})
		$("#modal_ver_terminos").modal("show");
		text_termino_ver.value=data.contrato_terminos;
	});
}
var obtener_dato_editar_conceptos_fijos = function(tbody, table){
  	$(tbody).on("click", "button.editar_datosconceptofijos", function(){
		var data       = table.row( $(this).parents("tr")).data();
		$('#lb_trabajador2').html(data.trabajador);
		$('#txtcontrato2').val(data.contrato_codigo);
		$('#txtsueldo').val(data.contrato_sueldo);
		$('#modal_ver_conceptos_fijos').modal({backdrop: 'static', keyboard: false})
		$("#modal_ver_conceptos_fijos").modal("show");
		listar_tipo_conceptosFijos(data.contrato_codigo);
		listar_concepto_fijo_contrato(data.contrato_codigo);
	});
}
var obtener_dato_editar_datos_contrato = function(tbody, table){
  	$(tbody).on("click", "button.editar_datoscontrato", function(){
		var data       = table.row( $(this).parents("tr")).data();
		$('#lb_trabajador3').html(data.trabajador);
		$('#txtcontrato3').val(data.contrato_codigo);
		$('#txtdatostrabajador').val(data.trabajador);
		$('#txtfecha_inicio').val(data.contrato_fecinicio);
		$('#txtfecha_fin').val(data.contrato_fecterm);
		$('#text_termino').val(data.contrato_terminos);
		$('#txtsueldo_contrato').val(data.contrato_sueldo);
		$("#cbm_cargo").val(data.cargo_codigo).trigger("change");
		$("#cbm_area").val(data.area_codigo).trigger("change");
		$("#cbm_seguro").val(data.seguro_id).trigger("change");
		$("#cbm_tipo_contrato").val(data.tipocon_codigo).trigger("change");
		$("#cbm_estado").val(data.contrato_estatus).trigger("change");
		$('#modal_ver_datos_contrato').modal({backdrop: 'static', keyboard: false})
		$("#modal_ver_datos_contrato").modal("show");
		
	});
}
function listar_tipo_conceptosFijos(id_contrato){
	$.ajax({
		url:'../controlador/contrato/controlador_combo_tipo_conceptoFijo.php',
		type:'POST',
		data:{
			id_contrato:id_contrato
		}
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length > 0) {
			cadena = "";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+" - "+data[i][2]+"%</option>";
			}
			$("#cbm_tipo_conceptos").html(cadena);
		}
		else{
			var cadena = "<option value=''>NO SE ENCONTRARON CONCEPTOS PARA ESTE CONTRATO</option>";
			$("#cbm_tipo_conceptos").html(cadena);
		}
	})
}
function listar_concepto_fijo_contrato(id_contrato){
	var cadena_principal ="";
	cadena_principal +='<table table id="tabla_concepto_fijo" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
              '<thead >'+
               ' <tr role="row" class="odd">'+
                 ' <th style="text-align: center;width: 200px;word-wrap: break-word;">CONCEPTO FIJO</th>'+
                 ' <th style="text-align: center;width: 200px;word-wrap: break-word;">PORCENTAJE</th>'+
                 ' <th style="text-align: center;width: 200px;word-wrap: break-word;">MONTO</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">ACCI&Oacute;N</th>'+
                '</tr>'+
              '</thead>'+
            '</table>';
           $("#div_tabla_concepto_fijo").html(cadena_principal);
	var table = $("#tabla_concepto_fijo").DataTable({
		"searching":false,
		"bLengthChange":false,
		"ordering":false,
		"pageLength":5,
		"destroy":true,
		"select":true,
		"ajax":{
			"method":"POST",
			"url":"../controlador/contrato/controlador_concepto_fijo_contrato.php",
			data:{
				id_contrato:id_contrato
			}
		},
		"columns":[
				{"data":"tipoconcepto_nombre"},
				{"data":"tipoconcepto_porcentaje"},
				{"data":"conceptofijo_monto"},
				{"defaultContent": "<button style='font-size:13px;' type='button' class='eliminar_conceptofijo btn btn-danger'><span class='fa fa-trash'></span></button>"},

		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
	        $($(nRow).find("td")[0]).css('text-align', 'center' );
	        $($(nRow).find("td")[1]).css('text-align', 'center' );
	        $($(nRow).find("td")[2]).css('text-align', 'center' );
	        $($(nRow).find("td")[3]).css('text-align', 'center' );
	    },
		"language":idioma_espanol
	});
	obtener_dato_eliminar_concepto_fijo("#tabla_concepto_fijo tbody",table);
}
var obtener_dato_eliminar_concepto_fijo = function(tbody, table){
  	$(tbody).on("click", "button.eliminar_conceptofijo", function(){
		var data       = table.row( $(this).parents("tr")).data();		
		EliminarConceptoFijo(data.conceptofijo_codigo,data.tipoconcepto_nombre,data.contrato_codigo);
	});
}
function EliminarConceptoFijo(id_conceptofijo,nombre_concepto,contrato_codigo){
	swal({
	  title: "¿Seguro que deseas eliminar el concepto "+nombre_concepto+"?",
	  text: "",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
	    $.ajax({
	  		url:'../controlador/contrato/controlador_concepto_fijo_eliminar.php',
	  		type:'POST',
	  		data:{
	  			id_conceptofijo:id_conceptofijo
	  		}
	  	})
	  	.done(function(resp){
	  		listar_tipo_conceptosFijos(contrato_codigo);
	  		listar_concepto_fijo_contrato(contrato_codigo);
	  		if (resp>0) {
	  			swal("Concepto  "+nombre_concepto+" Eliminado del contrato","", {
				    icon: "success",
				});
	  		}else{
	  			swal("No se pudo eliminar el concepto "+nombre_concepto,"","error");
	  		}
	  	})
	  }
	});
}
function registrar_concepto_fijo(){
	var id_contrato = $('#txtcontrato2').val();
	var id_concepto = $('#cbm_tipo_conceptos').val();
	var nombre_concepto = $('select[name="cbm_tipo_conceptos"] option:selected').text();
	var nom = nombre_concepto.split("-");
	var porc = nom[1].split("%");
	var sueldo      = $('#txtsueldo').val();
	var monto_neto = (porc[0]*sueldo)/100;
	$.ajax({
		url:'../controlador/contrato/controlador_concepto_fijo_registrar.php',
		type:'POST',
		data:{
			id_contrato:id_contrato,
			id_concepto:id_concepto,
			sueldo:monto_neto
		}
	})
	.done(function(resp){
		listar_tipo_conceptosFijos(id_contrato);
	  	listar_concepto_fijo_contrato(id_contrato);
		if (resp>0) {
			swal("Concepto asignado con exito al contrato","","success");
		}else{
			swal("No se pudo asignar el concepto al contrato","","error");
		}
	})
}
function listar_area(){
	$.ajax({
		url:'../controlador/contrato/controlador_combo_area.php',
		type:'POST'
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length > 0) {
			cadena = "";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
			}
			$("#cbm_area").html(cadena);
		}
		else{
			var cadena = "<option value=''>NO SE ENCONTRARON DATOS</option>";
			$("#cbm_area").html(cadena);
		}
	})
}
function listar_tipo_contrato(){
	$.ajax({
		url:'../controlador/contrato/controlador_combo_tipo_contrato.php',
		type:'POST'
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length > 0) {
			cadena = "";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
			}
			$("#cbm_tipo_contrato").html(cadena);
		}
		else{
			var cadena = "<option value=''>NO SE ENCONTRARON DATOS</option>";
			$("#cbm_tipo_contrato").html(cadena);
		}
	})
}
function listar_seguro(){
	$.ajax({
		url:'../controlador/contrato/controlador_combo_seguro.php',
		type:'POST'
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length > 0) {
			cadena = "";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
			}
			$("#cbm_seguro").html(cadena);
		}
		else{
			var cadena = "<option value=''>NO SE ENCONTRARON DATOS</option>";
			$("#cbm_seguro").html(cadena);
		}
	})
}
function listar_cargo(){
	$.ajax({
		url:'../controlador/contrato/controlador_combo_cargo.php',
		type:'POST'
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length > 0) {
			cadena = "";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
			}
			$("#cbm_cargo").html(cadena);
		}
		else{
			var cadena = "<option value=''>NO SE ENCONTRARON DATOS</option>";
			$("#cbm_cargo").html(cadena);
		}
	})
}
function Editar_dato_contrato(){
	var id_contrato  = $('#txtcontrato3').val();
	var fecha_inicio = $('#txtfecha_inicio').val();
	var fecha_final  = $('#txtfecha_fin').val();
	var terminos     = $('#text_termino').val();
	var cbm_tipocont = $('#cbm_tipo_contrato').val();
	var cbm_area     = $('#cbm_area').val();
	var cbm_seguro   = $('#cbm_seguro').val();
	var cbm_cargo    = $('#cbm_cargo').val();
	var cbm_estado   = $('#cbm_estado').val();
	$.ajax({
		url:'../controlador/contrato/controlador_contrato_editar.php',
		type:'POST',
		data:{
			id_contrato:id_contrato,
			fecha_inicio:fecha_inicio,
			fecha_final:fecha_final,
			terminos:terminos,
			cbm_tipocont:cbm_tipocont,
			cbm_area:cbm_area,
			cbm_seguro:cbm_seguro,
			cbm_cargo:cbm_cargo,
			cbm_estado:cbm_estado
		}
	})
	.done(function(resp){
		listar_contratos();
		if (resp>0) {
			swal("Contrato actualizado con exito","","success")
			.then ( ( value ) =>  { 
			  $("#modal_ver_datos_contrato").modal("hide"); 
			});
		}else{
			swal("No se pudo asignar el concepto al contrato","","error");
		}
	})
}
function buscar_trabajador(){
	$('#modal_ver_datos_contrato').modal({backdrop: 'static', keyboard: false})
	$("#modal_ver_datos_contrato").modal("show");
	listar_trabajador_contrato('');
}
function listar_trabajador_contrato(buscar){
	var cadena_principal ="";
	cadena_principal +='<table table id="tabla_trabajador" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
              '<thead >'+
               ' <tr role="row" class="odd">'+
                 ' <th style="text-align: left;width: 300px;word-wrap: break-word;">TRABAJADOR</th>'+
                 ' <th style="text-align: center;width: 80px;word-wrap: break-word;">SEXO</th>'+
                 ' <th style="text-align: center;width: 150px;word-wrap: break-word;">FECHA NACI.</th>'+
                  '<th style="text-align: center;width: 80px;word-wrap: break-word;">ACCI&Oacute;N</th>'+
                '</tr>'+
              '</thead>'+
            '</table>';
           $("#div_tabla_trabajador").html(cadena_principal);
	var table = $("#tabla_trabajador").DataTable({
		"searching":false,
		"bLengthChange":false,
		"ordering":false,
		"pageLength":5,
		"destroy":true,
		"select":true,
		"ajax":{
			"method":"POST",
			"url":"../controlador/contrato/controlador_trabajador_sincontrato_listar.php",
			data:{
				buscar:buscar
			}
		},
		"columns":[
				{"data":"empleado"},
				{"data":"trab_sexo"},
				{"data":"trab_fechanacimiento"},
				{"defaultContent": "<button style='font-size:13px;' type='button' class='editar_enviardatos btn btn-success'><b>Enviar</b></button>"},
		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
	        $($(nRow).find("td")[1]).css('text-align', 'center' );
	        $($(nRow).find("td")[2]).css('text-align', 'center' );
	        $($(nRow).find("td")[3]).css('text-align', 'center' );
	    },
		"language":idioma_espanol
	});
	obtener_dato_enviar("#tabla_trabajador tbody",table);
}
var obtener_dato_enviar = function(tbody, table){
  	$(tbody).on("click", "button.editar_enviardatos", function(){
		var data       = table.row( $(this).parents("tr")).data();
		txt_idempleado.value=data.trabajador_cod;
		txtnombre.value=data.trab_nombre;
		txtapellidos.value=data.trab_apellidopate+" "+data.trab_apellidomate;
		$("#modal_ver_datos_contrato").modal("hide");
	});
}
function listar_combo_tipo_conceptosFijos(){
	$.ajax({
		url:'../controlador/contrato/controlador_combo_tipo_concepto_Fijo.php',
		type:'POST'
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length > 0) {
			cadena = "";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+" - "+data[i][2]+"%</option>";
			}
			$("#cbm_tipo_conceptos").html(cadena);
		}
		else{
			var cadena = "<option value=''>NO SE ENCONTRARON CONCEPTOS FIJOS</option>";
			$("#cbm_tipo_conceptos").html(cadena);
		}
	})
}
function agregar_concepto_fijo(){
	var id_concepto     = $('#cbm_tipo_conceptos').val();
	var nombre_concepto = $('select[name="cbm_tipo_conceptos"] option:selected').text();
	var nom = nombre_concepto.split("-");
	var porc = nom[1].split("%");
	var id = id_concepto.toLowerCase();
	if (checkId(id)) {
	  	return swal("El concepto ya fue seleccionado Anteriormente","","warning");
	}
	var cadena_agregar = "<tr>";
		cadena_agregar += "<td hidden for='id'>"+id+"</td>";
		cadena_agregar += "<td style = 'text-align: left;width: 200px;word-wrap: break-word;'>"+nom[0]+"</td>";
		cadena_agregar += "<td hidden>"+porc[0]+"</td>";
		cadena_agregar += "<td style = 'text-align: center;width: 100px;word-wrap: break-word;'>"+porc[0]+" %</td>";
		cadena_agregar += '<td style = "text-align: center;width: 100px;word-wrap: break-word;"><button class="btn btn-danger" onclick="remove(this)">';
		cadena_agregar += "<i class='fa fa-close'></i><b> </b></button></td>";
		cadena_agregar += "</tr>";
		$("#tbody_tabla_concepto_fijo").append(cadena_agregar);
}
function checkId (id) {
	let ids = document.querySelectorAll('#tabla_concepto_fijo td[for="id"]');
  	return [].filter.call(ids, td => td.textContent === id).length === 1;
}
function remove(t){
    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
}
function Registrar_Contrato(){
	var fecha_inicio = $('#txtfecha_inicio').val();
	var fecha_final  = $('#txtfecha_fin').val();
	var terminos     = $('#text_termino').val();
	var cbm_tipocont = $('#cbm_tipo_contrato').val();
	var cbm_area     = $('#cbm_area').val();
	var cbm_seguro   = $('#cbm_seguro').val();
	var cbm_cargo    = $('#cbm_cargo').val();
	var txt_sueldo   = $('#txtsueldo_contrato').val();
	var id_trabajador= $('#txt_idempleado').val();
	$.ajax({
		url:'../controlador/contrato/controlador_contrato_registrar.php',
		type:'POST',
		data:{
			fecha_inicio:fecha_inicio,
			fecha_final:fecha_final,
			terminos:terminos,
			cbm_tipocont:cbm_tipocont,
			cbm_area:cbm_area,
			cbm_seguro:cbm_seguro,
			cbm_cargo:cbm_cargo,
			txt_sueldo:txt_sueldo,
			id_trabajador:id_trabajador 
		}
	})
	.done(function(resp){
		if (resp==0) {
			swal("No se pudo asignar el concepto al contrato","","error");
		}else{
			var id_contrato = parseInt(resp);
			registrar_asignacion_conceptofijo(id_contrato);
			swal("Contrato Registrado con exito","","success")
	      	.then ( ( value ) =>  { 
			  $("#contenido_principal").load("contrato/vista_contrato_listar.php"); 
			});
		}
	})
}
function registrar_asignacion_conceptofijo(id_contrato){
	var sueldo              = $('#txtsueldo_contrato').val();
	var arreglo_idconcepto  = new Array();
	var arreglo_porcentaje  = new Array();
	var monto_concepto      = new Array();
	var count =0;
	$("#tabla_concepto_fijo tbody#tbody_tabla_concepto_fijo tr").each(function(){
	 	arreglo_idconcepto.push($(this).find('td').eq(0).text());
	 	arreglo_porcentaje.push($(this).find('td').eq(2).text());
	 	count++;
 	})
 	for (var i = 0; i <count; i++) {
 		monto_concepto[i]=((parseInt(sueldo)*arreglo_porcentaje[i])/100);
 	};
 	var concepto_ID		    = arreglo_idconcepto.toString();
 	var concepto_monto 		= monto_concepto.toString();
	$.ajax({
		url:'../controlador/contrato/controlador_registrar_concepto_fijo.php',
		type:'POST',
		data:{
			id_contrato:id_contrato,
			cod_concepto:concepto_ID,
 			monto:concepto_monto
		}
	})
	.done(function(resp){
	})
}