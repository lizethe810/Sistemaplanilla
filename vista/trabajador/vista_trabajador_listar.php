<script type="text/javascript" src="js/console_trabajador.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary box-solid">
      <div class="box-header with-border"  style="background-color:#34495E;">
        <h3 class="box-title">BUSCAR TRABAJADOR</h3>
      </div>
      <div class="box-body">
        <div class="form-group">
          <div class="col-lg-10">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Ingresar datos trabajador" id="txtbuscar">
              <span class="input-group-addon"><i class="fa fa-search"></i></span>
            </div>
          </div>
          <div class="col-lg-2">
            <button class="btn btn-success  btn-danger" style="width:100%;" onclick="cargar_contenido('contenido_principal','trabajador/vista_trabajador_registro.php')"><span class="glyphicon glyphicon-plus"></span><b>&nbsp;Nuevo Registro</b></button>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-primary box-solid">
      <div class="box-header with-border"  style="background-color:#34495E;">
        <h3 class="box-title">LISTADO DE TRABAJADORES</h3>
      </div>
      <div class="box-body" style="text-align:left;">
        <div class="table-responsive" style="color:#000000;font-size:13px;" >
          <div class="col-md-12">
            <div id="div_tabla_trabajador"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
                  <label>Descripción:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-alpha-asc"></i>
                    </div>
                    <input type="text" class="form-control" name="txtrazonsocial"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtrazonsocial" maxlength="150" placeholder="Ingresar descripcion">
                  </div>
                </div>
                <div class="col-lg-2">
                  <label>Tipo:</label>
                  <select id="cbm_tipo" style="width: 100%" class="form-control select2">
                    <option>Correo</option>
                    <option>Telefono</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label><b>Nivel</b></label>
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
                  <label>Descripción:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-alpha-asc"></i>
                    </div>
                    <input type="text" class="form-control" name="txtdni"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtdni" maxlength="150" placeholder="Ingresar documento de identidad">
                  </div>
                </div>
                <div class="col-lg-3">
                  <label>Tipo:</label>
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
<div class="modal fade bs-example-modal-lg" id="modal_ver_datos_trabajador">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><label>EDITAR DATOS DE : <label id="lb_trabajador3"></label></h4>
        </div>
        <div class="modal-body">
           <div class="box-body">
             <div class="form-group">
                <input type="text" id="txttrabajador3" hidden="true">
                <div class="col-lg-12">
                  <label>Nombre:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-alpha-asc"></i>
                    </div>
                    <input type="text" class="form-control" name="txtnombre"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtnombre" maxlength="150" placeholder="Ingresar nombre del empleado">
                  </div><br>
                </div>
                <div class="col-lg-6">
                  <label>Apellido Paterno:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-alpha-asc"></i>
                    </div>
                    <input type="text" class="form-control" name="txtapepat"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtapepat" maxlength="150" placeholder="Ingresar apellido paterno">
                  </div><br>
                </div>
                <div class="col-lg-6">
                  <label>Apellido Materno:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-alpha-asc"></i>
                    </div>
                    <input type="text" class="form-control" name="txtapemat"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtapemat" maxlength="150" placeholder="Ingresar apellido materno">
                  </div><br>
                </div>
                <div class="col-lg-6">
                  <label><b>Sexo:</b></label>
                  <div class="form-group">
                    <div class="col-lg-6">
                      <label style="font-size: 13px;font-weight: normal;">
                        <input type="radio" name="sex" id="rad_sexo" style="" value="M" class="flat-red sexM" >
                        Masculino
                      </label>
                    </div>
                    <div class="col-lg-6">
                      <label style="font-size: 13px;font-weight: normal;">
                        <input type="radio" name="sex" id="rad_sexo" style="" value="F" class="flat-red sexF" checked>
                        Femenimo
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <label><b>Fecha Nacimiento:</b></label>
                  <div class="form-group">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="txtfecha_nacimiento">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <label>E-mail Principal:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      @
                    </div>
                    <input type="text" class="form-control" name="txtemail" disabled="" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold;" id="txtemail" maxlength="150" placeholder="Ingresar email del empleado">
                  </div><br>
                </div>
                <div class="col-lg-6">
                  <label>Telefono Principal:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-phone"></i>
                    </div>
                    <input type="text" class="form-control" name="txttelefono" disabled="" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold;" id="txttelefono" maxlength="150" placeholder="Ingresar nro telefonico">
                  </div><br>
                </div>
             </div>
           </div>
        </div>
        <div class="modal-footer">
          <button  class="btn btn-danger" onclick="Editar_datos_trabajador()"><i class="fa fa-check"></i>&nbsp;<b>MODIFICAR DATOS</b></button>&nbsp;&nbsp;&nbsp;
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
  $("#txtfecha_nacimiento").datepicker({
    autoclose:true,
    todayHighlight: true,
  });
</script>