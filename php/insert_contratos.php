<?php
    if (!empty($_POST["GuardarContrato"])) {
        $empleado = $_REQUEST['empleado'];
        $tipo_contrato = $_REQUEST['tipo_contrato'];
        $tipo_prestacion = $_REQUEST['tipo_prestacion'];
        $sueldo = $_REQUEST['sueldo'];
        $moneda = $_REQUEST['moneda'];
        $verificacion = $conexion->query("SELECT * FROM contratos WHERE empleado='$empleado'");

        if ($datos=$verificacion->fetch_object()) {
            echo "<div class='alert alert-danger'>Error: Empleado ya tiene un contrato asociado.</div>";
        }else{
            $query = $conexion->query("INSERT INTO contratos(empleado,tipo_contrato,tipo_prestacion,sueldo,moneda) VALUES('$empleado','$tipo_contrato','$tipo_prestacion','$sueldo','$moneda')");
            echo "<div class='alert alert-success'><i class='fa fa-spinner fa-spin' style='font-size:25px;margin-right:10px;'></i>Por favor espere, estamos subiendo la informaci&oacute;n.</div>";

            echo "<script>
            setTimeout(function () {
                window.location.href= 'contratos.php';
             }, 3000);
            </script>";
        }
    }
?>