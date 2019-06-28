<script type="text/javascript" src="js/console_planilla.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary box-solid">
      <div class="box-header with-border"  style="background-color:#34495E;">
        <h3 class="box-title">BUSCAR PLANILLA</h3>
      </div>
      <div class="box-body">
        <div class="form-group">
          <div class="col-md-4" >
            <label>A&Ntilde;O</label>
            <select id="combo_anio" style="text-align: center;width: 100%" class="form-control select2">
              <option >2019</option>
              <option >2020</option>
              <option >2021</option>
              <option >2022</option>
              <option >2023</option>
              <option >2024</option>
              <option >2025</option>
              <option >2025</option>
              <option >2026</option>
              <option >2027</option>
              <option >2028</option>
              <option >2029</option>
              <option >2030</option>
              <option >2031</option>
              <option >2032</option>
              <option >2033</option>
              <option >2034</option>
              <option >2035</option>
              <option >2035</option>
              <option >2036</option>
              <option >2037</option>
              <option >2038</option>
              <option >2039</option>
              <option >2040</option>
            </select>
            <br>
          </div>
          <div class="col-md-4">
            <label>MES</label> 
            <select id="combo_mes" style="text-align: center;width: 100%" class="form-control select2">
              <option value="%">TODOS</option>
              <option value="ENERO">ENERO</option>
              <option value="FEBRERO">FEBRERO</option>
              <option value="MARZO">MARZO</option>
              <option value="ABRIL">ABRIL</option>
              <option value="MAYO">MAYO</option>
              <option value="JUNIO">JUNIO</option>
              <option value="JULIO">JULIO</option>
              <option value="AGOSTO">AGOSTO</option>
              <option value="SEPTIEMBRE">SEPTIEMBRE</option>
              <option value="OCTUBRE">OCTUBRE</option>
              <option value="NOVIEMBRE">NOVIEMBRE</option>
              <option value="DICIEMBRE">DICIEMBRE</option>
            </select>
            <br>
          </div>
          <div class="col-lg-2">
            <label>&nbsp;</label> 
            <button class="btn btn-success  btn-success" style="width:100%;" onclick="listar_contratos_planilla();"><span class="fa fa-search"></span><b>&nbsp;Buscar</b></button>
          </div>
          <div class="col-lg-2">
            <label>&nbsp;</label> 
            <button class="btn btn-success  btn-danger" style="width:100%;" onclick="cargar_contenido('contenido_principal','Planilla/vista_planilla_registro.php')"><span class="glyphicon glyphicon-plus"></span><b>&nbsp;Nuevo Registro</b></button>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-primary box-solid">
      <div class="box-header with-border"  style="background-color:#34495E;">
        <h3 class="box-title">LISTADO DE CONTRATOS - PLANILLA</h3>
      </div>
      <div class="box-body" style="text-align:left;">
        <div class="table-responsive" style="color:#000000;font-size:13px;" >
          <div class="col-md-12"><br>
            <div style="text-align: center;" ><b>LISTADO DE CONTRATOS</b></div><br>
            <label>Buscar:</label>
            <div class="input-group">
              <input type="text" class="form-control global_filter" placeholder="Ingresar datos trabajador" id="global_filter">
              <span class="input-group-addon"><i class="fa fa-search"></i></span>
            </div><br>
            <div id="div_tabla_planillacontrato"></div>
          </div>
        </div>
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
         <h4 class="modal-title"><label>VER CONCEPTOS FIJOS DE : <label id="lb_trabajador1"></label></h4>
        </div>
        <div class="modal-body">
           <div class="box-body">
             <div class="form-group">
                <input type="text" id="txtcontrato1" hidden="true">
                <div class="col-md-12 table-responsive">
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
<div class="modal fade bs-example-modal-lg" id="modal_ver_conceptos_variables">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><label>EDITAR CONCEPTOS FIJOS VARIABLES DE : <label id="lb_trabajador2"></label></h4>
        </div>
        <div class="modal-body">
           <div class="box-body" style="overflow:auto;height:470px;width:auto;">
             <div class="form-group">
                <input type="text" id="txtidpagoplanilla" hidden="true">
                <div class="col-lg-6">
                  <label>Tipo de Conceptos Variables:</label>
                  <select id="cbm_tipo_conceptos" name="cbm_tipo_conceptos" style="width: 100%" class="form-control select2">
                  </select>
                </div>
                <div class="col-lg-6">
                  <label>Monto:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon glyphicon-usd"></i>
                    </div>
                    <input class="form-control"  type="text" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold;" id="txtmonto" onkeypress="return filterFloat(event,this);" >
                  </div>
                  <br>
                </div> 
                <div class="col-lg-12">
                  <label>Descripci&oacute;n:</label>
                  <textarea class='form-control'  rows='1' maxlength="30" style='resize: none' id='text_argumento'></textarea>
                </div>
                <div class="col-lg-12">
                  <label>&nbsp;</label>
                  <button type="button" id="btn_registrar_conceptovariable" class="btn btn-success" onclick="registrar_concepto_variable()"  style="width:100%;"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;<b>APLICAR</b></button><br>
                </div>
                <div class="col-md-12 table-responsive">
                  <div id="div_tabla_concepto_variable"></div>
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
  listar_contratos_planilla();
  $('.select2').select2();
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-orange'
  })
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
  function filterGlobal () {
      $('#tabla_planilla_contrato_principal').DataTable().search(
          $('#global_filter').val(),
      ).draw();
    }
    $("#global_filter").keyup(function(){
      $('#tabla_planilla_contrato_principal').DataTable();
      $('input.global_filter').on( 'keyup click', function () {
          filterGlobal();
      } );
      $('input.column_filter').on( 'keyup click', function () {
          filterColumn( $(this).parents('tr').attr('data-column') );
      } );
    });
    document.getElementById("tabla_planilla_contrato_principal_filter").style.display = "none";
</script>