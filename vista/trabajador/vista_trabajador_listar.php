<script type="text/javascript" src="js/console_trabajador.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
    <div class="box box-warning box-solid">
      <div class="box-header with-border"  style="background-color:#ff4111;">
        <h3 class="box-title">BUSCAR TRABAJADOR</h3>
      </div>
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
    </div>
    <div class="box box-warning box-solid">
      <div class="box-header with-border"  style="background-color:#ff4111;">
        <h3 class="box-title">LISTADO DE TRABAJADORES</h3>
      </div>
      <div class="box-body" style="text-align:left;">
        <div class="table-responsive" style="color:#000000;font-size:13px;" >
          <div class="col-md-12">
           <!-- <table table id="tabla_trabajador" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
              <thead >
                <tr role="row" class="odd">
                  <th style="text-align: center;width: 80px;word-wrap: break-word;">Nro</th>
                  <th style="text-align: left;width: 300px;word-wrap: break-word;">TRABAJADOR</th>
                  <th style="text-align: center;width: 80px;word-wrap: break-word;">SEXO</th>
                  <th style="text-align: center;width: 150px;word-wrap: break-word;">FECHA NACI.</th>
                  <th style="text-align: left;width: 100px;word-wrap: break-word;">E-MAIL PRINCIPAL</th>
                  <th style="text-align: left;width: 100px;word-wrap: break-word;">TELEFONO PRINCIPAL</th>
                  <th style="text-align: center;width: 100px;word-wrap: break-word;">MEDIOS DE COMUNICACIÓN</th>
                  <th style="text-align: center;width: 100px;word-wrap: break-word;">DOCUMENTOS DE IDENTIDAD</th>
                  <th style="text-align: center;width: 80px;word-wrap: break-word;">ACCI&Oacute;N</th>
                </tr>
              </thead>
            </table>-->
            <div id="div_tabla_trabajador"></div>
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
listar_trabajador('');
$("#txtbuscar").keyup(function(){
  var dato_buscar = $("#txtbuscar").val();
  listar_trabajador(dato_buscar);
});

$('#modal_editar').on('shown.bs.modal', function () {
  $('#txtcontra1').focus()
})
</script>
<div class="modal fade bs-example-modal-lg" id="modal_ver_medios_comunicacion">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><label>EDITAR MEDIOS DE COMUNICACIÓN DE : <label id="lb_trabajador1"></label></h4>
        </div>
        <div class="modal-body">
           <div class="box-body">
             <div class="form-group">
                <input type="text" id="txttrabajador1" hidden="true">
                <div class="col-lg-4">
                  <label>DESCRIPCIÓN:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-alpha-asc"></i>
                    </div>
                    <input type="text" class="form-control" name="txtrazonsocial"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtrazonsocial" maxlength="150" placeholder="Ingresar descripcion">
                  </div>
                </div>
                <div class="col-lg-2">
                  <label>TIPO</label>
                  <select id="cbm_tipo" style="width: 100%" class="form-control select2">
                    <option>Correo</option>
                    <option>Telefono</option>
                  </select>
                </div>
                <div class="col-md-3">
                      <label><b>NIVEL</b></label>
                      <div class="form-group">
                        <div class="col-lg-6">
                          <label style="font-size: 13px;font-weight: normal;">
                            <input type="radio" name="pr1" id="combo_nivel" style="" value="P" class="flat-red prt1" >
                            Principal
                          </label>
                        </div>
                        <div class="col-lg-6">
                          <label style="font-size: 13px;font-weight: normal;">
                            <input type="radio" name="pr1" id="combo_nivel" style="" value="S" class="flat-red prt2" checked>
                            Secundario
                          </label>
                        </div>
                      </div>
                      <br>
                  </div>
                 <div class="col-lg-3" style="padding-left: 2px;">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-primary" onclick="registrar_medio_comunicacion()" name="button" style="width:100%;"><i class="fa fa-fw fa-search"></i><b>AGREGAR</b></button><br>
                 </div>
                <div class="col-md-12 table-responsive">
                  <table id="tabla_mediocomunicacion" class="display dataTable" style="width: 100%;">
                    <thead >
                      <tr role="row" class="odd">
                        <th style="text-align: center;width: 80px;word-wrap: break-word;">Nro</th>
                        <th style="text-align: left;width: 300px;word-wrap: break-word;">MEDIO COMUNICACIÓN</th>
                        <th style="text-align: left;width: 80px;word-wrap: break-word;">TIPO</th>
                        <th style="text-align: center;width: 80px;word-wrap: break-word;">NIVEL</th>
                        <th style="text-align: center;width: 80px;word-wrap: break-word;">ACCI&Oacute;N</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_tabla_medio_comunicacion"></tbody>
                  </table>
                </div>
             </div>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success pull-right" data-dismiss="modal"><i class="fa fa-close"></i><b> CLOSE</b></button>
        </div>
     </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modal_ver_documento_identidad">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><label>EDITAR DOCUMENTO DE IDENTIDAD DE : <label id="lb_trabajador2"></label></h4>
        </div>
        <div class="modal-body">
           <div class="box-body">
             <div class="form-group">
                <input type="text" id="txttrabajador2" hidden="true">
                <div class="col-lg-6">
                  <label>DESCRIPCIÓN:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-alpha-asc"></i>
                    </div>
                    <input type="text" class="form-control" name="txtdni"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtdni" maxlength="150" placeholder="Ingresar documento de identidad">
                  </div>
                </div>
                <div class="col-lg-3">
                  <label>TIPO</label>
                  <select id="cbm_tipo_documento" style="width: 100%" class="form-control select2">
                    <option>DNI</option>
                    <option>PASAPORTE</option>
                    <option>RUC</option>
                  </select>
                </div>
                 <div class="col-lg-3" style="padding-left: 2px;">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-primary" onclick="registrar_documento_identidad()" name="button" style="width:100%;"><i class="fa fa-fw fa-search"></i><b>AGREGAR</b></button><br>
                 </div>
                <div class="col-md-12 table-responsive">
                  <table id="tabla_documentoidentidad" class="display dataTable" style="width: 100%;">
                    <thead >
                      <tr role="row" class="odd">
                        <th style="text-align: center;width: 80px;word-wrap: break-word;">Nro</th>
                        <th style="text-align: left;width: 300px;word-wrap: break-word;">DOCUMENTO IDENTIDAD</th>
                        <th style="text-align: left;width: 80px;word-wrap: break-word;">TIPO</th>
                        <th style="text-align: center;width: 80px;word-wrap: break-word;">ACCI&Oacute;N</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_tabla_documentoidentidad"></tbody>
                  </table>
                </div>
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
  $('.select2').select2();
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-orange'
    })
</script>