<?php
    if (!empty($_POST["GuardarPermiso"])) {
        $motivo = $_REQUEST['motivo'];
        $jefatura = $_REQUEST['jefatura'];
        $empleado = $_REQUEST['empleado'];
        $dias = $_REQUEST['dias'];
        $descripcion = $_REQUEST['descripcion'];
        $verificacion = $conexion->query("SELECT SUM(dias) as total_dias FROM permisos WHERE empleado='$empleado' HAVING SUM(dias) >= 4;");

        if ($datos=$verificacion->fetch_object()) {
            echo "<div class='alert alert-danger'>Error: Empleado ya no tiene días administrativos disponibles.</div>";
        }else{
            $query = $conexion->query("INSERT INTO permisos(motivo,jefatura,empleado,dias,descripcion) VALUES('$motivo','$jefatura','$empleado','$dias','$descripcion')");
            echo "<div class='alert alert-success'><i class='fa fa-spinner fa-spin' style='font-size:25px;margin-right:10px;'></i>Por favor espere, estamos subiendo la informaci&oacute;n.</div>";

            echo "<script>
            setTimeout(function () {
                window.location.href= 'control_equipos.php';
             }, 3000);
            </script>";
        }
    }
?>