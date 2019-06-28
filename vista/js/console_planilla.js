function listar_contratos_planilla(){
	var cadena_principal ="";
	cadena_principal +='<table table id="tabla_planilla_contrato_principal" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
              '<thead >'+
                '<tr role="row" class="odd">'+
                  '<th style="text-align: left;width: 80px;word-wrap: break-word;">NRO</th>'+
                  '<th style="text-align: center;width: 50px;word-wrap: break-word;">A&Ntilde;O</th>'+
                  '<th style="text-align: center;width: 50px;word-wrap: break-word;">MES</th>'+
                  '<th style="text-align: left;width: 200px;word-wrap: break-word;">TRABAJADOR</th>'+
                  '<th style="text-align: center;width: 120px;word-wrap: break-word;">INICIO CONTRATO</th>'+
                  '<th style="text-align: center;width: 120px;word-wrap: break-word;">FIN CONTRATO</th>'+
                  '<th style="text-align: center;width: 80px;word-wrap: break-word;">CARGO</th>'+
                  '<th style="text-align: center;width: 80px;word-wrap: break-word;">SUELDO</th>'+
                  '<th style="text-align: center;width: 80px;word-wrap: break-word;">C. FIJOS</th>'+
                  '<th style="text-align: center;width: 120px;word-wrap: break-word;">SUELDO BRUTO</th>'+
                  '<th style="text-align: center;width: 80px;word-wrap: break-word;">C. VARIABLE</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">SUELDO NETO</th>'+
                  //'<th style="text-align: center;width: 50px;word-wrap: break-word;">ACCI&Oacute;N</th>'+
                '</tr>'+
              '</thead>'+
            '</table>';
           $("#div_tabla_planillacontrato").html(cadena_principal);
    var combo_anio = $("#combo_anio").val();
    var combo_mes  = $("#combo_mes").val();
    var table = $("#tabla_planilla_contrato_principal").DataTable({
		"bLengthChange":false,
		"ordering":false,
		"pageLength":10,
		"destroy":true,
		"select":true,
		"ajax":{
			"method":"POST",
			"url":"../controlador/planilla/controlador_planilla_contrato_listar.php",
			data:{
				combo_anio:combo_anio,
				combo_mes:combo_mes
			}
		},
		"columns":[
				{"data":"posicion"},
				{"data":"planilla_anio"},
				{"data":"planilla_mes"},
				{"data":"trabajador"},
				{"data":"contrato_fecinicio"},
				{"data":"contrato_fecterm"},
				{"data":"cargo_descripcion"},
				{"data":"contrato_sueldo"},
				{"defaultContent": "<button style='font-size:13px;' type='button' class='editar_datosconceptofijos btn btn-warning'><span class='fa fa-folder-open'></span></button>"},
				{"data":"pagoplanilla_sueldobruto"},
				{"defaultContent": "<button style='font-size:13px;' type='button' class='editar_datosconceptovariables btn btn-primary'><span class='fa fa-folder-open'></span></button>"},
				{"data":"pagoplanilla_sueldoneto"},
				//{"defaultContent": "<button style='font-size:13px;' type='button' class='editar_datoscontrato btn btn-danger'><span class='fa fa-edit'></span></button>"},
		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
	        
	        $($(nRow).find("td")[1]).css('text-align', 'center' );
	        $($(nRow).find("td")[3]).css('text-align', 'center' );
	        $($(nRow).find("td")[4]).css('text-align', 'center' );
	        $($(nRow).find("td")[5]).css('text-align', 'center' );
	        
	        $($(nRow).find("td")[6]).css('text-align', 'center' );
	        $($(nRow).find("td")[7]).css('text-align', 'center' );
	        $($(nRow).find("td")[8]).css('text-align', 'center' );
	        $($(nRow).find("td")[9]).css('text-align', 'center' );
	        $($(nRow).find("td")[10]).css('text-align', 'center' );
	        $($(nRow).find("td")[11]).css('text-align', 'center' );
	        //$($(nRow).find("td")[11]).css('text-align', 'center' );
	        if (aData["contrato_estatus"] == "Anulado" ){
		        $('td', nRow).css('background-color', '#f8d7da' );
		        $('td', nRow).css('font-weight','bold');
		    }
	        $($(nRow).find("td")[1]).css('font-weight', 'bold' );
	        $($(nRow).find("td")[2]).css('font-weight', 'bold' );
	        $($(nRow).find("td")[6]).css('font-weight', 'bold' );
	        $($(nRow).find("td")[8]).css('font-weight', 'bold' );
	        $($(nRow).find("td")[10]).css('font-weight', 'bold' );
	    },
		"language":idioma_espanol
	});
	obtener_dato_ver_conceptos_fijos("#tabla_planilla_contrato_principal tbody",table);
	obtener_dato_ver_conceptos_variables("#tabla_planilla_contrato_principal tbody",table);
}
var obtener_dato_ver_conceptos_fijos = function(tbody, table){
  	$(tbody).on("click", "button.editar_datosconceptofijos", function(){
		var data       = table.row( $(this).parents("tr")).data();
		$('#lb_trabajador1').html(data.trabajador);
		$('#txtcontrato1').val(data.contrato_codigo);
		$('#modal_ver_conceptos_fijos').modal({backdrop: 'static', keyboard: false})
		$("#modal_ver_conceptos_fijos").modal("show");
		listar_concepto_fijo_contrato(data.contrato_codigo);
	});
}
var obtener_dato_ver_conceptos_variables = function(tbody, table){
  	$(tbody).on("click", "button.editar_datosconceptovariables", function(){
		var data       = table.row( $(this).parents("tr")).data();
		$('#lb_trabajador2').html(data.trabajador);
		$('#txtidpagoplanilla').val(data.pagoplanilla_codigo);
		$('#modal_ver_conceptos_variables').modal({backdrop: 'static', keyboard: false})
		$("#modal_ver_conceptos_variables").modal("show");
		listar_tipo_conceptosVariables();
		listar_concepto_variable_planilla(data.pagoplanilla_codigo);
	});
}
function listar_concepto_fijo_contrato(id_contrato){
	var cadena_principal ="<div style='text-align:center'><label >LISTADO DE CONCEPTOS FIJOS ASIGNADOS<br><br></label></div>";
	cadena_principal +='<table table id="tabla_concepto_fijo" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
              '<thead >'+
               ' <tr role="row" class="odd">'+
                 ' <th style="text-align: center;width: 200px;word-wrap: break-word;">CONCEPTO FIJO</th>'+
                 ' <th style="text-align: center;width: 200px;word-wrap: break-word;">PORCENTAJE</th>'+
                 ' <th style="text-align: center;width: 200px;word-wrap: break-word;">MONTO</th>'+
                  //'<th style="text-align: center;width: 100px;word-wrap: break-word;">ACCI&Oacute;N</th>'+
                '</tr>'+
              '</thead>'+
            '</table>';
           $("#div_tabla_concepto_fijo").html(cadena_principal);
	var table = $("#tabla_concepto_fijo").DataTable({
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
				//{"defaultContent": "<button style='font-size:13px;' type='button' class='eliminar_conceptofijo btn btn-danger'><span class='fa fa-trash'></span></button>"},

		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
	        $($(nRow).find("td")[0]).css('text-align', 'center' );
	        $($(nRow).find("td")[1]).css('text-align', 'center' );
	        $($(nRow).find("td")[2]).css('text-align', 'center' );
	        $($(nRow).find("td")[2]).css('font-weight', 'bold' );
	    },
		"language":idioma_espanol
	});
}
function listar_tipo_conceptosVariables(id_contrato){
	$.ajax({
		url:'../controlador/planilla/controlador_combo_tipo_conceptoVariable.php',
		type:'POST'
	})
	.done(function(resp){
		var data = JSON.parse(resp);
		if (data.length > 0) {
			cadena = "";
			for (var i = 0; i < data.length; i++) {
				cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
			}
			$("#cbm_tipo_conceptos").html(cadena);
		}
		else{
			var cadena = "<option value=''>NO SE ENCONTRARON CONCEPTOS</option>";
			$("#cbm_tipo_conceptos").html(cadena);
		}
	})
}
function listar_concepto_variable_planilla(pagoplanilla_codigo){
	$('#txtmonto').val("");
	$('#text_argumento').val("");
	var cadena_principal ="<div style='text-align:center'><label><br><br>LISTADO DE CONCEPTOS VARIABLES ASIGNADOS<br><br></label></div>";
	cadena_principal +='<table table id="tabla_concepto_variable" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
              '<thead >'+
               ' <tr role="row" class="odd">'+
                  '<th style="text-align: center;width: 200px;word-wrap: break-word;">CONCEPTO VARIABLE</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">FECHA REGISTRO</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">MONTO</th>'+
                  '<th style="text-align: center;width: 300px;word-wrap: break-word;">MOTIVO</th>'+
                  '<th style="text-align: center;width: 100px;word-wrap: break-word;">ACCI&Oacute;N</th>'+
                '</tr>'+
              '</thead>'+
            '</table>';
           $("#div_tabla_concepto_variable").html(cadena_principal);
	var table = $("#tabla_concepto_variable").DataTable({
		"bLengthChange":false,
		"ordering":false,
		"pageLength":5,
		"destroy":true,
		"select":true,
		"ajax":{
			"method":"POST",
			"url":"../controlador/planilla/controlador_concepto_variable_planilla.php",
			data:{
				id_pagoplanilla:pagoplanilla_codigo
			}
		},
		"columns":[
				{"data":"tipoconcepto_nombre"},
				{"data":"conceptova_fecharegistro"},
				{"data":"conceptova_monto"},
				{"data":"conceptova_descripcion"},
				{"defaultContent": "<button style='font-size:13px;' type='button' class='eliminar_conceptovariable btn btn-danger'><span class='fa fa-trash'></span></button>"},

		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
	        $($(nRow).find("td")[0]).css('text-align', 'center' );
	        $($(nRow).find("td")[1]).css('text-align', 'center' );
	        $($(nRow).find("td")[2]).css('text-align', 'center' );
	        $($(nRow).find("td")[3]).css('text-align', 'center' );
	        $($(nRow).find("td")[4]).css('text-align', 'center' );
	        $($(nRow).find("td")[2]).css('font-weight', 'bold' );
	    },
		"language":idioma_espanol
	});
	obtener_dato_eliminar_concepto_variables("#tabla_concepto_variable tbody",table);
}
var obtener_dato_eliminar_concepto_variables = function(tbody, table){
  	$(tbody).on("click", "button.eliminar_conceptovariable", function(){
		var data       = table.row( $(this).parents("tr")).data();		
		EliminarConceptoVariable(data.conceptova_id,data.tipoconcepto_nombre,data.pagoplanilla_codigo);
	});
}
function EliminarConceptoVariable(id_conceptovariable,nombre_concepto,pagoplanilla_codigo){
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
	  		url:'../controlador/planilla/controlador_concepto_variable_eliminar.php',
	  		type:'POST',
	  		data:{
	  			id_conceptovariable:id_conceptovariable
	  		}
	  	})
	  	.done(function(resp){
	  		listar_contratos_planilla();
	  		listar_concepto_variable_planilla(pagoplanilla_codigo);
	  		if (resp>0) {
	  			swal("Concepto  "+nombre_concepto+" Eliminado","", {
				    icon: "success",
				});
	  		}else{
	  			swal("No se pudo eliminar el concepto "+nombre_concepto,"","error");
	  		}
	  	})
	  }
	});
}
function registrar_concepto_variable(){
	var id_pagoplanilla = $('#txtidpagoplanilla').val();
	var id_tipoconcepto = $('#cbm_tipo_conceptos').val();
	var txt_monto       = $('#txtmonto').val();
	var text_argumento  = $('#text_argumento').val();
	if (txt_monto.length==0) {
		return swal("Falta agregar el monto","","warning");
	}
	if (text_argumento.length==0) {
		return swal("Falta agregar el argumento","","warning");
	}
	$("#btn_registrar_conceptovariable").attr("disabled",true);
	$.ajax({
		url:'../controlador/planilla/controlador_concepto_variable_registrar.php',
		type:'POST',
		data:{
			id_pagoplanilla:id_pagoplanilla,
			id_tipoconcepto:id_tipoconcepto,
			txt_monto:txt_monto,
			text_argumento:text_argumento
		}
	})
	.done(function(resp){
		$("#btn_registrar_conceptovariable").attr("disabled",false);
  		if (resp==1) {
  			listar_contratos_planilla();
  			listar_concepto_variable_planilla(id_pagoplanilla);
  			swal("Concepto  asignado con exito!","", {
			    icon: "success",
			});
			$('#txtmonto').val("");
			$('#text_argumento').val("");
  		}else{
  			if (resp==2) {
  				swal("Lo sentimos el monto ingresado no puede superar a la mitad de su sueldo neto actual","","error");
  			}else{
  				swal("No se pudo registrar el concepto variable ","","error");
  			}
  		}
	})
}
function listar_contratos_planilla_registro(){
	var cadena_principal ="";
	cadena_principal +='<table table id="tabla_planilla_contrato_registro" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
              '<thead >'+
                '<tr role="row" class="odd">'+
                  '<th style=" hidden">ID</th>'+
                  '<th style="text-align: left;width: 200px;word-wrap: break-word;">TRABAJADOR</th>'+
                  '<th style="text-align: center;width: 120px;word-wrap: break-word;">INICIO CONTRATO</th>'+
                  '<th style="text-align: center;width: 120px;word-wrap: break-word;">FIN CONTRATO</th>'+
                  '<th style="text-align: center;width: 80px;word-wrap: break-word;">CARGO</th>'+
                  '<th style="text-align: center;width: 80px;word-wrap: break-word;">SUELDO BASE</th>'+
                  '<th style="text-align: center;width: 120px;word-wrap: break-word;">SUELDO BRUTO</th>'+
                '</tr>'+
              '</thead>'+
            '</table>';
           $("#div_tabla_planillacontrato_registro").html(cadena_principal);
    var combo_anio = $("#combo_anio").val();
    var combo_mes  = $("#combo_mes").val();
    var table = $("#tabla_planilla_contrato_registro").DataTable({
		"bLengthChange":false,
		"ordering":false,
		"pageLength":5,
		"destroy":true,
		"select":true,
		"ajax":{
			"method":"POST",
			"url":"../controlador/planilla/controlador_planilla_contrato_registro_listar.php",
			data:{
				combo_anio:combo_anio,
				combo_mes:combo_mes
			}
		},
		"columns":[

				{"data":"contrato_codigo","visible": false},
				{"data":"trabajador"},
				{"data":"contrato_fecinicio"},
				{"data":"contrato_fecterm"},
				{"data":"cargo_descripcion"},
				{"data":"contrato_sueldo"},
				{"data":"sueldobruto"}
		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
	        $($(nRow).find("td")[1]).css('text-align', 'center' );
	        $($(nRow).find("td")[2]).css('text-align', 'center' );
	        $($(nRow).find("td")[3]).css('text-align', 'center' );
	        $($(nRow).find("td")[4]).css('text-align', 'center' );
	        $($(nRow).find("td")[5]).css('text-align', 'center' );

	        $($(nRow).find("td")[4]).css('font-weight', 'bold' );
	        $($(nRow).find("td")[5]).css('font-weight', 'bold' );
	    },
		"language":idioma_espanol
	});
	
}
function registrar_contrato_planilla(){
	var r = $("#tabla_planilla_contrato_registro").dataTable().fnGetNodes();
	if (r.length==0) {
		return swal("Aviso!","Lo sentimos no se encontro ningun contrato disponible para el registro","info");
	}
	var txt_anio = $('#txt_anio').val();
	var txt_mes  = $('#txt_mes').val();
    var cells = [];
    var dtTable = $('#tabla_planilla_contrato_registro').DataTable();
    var rows = $("#tabla_planilla_contrato_registro").dataTable().fnGetNodes();
    $("#btn_registrar").attr("disabled",true);
    for(var i=0;i<rows.length;i++){
        cells.push(dtTable.cells({ row: i, column: 0 }).data()[0]);
        var id_contrato = dtTable.cells({ row: i, column: 0 }).data()[0];
        var sueldobase  = dtTable.cells({ row: i, column: 5 }).data()[0];
        var sueldobruto = dtTable.cells({ row: i, column: 6 }).data()[0];
        $.ajax({
        	url:'../controlador/planilla/controlador_planilla_contrato_registro.php',
        	type:'POST',
        	data:{
        		id_contrato:id_contrato,
        		txt_anio:txt_anio,
        		txt_mes:txt_mes
        	}
        }).done(function(resp){
        	if (resp==0) {
        		$("#btn_registrar").attr("disabled",false);
        		listar_contratos_planilla_registro();
        		swal("Aviso de error","No se pudo registrar planilla a los contratos","error");
        	}else{
        		registrar_pago_planilla(resp,sueldobase,sueldobruto);
        	}
        })
    }
    swal("Contratos en planilla asignados con exito","","success")
    .then ( ( value ) =>  {
        listar_contratos_planilla_registro();
        $("#btn_registrar").attr("disabled",false);
    }); 
}
function registrar_pago_planilla(id_planilla,sueldobase,sueldobruto){
	var planilla_id = parseInt(id_planilla);
	$.ajax({
    	url:'../controlador/planilla/controlador_planilla_pago_contrato_registro.php',
    	type:'POST',
    	data:{
    		planilla_id:planilla_id,
    		sueldobase:sueldobase,
    		sueldobruto:sueldobruto
    	}
    }).done(function(resp){
    })
}