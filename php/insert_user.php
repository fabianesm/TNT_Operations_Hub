<?php
    if (!empty($_POST["GuardarUsuario"])) {
        $nombre_completo = $_POST['nombre_completo'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $contrasena = hash('sha512', $_POST['contrasena']);
        $rol = $_POST['rol_user'];
        $verificacion = $conexion->query("SELECT * FROM usuarios WHERE correo='$correo' OR usuario='$usuario'");

        if ($datos=$verificacion->fetch_object()) {
            echo "<div class='alert alert-danger'>Error: Email or username is already registered.</div>";
        }else{
            $query = $conexion->query("INSERT INTO usuarios(nombre,correo,usuario,contrasena,rol) VALUES('$nombre_completo','$correo','$usuario','$contrasena','$rol')");
            $lastid = $conexion->insert_id;
            $query2 = $conexion->query("INSERT INTO cambio_usuario_contrasena(id_usuario,usuario,contrasena,fecha_cambio,ciclo) VALUES('$lastid','$usuario','$contrasena',NOW(),'0')");
            
            echo "<div class='alert alert-success'><i class='fa fa-spinner fa-spin' style='font-size:25px;margin-right:10px;'></i>Please wait, we are uploading the information.</div>";

            echo "<script>
            setTimeout(function () {
                window.location.href= 'users.php';
             }, 3000);
            </script>";
        }
    }
?>