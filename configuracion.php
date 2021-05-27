<?php
session_start();

$autorizado = $_SESSION['autorizado'];

if($autorizado==false){
  echo "inicia sesion para poder ingresar";
  echo '<meta http-equiv="refresh" content="2; url=inicio.sesion.php">';
  die();
}

require_once('funciones.php'); //me asegura que se genere una sola ves en caso de que haya mas funciones.

//files variaable global.
obtener_imagen_usuario();

$msg="";
$msg2="";

//recibimos post de formulario cambio de imagen usuario
if ($_FILES){
  $archivo = $_FILES;
  $msg = graba_imagen($archivo);
}

//recibimos post de formulario cambio de clave
if(isset($_POST['nueva_password']) && isset($_POST['nueva_password']) && isset($_POST['nueva_password_repite'])) {

  $password = strip_tags($_POST['password']);
  $nueva_password = strip_tags($_POST['nueva_password']);
  $repite_password = strip_tags($_POST['nueva_password_repite']);

  if ($password==$password) {
    $mysqli->query("SELECT `usuarios_password` FROM `usuarios` WHERE `usuarios_password`= '$password' ");
  }

  if ($_POST['password'] ==""){
    $msg2.="Ingresa tu contraseña actual <br>";
  }
  if ($nueva_password != $repite_password){
    $msg2.="Las claves no coinciden <br>";
  }else if (strlen($nueva_password)<6){
    $msg2.="La clave debe tener al menos 6 caracteres <br>";
  }else{
    $nueva_password = sha1($nueva_password);
    $mysqli->query("UPDATE `usuarios` SET `usuarios_password`= '$password' WHERE `usuarios_id` = '".$_SESSION['usuarios_id']."' ");
    $msg2.="La clave ha sido actualizada correctamente <br>";
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PHPTube</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<!-- ************************** -->
<!--* HEADER O BARRA SUPERIOR * -->
<!-- ************************** -->

  <header class="main-header">
    <!-- Logo -->
    <a href="principal.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PHP</b>Tube</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo obtener_imagen_usuario(); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['usuario_nombre'] ?></span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>



  <!-- ************************-->
  <!--* ASIDE O BARRA LATERAL * -->
  <!-- ************************ -->

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo obtener_imagen_usuario(); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php echo $_SESSION['usuarios_email'] ?></p>
          <p>Ultima conexión:<br> <?php echo $_SESSION['usuarios_ultimo_login'] ?></p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menú de navegación</li>
        <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
        <li class=" ">
          <a href="#">
            <i class="fa fa-users "></i> <span>Seguir</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>



        <li class="header">Opciones</li>

        <li class="active">
          <a href="configuracion.php">
            <i class="fa fa-cog "></i> <span>Configuración</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="">
          <a href="inicio.sesion.php">
            <i class="fa fa-power-off"></i> <span>Cerrar sesión</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>



  <!-- *************************-->
  <!--* CONTENT / ZONA CENTRAL * -->
  <!-- ************************* -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-6">
          <!-- small box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cambia tu foto de perfil</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="configuracion.php" role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">                
                <div class="form-group">
                  <label for="exampleInputFile">Selecciona la imagen</label>
                  <input name="archivo" type="file" id="exampleInputFile">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Aceptar</button>
              </div>
              <div style="color:red" class="">
              <?php if($msg!=""){
                echo $msg;
              } ?>
            </div>
            </form>
          </div>
        </div>


        <!-- ./col -->
        <div class="col-xs-6">
          <!-- small box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Contraseña</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="configuracion.php" method="post" role="form">
              <div class="box-body">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Contraseña actual</label>
                  <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Ingresa tu contraseña">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nueva contraseña</label>
                  <input name="nueva_password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Ingresa la nueva contraseña">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Confirma tu nueva contraseña</label>
                  <input name="nueva_password_repite" type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirma tu nueva contraseña">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cambiar</button>
              </div>
              <div style="color:red" class="">
              <?php if($msg2!=""){
                echo $msg2;
              } ?>
               </div>
            </form>
          </div>


        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- *************************-->
  <!--* FOOTER / PIE DE PAGINA * -->
  <!-- ************************* -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2021 <a href="https://phptube.com">PHPTube</a>.</strong> Elavorado por Jaquedm
    reserved.
  </footer>

</div>
<!-- ./wrapper -->




<!-- *************************-->
<!--*        SCRIPTS         * -->
<!-- ************************* -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
