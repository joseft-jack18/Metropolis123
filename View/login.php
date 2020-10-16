<?php

  session_start();
  if(isset($_SESSION['S_ID'])){
    header('Location: index.php');
  }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>METROPOLIS | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../Admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Admin/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../Admin/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Admin/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../Admin/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<style>
  .swal2-popup{
    font-size:1.6rem !important;
  }
</style>

<body class="hold-transition login-page" style="background: url('../Admin/dist/img/fondo1.jpg')">
    <div class="login-box">  
        <!-- /.login-logo -->
        <div class="login-box-body">
            <br>
            <div class="login-logo">
                <img src="../Admin/dist/img/logo_tienda.png" width="280">
            </div>
            <br>
            <!-- <form name="formLogin" id="formLogin"> -->
              <div class="form-group has-feedback">
                <input type="email" class="form-control" id="txtEmail" placeholder="Correo Electrónico">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" id="txtPassword" placeholder="Contraseña">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="checkbox icheck">
                    <label>
                      <input type="checkbox"> Recuérdame
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-12">
                  <button class="btn btn-success btn-block btn-flat" onclick="VerificarUsuario()">Ingresar</button>
                </div>
                <!-- /.col -->
              </div>
            <!-- </form> -->
            <!-- /.social-auth-links -->
            <br>
            <a href="#" class="col-xs-12 text-center">Olvidó su contraseña?</a><br><br>
            <div class="col-xs-12 text-center">
              Cliente nuevo?<a href="registro.php"> Registrese aqui</a>
            </div>
            <br>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- SweetAlert 2 -->
    <script src="../Admin/bower_components/sweetalert2/sweetalert2.js"></script>
    <!-- jQuery 3 -->
    <script src="../Admin/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../Admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../Admin/plugins/iCheck/icheck.min.js"></script>
    <script src="../js/usuario.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' /* optional */
            });
        });
    </script>
</body>
</html>