<?php require(RUTA_APP . '/views/includes/header2.php'); ?>
<div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Tiempo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/analisis/analisisClientes">Inicio</a></li>
                    <li class="breadcrumb-item active">Tiempo</li>
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <form method="post" action="">
                <div class="container-fluid">
                    <div class="row form-group">
                        <div class="col-sm-4"  >
                            <label class="control-label" style="position:relative; top:7px; float:right">Tiempo de avisos:</label>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="">
                        </div>
                   
              
                 <div class="col-sm-1">
                    <button type="submit" name="" style="float:right" class="btn btn-primary">Actualizar</button>
                </div>
                </div>
            </form>
        </div>
    </section>
</div>


<?php require(RUTA_APP . '/views/includes/footer2.php'); ?>