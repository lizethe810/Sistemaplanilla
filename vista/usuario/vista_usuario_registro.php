<script type="text/javascript" src="js/console_usuario.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
    <div class="box box-warning box-solid">
      <div class="box-header with-border"  style="background-color:#ff4111;">
        <h3 class="box-title">CREAR USUARIO - DATOS</h3>
      </div>
      <div class="box-body">
        <div class="form-group">
          <div class="col-lg-9">
              <label style="color:#000000;">DATOS DEL TRABAJADOR:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-user"></i>
                </div>
                <input type="text" hidden="" id="txt_idtrabajador">
              <input type="text" class="form-control" disabled="" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;"  placeholder="Ingresar datos del trabajador" id="txt_datostrabajador">
              </div>
          </div>
          <div class="col-lg-3"><br>
            <button  class="btn btn-success" style="width: 100%" onclick="AbrirModalTrabajador()">&nbsp;<b>TRABAJADORES</b></button>
          </div>
          <div class="col-lg-4">
              <br>
          		<label>USUARIO:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-user"></i>
                </div>
                <input type="text" class="form-control"   style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtusuario" maxlength="15" placeholder="Ingresar usuario">
              </div>
          		<br>
          </div>
          <div class="col-lg-4">
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
          <div class="col-lg-4">
              <br>
              <label>ROL:</label>
              <select class="form-control select2" id="cmb_rol">
                <option value="1">ADMINISTRADOR</option>
                <option value="1">TRABAJADOR</option>
              </select>
              <br>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12" id="div_caracteristica_admin">
    <div class="box box-default box-solid">
      <div class="box-header with-border"  style="background-color:#3c3c3c;">
        <h3 class="box-title" style="color:#FFFFFF;"><b>FECHAS DE AUTORIZACION DEL USUARIO</b></h3>
      </div>
      <div class="box-body">
        <div class="form-group">
          <div class="col-md-6">
              <label>Fecha Inicio</label>
              <div class="form-group">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text"  class="form-control fecha" id="txtfecha_inicio" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold;padding: 0px 12px;">
                </div>
              </div>
          </div>
          <div class="col-md-6">
              <label>Fecha Fin</label>
              <div class="form-group">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text"  class="form-control fecha" id="txtfecha_final" style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold;padding: 0px 12px;">
                </div>
              </div>
          </div>
          <div  class="col-md-12" style="text-align: center;">
            <br>
            <button  class="btn btn-danger" onclick="RegistrarUsuario()">&nbsp;<b>CREAR USUARIO</b></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modal_ver_trabajadores">
  <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><label>TRABAJADORES SIN USUARIO &nbsp;</label></h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="col-lg-12">
                <div class="input-group">
                  <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar documento de identidad a buscar">
                  <span class="input-group-addon"><i class="fa fa-search"></i></span>
                </div>
              </div>
            </div>
          </div>
          <div class="box-body" style="text-align:left;">
            <div class="table-responsive" style="color:#000000;font-size:11px;" >
              <div class="col-md-12">
                <div id="div_tabla_trabajador"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
  </div>
</div>
<script type="text/javascript">
    $('.select2').select2();
  $(".fecha").datepicker({
    autoclose:true,
  }).on('keypress paste', function (e) {
    e.preventDefault();
    return false;
  });
$("#global_filter").keyup(function(){
  var dato_buscar = $("#global_filter").val();
  listar_trabajador(dato_buscar);
});
</script>
