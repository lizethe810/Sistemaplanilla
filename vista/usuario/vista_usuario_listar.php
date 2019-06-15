<script type="text/javascript" src="js/console_trabajador.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
            <div class="box box-warning box-solid">
              <div class="box-header with-border"  style="background-color:#ff4111;">
                <h3 class="box-title">BUSCAR TRABAJADOR</h3>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                      <div class="col-lg-12">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Ingresar datos trabajador" id="txtbuscar">
                          <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        </div>
                      </div>
                  </div>

              </div>

              <!-- /.box-body -->
            </div>
            <div class="box box-warning box-solid">
              <div class="box-header with-border"  style="background-color:#ff4111;">
                <h3 class="box-title">LISTADO DE USUARIOS</h3>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="text-align:left;">
                  <div class="table-responsive" style="color:#000000;font-size:13px;" >
                    <div class="col-md-12">
                      <table table id="tabla_empresa" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                        <thead >
                          <tr role="row" class="odd">
                            <th style="text-align: center;width: 80px;word-wrap: break-word;">Nro</th>
                            <th hidden="true">ID</th>
                            <th style="text-align: left;width: 300px;word-wrap: break-word;">TRABAJADOR</th>
                            <th style="text-align: left;width: 200px;word-wrap: break-word;">E-MAIL</th>
                            <th style="text-align: center;width: 200px;word-wrap: break-word;">USUARIO</th>
                            <th style="text-align: center;width: 200px;word-wrap: break-word;">CLAVE</th>
                            <th style="text-align: left;width: 100px;word-wrap: break-word;">ACCI&Oacute;N</th>
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
<div class="modal fade bs-example-modal-lg" id="modal_editar">
         <div class="modal-dialog modal-lg modal-dialog-centered">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title"><label>CAMBIAR CONTRASEÑA</h4>
             </div>
             <div class="modal-body">
                 <div class="box-body">
                       <div class="form-group">
                             <input type="text" id="txtidusuario" hidden="true">
                             <div class="col-lg-12">
                                 <label>NOMBRE:</label>
                                 <div class="input-group">
                                   <div class="input-group-addon">
                                     <i class="glyphicon glyphicon-sort-by-alphabet"></i>
                                   </div>
                                   <input type="text" class="form-control"  disabled style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtnombre" onkeypress="return soloLetras(event)" maxlength="50">
                                 </div>
                                 <br>
                             </div>
                             <div class="col-lg-12">
                               <label>USUARIO:</label>
                               <div class="input-group">
                                 <div class="input-group-addon">
                                   <i class="glyphicon glyphicon-user"></i>
                                 </div>
                                 <input type="text" class="form-control"  disabled style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtusuario" onkeypress="return soloLetras(event)" maxlength="50">
                               </div>
                               <br>
                             </div>
                             <div class="col-lg-12">
                                 <label style="color:#000000;">DEPARTAMENTO:</label>
                                 <select class="js-example-basic-single" name="state" id="combo_departamento" style="width:100%;height:50px;">
                                 </select>
                             </div>
                             <div class="col-lg-12">
                                <br>
                             		<label>CONTRASEÑA:</label>
                                 <div class="input-group">
                                   <div class="input-group-addon">
                                     <i class="fa fa-unlock-alt"></i>
                                   </div>
                                   <input type="password" class="form-control"   style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtcontra1" maxlength="15" placeholder="Ingresar contraseña">
                                 </div>
                             		<br>
                             </div>
                             <div class="col-lg-12">
                             		<label>CONFIRMAR CONTRASEÑA:</label>
                                 <div class="input-group">
                                   <div class="input-group-addon">
                                     <i class="fa fa-unlock-alt"></i>
                                   </div>
                                   <input type="password" class="form-control"   style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtcontra2" maxlength="15" placeholder="Ingresar contraseña">
                                 </div>
                             		<br>
                             </div>
                       </div>

                 </div>
              </div>

             <div class="modal-footer">
               <button  class="btn btn-danger" onclick="Modificar_Usuario_Empresa()"><i class="fa fa-check"></i>&nbsp;<b>MODIFICAR DATOS</b></button>&nbsp;&nbsp;&nbsp;
               <button type="button" class="btn btn-success pull-right" data-dismiss="modal"><i class="fa fa-close"></i><b> CLOSE</b></button>
             </div>
           </div>
           <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
</div>
 <!-- /.Buscar dato -->
<script type="text/javascript">
listar_usuario_empresa('');
$("#txtbuscar").keyup(function(){
  var dato_buscar = $("#txtbuscar").val();
  listar_usuario_empresa(dato_buscar);
});

$('#modal_editar').on('shown.bs.modal', function () {
  $('#txtcontra1').focus()
})
</script>
