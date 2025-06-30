<?php
include 'php/connect_bd.php';

$codaccion = $_REQUEST['codaccion'];
$id = $_REQUEST['id'];

switch ($codaccion) {
    case 'mostrarBatch':
        $query = "SELECT 
                    product_name, 
                    lot_number, 
                    so_number, 
                    due_date, 
                    amount_of_cases, 
                    folder_created_by, 
                    qa_released_by, 
                    base_complete, 
                    qa_notes 
                  FROM batch_records 
                  WHERE id = $id";

        $result = mysqli_query($conexion, $query);
        if (!$result) die('Query error: ' . mysqli_error($conexion));

        $data = array();

        if ($row = mysqli_fetch_assoc($result)) {
            $data = array(
                'product_name' => $row['product_name'],
                'lot_number' => $row['lot_number'],
                'so_number' => $row['so_number'],
                'due_date' => $row['due_date'],
                'amount_of_cases' => $row['amount_of_cases'],
                'folder_created_by' => $row['folder_created_by'],
                'qa_released_by' => $row['qa_released_by'],
                'base_complete' => $row['base_complete'],
                'qa_notes' => $row['qa_notes']
            );
        }

        echo json_encode($data);
        break;
}
?>
