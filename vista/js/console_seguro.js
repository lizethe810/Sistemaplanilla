function listar_seguro(){
  var table = $("#tabla_seguro").DataTable({
    "bLengthChange":false,
    "ordering":false,
    "pageLength":10,
    "destroy":true,
    "ajax":{
      "method":"POST",
      "url":"../controlador/seguro/controlador_seguro_listar.php"
    },
    "columns":[
        {"defaultContent":""},
        {"data":"seguro_descripcion"},
		{"data":"seguro_estatus",
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
	  obtener_dato_seguro("#tabla_seguro tbody",table);
	  table.on( 'order.dt search.dt', function () {
		table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
			cell.innerHTML = i+1;
		} );
		}).draw();
}

var obtener_dato_seguro = function(tbody, table){

    $(tbody).on("click", "button.editar", function(){
  		$('#modal_editar_seguro').modal({backdrop: 'static', keyboard: false})
  		$("#modal_editar_seguro").modal('show');
  		var data 			= table.row( $(this).parents("tr")).data();
  		idseguro		=  $("#txtidseguro").val(data.seguro_id),
  		nombre 		= $("#txtseguroeditar").val(data.seguro_descripcion),
	    status 		= $("#combo_estatuseditar").val(data.seguro_estatus).trigger("change");

	});
}

function Abrirmodalregistro(){
	  $('#modal_registro_seguro').modal({backdrop: 'static', keyboard: false})
	  $("#modal_registro_seguro").modal('show');
}

function Registrar_seguro(){
	var seguro = $("#txtseguro").val();
	var estatus = $("#combo_estatus").val();
  if (seguro.length==0) {
      return       swal("LLene todos los campos","","error");
  }
	$.ajax({
		url:'../controlador/seguro/controlador_seguro_registro.php',
		type:'POST',
		data:{
      seguro:seguro,
      estatus:estatus
		}
	})
	.done(function(resp){
		
		if (resp > 0) {
			if (resp==1) {
				$("#modal_editar_seguro").modal('hide');
				swal("Datos correctamente, seguro registrado","","success")
				.then ( ( value ) =>  {
				$("#contenido_principal").load("seguro/vista_seguro_listar.php");
				   });				
			} else {
				swal("Lo sentimos, el seguro ya esta registrado","","warning")				
			}
		}else{
      swal("Lo sentimos, no se pudo completar registro","","error")
		}
	})
}

function Modificar_seguro(){
  var idseguro = $("#txtidseguro").val();
  var seguro = $("#txtseguroeditar").val();
	var estatus = $("#combo_estatuseditar").val();
  if (seguro.length==0) {
      return       swal("LLene todos los campos","","error");
  }
	$.ajax({
		url:'../controlador/seguro/controlador_seguro_modificar.php',
		type:'POST',
		data:{
      idseguro:idseguro,
      seguro:seguro,
      estatus:estatus
		}
	})
	.done(function(resp){
		if (resp > 0) {
			$("#modal_editar_seguro").modal('hide');
			swal("Datos correctamente modificados","","success")
			.then ( ( value ) =>  {
			$("#contenido_principal").load("seguro/vista_seguro_listar.php");
       });
		}else{
      swal("Lo sentimos, no se pudo completar la modificacion","","error")
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
