<?php 
if (isset($_REQUEST['id'])) {
require('php/connect_bd.php');
include('php/header.php');
?>

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row" id="micaja">
                <div class="col-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-2">Por favor actualiza tus datos</h1>
                            <p class="mb-4">Si no puedes acceder al sistema y eres redirigido aquí, se debe a que cada 15 días el sistema necesita que actualices tus datos por seguridad, gracias por comprender.</p>
                            <?php
                                if (!empty($_POST["actualizar"])) {
                                    $idUser = $_REQUEST['id'];
                                    $usuarioNew = $_POST['usernew'];
                                    $contrasenaNew = hash('sha512', $_POST['passnew']);

                                    // selecciona el ultimo registro del ciclo actual
                                    $query = $conexion->query("SELECT ciclo FROM cambio_usuario_contrasena WHERE id_usuario = '$idUser' ORDER BY ciclo DESC LIMIT 1");
                                    $ciclo_actual = $query->fetch_object()->ciclo;

                                    if ($ciclo_actual<3) {
                                        // consulta SQL que seleccione las contraseñas anteriores del usuario
                                        $sql = "SELECT contrasena FROM cambio_usuario_contrasena WHERE id_usuario = '$idUser' ORDER BY fecha_cambio DESC";
                                        $query = $conexion->query($sql);

                                        // Recorre los resultados de la consulta y almacena las contraseñas anteriores en un array
                                        $contrasenas_anteriores = array();
                                        while ($row = $query->fetch_assoc()) {
                                            $contrasenas_anteriores[] = $row['contrasena'];
                                        }

                                        // Verifica que la nueva contraseña no sea igual a ninguna de las contraseñas anteriores.
                                        if (in_array($contrasenaNew, $contrasenas_anteriores)) {
                                            echo "<div class='alert alert-danger'>La nueva contraseña no puede ser igual a una contraseña anterior.</div>";
                                        } else {
                                            // // Inserta el nuevo registro en la tabla cambio_usuario_contrasena y actualiza la contraseña en la tabla usuarios
                                            $nuevo_ciclo = $ciclo_actual + 1;
                                            $sqledit = "INSERT INTO cambio_usuario_contrasena (id_usuario, usuario, contrasena, fecha_cambio, ciclo) VALUES ('$idUser', '$usuarioNew', '$contrasenaNew', NOW(), '$nuevo_ciclo')";
                                            $conexion->query($sqledit);

                                            $sqledit2 = "UPDATE usuarios SET contrasena = '$contrasenaNew', usuario= '$usuarioNew' WHERE id = '$idUser'";
                                            $conexion->query($sqledit2);
                                            echo "<div class='alert alert-success'>Datos actualizados correctamente, Redireccionando en 3 segundos...</div>";
                                            
                                            echo "<script>setTimeout(function() {window.location.href = 'index.php';}, 3000);</script>";
                                        }
                                    }else {
                                        // Si el ciclo es igual o mayor a 3, borra todos los registros anteriores de cambio_usuario_contrasena y actualiza la contraseña en la tabla usuarios
                                        $sqldel = "DELETE FROM cambio_usuario_contrasena WHERE id_usuario = '$idUser'";
                                        $conexion->query($sqldel);

                                        $sqledit3 = "INSERT INTO cambio_usuario_contrasena (id_usuario, usuario, contrasena, fecha_cambio, ciclo) VALUES ('$idUser', '$usuarioNew', '$contrasenaNew', NOW(), '0')";
                                        $conexion->query($sqledit3);

                                        $sqledit4 = "UPDATE usuarios SET contrasena = '$contrasenaNew', usuario= '$usuarioNew' WHERE id = '$idUser'";
                                        $conexion->query($sqledit4);
                                        echo "<div class='alert alert-success'>Datos actualizados correctamente, Redireccionando en 3 segundos...</div>";
                                        
                                        echo "<script>setTimeout(function() {window.location.href = 'index.php';}, 3000);</script>";
                                    }

                                }
                            ?>
                        </div>
                        <form class="user" action="" method="POST">
                            <div class="form-group">
                                <input type="text" name="usernew" class="form-control form-control-user mb-3" id="usernew" placeholder="Nuevo Usuario">
                                <input type="password" name="passnew" class="form-control form-control-user mb-3" id="passnew" placeholder="Nueva Contraseña">
                            </div>
                            <input type="submit" name="actualizar" class="btn btn-primary btn-user btn-block" value="Actualizar"></input>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>

<?php include('php/footer.php');

}else {
    header("location: index.php");
}
?>