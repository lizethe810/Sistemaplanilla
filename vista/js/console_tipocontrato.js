function listar_tipocontrato(){
    var table = $("#tabla_tipocontrato").DataTable({
      "bLengthChange":false,
      "ordering":false,
      "pageLength":10,
      "destroy":true,
      "ajax":{
        "method":"POST",
        "url":"../controlador/tipo_contrato/controlador_tipo_contrato_listar.php"
      },
      "columns":[
          {"defaultContent":""},
          {"data":"tipocon_descripcion"},
          {"data":"tipocon_estatus",
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
        obtener_dato_cargo("#tabla_tipocontrato tbody",table);
        table.on( 'order.dt search.dt', function () {
          table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
          } );
          }).draw();
  }
  var obtener_dato_cargo = function(tbody, table){
  
      $(tbody).on("click", "button.editar", function(){
            $('#modal_editar_tipocontrato').modal({backdrop: 'static', keyboard: false})
            $("#modal_editar_tipocontrato").modal('show');
            var data 			= table.row( $(this).parents("tr")).data();
            idtipocontrato		=  $("#txtidtipocontrato").val(data.tipocon_codigo),
            nombre 		= $("#txttipoconeditar").val(data.tipocon_descripcion),
            status 		= $("#combo_estatuseditar").val(data.tipocon_estatus).trigger("change");
  
      });
  }
  
  function Abrirmodalregistro(){
        $('#modal_registro_tipocontrato').modal({backdrop: 'static', keyboard: false})
        $("#modal_registro_tipocontrato").modal('show');
  }
  
  function Registrar_TipoContrato(){
      var tipocontrato = $("#txttipocon").val();
      var estatus = $("#combo_estatus").val();
    if (tipocontrato.length==0) {
        return      swal("Mensaje De Advertencia","Porfavor llene los campos vacios","warning");
    }
      $.ajax({
          url:'../controlador/tipo_contrato/controlador_tipo_contrato_registro.php',
          type:'POST',
          data:{
            tipocontrato:tipocontrato,
            estatus:estatus
          }
      })
      .done(function(resp){
          if (resp > 0) {
              if (resp==1) {
                  $("#modal_registro_tipocontrato").modal('hide');
                  swal("Mensaje De Confirmacion","Datos correctamente, nuevo tipo contrato registrado","success")
                  .then ( ( value ) =>  {
                   $("#contenido_principal").load("tipo_contrato/vista_tipo_contrato_listar.php");
                   });				
              }else {
                swal("Mensaje De Advertencia","Lo sentimos, el tipo de contrato ya esta registrado","warning");				
              }
          }else{
            swal("Mensaje De Error","Lo sentimos, no se pudo completar el registro","error")
          }
      })
  }
  
  function Modificar_TipoContrato(){
      var idtipo = $("#txtidtipocontrato").val();
      var nombre = $("#txttipoconeditar").val();
      var estatus = $("#combo_estatuseditar").val();
    if (idtipo.length==0 || nombre.length==0) {
        return    swal("Mensaje De Advertencia","Porfavor llene los campos vacios","warning");
    }
      $.ajax({
          url:'../controlador/tipo_contrato/controlador_tipo_contrato_modificar.php',
          type:'POST',
          data:{
            idtipo:idtipo,
            nombre:nombre,
            estatus:estatus
          }
      })
      .done(function(resp){
          if (resp > 0) {
        $("#modal_editar_tipocontrato").modal('hide');
        swal("Mensaje De Confirmacion","Datos correctamente modificados","success")
        .then ( ( value ) =>  {
         $("#contenido_principal").load("tipo_contrato/vista_tipo_contrato_listar.php");
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
  