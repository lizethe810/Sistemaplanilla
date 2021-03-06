function listar_cargo(){
  var table = $("#tabla_cargo").DataTable({
    "bLengthChange":false,
    "ordering":false,
    "pageLength":10,
    "destroy":true,
    "ajax":{
      "method":"POST",
      "url":"../controlador/cargo/controlador_cargo_listar.php"
    },
    "columns":[
        {"defaultContent":""},
        {"data":"cargo_descripcion"},
		{"data":"cargo_estatus",
		render: function (data, type, row ) {
				if (data=='ACTIVO') {
				  return "<span class='badge bg-green'>"+data+"</span>";
				} else {
				  return '<span class="badge bg-red">'+data+'</span>';                 
				}
			}
		},
		{"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><span class='fa fa-edit'></span></button>"}
    ],
		"language":idioma_espanol,
		select: true
  });
	  obtener_dato_cargo("#tabla_cargo tbody",table);
	  table.on( 'order.dt search.dt', function () {
		table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
			cell.innerHTML = i+1;
		} );
		}).draw();
}
var obtener_dato_cargo = function(tbody, table){

    $(tbody).on("click", "button.editar", function(){
  		$('#modal_editar_cargo').modal({backdrop: 'static', keyboard: false})
  		$("#modal_editar_cargo").modal('show');
  		var data 			= table.row( $(this).parents("tr")).data();
  		idcargo		=  $("#txtidcargo").val(data.cargo_codigo),
  		nombre 		= $("#txtcargoeditar").val(data.cargo_descripcion),
	    status 		= $("#combo_estatuseditar").val(data.cargo_estatus).trigger("change");

	});
}

function Abrirmodalregistro(){
	  $('#modal_registro_cargo').modal({backdrop: 'static', keyboard: false})
	  $("#modal_registro_cargo").modal('show');
}

function Registrar_cargo(){
	var cargo = $("#txtcargo").val();
	var estatus = $("#combo_estatus").val();
  if (cargo.length==0) {
      return       swal("LLene todos los campos","","error");
  }
	$.ajax({
		url:'../controlador/cargo/controlador_cargo_registro.php',
		type:'POST',
		data:{
      cargo:cargo,
      estatus:estatus
		}
	})
	.done(function(resp){
		if (resp > 0) {
			if (resp==1) {
				$("#modal_registro_cargo").modal('hide');
				swal("Mensaje De Confirmacion","Datos correctamente, nuevo cargo registrado","success")
				.then ( ( value ) =>  {
				 $("#contenido_principal").load("cargo/vista_cargo_listar.php");
				 });				
			}else {
				swal("Mensaje De Advertencia","Lo sentimos, el cargo ya esta registrado","warning")       		
			}
		}else{
			swal("Mensaje De Error","Lo sentimos, no se pudo completar el registro","error")
		}
	})
}

function Modificar_cargo(){
  var idcargo = $("#txtidcargo").val();
	var cargo = $("#txtcargoeditar").val();
	var estatus = $("#combo_estatuseditar").val();
  if (cargo.length==0 || idcargo.length==0) {
      return  swal("LLene todos los campos","","error");
  }
	$.ajax({
		url:'../controlador/cargo/controlador_cargo_modificar.php',
		type:'POST',
		data:{
      idcargo:idcargo,
      cargo:cargo,
      estatus:estatus
		}
	})
	.done(function(resp){
		if (resp > 0) {
      $("#modal_editar_cargo").modal('hide');
	  swal("Mensaje De Confirmacion","Datos correctamente modificacdos")
      .then ( ( value ) =>  {
       $("#contenido_principal").load("cargo/vista_cargo_listar.php");
       });
		}else{
			swal("Mensaje De Error","Lo sentimos, no se pudo completar la modificacion","error")
		}
	})
}

var idioma_espanol = {
	select: {
        rows: "%d fila seleccionada"
      },
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
