function listar_derechohabiente(){
    var table = $("#tabla_derechohabiente").DataTable({
      "bLengthChange":false,
      "ordering":false,
      "pageLength":10,
      "destroy":true,
      "ajax":{
        "method":"POST",
        "url":"../controlador/derecho_habiente/controlador_derecho_listar.php"
      },
      "columns":[
          {"defaultContent":""},
          {"data":"trabajador"},
          {"data":"trab_email"},   
          {"data":"cargo_descripcion"},
          {"data":"area_descripcion"},    
          {"defaultContent":"<button style='font-size:13px;' type='button' class='ver_familiar btn btn-default' style='background:#FFFFFF;outline: none;'><span class='glyphicon glyphicon-eye-open'></span></button>"}           
      ],
      "language":idioma_espanol,
      select: true
    });
        obtener_dato_familiares("#tabla_derechohabiente tbody",table);
        table.on( 'order.dt search.dt', function () {
          table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
          } );
          }).draw();
}
  
  var obtener_dato_familiares = function(tbody, table){
  
      $(tbody).on("click", "button.ver_familiar", function(){
            $('#modal_ver_familiares').modal({backdrop: 'static', keyboard: false})
            $("#modal_ver_familiares").modal('show');
            var data 			= table.row( $(this).parents("tr")).data();
            var idtrabajador =data.trabajador_cod; 
            $('#txttrabajador').html(data.trabajador);
            listar_familar_asignados_ver(idtrabajador);
  
      });
  }
  
  function Abrirmodalregistro(){
        $('#modal_registro_area').modal({backdrop: 'static', keyboard: false})
        $("#modal_registro_area").modal('show');
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
  
function buscar_trabajador(){
    $('#modal_listar_trabajadores').modal({backdrop: 'static', keyboard: false})
    $("#modal_listar_trabajadores").modal('show');
    listar_trabajadores();
    document.getElementById("tabla_trabajadores_filter").style.display = "none";
}

function listar_trabajadores(){
    var cadena_principal ="";
    cadena_principal+='<table table id="tabla_trabajadores" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
    '<thead >'+
       '<tr role="row" class="odd">'+
         '<th style="text-align: center;width: 50px;word-wrap: break-word;">#</th>'+
         '<th style="text-align: center;width: 150px;word-wrap: break-word;">TRABAJADOR</th>'+
         '<th style="text-align: center;width: 120px;word-wrap: break-word;">EMAIL</th>  '+    
        '<th style="text-align: center;width: 150px;word-wrap: break-word;">CARGO</th>'+         
        '<th style="text-align: center;width: 100px;word-wrap: break-word;">&Aacute;REA</th>'+     
        '<th style="text-align: center;width: 50;word-wrap: break-word;">ACCI&Oacute;N</th>'+
       '</tr>'+
     '</thead>'+
   '</table>';
   $("#div_tabla_trabajador").html(cadena_principal);
    var table = $("#tabla_trabajadores").DataTable({
      "bLengthChange":false,
      "ordering":false,
      "pageLength":10,
      "destroy":true,
      "ajax":{
        "method":"POST",
        "url":"../controlador/derecho_habiente/controlador_derecho_listar.php"
      },
      "columns":[
          {"defaultContent":""},
          {"data":"trabajador"},
          {"data":"trab_email"},   
          {"data":"cargo_descripcion"},
          {"data":"area_descripcion"},               
          {"defaultContent":"<button style='font-size:13px;' type='button' class='editar_enviardatostrabajador btn btn-success'><span>Enviar</span></button>"}
      ],
      "language":idioma_espanol,
      select: true
    });
        obtener_dato_enviar_trabajadores("#tabla_trabajadores tbody",table);
        table.on( 'order.dt search.dt', function () {
          table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
          } );
          }).draw();
}
var obtener_dato_enviar_trabajadores = function(tbody, table){
    $(tbody).on("click", "button.editar_enviardatostrabajador", function(){
      var data       = table.row( $(this).parents("tr")).data();
      txtidtrabajador.value=data.trabajador_cod;
      txtnombre.value=data.trabajador;
      var idtrabajador=$("#txtidtrabajador").val();
      listar_familar_asignados(idtrabajador);
      $("#modal_listar_trabajadores").modal("hide");
    });
}

