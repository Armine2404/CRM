
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-navy navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php //echo RUTA_URL ?>/paginas" class="nav-link">Home</a>
      </li> -->
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <!-- AQUI TOTAL DE NOTIFICACIONES DE PERSONA LOGADA -->
          <span class="badge badge-warning navbar-badge" id="notTotal"><?php echo $_SESSION['notifi']['total'] - $_SESSION['notifi']['finalizadas'];  ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- AQUI TOTAL DE NOTIFICACIONES DE PERSONA LOGADA 2-->
          <span class="dropdown-header">Lo más urgente <?php echo $_SESSION['notifi']['nombre'];  ?></span>
          <div class="dropdown-divider"></div>
          <a href="<?php echo RUTA_URL ?>/crm" class="dropdown-item bg-danger notifi" id="pen">
          <!-- AQUI TAREAS PENDIENTES DE PERSONA LOGADA -->
            <i class="fas fa-exclamation-circle"></i> <span id="notPendientes"><?php echo $_SESSION['notifi']['pendientes'];  ?> </span>Pendientes
            <span class="float-right  text-sm" id="notPenPorcentaje"><?php echo $_SESSION['notifi']['penPorcentaje'];  ?> %</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo RUTA_URL ?>/crm" class="dropdown-item bg-warning notifi" id="pro">
          <!-- AQUI TAREAS PROCESO DE PERSONA LOGADA -->
            <i class="fas fa-hourglass-half"></i><span id="notProceso"> <?php echo $_SESSION['notifi']['proceso'];  ?> </span>En Proceso
            <span class="float-right  text-sm" id="notProPorcentaje"><?php echo $_SESSION['notifi']['proPorcentaje'];  ?> %</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo RUTA_URL ?>/crm" class="dropdown-item bg-blue">
          <!-- AQUI TAREAS HOY DE PERSONA LOGADA -->
            <i class="fa fa-bookmark-o"></i><span id="notHoy"> <?php echo $_SESSION['notifi']['hoy'];  ?> </span>Para Hoy
            <span class="float-right  text-sm" id="notHoyPorcentaje"><?php echo round(((($_SESSION['notifi']['hoy']*100)+1)/$_SESSION['notifi']['total']),0);  ?> %</span>
          </a>
          <div class="dropdown-divider"></div>
          <!-- ENLACE A AGENDA -->
          <a href="<?php echo RUTA_URL ?>/crm" class="dropdown-item dropdown-footer">Revisa todas tus tareas aqui.</a>
        </div>
      </li>
      <!-- AQUI PODRIAMOS PONER LA CONFIGURACIÓN DE DISEÑO -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link"  href="<?php echo RUTA_URL ?>/salir"><i
            class="fas fa-power-off"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->