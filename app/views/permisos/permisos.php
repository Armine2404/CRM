<?php require(RUTA_APP . '/views/includes/header2.php'); ?>

<!-- EMPIEZA BREADCRUMB -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Actualizaci&oacute;n de permisos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/analisis/analisisClientes">Inicio</a></li>
                        <li class="breadcrumb-item active">Actualizaci&oacute;n de permisos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <!-- FIN BREADCRUMB -->
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead style="background-color:#001f3f; color:#fff;">
                            <tr>
                                <th>Men&uacute;/Submen&uacute;</th>
                                <th class="text-center">Administrador</th>
                                <th class="text-center">Direcci&oacute;n</th>
                                <th class="text-center">Agente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-info">
                                <td><strong>Analisis</strong></td>
                                <td class="text-center"><input type="checkbox" id="analisis_administrador" name="analisis_administrador" <?php echo $datos['permisos']->administrador->analisis == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="analisis_direccion" name="analisis_direccion" <?php echo $datos['permisos']->direccion->analisis == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="analisis_agente" name="analisis_agente" <?php echo $datos['permisos']->agente->analisis == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr class="table-info">
                                <td><strong>Planificacion</strong></td>
                                <td class="text-center"><input type="checkbox" id="planificacion_administrador" name="planificacion_administrador" <?php echo $datos['permisos']->administrador->planificacion == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="planificacion_direccion" name="planificacion_direccion" <?php echo $datos['permisos']->direccion->planificacion == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="planificacion_agente" name="planificacion_agente" <?php echo $datos['permisos']->agente->planificacion == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr>
                                <td>Clientes</td>
                                <td class="text-center"><input type="checkbox" id="clientes_administrador" name="clientes_administrador" <?php echo $datos['permisos']->administrador->clientes == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="clientes_direccion" name="clientes_direccion" <?php echo $datos['permisos']->direccion->clientes == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="clientes_agente" name="clientes_agente" <?php echo $datos['permisos']->agente->clientes == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr>
                                <td>Agenda</td>
                                <td class="text-center"><input type="checkbox" id="agenda_administrador" name="agenda_administrador" <?php echo $datos['permisos']->administrador->agenda == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="agenda_direccion" name="agenda_direccion" <?php echo $datos['permisos']->direccion->agenda == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="agenda_agente" name="agenda_agente" <?php echo $datos['permisos']->agente->agenda == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr>
                                <td>Acciones</td>
                                <td class="text-center"><input type="checkbox" id="acciones_administrador" name="acciones_administrador" <?php echo $datos['permisos']->administrador->acciones == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="acciones_direccion" name="acciones_direccion" <?php echo $datos['permisos']->direccion->acciones == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="acciones_agente" name="acciones_agente" <?php echo $datos['permisos']->agente->acciones == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr class="table-info">
                                <td><strong>Config</strong></td>
                                <td class="text-center"><input type="checkbox" id="config_administrador" name="config_administrador" <?php echo $datos['permisos']->administrador->config == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="config_direccion" name="config_direccion" <?php echo $datos['permisos']->direccion->config == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="config_agente" name="config_agente" <?php echo $datos['permisos']->agente->config == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr>
                                <td>Tipo Cliente</td>
                                <td class="text-center"><input type="checkbox" id="tipoCliente_administrador" name="tipoCliente_administrador" <?php echo $datos['permisos']->administrador->tipoCliente == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="tipoCliente_direccion" name="tipoCliente_direccion" <?php echo $datos['permisos']->direccion->tipoCliente == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="tipoCliente_agente" name="tipoCliente_agente" <?php echo $datos['permisos']->agente->tipoCliente == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr>
                                <td>Usuarios</td>
                                <td class="text-center"><input type="checkbox" id="usuarios_administrador" name="usuarios_administrador" <?php echo $datos['permisos']->administrador->usuarios == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="usuarios_direccion" name="usuarios_direccion" <?php echo $datos['permisos']->direccion->usuarios == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="usuarios_agente" name="usuarios_agente" <?php echo $datos['permisos']->agente->usuarios == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr>
                                <td>Roles</td>
                                <td class="text-center"><input type="checkbox" id="roles_administrador" name="roles_administrador" <?php echo $datos['permisos']->administrador->roles == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="roles_direccion" name="roles_direccion" <?php echo $datos['permisos']->direccion->usuarios == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="roles_agente" name="roles_agente" <?php echo $datos['permisos']->agente->usuarios == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr>
                                <td>Tipo Acciones</td>
                                <td class="text-center"><input type="checkbox" id="tipoAcciones_administrador" name="tipoAcciones_administrador" <?php echo $datos['permisos']->administrador->tipoAcciones == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="tipoAcciones_direccion" name="tipoAcciones_direccion" <?php echo $datos['permisos']->direccion->tipoAcciones == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="tipoAcciones_agente" name="tipoAcciones_agente" <?php echo $datos['permisos']->agente->tipoAcciones == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr>
                                <td>Tiempos</td>
                                <td class="text-center"><input type="checkbox" id="tiempos_administrador" name="tiempos_administrador" <?php echo $datos['permisos']->administrador->tiempos == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="tiempos_direccion" name="tiempos_direccion" <?php echo $datos['permisos']->direccion->tiempos == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="tiempos_agente" name="tiempos_agente" <?php echo $datos['permisos']->agente->tiempos == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr>
                                <td>Permisos</td>
                                <td class="text-center"><input type="checkbox" id="permisos_administrador" name="permisos_administrador" <?php echo $datos['permisos']->administrador->permisos == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="permisos_direccion" name="permisos_direccion" <?php echo $datos['permisos']->direccion->permisos == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="permisos_agente" name="permisos_agente" <?php echo $datos['permisos']->agente->permisos == "ver" ? "checked": ""; ?>></td>
                            </tr>
                            <tr>
                                <td>Busacdor Clientes</td>
                                <td class="text-center"><input type="checkbox" id="buscadorclientes_administrador" name="buscadorclientes_administrador" <?php echo $datos['permisos']->administrador->buscadorclientes == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="buscadorclientes_direccion" name="buscadorclientes_direccion" <?php echo $datos['permisos']->direccion->buscadorclientes == "ver" ? "checked": ""; ?>></td>
                                <td class="text-center"><input type="checkbox" id="buscadorclientes_agente" name="buscadorclientes_agente" <?php echo $datos['permisos']->agente->buscadorclientes == "ver" ? "checked": ""; ?>></td>
                            </tr>
                        </tbody>
                        <tfoot style="background-color:#001f3f; color:#fff;">
                            <tr>
                                <th>Men&uacute;/Submen&uacute;</th>
                                <th class="text-center">Administrador</th>
                                <th class="text-center">Direcci&oacute;n</th>
                                <th class="text-center">Agente</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button class="btn btn-warning float-right" id="btnPermisos">Actualizar</button>
                <p>En fondo azul Men&uacute;s, en fondo blanco submen&uacute;s </p>
                
            </div>
            <div class="clearfix"><br></div>

            <?php require(RUTA_APP . '/views/includes/footer2.php'); ?>