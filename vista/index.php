<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {
    header('Location: ../Login/index.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  <title>SISTEMA PLANILLA</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="Plantilla/img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="Plantilla/boostrap/bootstrap/dist/css/bootstrap.min.css?rev=<?php echo time();?>">
  <link rel="stylesheet" href="Plantilla/boostrap/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="Plantilla/boostrap/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="Plantilla/boostrap/dist/css/AdminLTE.min.css?rev=<?php echo time();?>">
  <link rel="stylesheet" href="Plantilla/boostrap/dist/css/skins/_all-skins.min.css">
  <link href="Plantilla/complemento-propio/customs.css" rel="stylesheet">
  <link rel="stylesheet" href="Plantilla/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="Plantilla/boostrap/tipo-letra/letra.css">
  <link rel="stylesheet" type="text/css" href="Plantilla/componentes/js/sweetalert.css">
  <link type="text/css" rel="stylesheet" href="Plantilla/input-file/css/disenio_input_2.css">
  <link rel="stylesheet" href="Plantilla/boostrap/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <link rel="stylesheet" href="Plantilla/timepicker/bootstrap-timepicker.min.css?rev=<?php echo time();?>">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script src="../plugins/bootstrap-checkbox-1.5.0/dist/js/bootstrap-checkbox.js" defer></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
  <style type="text/css">
    .sidebar-mini.sidebar-collapse .main-header .logo {
    }
    .sidebar-mini.sidebar-collapse .main-header .navbar {
    }
  </style>

<body> 


</head>
<body class="sidebar-mini fixed sidebar-mini-expand-feature skin-purple" style="height: 100%;">
<!-- Site wrapper -->
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="index.php" class="logo" style="height: 54px;">
        <!-- mini logo for sidebar mini 50x50 pixels -->

          <b>SIS PLANILLA</b>
        <!-- logo for regular state and mobile devices -->
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <input type="text" value="<?php echo $_SESSION['iduser']; ?>"  id="txtcodigo_principal_usuario" hidden>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!--<img src="Plantilla/boostrap/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->

                <img class="user-image" style="float: left;"  src="Plantilla/img/admin.png" alt="...">

                <span class="hidden-xs"><strong>USUARIO: </strong><?php echo $_SESSION['usuario'] ?></span>
                 <input type="text" id="txt_nomusuario" hidden value="<?= $_SESSION['usuario'] ?>">
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header" style="height: 100%">
                  <div id="txtimagen" >
                  </div>
                  <p style="margin-top: -5px;">
                    <label id="txtnombre_usuario1"></label><br>
                    <strong><?php echo $_SESSION['rol'] ?><br></strong>
                  </p>
                </li>
                <!-- Menu Body -->
                
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="javascript:abrirmodaladministrativo()" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div style="float:left!important;padding-left:41px;text-align: center;">
                    <a href="javascript:abrirModalusuario()"  class="btn btn-default btn-flat">Cuenta</a>
                  </div>
                  <div class="pull-right">
                    <a href="../controlador/usuario/controlador_cerrar_sesion.php" class="btn btn-default btn-flat">Salir</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar" style="display:none"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="height: 60px;">
          <div class="pull-left image">
            <img  class="img-circle" style="width: 100%;max-width: 45px;height: auto;" src="Plantilla/img/admin.png" alt="...">
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['rol'] ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
          <br>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <?php
            if ($_SESSION['rol'] == 'ADMINISTRADOR') {
            ?>
            <li class="treeview">
              <a href="#">
                <i class="fa  fa-users"></i> <span>REGISTRO DE USUARIO</span>
                <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul  class="treeview-menu">
                <li><a href="#" onclick="cargar_contenido('contenido_principal','usuario/vista_usuario_registro.php')"><i class="fa fa-caret-right"></i>Creaci&oacute;n usuario</a></li>              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gears"></i> <span>LISTADO DE USUARIO</span>
                <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul  class="treeview-menu">
                <li><a href="#" onclick="cargar_contenido('contenido_principal','usuario/vista_usuario_listar.php')"><i class="fa fa-caret-right"></i>Usuarios registrados</a></li>
                </li>
              </ul>
            </li>
             <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-list-alt"></i> <span>MATENIMIENTO</span>
                <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul  class="treeview-menu">
                <li><a href="#" onclick="cargar_contenido('contenido_principal','trabajador/vista_trabajador_listar.php')"><i class="fa fa-chevron-circle-right"></i>TRABAJADORES</a>            
                <li><a href="#" onclick="cargar_contenido('contenido_principal','cargo/vista_cargo_listar.php')"><i class="fa fa-chevron-circle-right"></i>CARGO</a></li>
                <li><a href="#" onclick="cargar_contenido('contenido_principal','seguro/vista_seguro_listar.php')"><i class="fa fa-chevron-circle-right"></i>SEGURO</a></li>
               </ul>
            </li>           
            <?php
            }
            if ($_SESSION['rol'] == 'TRABAJADOR') {
            ?>
           
            <?php
            }
            ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <input type="text" value="<?php echo $_SESSION['tipo_usuario']; ?>" hidden id="txttipo_usuario_principal">
      <input type="text" value="<?php echo $_SESSION['usuario']; ?>" hidden id="txtnombre_principal_usuario">
      <input type="text" value="<?php echo $_SESSION['iduser']; ?>" hidden id="txtidusuario_principal_usuario">
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
          <div id="contenido_principal">

            <div class="box">
                <div class="box-header with-border">
                  <table width="100%">
                    <tr>
                      <td style="text-align: justified;font-family:calibri;">
                        <h2> <b> Bienvenido</b> </h2>
                        
                      </td>
                    </tr>

                  </table>
                </div>
            </div>
            <!-- /.box -->
 
          </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        - <b> Resolución MTC : 035-2019-mtc/27 </b> -
      </div>
      <strong> ® Todos los derechos reservados <?php echo date("Y");  ?> - <label> - Versión 3.00 </label> </strong>
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
       <!-- <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>-->
              <li><a href='#control-sidebar-theme-demo-options-tab' data-toggle='tab'><i class="fa fa-wrench"></i></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane" id="control-sidebar-home-tab">
        </div>
      </div>
    </aside>

    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <script src="Plantilla/boostrap/jquery/dist/jquery.min.js"></script>
  <script src="Plantilla/boostrap/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="Plantilla/boostrap/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="Plantilla/boostrap/fastclick/lib/fastclick.js"></script>
  <script src="Plantilla/boostrap/dist/js/adminlte.min.js"></script>
  <script src="Plantilla/boostrap/dist/js/demo.js"></script>

  <script type="text/javascript" src="Plantilla/componentes/js/sweetalert.min.js"></script>
  <script src="Plantilla/input-file/js/bootstrap-uploader/file-upload.js"></script>
  <script src="Plantilla/boostrap/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="../plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>

<div class="modal fade bs-example-modal-lg" id="modal_cuenta"  style="padding:50px 0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="mimodal_registrar"><label>Configuraci&oacute;n de la Cuenta</label></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="formulario_usuario">
              <div class="box-body">
                <div class="" id="msj_persona">
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Tipo Usuario</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" style="background:#fff;font-weight:bold;" value="<?php echo $_SESSION['rol'] ?>" disabled="" id="tipo_usuario" placeholder="Tipo Usuario" maxlength="40">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Usuario</label>
                  <div class="col-sm-5">
                    <input type="text" id="txtoriginal" value="" hidden='true'>
                    <input type="text"  style="background:#fff;font-weight:bold;" id="txtusuario" class="form-control" value="<?php echo $_SESSION['usuario'] ?>" disabled=""  placeholder="Usuario" maxlength="30">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"> Actual</label>
                  <div class="col-sm-5">
                    <input type="password" class="form-control"  id="txtactual" placeholder="Clave Actual" maxlength="30">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Nueva </label>
                  <div class="col-sm-5">
                    <input type="password" class="form-control"  id="txtnueva" placeholder="Nueva Clave" maxlength="30">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Repetir Contraseña Nueva</label>
                  <div class="col-sm-5">
                    <input type="password" class="form-control" id="txtrepetir" placeholder="repetir Clave nueva" maxlength="30">
                  </div>
                  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <button type="button" style="cursor:pointer;" onclick="Editar_cuenta();" class="btn btn-success"><b>Actualizar </b>&nbsp;&nbsp; <i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> </button>
              </div>
              <!-- /.box-footer -->
            </form>  
        </div>
        <div class="modal-footer">
          <div class="form-group">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><b> Cerrar</b></button>
           
          </div>
        </div>
      </div>
    </div>
</div>
<script>
  $(document).ready(function () {
        $('[data-mask]').inputmask()
  })
</script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<script type="text/javascript">
    function cargar_contenido(contenedor,contenido){
      $("#"+contenedor).load(contenido);

    }
</script>

<style type="text/css">
    button{
    font-weight:bold;

    }
    select{
       font-weight:bold;
      text-align-last:center;
    }
   /* .select2-container--default.select2-container--disabled .select2-selection--single{
       color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;
    }*/
    .modal-open .select2-container--open { z-index: 999999 !important; width:100% !important; }
</style>
<script type="text/javascript" src="js/console_usuario.js?rev=<?php echo time();?>"></script>
<div class="modal fade bs-example-modal-lg" id="modal_ver_imagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <div class="kv-zoom-actions pull-right"><button type="button" class="btn btn-default btn-close" title="Close detailed preview" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button></div>
      <h3 class="modal-title">Fotograf&iacute;a<small><span class="kv-zoom-title"></span></small></h3>
    </div>
    <div class="modal-body">
        <div class="floating-buttons"></div>
        <div class="kv-zoom-body file-zoom-content" style="text-align:center; ">
          <div  id="id_imagen" ></div>
        </div>
    </div>
  </div>
 </div>
</div>
<script>
    $(function () {
        $('.select2').select2();
    })
</script>
</body>

<script>
  traer_administrador();
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
    function soloNumeros(e){
        tecla = (document.all) ? e.keyCode : e.which;

        //Tecla de retroceso para borrar, siempre la permite
        if (tecla==8){
            return true;
        }

        // Patron de entrada, en este caso solo acepta numeros
        patron =/[0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }
    $(document).on('submit', '#update-form-administrador', function() {
               //Obtenemos datos.
                var data = $(this).serialize();
                $.ajax({
                    type : 'POST',
                    mimeType: "multipart/form-data",
                    url  : '../controlador/ciudadano/controlador_editar_administrativo.php',
                    data:  new FormData(this),
                    contentType: false,
                          cache: false,
                    processData:false,
                    success:function(resp) {
                      $("#modal_editar_adminsitrador").modal('hide');
                      traer_administrador();
                      document.getElementById("update-form-administrador").reset();
                      if(resp>0){
                          swal("Datos Actualizados","","success")
                          .then ( ( value ) =>  {
                              document.getElementById("update-form-administrador").reset();
                              traer_administrador();
                            } ) ;
                      }else{
                          swal("Lo sentimos los datos no fueron registrados","","error")
                          .then ( ( value ) =>  {
                             document.getElementById("update-form-administrador").reset();
                             traer_administrador();
                          } ) ;
                      }
                      traer_administrador();
                    }
                });

                return false;
    });
</script>
<script>
          $(document).ready(function() {
            function validar_email(email)
            {
                var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email) ? true : false;
            }
        });
</script>
<style type="text/css">

input[type=email],
fieldset {
/* requerido para estilizar adecuadamente elementos
   de formulario en navegadores basados en WebKit */
  -webkit-appearance: none;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
input:invalid {
  box-shadow: 0 0 1px 1px red;
}
input:focus:invalid {
  outline: none;
}
.error{
     box-shadow: 0 0 1px 1px red;
      outline: none;
}
</style>
<style type="text/css">
    label{
      font-weight:bold;
    }
    button{
    font-weight:bold;
    }
        .modal-open .select2-container--open { z-index: 999999 !important; width:100% !important; }
</style>
<script src="Plantilla/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="Plantilla/timepicker/bootstrap-timepicker.min.js?rev=<?php echo time();?>"></script>
<script src="../plugins/iCheck/icheck.min.js"></script>
</body>
</html>
