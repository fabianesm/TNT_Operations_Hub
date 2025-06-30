<?php
    if (!empty($_POST["SaveEquipment"])) {
        $motivo = $_REQUEST['EquipmentType'];
        $jefatura = $_REQUEST['supervisor_form'];
        $empleado = $_REQUEST['empleado'];
        $status = $_REQUEST['status'];
        $descripcion = $_REQUEST['descripcion'];

        $query = $conexion->query("INSERT INTO permisos(motivo,jefatura,empleado,dias,descripcion) VALUES('$motivo','$jefatura','$empleado','$status','$descripcion')");
        echo "<div class='alert alert-success'><i class='fa fa-spinner fa-spin' style='font-size:25px;margin-right:10px;'></i>Please wait, we are uploading the information.</div>";

        echo "<script>
        setTimeout(function () {
            window.location.href= 'equipment_control.php';
         }, 3000);
        </script>";
    }
?>