function buscar_familiar(){
  $('#modal_listar_familiares').modal({backdrop: 'static', keyboard: false})
  $("#modal_listar_familiares").modal('show');
  listar_familiar('%');
}

function listar_familiar(buscar){
  var cadena_principal ="";
  cadena_principal+='<table table id="tabla_familiares" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
  '<thead >'+
     '<tr role="row" class="odd">'+
       '<th style="text-align: center;width: 50px;word-wrap: break-word;">#</th>'+
       '<th style="text-align: center;width: 150px;word-wrap: break-word;">FAMILIAR</th>'+
       '<th style="text-align: center;width: 120px;word-wrap: break-word;">N° DOCUMENTO</th>  '+   
      '<th style="text-align: center;width: 150px;word-wrap: break-word;">FECHA NACIMIENTO</th>'+         
      '<th style="text-align: center;width: 100px;word-wrap: break-word;">&Aacute;REA</th>'+     
      '<th style="text-align: center;width: 50;word-wrap: break-word;">ACCI&Oacute;N</th>'+
     '</tr>'+
   '</thead>'+
 '</table>';
 $("#div_tabla_familiar").html(cadena_principal);
  var table = $("#tabla_familiares").DataTable({
    "bLengthChange":false,
    "ordering":false,
    "pageLength":10,
    "destroy":true,
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
        {"defaultContent":"<button style='font-size:13px;' type='button' class='editar_enviardatosfamiliar btn btn-success'><span>Enviar</span></button>"}                 
    ],
    "language":idioma_espanol,
    select: true
  });
  obtener_dato_enviar_familiares("#tabla_familiares tbody",table);  
    table.on( 'order.dt search.dt', function () {
      table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
      } );
      }).draw();
      document.getElementById("tabla_familiares_filter").style.display = "none";  
}

var obtener_dato_enviar_familiares = function(tbody, table){
  $(tbody).on("click", "button.editar_enviardatosfamiliar", function(){
    var data       = table.row( $(this).parents("tr")).data();
    txtidfamiliar.value=data.familiar_codigo;
    txtnombrefamiliar.value=data.FAMILIAR;
    $("#modal_listar_familiares").modal("hide");
  });
}

function Registrar_DerechoHabiente(){
  var idtrabajador = $("#txtidtrabajador").val();
  var idfamiliar = $("#txtidfamiliar").val();
  var parentesco = $("#cbm_parentesco").val();
  if (parentesco.length==0 ) {
    return   swal("Mensaje De Advertencia","Porfavor, seleccione un parentesco","warning");
  }  
if (idfamiliar.length==0 || idtrabajador.length==0) {
  return   swal("Mensaje De Advertencia","Porfavor llene los campos vacios","warning");
}
  $.ajax({
      url:'../controlador/derecho_habiente/controlador_derecho_habiente_registro.php',
      type:'POST',
      data:{
        idtrabajador:idtrabajador,
        idfamiliar:idfamiliar,
        parentesco:parentesco
      }
  })
  .done(function(resp){
      if (resp > 0) {
        if (resp==1) {
          swal("Mensaje De Confirmacion","Datos correctamente, nuevo familiar asignado","success")          
          listar_familar_asignados(idtrabajador);
        } else {
          swal("Mensaje De Advertencia","Lo sentimos, el familiar ya esta registrado","warning")              
        }

      }else{
        swal("Mensaje De Error","Lo sentimos, no se pudo completar el registro","error")
      }
  })
}


