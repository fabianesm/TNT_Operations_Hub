<?php
require 'connect_bd.php';

if (!empty($_POST["SaveBatch"])) {
    // Sanitización
    $product_name = mysqli_real_escape_string($conexion, $_POST['product_name']);
    $lot_number = mysqli_real_escape_string($conexion, $_POST['lot_number']);
    $so_number = mysqli_real_escape_string($conexion, $_POST['so_number']);

    // Formato de fecha
    $due_date = DateTime::createFromFormat('m/d/Y', $_POST['due_date']);
    $due_date_formatted = $due_date ? $due_date->format('Y-m-d') : null;

    $cases_amount = (int)$_POST['cases_amount'];
    $folder_made_by = mysqli_real_escape_string($conexion, $_POST['folder_made_by']);

    // QA fields
    $qa_released_by = !empty($_POST['qa_released_by']) ? (int)$_POST['qa_released_by'] : 'NULL';
    $base_complete = !empty($_POST['base_complete']) ? "'" . mysqli_real_escape_string($conexion, $_POST['base_complete']) . "'" : "NULL";
    $qa_notes = !empty($_POST['qa_notes']) ? "'" . mysqli_real_escape_string($conexion, $_POST['qa_notes']) . "'" : "NULL";

    // Inserción
    $query = $conexion->query("
        INSERT INTO batch_records (
            product_name,
            lot_number,
            so_number,
            due_date,
            amount_of_cases,
            folder_created_by,
            qa_released_by,
            base_complete,
            qa_notes
        ) VALUES (
            '$product_name',
            '$lot_number',
            '$so_number',
            " . ($due_date_formatted ? "'$due_date_formatted'" : "NULL") . ",
            $cases_amount,
            '$folder_made_by',
            $qa_released_by,
            $base_complete,
            $qa_notes
        )
    ");

    if ($query) {
        echo "<div class='alert alert-success'>
                <i class='fa fa-spinner fa-spin' style='font-size:25px;margin-right:10px;'></i>
                Please wait, we are uploading the information.
              </div>";
        echo "<script>
            setTimeout(function () {
                window.location.href = 'batch_records.php';
            }, 3000);
        </script>";
    } else {
        echo "<div class='alert alert-danger'>Error saving the batch record. Please try again.</div>";
    }
}
?>
