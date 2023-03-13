<?php
    include 'php/connect_bd.php';

    $codaccion = $_REQUEST['codaccion'];
    $id = $_REQUEST['id'];

    switch ($codaccion) {
        case 'mostrarcontrato':
            $consulta = "SELECT empleado, tipo_contrato, tipo_prestacion, sueldo, moneda FROM contratos WHERE id = $id";
            if(!$result = mysqli_query($conexion, $consulta)) die();
            $data = array();

            while($row = mysqli_fetch_array($result)) { 
                $empleado=$row['empleado'];
                $tipo_contrato=$row['tipo_contrato'];
                $tipo_prestacion=$row['tipo_prestacion'];
                $sueldo=$row['sueldo'];
                $moneda=$row['moneda'];
                
                $data[] = array('empleado'=> $empleado, 'tipo_contrato'=> $tipo_contrato, 'tipo_prestacion'=> $tipo_prestacion, 'sueldo'=> $sueldo, 'moneda'=> $moneda);            
            }

            $json_string = json_encode($data);
            echo $json_string;

            break;
    }


?>