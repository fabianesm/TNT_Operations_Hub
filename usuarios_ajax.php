<?php
    include 'php/connect_bd.php';

    $codaccion = $_REQUEST['codaccion'];
    $id = $_REQUEST['id'];

    switch ($codaccion) {
        case 'mostrarusuario':
            $consulta = "SELECT nombre, correo, usuario, rol, contrasena FROM usuarios WHERE id = $id";
            if(!$result = mysqli_query($conexion, $consulta)) die();
            $data = array();

            while($row = mysqli_fetch_array($result)) { 
                $nombre=$row['nombre'];
                $correo=$row['correo'];
                $usuario=$row['usuario'];
                $rol=$row['rol'];
                $contrasena=$row['contrasena'];
                $password_descrypt= hash("sha512", $contrasena);
                
                $data[] = array('nombre'=> $nombre, 'correo'=> $correo, 'usuario'=> $usuario, 'rol'=> $rol, 'contrasena'=> $password_descrypt);            
            }

            $json_string = json_encode($data);
            echo $json_string;

            break;
    }


?>