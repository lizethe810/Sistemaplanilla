  function listar_familiar(){
    var buscar="%";
    var table = $("#tabla_familiar").DataTable({
      "bLengthChange":false,
      "ordering":false,
      "pageLength":10,
      "destroy":true,
      "select":false,
      "ajax":{
        "method":"POST",
        "url":"../controlador/familiar/controlador_familiar_listar.php",
        data:{
          buscar:buscar
        }
      },
      "columns":[
          {"defaultContent":""},
          {"data":"FAMILIAR"}, 
          {"data":"familiar_nrodocumento"},   
          {"data":"familiar_tipodocumento"},        
          {"data":"familiar_fecnac"},                                    
          {"data":"familiar_estatus",
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
      "language": {
        select: {
          rows: "%d fila seleccionada"
        }
      },
      "language": idioma_espanol,
      select: true
    });
        obtener_dato_familiar("#tabla_familiar tbody",table);
        table.on( 'order.dt search.dt', function () {
          table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
          } );
          }).draw();
  }
  var obtener_dato_familiar = function(tbody, table){
  
      $(tbody).on("click", "button.editar", function(){
            $('#modal_editar_familiar').modal({backdrop: 'static', keyboard: false})
            $("#modal_editar_familiar").modal('show');
            var data 			= table.row( $(this).parents("tr")).data();
            idfamiliar		=  $("#txtidfamiliar").val(data.familiar_codigo)
            familiar = $("#lblfamiliar").html(data.FAMILIAR),
            nombre 		= $("#txtnombre_editar").val(data.familiar_nombre),
            apepat		=  $("#txtapepat_editar").val(data.familiar_apepat),
            apemat 		= $("#txtapemat_editar").val(data.familiar_apemat),
            nrodocumento 		= $("#txtnrodocumento_editar").val(data.familiar_nrodocumento),
            tipodocumento 		= $("#combo_tipodocumento_editar").val(data.familiar_tipodocumento).trigger("change"),        
            fechanac 		= data.familiar_fecnac,
            status= $("#combo_estatus_editar").val(data.familiar_estatus).trigger("change");
            var info = fechanac.split('-');
            var fechanacimiento = info[2] + '-' + info[1] + '-' + info[0];
            $("#txtfechanaci_editar").val(fechanacimiento);
  
      });
  }
  
  function Abrirmodalregistro(){
        $('#modal_registro_familiar').modal({backdrop: 'static', keyboard: false})
        $("#modal_registro_familiar").modal('show');
  }
  
  function Registrar_Familiar(){
      var nombre = $("#txtnombre").val();
      var apepat = $("#txtapepat").val();
      var apemat = $("#txtapemat").val();
      var fechanacimiento = $("#txtfechanaci").val();
      var estatus = $("#combo_estatus").val();
      var nrodocumento = $("#txtnrodocumento").val();
      var tipodocumento = $("#combo_tipodocumento").val();
      var info = fechanacimiento.split('-');
      var fechanacimiento = info[2] + '-' + info[1] + '-' + info[0];
      if (nombre.length==0 || apepat.length==0 || apemat.length==0 || fechanacimiento.length==0 || estatus.length==0 || nrodocumento.length==0) {
        return   swal("Mensaje De Advertencia","Porfavor llene los campos vacios","warning");
      }
      $.ajax({
          url:'../controlador/familiar/controlador_familiar_registro.php',
          type:'POST',
          data:{
            nombre:nombre,
            apepat:apepat,
            apemat:apemat,
            fechanacimiento:fechanacimiento,
            estatus:estatus,
            nrodocumento:nrodocumento,
            tipodocumento:tipodocumento
          }
      })
      .done(function(resp){
          if (resp > 0) {
            if (resp==1) {
              $("#modal_registro_familiar").modal('hide');
              swal("Mensaje De Confirmacion","Datos correctamente, nuevo familiar registrado","success")
              .then ( ( value ) =>  {
              $("#contenido_principal").load("familiar/vista_familiar_listar.php");
              });             
            } else {
              swal("Mensaje De Advertencia","Lo sentimos, el familiar ya esta registrado","warning")         
            }

          }else{
             swal("Mensaje De Error","Lo sentimos, no se pudo completar el registro","error")
          }
      })
  }
  
  function Modificar_Familiar(){
    var idfamiliar = $("#txtidfamiliar").val();    
    var nombre = $("#txtnombre_editar").val();
    var apepat = $("#txtapepat_editar").val();
    var apemat = $("#txtapemat_editar").val();
    var fechanacimiento = $("#txtfechanaci_editar").val();
    var estatus = $("#combo_estatus_editar").val();
    var nrodocumento = $("#txtnrodocumento_editar").val();
    var tipodocumento = $("#combo_tipodocumento_editar").val();
    var info = fechanacimiento.split('-');
    var fechanacimiento = info[2] + '-' + info[1] + '-' + info[0];
    if (idfamiliar.length==0 ,nombre.length==0 || apepat.length==0 || apemat.length==0 || fechanacimiento.length==0 || estatus.length==0 || nrodocumento.length==0) {
        return       swal("Mensaje De Advertencia","Porfavor llene los campos vacios","warning");
    }
    $.ajax({
        url:'../controlador/familiar/controlador_familiar_modificar.php',
        type:'POST',
        data:{
          idfamiliar:idfamiliar,
          nombre:nombre,
          apepat:apepat,
          apemat:apemat,
          fechanacimiento:fechanacimiento,
          estatus:estatus,
          nrodocumento:nrodocumento,
          tipodocumento:tipodocumento
        }
    })
    .done(function(resp){
        if (resp > 0) {
          if (resp==1) {
            $("#modal_editar_familiar").modal('hide');
            swal("Mensaje De Confirmacion","Datos correctamente, modificados","success")
            .then ( ( value ) =>  {
            $("#contenido_principal").load("familiar/vista_familiar_listar.php");
            });             
          } else {
            swal("Mensaje De Advertencia","Lo sentimos, el familiar ya esta registrado","warning")                
          }

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
  