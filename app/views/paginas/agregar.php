<?php require(RUTA_APP . '/views/includes/header2.php'); ?>
<div class="container">
<div><a href="<?php echo RUTA_URL; ?>/paginas"><i class="fa fa-backward"></i> Volver</a></div>
<div class="card card-body bg-light md-5">
    <h2>Agregar Usuarios</h2>
    <form action="<?php echo RUTA_URL;  ?>/paginas/agregar" method="POST">
<div class="form group">
    <label for="nombre">Nombre: <sup>*</sup></label>
    <input type="text" name="nombre" class="form-control from-control-lg">
</div>
<div class="form group">
    <label for="mail">Mail: <sup>*</sup></label>
    <input type="email" name="mail" class="form-control from-control-lg">
</div>
<div class="form group">
    <label for="nombre">Telefono: <sup>*</sup></label>
    <input type="text" name="telefono" class="form-control from-control-lg">
</div>
<input type="submit" class="btn btn-success" value="Agregar Usuario">
</form>

</div>

</div>

<?php require(RUTA_APP . '/views/includes/footer2.php'); ?>