function listar_familar_asignados(idtrabajador){
  var cadena_principal ="<b>LISTADO DE FAMILIARES ASIGNADOS</b><br>";
  cadena_principal+='<table table id="tabla_asignar_familiar" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
  '<thead >'+
     '<tr role="row" class="odd">'+
       '<th style="text-align: center;width: 50px;word-wrap: break-word;">#</th>'+
       '<th style="text-align: center;width: 250px;word-wrap: break-word;">FAMILIAR</th>'+
       '<th style="text-align: center;width: 120px;word-wrap: break-word;">N° DOCUMENTO</th>  '+   
      '<th style="text-align: center;width: 100px;word-wrap: break-word;">FECHA NACIMIENTO</th>'+         
      '<th style="text-align: center;width: 50;word-wrap: break-word;">ACCI&Oacute;N</th>'+
     '</tr>'+
   '</thead>'+
 '</table>';
 $("#div_asignar_familiar").html(cadena_principal);
  var table = $("#tabla_asignar_familiar").DataTable({
    "bLengthChange":false,
    "ordering":false,
    "pageLength":10,
    "destroy":true,
    "ajax":{
      "method":"POST",
      "url":"../controlador/derecho_habiente/controlador_familiar_asignado_listar.php",
      data:{
        idtrabajador:idtrabajador
      }
    },
    "columns":[
        {"defaultContent":""},
        {"data":"FAMILIAR"}, 
        {"data":"familiar_nrodocumento"},          
        {"data":"familiar_fecnac"},     
        {"data":"derechohabiente_codigo",
        render: function (data, type, row ) {
                  return "<button style='font-size:13px;' name='"+data+"' type='button' class='btn btn-danger' onclick='Eliminar_DerechoHabiente(this)'><span class='glyphicon glyphicon-trash'></span></button>";
            }
        }             
    ],
    "language":idioma_espanol,
    select: true
  });
    obtener_dato_enviar_familiares("#tabla_asignar_familiar tbody",table);  
    table.on( 'order.dt search.dt', function () {
      table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
      } );
      }).draw();
      document.getElementById("tabla_asignar_familiar_filter").style.display = "none";
      document.getElementById("div_asignar_familiar").style.display = "block";  
}

function listar_familar_asignados_ver(idtrabajador){
  var cadena_principal ="<b>LISTADO DE FAMILIARES ASIGNADOS</b><br>";
  cadena_principal+='<table table id="tabla_asignar_familiar" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">'+
  '<thead >'+
     '<tr role="row" class="odd">'+
       '<th style="text-align: center;width: 50px;word-wrap: break-word;">#</th>'+
       '<th style="text-align: center;width: 250px;word-wrap: break-word;">FAMILIAR</th>'+
       '<th style="text-align: center;width: 120px;word-wrap: break-word;">N° DOCUMENTO</th>  '+   
      '<th style="text-align: center;width: 100px;word-wrap: break-word;">FECHA NACIMIENTO</th>'+         
     '</tr>'+
   '</thead>'+
 '</table>';
 $("#div_asignar_familiar").html(cadena_principal);
  var table = $("#tabla_asignar_familiar").DataTable({
    "bLengthChange":false,
    "ordering":false,
    "pageLength":10,
    "destroy":true,
    "ajax":{
      "method":"POST",
      "url":"../controlador/derecho_habiente/controlador_familiar_asignado_listar.php",
      data:{
        idtrabajador:idtrabajador
      }
    },
    "columns":[
        {"defaultContent":""},
        {"data":"FAMILIAR"}, 
        {"data":"familiar_nrodocumento"},          
        {"data":"familiar_fecnac"},              
    ],
    "language":idioma_espanol,
    select: true
  }); 
    table.on( 'order.dt search.dt', function () {
      table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
      } );
      }).draw();
      document.getElementById("tabla_asignar_familiar_filter").style.display = "none";
      document.getElementById("div_asignar_familiar").style.display = "block";  
}


function Eliminar_DerechoHabiente(control){
	var dato   = control.name;
  var datos  = dato.split("*");
  var idtrabajador = $("#txtidtrabajador").val();
  var idderecho = datos[0];

  $.ajax({
      url:'../controlador/derecho_habiente/controlador_derecho_habiente_eliminar.php',
      type:'POST',
      data:{
        idderecho:idderecho
      }
  })
  .done(function(resp){
      if (resp > 0) {
      swal("Mensaje De Confirmacion","Familiar del trabajador eliminado","success") 
      listar_familar_asignados(idtrabajador);   
      }else{
        swal("Mensaje De Error","Lo sentimos, no se pudo completar el registro","error")
      }
  })
}