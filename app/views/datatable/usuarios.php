<?php require(RUTA_APP . '/views/includes/header2.php'); ?>

<!-- EMPIEZA BREADCRUMB -->
<div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Usuarios</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/analisis/analisisClientes">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
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

    <div class="row">
        <div class="col-lg-12">
            <a href="#ModalAdd" class=" btn btn-primary modalAddBtn" data-toggle="modal" style="margin-bottom:20px;"><span
                    class="fa fa-plus"></span> </a>
            <div class="table-responsive">
                <table id="table_usuarios" class="table table-striped table-bordered" style="width:100%">
                    <thead style="background-color:#001f3f; color:#fff;">
                        <tr>
                            <th>id</th>
                            <th>idRol</th>
                            <th>Usuario</th>
                            <th>Email</th>                         
                            <th>Rol</th>
                            <th>Contraseña</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- =========================== Empieza el modal para agregar usuarios =========================== -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="Usuarios/agregarUsuario">
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label class="control-label" style="position:relative; top:7px;">Nombre:</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="usuario">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label class="control-label" style="position:relative; top:7px;">Email:</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label class="control-label" style="position:relative; top:7px;">Password:</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label class="control-label" style="position:relative; top:7px;">Rol:</label>
                            </div>
                            <div class="col-sm-7">
                                <select id="selectRol" class="form-control select2" style="width:100% !important;"
                                    name="idRol">

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span>
                        Cancelar</button>
                    <button type="submit" name="add" class="btn btn-primary"><span class="fa fa-save"></span>
                        Guardar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- =========================== Termina el modal para agregar usuarios =========================== -->

<!-- =========================== Empieza el modal para editar usuarios =========================== -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="Usuarios/actualizarUsuario">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label class="control-label" style="position:relative; top:7px;">Nombre:</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="usuario">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label class="control-label" style="position:relative; top:7px;">Email:</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label class="control-label" style="position:relative; top:7px;">Password:</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="passEdit">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label class="control-label" style="position:relative; top:7px;">Rol:</label>
                            </div>
                            <div class="col-sm-7">
                                <select id="selectRolEdit" class="form-control select2" style="width:100% !important;"
                                    name="idRol">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span>
                        Cancelar</button>
                    <button type="submit" name="edit" class="btn btn-primary"><span class="fa fa-save"></span>
                        Guardar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- =========================== Termina el modal para agregar usuarios =========================== -->

<!-- =========================== Empieza el modal para eliminar usuarios =========================== -->
<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="myModalLabel">Borrar Tipo Contrato</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form method="POST" action="Usuarios/borrarUsuario">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p class="text-center">¿Estas seguro en borrar los datos de?</p>
          					<h2 class="text-center"><input type="text" class="form-control" name="usuario" style="width:auto; margin: 0 auto; text-align:center" disabled></h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="fa fa-close"></span></button>
                    <button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- =========================== Termina el modal para eliminar usuarios =========================== -->



<?php require(RUTA_APP . '/views/includes/footer2.php'); ?>
