<script type="text/javascript" src="js/console_derechohabiente.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
        <div class="box box-solid box-primary">
            <div class="box-header with-border"  style="background-color:#34495E;">
                <h3 class="box-title">DERECHO DE HABIENTE - BUSCAR TRABAJADOR</h3>
                <!-- /.box-tools -->
            </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                      <div class="col-lg-10">
                        <div class="input-group">
                            <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <button type="submit" class="btn btn-success  btn-danger" style="width:100%;" onclick="cargar_contenido('contenido_principal','derecho_habiente/vista_derecho_habiente_registro.php')"><span class="glyphicon glyphicon-plus"></span>&nbsp;Nuevo Registro</button>
                      </div>
                  </div>

              </div>

              <!-- /.box-body -->
        </div>
        <div class="box box-solid box-primary">
            <div class="box-header with-border"  style="background-color:#34495E;">
                <h3 class="box-title">LISTADO DE TRABAJADORES</h3>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="text-align:center;">
                  <div class="table-responsive" style="color:#000000;font-size:small;" >
                    <div class="col-md-12">
                               <table table id="tabla_derechohabiente" class="display dataTable" style='width: 100%;' role="grid" aria-describedby="example_info">
                                <thead >
                                   <tr role="row" class="odd">
                                     <th style="text-align: center;width: 50px;word-wrap: break-word;">#</th>
                                     <th style="text-align: center;width: 150px;word-wrap: break-word;">TRABAJADOR</th>  
                                     <th style="text-align: center;width: 120px;word-wrap: break-word;">EMAIL</th>      
                                     <th style="text-align: center;width: 150px;word-wrap: break-word;">CARGO</th>               <th style="text-align: center;width: 100px;word-wrap: break-word;">&Aacute;REA</th>         <th style="text-align: center;width: 100px;word-wrap: break-word;">FAMILIARES</th>
                                   </tr>
                                 </thead>
                               </table>
                     </div>
                  </div>
               </div>
        </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal_ver_familiares">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><label>FAMILIARES ASIGNADOS DE <label id="txttrabajador"></label></h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="table-responsive col-md-12" id="div_asignar_familiar" style="text-align:center;"><br>
   
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success pull-right" data-dismiss="modal"><i class="fa fa-close"></i><b> CLOSE</b></button>
        </div>
     </div>
  </div>
</div>
<script type="text/javascript">
listar_derechohabiente();
function filterGlobal () {
    $('#tabla_derechohabiente').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

$(document).ready(function() {
  $('.js-example-basic-single').select2();
  document.getElementById("tabla_derechohabiente_filter").style.display = "none";
    $('#tabla_derechohabiente').DataTable();
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );

    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    } );
} );
</script>
