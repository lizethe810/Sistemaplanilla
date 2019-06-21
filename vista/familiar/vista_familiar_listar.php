<script type="text/javascript" src="js/console_familiar.js?rev=<?php echo time();?>"></script>
<style>
.row_selected td {
    background-color: black !important; /* Add !important to make sure override datables base styles */
 }
 </style>
<div class="row">
  <div class="col-lg-12">
        <div class="box box-solid box-primary">
            <div class="box-header with-border"  style="background-color:#34495E;">
                <h3 class="box-title">BUSCAR FAMILIAR</h3>
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
                <h3 class="box-title">LISTADO DE FAMILIARES</h3>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="text-align:center;">
                  <div class="table-responsive" style="color:#000000;font-size:small;" >
                    <div class="col-md-12">
                               <table table id="tabla_familiar" class="display dataTable" style='width: 100%;' role="grid" aria-describedby="example_info">
                                <thead >
                                   <tr role="row" class="odd">
                                     <th style="text-align: center;width: 50px;word-wrap: break-word;">#</th>
                                     <th style="text-align: center;width: 300px;word-wrap: break-word;">FAMILIAR</th>  
                                     <th style="text-align: center;width: 100px;word-wrap: break-word;">N° DOCUMENTO</th>                     <th style="text-align: center;width: 80px;word-wrap: break-word;">TIPO DOCUMENTO</th>                     <th style="text-align: center;width: 80px;word-wrap: break-word;">FECHA NACIMIENTO</th>                   
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
<div class="modal fade bs-example-modal-sm" id="modal_registro_familiar">
  <div class="modal-dialog modal-sm modal-dialog-centered">
     <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title"><label>REGISTRO CARGO</label></h4>
             </div>
             <div class="modal-body">
                 <div class="box-body">
                      <div class="col-lg-12">                  
                          <div class="col-lg-12">
                              <label for="">Nombres:</label>
                              <input type="text" id="txtnombre" class="form-control"><br>
                          </div>
                      </div>
                      <div class="col-lg-12">                     
                          <div class="col-lg-6">
                              <label for="">Apellido Paterno:</label>
                              <input type="text" id="txtapepat" class="form-control"><br>
                          </div>
                          <div class="col-lg-6">
                              <label for="">Apellido Materno:</label>
                              <input type="text" id="txtapemat" class="form-control"><br>
                          </div>  
                      </div>                          
                      <div class="col-lg-12">                     
                          <div class="col-lg-6">
                              <label for="">Fecha Nacimiento:</label>
                              <input type="text" id="txtfechanaci" class="form-control floating-label" placeholder="DD-MM-AA"><br>
                          </div>
                          <div class="col-lg-6">
                              <label for="">Estatus:</label><br>
                              <select class="js-example-basic-single" name="state" style="width:100%;" id="combo_estatus">
                              <option value="ACTIVO">ACTIVO</option>
                              <option value="INACTIVO">INACTIVO</option>
                              </select><br>
                          </div>            
                      </div> 
                      <div class="col-lg-12">
                          <div class="col-lg-6">
                              <label for="">N° Documento</label>
                              <input type="text" id="txtnrodocumento" class="form-control" maxlength="12" onkeyup="SoloNumeros(this)" onchange="SoloNumeros(this)"><br>
                          </div>
                          <div class="col-lg-6">
                          <label for="">Tipo Documento:</label><br>
                              <select class="js-example-basic-single" name="state" style="width:100%;" id="combo_tipodocumento">
                              <option value="DNI">DNI</option>
                              <option value="RUC">PASAPORTE</option>
                              <option value="RUC">RUC</option>        
                              </select>
                          </div>                       
                      </div>                                                                          
                 </div>
              </div>

             <div class="modal-footer">
               <button type="submit" class="btn btn-success" onclick="Registrar_cargo()"><i class="fa fa-check"></i>&nbsp;<b>Registrar cargo</b></button>&nbsp;&nbsp;&nbsp;
               <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-close"></i><b>&nbsp;Close</b></button>
             </div>
      </div>
           <!-- /.modal-content -->
  </div>
         <!-- /.modal-dialog -->
