function listar_area(){
    var table = $("#tabla_area").DataTable({
      "bLengthChange":false,
      "ordering":false,
      "pageLength":10,
      "destroy":true,
      "ajax":{
        "method":"POST",
        "url":"../controlador/area/controlador_area_listar.php"
      },
      "columns":[
          {"defaultContent":""},
          {"data":"area_descripcion"},
          {"data":"area_fecregistro"},      
          {"data":"area_estatus",
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
        obtener_dato_area("#tabla_area tbody",table);
        table.on( 'order.dt search.dt', function () {
          table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
          } );
          }).draw();
  }
  
  var obtener_dato_area = function(tbody, table){
  
      $(tbody).on("click", "button.editar", function(){
            $('#modal_editar_area').modal({backdrop: 'static', keyboard: false})
            $("#modal_editar_area").modal('show');
            var data 			= table.row( $(this).parents("tr")).data();
            idarea		=  $("#txtidarea").val(data.area_codigo),
            nombre 		= $("#txtareaeditar").val(data.area_descripcion),
            status 		= $("#combo_estatuseditar").val(data.area_estatus).trigger("change");
  
      });
  }
  
  function Abrirmodalregistro(){
        $('#modal_registro_area').modal({backdrop: 'static', keyboard: false})
        $("#modal_registro_area").modal('show');
  }
  
  function Registrar_Area(){
      var area = $("#txtarea").val();
      var estatus = $("#combo_estatus").val();
    if (area.length==0) {
        return       swal("LLene todos los campos","","error");
    }
      $.ajax({
          url:'../controlador/area/controlador_area_registro.php',
          type:'POST',
          data:{
        area:area,
        estatus:estatus
          }
      })
      .done(function(resp){
          if (resp > 0) {
            if (resp==1) {
              $("#modal_registro_area").modal('hide');
              swal("Datos correctamente, nueva area registrada","","success")
              .then ( ( value ) =>  {
              $("#contenido_principal").load("area/vista_area_listar.php");
              });             
            } else {
              swal("Lo sentimos, el area ya esta registrada","","warning")             
            }

          }else{
             swal("Lo sentimos, no se pudo completar registro","","error")
          }
      })
  }
  
  function Modificar_Area(){
    var idarea = $("#txtidarea").val();
    var area = $("#txtareaeditar").val();
      var estatus = $("#combo_estatuseditar").val();
    if (area.length==0) {
        return       swal("LLene todos los campos","","error");
    }
      $.ajax({
          url:'../controlador/area/controlador_area_modificar.php',
          type:'POST',
          data:{
            idarea:idarea,
            area:area,
            estatus:estatus
          }
      })
      .done(function(resp){
          if (resp > 0) {
        $("#modal_editar_area").modal('hide');
        swal("Datos correctamente modificados","","success")
        .then ( ( value ) =>  {
         $("#contenido_principal").load("area/vista_area_listar.php");
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
  