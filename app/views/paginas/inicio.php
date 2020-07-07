<?php require(RUTA_APP . '/views/includes/header2.php'); ?>

<div class="container">
    <div><a href="<?php echo RUTA_URL; ?>/paginas/agregar"><i class="fas fa-plus-square" style="font-size:36px;color:blue;"></i></a></div>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Mail</th>
                <th>telefono</th>
                <th>Password</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($datos['usuarios'] as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario->id_usuario; ?></td>
                    <td><?php echo $usuario->nombre; ?></td>
                    <td><?php echo $usuario->mail; ?></td>
                    <td><?php echo $usuario->telefono; ?></td>
                    <td><?php echo $usuario->password; ?></td>
                    <td><?php echo $usuario->rol; ?></td>
                    <td><a href="<?php echo RUTA_URL; ?>/paginas/editar/<?php echo $usuario->id_usuario; ?>"><i class="fas fa-pen-square" style="font-size:36px;color:orange;"></i></a></td>
                    <td><a href="<?php echo RUTA_URL; ?>/paginas/borrar/<?php echo $usuario->id_usuario; ?>"><i class="fas fa-trash-alt" style="font-size:36px;color:red;"></i></a></td>
            
                </tr>
            <?php endforeach; ?>


        </tbody>

    </table>

</div>

<?php require(RUTA_APP . '/views/includes/footer2.php'); ?>