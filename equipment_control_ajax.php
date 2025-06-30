<?php
    include 'php/connect_bd.php';

    $codaccion = $_REQUEST['codaccion'];
    $id = $_REQUEST['id'];

    switch ($codaccion) {
        case 'mostrarpermisos':
            $consulta = "SELECT motivo, jefatura, empleado, dias, descripcion FROM permisos WHERE id = $id";
            if(!$result = mysqli_query($conexion, $consulta)) die();
            $data = array();

            while($row = mysqli_fetch_array($result)) { 
                $motivo=$row['motivo'];
                $jefatura=$row['jefatura'];
                $empleado=$row['empleado'];
                $status=$row['dias'];
                $descripcion=$row['descripcion'];
                
                $data[] = array('motivo'=> $motivo, 'jefatura'=> $jefatura, 'empleado'=> $empleado, 'dias'=> $status, 'descripcion'=> $descripcion);            
            }

            $json_string = json_encode($data);
            echo $json_string;

            break;
    }


?>