<?php
    if (!empty($_POST["btnregistrarse"])) {
        $nombre_completo = $_POST['nombre_completo'];
        $correo = $_POST['correo_electronico'];
        $usuario = $_POST['usuario'];
        $contrasena = hash('sha512', $_POST['password']);
        $verificacion = $conexion->query("SELECT * FROM usuarios WHERE correo='$correo' OR usuario='$usuario'");

        if ($datos=$verificacion->fetch_object()) {
            echo "<div class='alert alert-danger'>Error: Correo o usuario ya se encuentran registrados.</div>";
        }else{
            $query = $conexion->query("INSERT INTO usuarios(nombre,correo,usuario,contrasena,rol) VALUES('$nombre_completo','$correo','$usuario','$contrasena','empleado')");
            $lastid = $conexion->insert_id;
            $query2 = $conexion->query("INSERT INTO cambio_usuario_contrasena(id_usuario,usuario,contrasena,fecha_cambio,ciclo) VALUES('$lastid','$usuario','$contrasena',NOW(),'0')");

            echo "<div class='alert alert-success'>Usuario registrado correctamente.</div>";
        }
    }
?>