<?php 
require 'php/connect_bd.php';
session_start();
$active='batch_records';

if (!isset($_SESSION['id'])){
    header("location: index.php");
    exit();
} else{
    include 'php/header.php';?>

<!-- Page Wrapper -->
<div id="wrapper">

    <?php include 'php/sidebar.php';?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include 'php/topbar.php';?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?php 
                    $keyVal = (!isset($_REQUEST['llavegrabar'])) ? "none" : $_REQUEST['llavegrabar'];

                    switch ($keyVal) {
                        case 'EDITAR_BatchRecord':
                            $idBatchEdit = $_REQUEST['idBatchEdit'];
                            $product_name = $_REQUEST['product_name_edit'];
                            $lot_number = $_REQUEST['lot_number_edit'];
                            $so_number = $_REQUEST['so_number_edit'];

                            $due_date = DateTime::createFromFormat('m/d/Y', $_REQUEST['due_date_edit']);
                            $due_date_formatted = $due_date ? $due_date->format('Y-m-d') : null;

                            $amount_of_cases = $_REQUEST['cases_amount_edit'];
                            $folder_created_by = $_REQUEST['folder_made_by_edit'];
                            $qa_released_by = !empty($_REQUEST['qa_released_by_edit']) ? $_REQUEST['qa_released_by_edit'] : 'NULL';
                            $base_complete = !empty($_REQUEST['base_complete_edit']) ? $_REQUEST['base_complete_edit'] : NULL;
                            $qa_notes = !empty($_REQUEST['qa_notes_edit']) ? $_REQUEST['qa_notes_edit'] : NULL;

                            $sqlEdit = "
                                UPDATE batch_records SET 
                                    product_name = '$product_name',
                                    lot_number = '$lot_number',
                                    so_number = '$so_number',
                                    due_date = '$due_date_formatted',
                                    amount_of_cases = '$amount_of_cases',
                                    folder_created_by = '$folder_created_by',
                                    qa_released_by = $qa_released_by,
                                    base_complete = " . ($base_complete !== NULL ? "'$base_complete'" : "NULL") . ",
                                    qa_notes = " . ($qa_notes !== NULL ? "'$qa_notes'" : "NULL") . "
                                WHERE id = '$idBatchEdit'
                            ";
                            $conexion->query($sqlEdit);
                            break;

                        case 'Eliminar_BatchRecord':
                            $idBatchDelete = $_REQUEST['idBatchDelete'];
                            $sqlDelete = "DELETE FROM batch_records WHERE id = '$idBatchDelete'";
                            $conexion->query($sqlDelete);
                            break;
                    }
                ?>
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Batch Records</h1>

                <?php 
                    $consulta = "
                        SELECT 
                            br.id,
                            br.product_name,
                            br.lot_number,
                            br.so_number,
                            br.due_date,
                            br.amount_of_cases,
                            br.folder_created_by,
                            u.nombre AS qa_released_by,
                            br.base_complete,
                            br.qa_notes,
                            br.status,
                            br.created_at
                        FROM 
                            batch_records br
                        LEFT JOIN 
                            usuarios u ON br.qa_released_by = u.id
                    ";
                    $ejecucion = mysqli_query($conexion, $consulta);
                ?>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-11">
                                <h6 class="m-0 font-weight-bold text-primary mb-2">Work Orders</h6>
                                <?php include 'php/insert_batch_record.php';?>
                            </div>
                            <div class="col-1">
                                <button type="submit" id="addbatchrecord" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalAddBatch"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Work Order</th>
                                        <th>Due Date</th>
                                        <th>Cases/Pounds</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($obj = mysqli_fetch_array($ejecucion)):?>
                                        <tr>
                                            <td><?= $obj['id'] ?></td>
                                            <td><?= $obj['product_name'] ?></td>
                                            <td><?= $obj['lot_number'] ?></td>
                                            <td><?= date("m/d/Y", strtotime($obj['due_date'])) ?></td>
                                            <td><?= $obj['amount_of_cases'] ?></td>
                                            <td>
                                                <?php 
                                                    switch ($obj['base_complete']) {
                                                        case 'Yes':
                                                            echo "Completed";
                                                            break;
                                                        case 'No':
                                                            echo "In Progress";
                                                            break;
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a id="btn_edit" href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#ModalEditBatch" data-id="<?= $obj['id'] ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a id="btn_delete" href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#ModalDeleteBatch" data-id="<?= $obj['id'] ?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Fabian Soto <?= date('Y') ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

       <!-- MODALES -->
        <!-- MODAL New Batch Record Entry -->
        <div class="modal fade" id="ModalAddBatch" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white"><i class="fa fa-file"></i> New WO Entry</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="BatchRecordForm_add" action="" method="POST">
                        <div class="modal-body">
                            <ul class="nav nav-tabs" id="batchTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="production-tab" data-toggle="tab" href="#production" role="tab">Production</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="qa-tab" data-toggle="tab" href="#qa" role="tab">QA</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-3">
                                <!-- Production Tab -->
                                <div class="tab-pane fade show active" id="production" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label" for="product_name">Product Name:</label>
                                            <input type="text" name="product_name" id="product_name" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label" for="lot_number">Work Order:</label>
                                            <input type="text" name="lot_number" id="lot_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row pt-15">
                                        <div class="col-sm-6">
                                            <label class="control-label" for="so_number">SO#:</label>
                                            <input type="text" name="so_number" id="so_number" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label" for="due_date">Due Date:</label>
                                            <!-- <input type="date" name="due_date" id="due_date" class="form-control"> -->
                                            <input type="text" name="due_date" id="due_date" class="form-control" placeholder="MM/DD/YYYY">
                                        </div>
                                    </div>
                                    <div class="row pt-15">
                                        <div class="col-sm-6">
                                            <label class="control-label" for="cases_amount">Amount of Cases/Pounds:</label>
                                            <input type="number" name="cases_amount" id="cases_amount" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label" for="folder_made_by">Folder made by:</label>
                                            <input type="text" name="folder_made_by" id="folder_made_by" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!-- QA Tab -->
                                <div class="tab-pane fade" id="qa" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label" for="qa_released_by">QA Released by:</label>
                                            <select name="qa_released_by" id="qa_released_by" class="form-control">
                                                <option value=''>Select QA</option>
                                                <?php
                                                    $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='QA'");
                                                    while ($row = mysqli_fetch_array($select)) {
                                                        $id = $row['id']; 
                                                        $nombres = $row['nombre'];
                                                        echo "<option value='$id'>$nombres</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label" for="base_complete">Base Complete:</label>
                                            <select name="base_complete" id="base_complete" class="form-control">
                                                <option value=''>Select Option</option>
                                                <option value='Yes'>Yes</option>
                                                <option value='No'>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row pt-15">
                                        <div class="col-sm-12">
                                            <label for="qa_notes">Notes:</label>
                                            <textarea class="form-control" id="qa_notes" name="qa_notes" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="pull-left MensajeModal"></div>
                            <input disabled id="SaveBatch" name="SaveBatch" class="btn btn-primary" type="submit" value="Save">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL Edit Equipment Log -->
        <div class="modal fade" id="ModalEditBatch" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white"><i class="fa fa-edit"></i> Edit WO <span id="idBatch_Editar"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="BatchRecordForm_edit" action="" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="llavegrabar" value="EDITAR_BatchRecord">
                            <input type="hidden" name="idBatchEdit" id="idBatchEdit">
                            <ul class="nav nav-tabs" id="batchTabsEdit" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="production-tab-edit" data-toggle="tab" href="#production-edit" role="tab">Production</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="qa-tab-edit" data-toggle="tab" href="#qa-edit" role="tab">QA</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-3">
                                <!-- Production Tab -->
                                <div class="tab-pane fade show active" id="production-edit" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label" for="product_name_edit">Product Name:</label>
                                            <input type="text" name="product_name_edit" id="product_name_edit" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label" for="lot_number_edit">Work Order:</label>
                                            <input type="text" name="lot_number_edit" id="lot_number_edit" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row pt-15">
                                        <div class="col-sm-6">
                                            <label class="control-label" for="so_number_edit">SO#:</label>
                                            <input type="text" name="so_number_edit" id="so_number_edit" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label" for="due_date_edit">Due Date:</label>
                                            <input type="text" name="due_date_edit" id="due_date_edit" class="form-control" placeholder="MM/DD/YYYY">
                                        </div>
                                    </div>
                                    <div class="row pt-15">
                                        <div class="col-sm-6">
                                            <label class="control-label" for="cases_amount_edit">Amount of Cases/Pounds:</label>
                                            <input type="number" name="cases_amount_edit" id="cases_amount_edit" class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label" for="folder_made_by_edit">Folder made by:</label>
                                            <input type="text" name="folder_made_by_edit" id="folder_made_by_edit" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!-- QA Tab -->
                                <div class="tab-pane fade" id="qa-edit" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label" for="qa_released_by_edit">QA Released by:</label>
                                            <select name="qa_released_by_edit" id="qa_released_by_edit" class="form-control">
                                                <option value=''>Select QA</option>
                                                <?php
                                                    $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='QA'");
                                                    while ($row = mysqli_fetch_array($select)) {
                                                        $id = $row['id']; 
                                                        $nombres = $row['nombre'];
                                                        echo "<option value='$id'>$nombres</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label" for="base_complete_edit">Base Complete:</label>
                                            <select name="base_complete_edit" id="base_complete_edit" class="form-control">
                                                <option value=''>Select Option</option>
                                                <option value='Yes'>Yes</option>
                                                <option value='No'>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row pt-15">
                                        <div class="col-sm-12">
                                            <label for="qa_notes_edit">Notes:</label>
                                            <textarea class="form-control" id="qa_notes_edit" name="qa_notes_edit" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="pull-left MensajeModal"></div>
                            <input disabled id="UpdateBatch" name="UpdateBatch" class="btn btn-primary" type="submit" value="Update">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- MODAL Delete Equipment Log -->
        <div class="modal fade" id="ModalDeleteBatch" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white"><i class="fa fa-trash"></i> Delete WO <span id="idBatch_Delete"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="BatchRecordForm_delete" action="" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="llavegrabar" value="Eliminar_BatchRecord">
                            <input type="hidden" name="idBatchDelete" id="idBatchDelete">
                            <ul class="nav nav-tabs" id="deleteBatchTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#delete_production" role="tab">Production</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#delete_qa" role="tab">QA</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-3">
                                <!-- Production Tab -->
                                <div class="tab-pane fade show active" id="delete_production" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Product Name:</label>
                                            <input type="text" id="delete_product_name" class="form-control" disabled>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Work Order:</label>
                                            <input type="text" id="delete_lot_number" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="row pt-15">
                                        <div class="col-sm-6">
                                            <label>SO#:</label>
                                            <input type="text" id="delete_so_number" class="form-control" disabled>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Due Date:</label>
                                            <input type="text" id="delete_due_date" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="row pt-15">
                                        <div class="col-sm-6">
                                            <label>Amount of Cases/Pounds:</label>
                                            <input type="text" id="delete_cases_amount" class="form-control" disabled>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Folder made by:</label>
                                            <input type="text" id="delete_folder_made_by" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>

                                <!-- QA Tab -->
                                <div class="tab-pane fade" id="delete_qa" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>QA Released by:</label>
                                            <label class="control-label" for="delete_qa_released_by">QA Released by:</label>
                                            <select name="delete_qa_released_by" id="delete_qa_released_by" class="form-control" disabled>
                                                <option value=''>Select QA</option>
                                                <?php
                                                    $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='QA'");
                                                    while ($row = mysqli_fetch_array($select)) {
                                                        $id = $row['id']; 
                                                        $nombres = $row['nombre'];
                                                        echo "<option value='$id'>$nombres</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Base Complete:</label>
                                            <input type="text" id="delete_base_complete" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="row pt-15">
                                        <div class="col-sm-12">
                                            <label>Notes:</label>
                                            <textarea class="form-control" id="delete_qa_notes" rows="3" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="delete_batch_id" name="delete_batch_id">
                        </div>
                        <div class="modal-footer">
                            <div class="pull-left MensajeModal"></div>
                            <button id="ConfirmDeleteBatch" type="submit" name="ConfirmDeleteBatch" class="btn btn-primary">Delete</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
                                                
    <?php 
        include 'php/logout_modal.php';
        include 'php/footer.php';
    }?>
<script src="assets/js/crud_batch_records.js"></script>
