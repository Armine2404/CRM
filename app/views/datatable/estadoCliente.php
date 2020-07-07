<?php require(RUTA_APP . '/views/includes/header2.php'); ?>

<!-- EMPIEZA BREADCRUMB -->
<div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Tipo Cliente</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/analisis/analisisClientes">Inicio</a></li>
                    <li class="breadcrumb-item active">Tipo Cliente</li>
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
        <div class="text-center">
            <a href="#addnew" class="btn btn-primary" data-toggle="modal" style="margin-bottom:20px;"><span
                    class="fa fa-plus"></span></a></div>
            <div class="table-responsive">
                <table id="table_esclientes" class="table table-striped table-bordered" style="width:100%">
                    <thead style="background-color:#001f3f; color:#fff;">
                        <tr>
                            <th>id</th>
                            <th>Tipo Cliente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- ==================== Empieza la ventana modal para añadir un registro nuevo =========================== -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <center>
                    <h4 class="modal-title" id="myModalLabel">Agregar Tipo Cliente</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="EstadoCliente/agregarEstadoCliente">
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-sm-5">
                            <label class="control-label" style="position:relative; top:7px;">Tipo Cliente:</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="estado">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span>
                        Cancelar</button>
                    <button type="submit" name="add" class="btn btn-primary"><span class="fa fa-save"></span>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ==================== Termina la ventana modal para añadir un registro nuevo =========================== -->

<!-- ==================== Empieza la ventana modal para editar un registro =========================== -->
<div class="modal fade" id="ModalEdit" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <center>
                    <h4 class="modal-title" id="myModalLabel">Editar Tipo Cliente</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form method="POST" action="EstadoCliente/actualizarEstadoCliente">
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="hidden" name="id">
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label class="control-label" style="position:relative; top:7px;">Tipo Cliente:</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="estado">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span>
                        Cancelar</button>
                    <button type="submit" name="edit" class="btn btn-primary"><span class="fa fa-check"></span>
                        Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ==================== Termina la ventana modal para editar un registro =========================== -->
<!-- ==================== Empieza la ventana modal para eliminar un registro =========================== -->
<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <center>
                    <h4 class="modal-title" id="myModalLabel">Borrar Tipo</h4>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form method="POST" action="EstadoCliente/borrarEstadoCliente">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <p class="text-center">¿Estas seguro en borrar los datos de?</p>
                    <div id="" style="text-align: center;">
                    <h2 class="text-center"><input type="text" class="form-control" name="estado" style="width:auto; margin: 0 auto; text-align:center" disabled></h2>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="fa fa-close"></span></button>
                    <button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span>
                        Si</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php require(RUTA_APP . '/views/includes/footer2.php'); ?>