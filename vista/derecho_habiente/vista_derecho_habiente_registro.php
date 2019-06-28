<script type="text/javascript" src="js/console_derechohabiente.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
    <div class="box box-primary box-solid">
      <div class="box-header with-border"  style="background-color:#34495E;">
        <h3 class="box-title" style="color:#FFFFFF;"><b>DATOS DEL TRABAJADOR</b></h3>
      </div>
      <div class="box-body">
        <div class="col-lg-8">
          <label>Trabajador:</label>
          <input type="text" id="txtidtrabajador" hidden="">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-sort-alpha-asc"></i>
            </div>
            <input type="text" class="form-control" disabled="" style="background-color: #FFFFFF" name="txtnombre"  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtnombre" maxlength="150" placeholder="Ingresar nombre del trabajador">
          </div><br>
        </div>
        <div class="col-lg-4">
          <label>&nbsp;</label>
          <button type="button"  class="btn btn-danger" onclick="buscar_trabajador()" name="button" style="width:100%;"><i class="fa fa-fw fa-search"></i><b>BUSCAR TRABAJADOR</b></button><br>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="box box-default box-solid" style="border-color: #3c3c3c;">
      <div class="box-header with-border"  style="background-color:#3c3c3c;">
        <h3 class="box-title" style="color:#FFFFFF;"><b>ASIGNACI&Oacute;N DE FAMILIARES</b></h3>
      </div>
      <div class="box-body">
        <div class="col-lg-4">
          <label>Familiar:</label>
          <input type="text" id="txtidfamiliar" hidden="">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-sort-alpha-asc"></i>
            </div>
            <input type="text" class="form-control" disabled="" style="background-color: #FFFFFF" name=""  style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtnombrefamiliar" maxlength="150" placeholder="Ingresar nombre del familiar">
          </div><br>
        </div>
        <div class="col-lg-4">
          <label>Parentesco:</label>
          <select id="cbm_parentesco"  style="width: 100%" class="js-example-basic-single">
            <option value="">Seleccionar:</option>         
            <option value="Madre">Madre</option>
            <option value="Padre">Padre</option>
            <option value="Hermano">Hermano(a)</option>
            <option value="Primo">Primo(a)</option>
            <option value="Hijo">Hijo(a)</option>        
            <option value="Esposo">Esposo(a)</option>               
          </select>
        </div>
        <div class="col-lg-4" style="padding-left: 2px;">
          <label>&nbsp;</label>
          <button type="button" class="btn btn-success" onclick="buscar_familiar()" name="button" style="width:100%;"><i class="fa fa-fw fa-search"></i><b>BUSCAR FAMILIAR</b></button><br>
        </div>
        <div class="col-md-12" style="text-align:center;"><br>
        </div>
        <div class="col-md-12 table-responsive" id="div_asignar_familiar" style="text-align:center;display:none;">
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12" style="text-align:center;">
    <br>
    <button type="button" id="btn_registrar" style="font-size: 18px" class="btn btn-danger" onclick="Registrar_DerechoHabiente()"><b>Agregar Familiar</b></button><br><br>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal_listar_trabajadores">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><label>LISTADO DE TRABAJADORES</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="col-lg-12">
                <label>Buscar:</label>  
                <div class="input-group">
                    <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                  </div>
              </div>
            </div>
            <div class="table-responsive col-md-12" id="div_tabla_trabajador" style="text-align:center;"><br>
   
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success pull-right" data-dismiss="modal"><i class="fa fa-close"></i><b> CLOSE</b></button>
        </div>
     </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal_listar_familiares">
  <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
        <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title"><label>LISTADO DE TRABAJADORES</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="col-lg-12">
                <label>Buscar:</label>  
                <div class="input-group">
                    <input type="text" class="form-control" id="txtbuscar" placeholder="Busquedad por familiar o nro documento">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                  </div>
              </div>
            </div>
            <div class="table-responsive col-md-12"  style="text-align:center;" id="div_tabla_familiar"><br>
   
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
function filterGlobal () {
    $('#tabla_trabajadores').DataTable().search(
        $('#global_filter').val(),
    ).draw(); 
}

$(document).ready(function() {
  $('.js-example-basic-single').select2();
    $('#tabla_trabajadores').DataTable();
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );

    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    } );
} );
$("#txtbuscar").keyup(function(){
  var dato_buscar = $("#txtbuscar").val();
  listar_familiar(dato_buscar);
});
</script>