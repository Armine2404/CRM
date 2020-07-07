<?php require '../public/librerias/vendor/autoload.php'; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo NOMBRE_SITIO; ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/all.min.css">

  <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/datatables/responsive.bootstrap4.min.css">
  <!-- datatable buttons -->
  <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/datatables/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/adminlte.min.css">
  <!-- menu sidebar style  control de permisos usuarios -->
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/menu.css">
  <!-- FULLCALENDAR -->
  <!-- <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/librerias/components/fullcalendar/fullcalendar-built.css" /> -->
  <link href='<?php echo RUTA_URL ?>/public/librerias/fullcalendar/packages/core/main.css' rel='stylesheet' />
  <link href='<?php echo RUTA_URL ?>/public/librerias/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
  <link href='<?php echo RUTA_URL ?>/public/librerias/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
  <link href='<?php echo RUTA_URL ?>/public/librerias/fullcalendar/packages/list/main.css' rel='stylesheet' />

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL; ?>/public/css/estilos.css">



  <!--Select2-->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<!-- tail.select -->
<link href='<?php echo RUTA_URL ?>/public/librerias/tailSelect/css/bootstrap4/tail.select-default.css' rel='stylesheet' />

</head>

<body class="hold-transition sidebar-mini sidebar-collapse">

  <input type="hidden" id="usuario" value="<?php echo $_SESSION['id_usuario'] ?>" />
  <input type="hidden" id="rol" value="<?php echo $_SESSION['rol'] ?>" />
  <div class="wrapper">

    <!-- Navbar -->
    <?php include("navBar.php"); ?>
    <!-- end navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

      <!-- Brand Logo -->
      <?/*php include("brandLogo.php");*/ ?>
      <!-- end Brand Logo -->

      <!-- Sidebar -->
      <?php include("sideBarCrm.php"); ?>
      <!-- end Sidebar -->
    </aside>