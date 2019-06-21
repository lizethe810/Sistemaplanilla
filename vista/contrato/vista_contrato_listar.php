<script type="text/javascript" src="js/console_contrato.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary box-solid">
      <div class="box-header with-border"  style="background-color:#34495E;">
        <h3 class="box-title">BUSCAR CONTRATOS</h3>
      </div>
      <div class="box-body">
        <div class="form-group">
          <div class="col-lg-4">
            <label><b>Fecha Inicio:</b></label>
            <div class="form-group">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right fecha" id="txt_fechainicio">
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <label><b>Fecha Fin:</b></label>
            <div class="form-group">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right fecha" id="txt_fechafinal">
              </div>
            </div>
          </div>
          <div class="col-lg-2">
            <label>&nbsp;</label> 
            <button class="btn btn-success  btn-success" style="width:100%;" onclick="listar_contratos();"><span class="fa fa-search"></span><b>&nbsp;Buscar</b></button>
          </div>
          <div class="col-lg-2">
            <label>&nbsp;</label> 
            <button class="btn btn-success  btn-danger" style="width:100%;" onclick="cargar_contenido('contenido_principal','contrato/vista_contrato_registro.php')"><span class="glyphicon glyphicon-plus"></span><b>&nbsp;Nuevo Registro</b></button>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-primary box-solid">
      <div class="box-header with-border"  style="background-color:#34495E;">
        <h3 class="box-title">LISTADO DE CONTRATOS</h3>
      </div>
      <div class="box-body" style="text-align:left;">
        <div class="table-responsive" style="color:#000000;font-size:13px;" >
          <div class="col-md-12">
            <div id="div_tabla_contrato"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#modal_editar').on('shown.bs.modal', function () {
  $('#txtcontra1').focus()
})
</script>
<div class="modal fade bs-example-modal-lg" id="modal_ver_terminos">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><label>T&Eacute;RMINOS DEL CONTRATO DE : <label id="lb_trabajador1"></label></h4>
        </div>
        <div class="modal-body">
           <div class="box-body">
             <div class="form-group">
                <div class="col-lg-12">
                  <textarea class='form-control' disabled="" rows='5' style='resize: none' id='text_termino_ver'></textarea>
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
<div class="modal fade bs-example-modal-lg" id="modal_ver_conceptos_fijos">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><label>EDITAR CONCEPTOS FIJOS DE : <label id="lb_trabajador2"></label></h4>
        </div>
        <div class="modal-body">
           <div class="box-body">
             <div class="form-group">
                <input type="text" id="txtcontrato2" hidden="true">
                <input type="text" id="txtsueldo" hidden="true" >
                <div class="col-lg-6">
                  <label>Tipo de Conceptos Fijos:</label>
                  <select id="cbm_tipo_conceptos" name="cbm_tipo_conceptos" style="width: 100%" class="form-control select2">
                  </select>
                </div>
                 <div class="col-lg-6" style="padding-left: 2px;">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-primary" onclick="registrar_concepto_fijo()" name="button" style="width:100%;"><i class="fa fa-fw fa-search"></i><b>REGISTRAR</b></button><br>
                 </div>
                <div class="col-md-12 table-responsive"><br>
                  <div id="div_tabla_concepto_fijo"></div>
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
<div class="modal fade bs-example-modal-lg" id="modal_ver_datos_contrato">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><label>EDITAR CONTRATO DE : <label id="lb_trabajador3"></label></h4>
        </div>
        <div class="modal-body">
          <div class="box-body"  style="overflow:auto;height:470px;width:auto;">
            <div class="form-group">
                <input type="text" id="txtcontrato3" hidden="true">
                <div class="col-lg-12">
                  <label>Datos Trabajador:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-alpha-asc"></i>
                    </div>
                    <input type="text" class="form-control" disabled="" name="txtdatostrabajador"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtdatostrabajador" maxlength="150" placeholder="Ingresar nombre del empleado">
                  </div><br>
                </div>
                <div class="col-lg-6">
                  <label><b>Inicio Contrato:</b></label>
                  <div class="form-group">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right fecha" id="txtfecha_inicio">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <label><b>Fin Contrato:</b></label>
                  <div class="form-group">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right fecha" id="txtfecha_fin">
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <label>T&eacute;rminos:</label>
                  <textarea class='form-control'  rows='1' maxlength="350" style='resize: none' id='text_termino'></textarea>
                </div>
                <div class="col-lg-6"><br>
                  <label><b>Tipo Contrato:</b></label>
                  <select class="form-control select2" style="width: 100%" id="cbm_tipo_contrato"></select><br>
                </div>
                <div class="col-lg-6"><br>
                  <label><b>&Aacute;rea:</b></label>
                  <select class="form-control select2" style="width: 100%" id="cbm_area"></select><br>
                </div>
                <div class="col-lg-6"><br>
                  <label><b>Seguro:</b></label>
                  <select class="form-control select2" style="width: 100%" id="cbm_seguro"></select><br>
                </div>
                <div class="col-lg-6"><br>
                  <label><b>Cargo:</b></label>
                  <select class="form-control select2" style="width: 100%" id="cbm_cargo"></select><br>
                </div>
                <div class="col-lg-6"><br>
                  <label><b>Sueldo:</b></label>
                  <input type="text" id="txtsueldo_contrato" class="form-control" disabled style="background-color: white;color:#9B0000; text-align:center;font-size: 16pt;">
                </div>
                <div class="col-lg-6"><br>
                  <label><b>Estado:</b></label>
                  <select class="form-control select2" style="width: 100%" id="cbm_estado">
                    <option value="Activo">Activo</option>
                    <option value="Anulado">Anulado</option>
                  </select><br>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" onclick="Editar_dato_contrato()"><i class="fa fa-check"></i>&nbsp;<b>MODIFICAR DATOS</b></button>&nbsp;&nbsp;&nbsp;
          <button type="button" class="btn btn-success pull-right" data-dismiss="modal"><i class="fa fa-close"></i><b> CLOSE</b></button>
        </div>
     </div>
  </div>
</div>
<script type="text/javascript">
  listar_contratos();
  listar_area();
  listar_tipo_contrato();
  listar_seguro();
  listar_cargo();
  $('.select2').select2();
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-orange'
  })
  $(".fecha").datepicker({
      autoclose:true,
      todayHighlight: true,
  }).on('keypress paste', function (e) {
    e.preventDefault();
    return false;
  });
</script>