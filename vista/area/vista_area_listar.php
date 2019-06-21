<script type="text/javascript" src="js/console_area.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
        <div class="box box-solid box-primary">
            <div class="box-header with-border"  style="background-color:#34495E;">
                <h3 class="box-title">BUSCAR AREA</h3>
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
                        <button type="submit" class="btn btn-success  btn-danger" style="width:100%;" onclick="Abrirmodalregistro()"><span class="glyphicon glyphicon-plus"></span>&nbsp;Nuevo Registro</button>
                      </div>
                  </div>

              </div>

              <!-- /.box-body -->
        </div>
        <div class="box box-solid box-primary">
            <div class="box-header with-border"  style="background-color:#34495E;">
                <h3 class="box-title">LISTADO DE AREAS</h3>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="text-align:center;">
                  <div class="table-responsive" style="color:#000000;font-size:small;" >
                    <div class="col-md-12">
                               <table table id="tabla_area" class="display dataTable" style='width: 100%;' role="grid" aria-describedby="example_info">
                                <thead >
                                   <tr role="row" class="odd">
                                     <th style="text-align: center;width: 50px;word-wrap: break-word;">#</th>
                                     <th style="text-align: center;width: 500px;word-wrap: break-word;">&Aacute;REA</th>
                                     <th style="text-align: center;width: 200px;word-wrap: break-word;">FECHA REGISTRO</th>                                    
                                     <th style="text-align: center;width: 100px;word-wrap: break-word;">ESTATUS</th>
                                     <th style="text-align: center;width: 50;word-wrap: break-word;">ACCI&Oacute;N</th>
                                   </tr>
                                 </thead>
                               </table>
                     </div>
                  </div>
               </div>
        </div>
  </div>
</div>
<!-- /.Inicio modal -->
<div class="modal fade bs-example-modal-sm" id="modal_registro_area">
  <div class="modal-dialog modal-sm modal-dialog-centered">
     <div class="modal-content">
             <div class="modal-header" style="background-color:#34495E;color:#FFFFFF;"> 
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="color:black">
                 <span aria-hidden="true"  style="color:black">&times;</span></button>
               <h4 class="modal-title"><label>REGISTRO DE &Aacute;REA</label></h4>
             </div>
             <div class="modal-body">
                 <div class="box-body">
                    <label for="">Descripci&oacute;n:</label>
                    <input type="text" name="" value="" id="txtarea"  class="form-control"><br>
                    <label for="">Estatus:</label><br>
                    <select class="js-example-basic-single" name="state" style="width:100%;" id="combo_estatus">
                      <option value="ACTIVO">ACTIVO</option>
                      <option value="INACTIVO">INACTIVO</option>
                    </select>
                 </div>
              </div>

             <div class="modal-footer">
               <button type="submit" class="btn btn-success" onclick="Registrar_Area()"><i class="fa fa-check"></i>&nbsp;<b>Registrar &aacute;rea</b></button>&nbsp;&nbsp;&nbsp;
               <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-close"></i><b>&nbsp;Close</b></button>
             </div>
      </div>
           <!-- /.modal-content -->
  </div>
         <!-- /.modal-dialog -->
</div>
 <!-- /.Fin modal -->

 <!-- /.Inicio modal -->
 <div class="modal fade bs-example-modal-sm" id="modal_editar_area">
   <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><label>MODIFICAR &Aacute;REA</label></h4>
              </div>
              <div class="modal-body">
                  <div class="box-body">
                     <input type="text" name="" value="" id="txtidarea" hidden="true">
                     <label for="">Cargo:</label>
                     <input type="text" name="" value="" id="txtareaeditar"  class="form-control"><br>
                     <label for="">Estatus:</label><br>
                     <select class="js-example-basic-single" name="state" style="width:100%;" id="combo_estatuseditar">
                       <option value="ACTIVO">ACTIVO</option>
                       <option value="INACTIVO">INACTIVO</option>
                     </select>
                  </div>
               </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-success" onclick="Modificar_Area()"><i class="fa fa-check"></i>&nbsp;<b>Modificar &Aacute;rea</b></button>&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-close"></i><b>&nbsp;Close</b></button>
              </div>
       </div>
            <!-- /.modal-content -->
   </div>
          <!-- /.modal-dialog -->
 </div>
  <!-- /.Fin modal -->
<script type="text/javascript">
listar_area();
function filterGlobal () {
    $('#tabla_area').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

$(document).ready(function() {
  $('.js-example-basic-single').select2();
  document.getElementById("tabla_area_filter").style.display = "none";
    $('#tabla_area').DataTable();
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );

    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    } );
} );
</script>
