<script type="text/javascript" src="js/console_contrato.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary box-solid">
      <div class="box-header with-border"  style="background-color:#34495E;">
        <h3 class="box-title" style="color:#FFFFFF;"><b>DATOS DEL CONTRATO</b></h3>
      </div>
      <div class="box-body">
        <div class="col-lg-4">
          <label>Nombre:</label>
          <input type="text" id="txt_idempleado" hidden="">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-sort-alpha-asc"></i>
            </div>
            <input type="text" class="form-control" disabled="" style="background-color: #FFFFFF" name="txtnombre"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtnombre" maxlength="150" placeholder="Ingresar nombre del empleado">
          </div><br>
        </div>
        <div class="col-lg-4">
          <label>Apellidos:</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-sort-alpha-asc"></i>
            </div>
            <input type="text" class="form-control" name="txtapellidos" disabled="" style="background-color: #FFFFFF" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtapellidos" maxlength="250" placeholder="Ingresar apellidos del empleado">
          </div><br>
        </div>
        <div class="col-lg-4">
          <label>&nbsp;</label>
          <button type="button"  class="btn btn-danger" onclick="buscar_trabajador()" name="button" style="width:100%;"><i class="fa fa-fw fa-search"></i><b>BUSCAR PERSONAL</b></button><br>
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
          <input type="text" id="txtsueldo_contrato"  onkeypress="return filterFloat(event)" class="form-control">
        </div>
        <div class="col-lg-6"><br>
          <label><b>Estado:</b></label>
          <input type="text" id="txtestado" value="ACTIVO" class="form-control" disabled style="background-color: white;color:#9B0000; text-align:center;font-size: 16pt;">
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="box box-default box-solid" style="border-color: #3c3c3c;">
      <div class="box-header with-border"  style="background-color:#3c3c3c;">
        <h3 class="box-title" style="color:#FFFFFF;"><b>ASIGNACI&Oacute;N DE CONCEPTOS FIJOS</b></h3>
      </div>
      <div class="box-body">
        <div class="col-lg-6">
          <label>Tipo de Conceptos Fijos:</label>
          <select id="cbm_tipo_conceptos" name="cbm_tipo_conceptos" style="width: 100%" class="form-control select2">
          </select>
        </div>
        <div class="col-lg-6" style="padding-left: 2px;">
          <label>&nbsp;</label>
          <button type="button" class="btn btn-success" onclick="agregar_concepto_fijo()" name="button" style="width:100%;"><i class="fa fa-fw fa-search"></i><b>AGREGAR</b></button><br>
        </div>
        <div class="col-md-12"><br></div>
        <div class="col-md-12 table-responsive" id="div_table_concepto_fijo">
          <table id="tabla_concepto_fijo" class="display dataTable" style="width: 100%;">
            <thead >
              <tr role="row" class="odd">
                <th style="text-align: left;width: 200px;word-wrap: break-word;">CONCEPTO FIJO</th>
                <th style="text-align: center;width: 100px;word-wrap: break-word;">PORCENTAJE</th>
                <th style="text-align: center;width: 100px;word-wrap: break-word;"></th>
              </tr>
            </thead>
            <tbody id="tbody_tabla_concepto_fijo"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12" style="text-align:center;">
    <br>
    <button type="button" id="btn_registrar" style="font-size: 18px" class="btn btn-danger" onclick="Registrar_Contrato()"><b>Registrar Contrato</b></button><br><br>
  </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modal_ver_datos_contrato">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><label>LISTADO DE TRABAJADORES SIN UN CONTRATO VIGENTE</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="col-lg-12">
               <label>Buscar:</label>  
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Buscar por apellido - nombres - documentos de identidad" id="txtbuscar">
                  <span class="input-group-addon"><i class="fa fa-search"></i></span>
                </div>
              </div>
            </div>
            <div class="table-responsive col-md-12"><br>
              <div id="div_tabla_trabajador"></div>
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
  $("#txtbuscar").keyup(function(){
  var dato_buscar = $("#txtbuscar").val();
  listar_trabajador_contrato(dato_buscar);
});
  $(document).ready(function() {
    listar_combo_tipo_conceptosFijos();
    listar_area();
    listar_tipo_contrato();
    listar_seguro();
    listar_cargo();
    $('.select2').select2();
    $("#txtfecha_inicio").focus();
  });
    $(".fecha").datepicker({
      autoclose:true,
      todayHighlight: true,
  }).on('keypress paste', function (e) {
    e.preventDefault();
    return false;
  });
  function filterFloat(evt,input){
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {
              return true;
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{
                    return true;
                }
          }else{
              return false;
          }
    }
  }
  function filter(__val__){
      var preg = /^([0-9]+\.?[0-9]{0,2})$/;
      if(preg.test(__val__) === true){
          return true;
      }else{
         return false;
      }
  }
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-orange'
  })
  $("#txtfecha_nacimiento").datepicker({
    autoclose:true,
    todayHighlight: true,
  });
</script>