</div>
 <!-- /.Fin modal -->

 <!-- /.Inicio modal -->
 <div class="modal fade bs-example-modal-lg" id="modal_editar_familiar">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><label>MODIFICAR DATOS DE: <label for="" id="lblfamiliar"></label></label></h4>
              </div>
              <div class="modal-body">
                  <div class="box-body">
                    <div class="col-lg-12">                  
                          <div class="col-lg-12">
                          <input type="text" id="txtidfamiliar" hidden="true">
                              <label for="">Nombres:</label>
                              <input type="text" id="txtnombre_editar" class="form-control"><br>
                          </div>
                      </div>
                      <div class="col-lg-12">                     
                          <div class="col-lg-6">
                              <label for="">Apellido Paterno:</label>
                              <input type="text" id="txtapepat_editar" class="form-control"><br>
                          </div>
                          <div class="col-lg-6">
                              <label for="">Apellido Materno:</label>
                              <input type="text" id="txtapemat_editar" class="form-control"><br>
                          </div>  
                      </div>                          
                      <div class="col-lg-12">                     
                          <div class="col-lg-6">
                              <label for="">Fecha Nacimiento:</label>
                              <input type="text" id="txtfechanaci_editar" class="form-control floating-label" placeholder="DD-MM-AA"><br>
                          </div>
                          <div class="col-lg-6">
                              <label for="">Estatus:</label><br>
                              <select class="js-example-basic-single" name="state" style="width:100%;" id="combo_estatus_editar">
                              <option value="ACTIVO">ACTIVO</option>
                              <option value="INACTIVO">INACTIVO</option>
                              </select><br>
                          </div>            
                      </div> 
                      <div class="col-lg-12">
                          <div class="col-lg-6">
                              <label for="">N° Documento</label>
                              <input type="text" id="txtnrodocumento_editar" class="form-control" maxlength="12" onkeyup="SoloNumeros(this)" onchange="SoloNumeros(this)"><br>
                          </div>
                          <div class="col-lg-6">
                          <label for="">Tipo Documento:</label><br>
                              <select class="js-example-basic-single" name="state" style="width:100%;" id="combo_tipodocumento_editar">
                              <option value="DNI">DNI</option>
                              <option value="RUC">PASAPORTE</option>
                              <option value="RUC">RUC</option>        
                              </select>
                          </div>                       
                      </div>   
                    </div>
               </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-success" onclick="Modificar_Familiar()"><i class="fa fa-check"></i>&nbsp;<b>Modificar cargo</b></button>&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-close"></i><b>&nbsp;Close</b></button>
              </div>
       </div>
            <!-- /.modal-content -->
   </div>
          <!-- /.modal-dialog -->
 </div>
  <!-- /.Fin modal -->
<script type="text/javascript">
listar_familiar();
$('#modal_registro_familiar').on('shown.bs.modal', function () {
    $('#txtnombre').focus();
})  
function SoloNumeros(obj) {
  /* El evento "change" sólo saltará si son diferentes */
  obj.value = obj.value.replace(/\D/g, '');
}
function filterGlobal () {
    $('#tabla_familiar').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

$(document).ready(function() {
  $('.js-example-basic-single').select2();  
  $('#txtfechanaci').bootstrapMaterialDatePicker
    ({
      time: false,
      clearButton: true,
      lang : 'es',
      format: 'DD-MM-YYYY',

  });
  $('#txtfechanaci_editar').bootstrapMaterialDatePicker
    ({
      time: false,
      clearButton: true,
      lang : 'es',
      format: 'DD-MM-YYYY',

  });
  document.getElementById("tabla_familiar_filter").style.display = "none";
    $('#tabla_familiar').DataTable();
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );

    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    } );
  });
</script>
