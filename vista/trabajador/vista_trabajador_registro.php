<script type="text/javascript" src="js/console_trabajador.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary box-solid">
      <div class="box-header with-border"  style="background-color:#34495E;">
        <h3 class="box-title" style="color:#FFFFFF;"><b>DATOS TRABAJADOR</b></h3>
      </div>
      <div class="box-body">
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
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="box box-default box-solid" style="border-color: #3c3c3c;">
      <div class="box-header with-border"  style="background-color:#3c3c3c;">
        <h3 class="box-title" style="color:#FFFFFF;"><b>MEDIOS DE COMUNICACIÓN</b></h3>
      </div>
      <div class="box-body">
        <div class="col-lg-8">
          <label>Descripción:</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-sort-alpha-asc"></i>
            </div>
            <input type="text" class="form-control" name="txtrazonsocial"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtrazonsocial" maxlength="150" placeholder="Ingresar descripcion">
          </div><br>
        </div>
        <div class="col-lg-4">
          <label>Tipo:</label>
          <select id="cbm_tipo" style="width: 100%" class="form-control select2">
            <option>Correo</option>
            <option>Telefono</option>
          </select><br>
        </div>
        <div class="col-md-6">
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
        <div class="col-lg-6" style="padding-left: 2px;">
            <label>&nbsp;</label>
            <button type="button" class="btn btn-primary" onclick="agregar_medio_comunicacion()" name="button" style="width:100%;"><i class="fa fa-fw fa-search"></i><b>AGREGAR</b></button><br>
        </div>
        <div class="col-md-12"><br></div>
        <div class="col-md-12 table-responsive" id="div_table_mediocomunicacion">
          <table id="tabla_mediocomunicacion" class="display dataTable" style="width: 100%;">
            <thead >
              <tr role="row" class="odd">
                <th style="text-align: left;width: 300px;word-wrap: break-word;">MEDIO COMUNICACIÓN</th>
                <th style="text-align: left;width: 100px;word-wrap: break-word;">TIPO</th>
                <th style="text-align: center;width: 100px;word-wrap: break-word;">NIVEL</th>
                <th style="text-align: center;width: 50px;word-wrap: break-word;"></th>
              </tr>
            </thead>
            <tbody id="tbody_tabla_medio_comunicacion"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="box box-default box-solid" style="border-color: #3c3c3c;">
      <div class="box-header with-border"  style="background-color:#3c3c3c;">
        <h3 class="box-title" style="color:#FFFFFF;"><b>DOCUMENTOS DE IDENTIDAD</b></h3>
      </div>
      <div class="box-body">
        <div class="form-group">
          <div class="col-lg-8">
            <label>Descripción:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-sort-alpha-asc"></i>
              </div>
              <input type="text" class="form-control" name="txtdni"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtdni" maxlength="150" placeholder="Ingresar documento de identidad">
            </div>
          </div>
          <div class="col-lg-4">
            <label>Tipo:</label>
            <select id="cbm_tipo_documento" style="width: 100%" class="form-control select2">
              <option>DNI</option>
              <option>PASAPORTE</option>
              <option>RUC</option>
            </select>
          </div>
          <div class="col-lg-12" style="">
            <label>&nbsp;</label>
            <button type="button" class="btn btn-primary" onclick="agregar_documento_identidad()" name="button" style="width:100%;"><i class="fa fa-fw fa-search"></i><b>AGREGAR</b></button><br><br>
          </div>
          <div class="col-md-12 table-responsive">
            <table id="tabla_documentoidentidad" class="display dataTable" style="width: 100%;">
              <thead >
                <tr role="row" class="odd">
                  <th style="text-align: left;width: 300px;word-wrap: break-word;">DOCUMENTO IDENTIDAD</th>
                  <th style="text-align: center;width: 100px;word-wrap: break-word;">TIPO</th>
                  <th style="text-align: center;width: 50px;word-wrap: break-word;"></th>
                </tr>
              </thead>
              <tbody id="tbody_tabla_documentoidentidad"></tbody>
            </table>
          </div>
       </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12" style="text-align:center;">
    <br>
    <button type="button" id="btn_registrar" style="font-size: 18px" class="btn btn-danger" onclick="Registrar_trabajador()"><b>Registrar Trabajador</b></button><br><br>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2();
    $("#txtnombre").focus();
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