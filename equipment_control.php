<?php 
    require 'php/connect_bd.php';
    session_start();
    $active='equipment_control';

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
                            $keyVal = (!isset($_REQUEST['llavegrabar'])) ? $llavegrabar = "none" : $llavegrabar = $_REQUEST['llavegrabar'];
                            switch ($llavegrabar) {
                                case 'EDITAR_Equipment':
                                    $idEquipmentEditar = $_REQUEST['idEquipmentEditar'];
                                    $EquipmentType_edit = $_REQUEST['EquipmentType_edit'];
                                    $empleado_edit = $_REQUEST['empleado_edit'];
                                    $supervisor_edit = $_REQUEST['supervisor_edit'];
                                    $status_edit = $_REQUEST['status_edit'];
                                    $descripcion_edit = $_REQUEST['descripcion_edit'];
    
                                    $sqledit = "UPDATE permisos SET motivo ='$EquipmentType_edit', empleado = '$empleado_edit', jefatura = '$supervisor_edit', dias = '$status_edit', descripcion = '$descripcion_edit' WHERE id = '$idEquipmentEditar'";
                                    $conexion->query($sqledit);
                                    break;
                                case 'Eliminar_Equipment':
                                    $idEquipmentEliminar = $_REQUEST['idEquipmentEliminar'];

                                    $sqldelete = "DELETE FROM permisos WHERE id = '$idEquipmentEliminar'";
                                    $conexion->query($sqldelete);
                                    break;
                            }
                        ?>


                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Equipment Control</h1>

                        <?php 
                            $consulta = "SELECT p.id, motivo, u2.nombre 'empleado',u.nombre 'jefatura', dias, descripcion FROM permisos p INNER JOIN usuarios u ON u.id = p.jefatura INNER JOIN usuarios u2 ON u2.id=p.empleado;";
                            $ejecucion = mysqli_query($conexion, $consulta);
                        ?>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-11">
                                        <h6 class="m-0 font-weight-bold text-primary mb-2">Equipment Log</h6>
                                        <?php include 'php/insert_equipment.php';?>
                                    </div>
                                    <div class="col-1">
                                        <button type="submit" id="addpermiso" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalAddEquipment"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Equipment Type</th>
                                                <th>Employee</th>
                                                <th>Supervisor</th>
                                                <th>Status</th>
                                                <th>Comments</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($obj = mysqli_fetch_array($ejecucion)):?>
                                                <tr>
                                                    <td><?= $obj['id']?></td>
                                                    <td><?php 
                                                        switch ($obj['motivo']) {
                                                            case 1:
                                                                echo "Scanner";
                                                                break;
                                                            case 2:
                                                                echo "Knife";
                                                                break;
                                                        }
                                                    ?></td>
                                                    <td><?= $obj['empleado']?></td>
                                                    <td><?= $obj['jefatura']?></td>
                                                    <td><?php 
                                                        switch ($obj['dias']) {
                                                            case 1:
                                                                echo "Assigned";
                                                                break;
                                                            case 2:
                                                                echo "Returned";
                                                                break;
                                                        }
                                                    ?></td>
                                                    <td><?= $obj['descripcion']?></td>
                                                    <td>
                                                    <a id="btn_edit" href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#ModalEditEquipment" data-id="<?= $obj['id']?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a id="btn_delete" href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#ModalDeleteEquipment" data-id="<?= $obj['id']?>">
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
        <!-- MODAL New Equipment Entry -->
        <div class="modal fade" id="ModalAddEquipment" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-file"></i> New Equipment Entry</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="EquipmentForm_add" action="" method="POST">
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="EquipmentType">Equipment Type:</label>
                                <select name="EquipmentType" id="EquipmentType" class="form-control" >
                                    <option value=''>Select Equipment</option>
                                    <option value='1'>Scanner</option>
                                    <option value='2'>Knife</option>
                                </select>
                            </div>      
                            <div class="col-sm-6">
                                <label class="control-label" for="supervisor_form">Supervisor:</label>
                                <select name="supervisor_form" id="supervisor_form" class="form-control" >
                                    <option value=''>Select Supervisor</option>
                                    <?php
                                        $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='Production'");
                                        while ($row = mysqli_fetch_array($select)) {
                                            $id = $row['id']; 
                                            $nombres = $row['nombre'];
                                                
                                            echo "<option value='$id'>$nombres</option>";
                                        }
                                    ?>
                                </select>
                            </div>                                                        
                        </div>
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="empleado">Employee:</label>
                                <select name="empleado" id="empleado" class="form-control" >
                                    <option value=''>Select Employee</option>
                                    <?php
                                        $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='Employee'");
                                        while ($row = mysqli_fetch_array($select)) {
                                            $id = $row['id']; 
                                            $nombres = $row['nombre'];
                                                
                                            echo "<option value='$id'>$nombres</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="status">Status:</label>
                                <select name="status" id="status" class="form-control" >
                                    <option value=''>Select Status</option>
                                    <option value='1'>Assigned</option>
                                    <option value='2'>Returned</option>
                                </select>
                            </div>                             
                        </div>  
                        <div class="row pt-15">
                            <div class="col-sm-12">
                                <label for="descripcion">Comments:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left MensajeModal"></div>
                        <input disabled id="SaveEquipment" name="SaveEquipment" class="btn btn-primary" type="submit" value="Save">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- MODAL Edit Equipment Log -->
        <div class="modal fade" id="ModalEditEquipment" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-edit"></i> Edit Equipment Log <span id="idEquipment_Editar"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="EquipmentForm_edit" action="" method="POST">
                            <input type="hidden" name="llavegrabar" value="EDITAR_Equipment">
                            <input type="hidden" name="idEquipmentEditar" id="idEquipmentEditar">
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="EquipmentType_edit">Equipment Type:</label>
                                    <select name="EquipmentType_edit" id="EquipmentType_edit" class="form-control" >
                                        <option value=''>Select Equipment</option>
                                        <option value='1'>Scanner</option>
                                        <option value='2'>Knife</option>
                                    </select>
                                </div>      
                                <div class="col-sm-6">
                                    <label class="control-label" for="supervisor_edit">Supervisor:</label>
                                    <select name="supervisor_edit" id="supervisor_edit" class="form-control" >
                                        <option value=''>Select Supervisor</option>
                                        <?php
                                            $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='Production'");
                                            while ($row = mysqli_fetch_array($select)) {
                                                $id = $row['id']; 
                                                $nombres = $row['nombre'];
                                                    
                                                echo "<option value='$id'>$nombres</option>";
                                            }
                                        ?>
                                    </select>
                                </div>                                                        
                            </div>
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="empleado_edit">Employee:</label>
                                    <select name="empleado_edit" id="empleado_edit" class="form-control" >
                                        <option value=''>Select Employee</option>
                                        <?php
                                            $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='Employee'");
                                            while ($row = mysqli_fetch_array($select)) {
                                                $id = $row['id']; 
                                                $nombres = $row['nombre'];
                                                    
                                                echo "<option value='$id'>$nombres</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label" for="status_edit">Status:</label>
                                    <select name="status_edit" id="status_edit" class="form-control" >
                                        <option value=''>Select Status</option>
                                        <option value='1'>Assigned</option>
                                        <option value='2'>Returned</option>
                                    </select>
                                </div>                             
                            </div>  
                            <div class="row pt-15">
                                <div class="col-sm-12">
                                    <label for="descripcion_edit">Comments:</label>
                                    <textarea class="form-control" id="descripcion_edit" name="descripcion_edit" rows="3"></textarea>
                                </div>
                            </div>                            
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left MensajeModal"></div>
                        <input disabled id="EditarEquipment" name="EditarEquipment" class="btn btn-primary" type="submit" value="Update">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- MODAL Delete Equipment Log -->
        <div class="modal fade" id="ModalDeleteEquipment" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-trash"></i> Delete Equipment Log <span id="idEquipment_Delete"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="EquipmentForm_delete" action="" method="POST">
                            <input type="hidden" name="llavegrabar" value="Eliminar_Equipment">
                            <input type="hidden" name="idEquipmentEliminar" id="idEquipmentEliminar">
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="EquipmentType_delete">Equipment Type:</label>
                                    <select name="EquipmentType_delete" id="EquipmentType_delete" class="form-control"  disabled>
                                        <option value=''>Select Equipment</option>
                                        <option value='1'>Scanner</option>
                                        <option value='2'>Knife</option>
                                    </select>
                                </div>      
                                <div class="col-sm-6">
                                    <label class="control-label" for="supervisor_delete">Supervisor:</label>
                                    <select name="supervisor_delete" id="supervisor_delete" class="form-control"  disabled>
                                        <option value=''>Select Supervisor</option>
                                        <?php
                                            $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='Production'");
                                            while ($row = mysqli_fetch_array($select)) {
                                                $id = $row['id']; 
                                                $nombres = $row['nombre'];
                                                    
                                                echo "<option value='$id'>$nombres</option>";
                                            }
                                        ?>
                                    </select>
                                </div>                                                        
                            </div>
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="empleado_delete">Employee:</label>
                                    <select name="empleado_delete" id="empleado_delete" class="form-control" disabled>
                                        <option value=''>Select Employee</option>
                                        <?php
                                            $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='Employee'");
                                            while ($row = mysqli_fetch_array($select)) {
                                                $id = $row['id']; 
                                                $nombres = $row['nombre'];
                                                    
                                                echo "<option value='$id'>$nombres</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label" for="status_delete">Status:</label>
                                    <select name="status_delete" id="status_delete" class="form-control" disabled>
                                        <option value=''>Select Status</option>
                                        <option value='1'>Assigned</option>
                                        <option value='2'>Returned</option>
                                    </select>
                                </div>                             
                            </div>  
                            <div class="row pt-15">
                                <div class="col-sm-12">
                                    <label for="descripcion_delete">Comments:</label>
                                    <textarea class="form-control" id="descripcion_delete" name="descripcion_delete" rows="3" disabled></textarea>
                                </div>
                            </div>                        
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left MensajeModal"></div>
                        <input id="EliminarEquipment" name="EliminarEquipment" class="btn btn-danger" type="submit" value="Delete">
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
    <script src="assets/js/crud_equipment_control.js"></script>