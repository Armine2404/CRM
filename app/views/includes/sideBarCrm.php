
<?php $rol = $_SESSION['nombreRol']; // definimos la variable del nombre de rol de la base de datos para la visibilidad del menu por permisos ?>
 <!-- Sidebar -->
 <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="<?php //echo RUTA_URL ?>/img/<?php //echo $_SESSION['nombre']; ?>.png" class="img-circle elevation-2" alt="User Image"> -->
          <img src="<?php echo RUTA_URL ?>/img/avatar1.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['nombre']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- ==== DASHBOARDS ======== -->
          <li class="nav-item <?php echo $datos['permisos']->$rol->analisis; ?>">
            <a href="<?php echo RUTA_URL ?>/analisis/analisisClientes" class="nav-link active">
              <i class="fas fa-chart-bar"></i>
              <p>
                Análisis
              </p>
            </a>
          </li>
          <!-- ==== CRM ======== -->
          
          <li class="nav-item has-treeview <?php echo $datos['permisos']->$rol->planificacion; ?>">
            <a href="#" class="nav-link active">
              <i class="far fa-calendar-alt"></i>
              <p>
                Planificacion 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item <?php echo $datos['permisos']->$rol->clientes; ?> ">
                <a href="<?php echo RUTA_URL ?>/clientes" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item <?php echo $datos['permisos']->$rol->agenda; ?>">
                <a href="<?php echo RUTA_URL ?>/crm" class="nav-link">
                  <i class="far fa-calendar-alt nav-icon"></i>
                  <p>Agenda</p>
                </a>
              </li>
              <li class="nav-item <?php echo $datos['permisos']->$rol->acciones; ?>">
                <a href="<?php echo RUTA_URL ?>/acciones" class="nav-link"><!-- La ruta es el controlador -->
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Acciones</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- ==== Configuracion ======== -->
          <li class="nav-item has-treeview <?php echo $datos['permisos']->$rol->config; ?>">
            <a href="#" class="nav-link active">
              <i class="fas fa-cogs"></i>
              <p>
                Config.
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item <?php echo $datos['permisos']->$rol->tipoCliente; ?>">
                <a href="<?php echo RUTA_URL ?>/estadoCliente" class="nav-link">
                  <i class="far fa-smile nav-icon"></i>
                  <p>Tipo Cliente</p>
                </a>
              </li>
              <li class="nav-item <?php echo $datos['permisos']->$rol->usuarios; ?>">
                <a href="<?php echo RUTA_URL ?>/usuarios" class="nav-link">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item <?php echo $datos['permisos']->$rol->roles; ?>">
                <a  href="<?php echo RUTA_URL ?>/roles" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              <li class="nav-item <?php echo $datos['permisos']->$rol->tipoAcciones; ?>">
                <a href="<?php echo RUTA_URL ?>/permisos" class="nav-link">
                  <i class="fas fa-user-lock"></i>
                  <p>Permisos</p>
                </a>
              </li>
              <li class="nav-item <?php echo $datos['permisos']->$rol->tipoAcciones; ?>">
                <a href="<?php echo RUTA_URL ?>/tipoAcciones" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Tipo Acciones</p>
                </a>
              </li>
              <li class="nav-item <?php echo $datos['permisos']->$rol->tiempos; ?>">
              <a href="<?php echo RUTA_URL ?>/tiempos" class="nav-link" disabled>
                  <i class="far fa-clock nav-icon"></i>
                  <p>Tiempos</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
