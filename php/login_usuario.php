<?php
    if (!empty($_POST["btningresar"])) {
        if (!empty($_POST["correo_usuario"]) and !empty($_POST["contrasena"])) {
            $correo_usuario = $_POST['correo_usuario'];
            $contrasena = hash('sha512', $_POST['contrasena']);
            $query = $conexion->query("SELECT * FROM usuarios WHERE (correo='$correo_usuario' OR usuario='$correo_usuario') AND contrasena='$contrasena'");
            if ($datos=$query->fetch_object()) {
                // Obtener la fecha de registro del usuario
                $id_usuario = $datos->id;
                $query_fecha = $conexion->query("SELECT fecha_cambio FROM cambio_usuario_contrasena WHERE id_usuario='$id_usuario' ORDER BY fecha_cambio DESC LIMIT 1");
                $fecha_registro = $query_fecha->fetch_object()->fecha_cambio;

                 // Comparar la fecha de registro con la fecha actual
                 $dias_transcurridos = round((time() - strtotime($fecha_registro)) / (60 * 60 * 24));
                 if ($dias_transcurridos >= 45) {
                     // Si han pasado 45 días o más desde el registro, redirigir a la página de cambio de contraseña
                     header("location: change_password.php?id=" . $datos->id);
                     exit();
                 }

                $_SESSION["id"]=$datos->id;
                $_SESSION["nombre"]=$datos->nombre;
                $_SESSION["rol"]=$datos->rol;
                header("location: index.php");
            }else{
                echo "<div class='alert alert-danger'>Access Denied</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Access Denied</div>";
        }
    }
?>