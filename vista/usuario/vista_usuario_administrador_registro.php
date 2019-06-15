<script type="text/javascript" src="js/console_usuario.js?rev=<?php echo time();?>"></script>
<div class="row">
  <div class="col-lg-12">
            <div class="box box-warning box-solid">
              <div class="box-header with-border"  style="background-color:#ff4111;">
                <h3 class="box-title">CREAR USUARIO ADMINISTRADOR</h3>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                      <div class="col-lg-6">
                          <label style="color:#000000;">DEPARTAMENTO:</label>
                          <select class="js-example-basic-single" name="state" id="combo_departamento" style="width:100%;height:50px;">
                          </select>
                      </div>
                      <div class="col-lg-6">
                      		<label>NOMBRE:</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-sort-alpha-asc"></i>
                            </div>
                            <input type="text" class="form-control"   style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtnombre" maxlength="100" placeholder="Ingresar nombre">
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <br>
                      		<label>USUARIO:</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="glyphicon glyphicon-user"></i>
                            </div>
                            <input type="text" class="form-control"   style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtusuario" maxlength="15" placeholder="Ingresar usuario">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <br>
                      		<label>CORREO:</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="">@</i>
                            </div>
                            <input type="text" class="form-control"   style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtcorreo" maxlength="100" placeholder="Ingresar correo">
                          </div>
                      		<br>
                      </div>
                      <div class="col-lg-6">
                      		<label>CONTRASEÑA:</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-unlock-alt"></i>
                            </div>
                            <input type="password" class="form-control"   style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtcontra1" maxlength="15" placeholder="Ingresar contraseña">
                          </div>
                      		<br>
                      </div>
                      <div class="col-lg-6">
                      		<label>CONFIRMAR CONTRASEÑA:</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-unlock-alt"></i>
                            </div>
                            <input type="password" class="form-control"   style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;" id="txtcontra2" maxlength="15" placeholder="Ingresar contraseña">
                          </div>
                      		<br>
                      </div>
                      <div class="col-lg-12">
                      		<label>OBSERVACIONES:</label>
                          <textarea class="form-control" rows="2" placeholder="INGRESAR OBSERVACIONES" id="txtobservacion" maxlength="250"></textarea>
                      </div>
                  </div>
                  <div class="col-lg-12" style="text-align:center;">
                      		<label>PERMISOS DE ACCESO</label><br><br>
                  </div>
                  <div class="col-lg-4">
                    <label>FORMULARIOS:</label>
                    <input type="checkbox" id="formulario"><br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>IMPRIMIR:</label>
                    <input type="checkbox" id="formulario">
                  </div>
                  <div class="col-lg-4">
                    <label>TRACKING:</label>
                    <input type="checkbox" id="formulario"><br><br>
                    <label>USUARIOS:</label>
                    <input type="checkbox" id="formulario">
                  </div>
                  <div class="col-lg-4">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>REPORTES:</label>
                    <input type="checkbox" id="formulario"><br><br>
                    <label>MANTENIMIENTO:</label>
                    <input type="checkbox" id="formulario">
                  </div>
                  <div  class="col-md-12" style="text-align: center;">
                   	<br>
                    <button onclick="VerificarExistenciaDeUsuarioEmpresaAdmin()" class="btn btn-danger">&nbsp;<b>CREAR USUARIO</b></button>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
  </div>
</div>
<script type="text/javascript">
combo_listar_empresa();
combo_listar_departamento();
$(document).ready(function() {
  $('.js-example-basic-single').select2();
  $("#txtnombre").focus();
  $(':checkbox').checkboxpicker();
});
</script>
