<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo NOMBRE_SITIO; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/librerias/vendor/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
<!--  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/librerias/vendor/almasaeed2010/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- Theme style -->
<link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/librerias/vendor/almasaeed2010/adminlte/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="<?php echo RUTA_URL ?>/img/logo/logoDataLeanMakers.png" style="width:350px">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>

      <form action="<?php echo RUTA_URL ?>/recuperar/getEmail" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="mail" placeholder="Email" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">

      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<!-- /.login-box -->


<!-- jQuery -->
<script src="<?php echo RUTA_URL ?>/public/librerias/vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo RUTA_URL ?>/public/librerias/vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo RUTA_URL ?>/public/librerias/vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script>
</body>
</html>
