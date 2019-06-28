<script type="text/javascript" src="js/console_planilla.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary box-solid">
      <div class="box-header with-border"  style="background-color:#34495E;">
        <h3 class="box-title" style="color:#FFFFFF;"><b>DATOS DEL CONTRATO - PLANILLA</b></h3>
      </div>
      <div class="box-body">
        <div class="col-lg-6">
          <label>A&Ntilde;O:</label>
          <input type="text" id="txt_idempleado" hidden="">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-sort-alpha-asc"></i>
            </div>
            <input type="text" class="form-control" disabled="" style="background-color: white;color:#9B0000; text-align:center;font-size: 16pt;" id="txt_anio" maxlength="150" placeholder="Ingresar anio">
          </div><br>
        </div>
        <div class="col-lg-6">
          <label>MES:</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-sort-alpha-asc"></i>
            </div>
            <input type="text" class="form-control" disabled="" style="background-color: white;color:#9B0000; text-align:center;font-size: 16pt;" id="txt_mes" maxlength="250" placeholder="Ingresar mes">
          </div><br>
        </div>
        <div class="col-lg-12 table-responsive">
          <div style="text-align: center;" ><b>LISTADO DE CONTRATOS DISPONIBLES</b></div><br>
          <div class="input-group">
            <input type="text" class="form-control global_filter" placeholder="Ingresar datos trabajador" id="global_filter">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
          </div>
          <br>
          <div id="div_tabla_planillacontrato_registro"></div>
        </div>
        <div class="col-lg-12"  style="text-align: center;" align="center">
          <button type="button" id="btn_registrar" class="btn btn-danger" onclick="registrar_contrato_planilla()"><b>Registrar Planilla a Trabajadores</b></button><br>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    listar_contratos_planilla_registro();
    function filterGlobal () {
      $('#tabla_planilla_contrato_registro').DataTable().search(
          $('#global_filter').val(),
      ).draw();
    }
    $("#global_filter").keyup(function(){
      $('#tabla_planilla_contrato_registro').DataTable();
      $('input.global_filter').on( 'keyup click', function () {
          filterGlobal();
      } );
      $('input.column_filter').on( 'keyup click', function () {
          filterColumn( $(this).parents('tr').attr('data-column') );
      } );
    });
    document.getElementById("tabla_planilla_contrato_registro_filter").style.display = "none";
    var fecha = new Date();
    var anio = fecha.getFullYear();
    $('#txt_anio').val(anio);
    var month = new Array();
    month[0] = "ENERO";
    month[1] = "FEBRERO";
    month[2] = "MARZO";
    month[3] = "ABRIL";
    month[4] = "MAYO";
    month[5] = "JUNIO";
    month[6] = "JULIO";
    month[7] = "AGOSTO";
    month[8] = "SEPTIEMBRE";
    month[9] = "OCTUBRE";
    month[10] = "NOVIEMBRE";
    month[11] = "DICIEMBRE";

    var d = new Date();
    var mes = month[d.getMonth()];
    $('#txt_mes').val(mes);
    $('.select2').select2();
  });
  $(".fecha").bootstrapMaterialDatePicker
    ({
      time: false,
      clearButton: true,
      lang : 'es',
      format: 'DD-MM-YYYY',

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
</script>