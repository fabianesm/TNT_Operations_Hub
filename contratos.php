<?php 
    require 'php/connect_bd.php';
    session_start();
    $active='contratos';

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
                                case 'EDITAR_Contrato':
                                    $idContratoEditar = $_REQUEST['idContratoEditar'];
                                    $empleado_edit = $_REQUEST['empleado_edit'];
                                    $tipo_contrato_edit = $_REQUEST['tipo_contrato_edit'];
                                    $tipo_prestacion_edit = $_REQUEST['tipo_prestacion_edit'];
                                    $sueldo_edit = $_REQUEST['sueldo_edit'];
                                    $moneda_edit = $_REQUEST['moneda_edit'];
    
                                    $sqledit = "UPDATE contratos SET empleado ='$empleado_edit', tipo_contrato = '$tipo_contrato_edit', tipo_prestacion = '$tipo_prestacion_edit', sueldo = '$sueldo_edit', moneda = '$moneda_edit' WHERE id = '$idContratoEditar'";
                                    $conexion->query($sqledit);
                                    break;
                                case 'Eliminar_Contrato':
                                    $idContratoEliminar = $_REQUEST['idContratoEliminar'];

                                    $sqldelete = "DELETE FROM contratos WHERE id = '$idContratoEliminar'";
                                    $conexion->query($sqldelete);
                                    break;
                            }
                        ?>


                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Contratos</h1>

                        <?php 
                            $consulta = "SELECT c.id, empleado, u.nombre, tipo_contrato, tipo_prestacion, sueldo, moneda FROM contratos c INNER JOIN usuarios u ON u.id=c.empleado;";
                            $ejecucion = mysqli_query($conexion, $consulta);
                        ?>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-11">
                                        <h6 class="m-0 font-weight-bold text-primary mb-2">Tabla de Contratos</h6>
                                        <?php include 'php/insert_contratos.php';?>
                                    </div>
                                    <div class="col-1">
                                        <button type="submit" id="addcontrato" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalAddContrato"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Empleado</th>
                                                <th>Tipo de Contrato</th>
                                                <th>Tipo de Prestación</th>
                                                <th>Sueldo</th>
                                                <th>Moneda</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Empleado</th>
                                                <th>Tipo de Contrato</th>
                                                <th>Tipo de Prestación</th>
                                                <th>Sueldo</th>
                                                <th>Moneda</th>
                                                <th>Acción</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php while($obj = mysqli_fetch_array($ejecucion)):?>
                                                <tr>
                                                    <td><?= $obj['id']?></td>
                                                    <td><?= $obj['nombre']?></td>
                                                    <td><?php 
                                                        switch ($obj['tipo_contrato']) {
                                                            case 1:
                                                                echo "Contrato Indefinido";
                                                                break;
                                                            case 2:
                                                                echo "Contrato a Plazo Fijo";
                                                                break;
                                                        }
                                                    ?></td>
                                                    <td><?php 
                                                        switch ($obj['tipo_prestacion']) {
                                                            case 1:
                                                                echo "Indefinido";
                                                                break;
                                                            case 2:
                                                                echo "Contra Hito";
                                                                break;
                                                        }
                                                    ?></td>
                                                    <td><?= "$".number_format($obj['sueldo'], 0, ",", ".");?></td>
                                                    <td><?php 
                                                        switch ($obj['moneda']) {
                                                            case 1:
                                                                echo "CLP";
                                                                break;
                                                            case 2:
                                                                echo "USD";
                                                                break;
                                                            case 3:
                                                                echo "EUR";
                                                                break;
                                                        }
                                                    ?></td>
                                                    <td>
                                                    <a id="btn_edit" href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#ModalEditContrato" data-id="<?= $obj['id']?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a id="btn_delete" href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#ModalDeleteContrato" data-id="<?= $obj['id']?>">
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
        <!-- MODAL AGREGAR CONTRATO -->
        <div class="modal fade" id="ModalAddContrato" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-file"></i> Ingreso de Contrato</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="contratoForm_add" action="" method="POST">
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="empleado">Empleado:</label>
                                <select name="empleado" id="empleado" class="form-control" style="">
                                    <option value=''>Indique Empleado</option>
                                    <?php
                                        $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='empleado'");
                                        while ($row = mysqli_fetch_array($select)) {
                                            $id = $row['id']; 
                                            $nombres = $row['nombre'];
                                                
                                            echo "<option value='$id'>$nombres</option>";
                                        }
                                    ?>
                                </select>
                            </div>                              
                            <div class="col-sm-6">
                                <label class="control-label" for="tipo_contrato">Tipo de Contrato:</label>
                                <select name="tipo_contrato" id="tipo_contrato" class="form-control" style="">
                                    <option value=''>Indique Tipo</option>
                                    <option value='1'>Contrato Indefinido</option>
                                    <option value='2'>Contrato a Plazo Fijo</option>
                                </select>
                            </div>                                
                        </div>
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="tipo_prestacion">Tipo de Prestación:</label>
                                <select name="tipo_prestacion" id="tipo_prestacion" class="form-control" style="">
                                    <option value=''>Indique Tipo</option>
                                    <option value='1'>Indefinido</option>
                                    <option value='2'>Contra Hito</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="sueldo">Sueldo:</label>
                                <input type="number" name="sueldo" id="sueldo" class="form-control" onpaste="return false;" min="0">
                            </div>                             
                        </div>  
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="moneda">Moneda:</label>
                                <select name="moneda" id="moneda" class="form-control" style="">
                                    <option value=''>Indique Moneda</option>
                                    <option value='1'>CLP</option>
                                    <option value='2'>USD</option>
                                    <option value='2'>EUR</option>
                                </select>
                            </div>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <input disabled id="GuardarContrato" name="GuardarContrato" class="btn btn-primary" type="submit" value="Grabar">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- MODAL EDITAR CONTRATO -->
        <div class="modal fade" id="ModalEditContrato" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-edit"></i> Editar Contrato <span id="idContrato_Editar"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="contratoForm_edit" action="" method="POST">
                            <input type="hidden" name="llavegrabar" value="EDITAR_Contrato">
                            <input type="hidden" name="idContratoEditar" id="idContratoEditar">
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="empleado_edit">Empleado:</label>
                                    <select name="empleado_edit" id="empleado_edit" class="form-control" style="">
                                        <option value=''>Indique Empleado</option>
                                        <?php
                                            $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='empleado'");
                                            while ($row = mysqli_fetch_array($select)) {
                                                $id = $row['id']; 
                                                $nombres = $row['nombre'];
                                                    
                                                echo "<option value='$id'>$nombres</option>";
                                            }
                                        ?>
                                    </select>
                                </div>                              
                                <div class="col-sm-6">
                                    <label class="control-label" for="tipo_contrato_edit">Tipo de Contrato:</label>
                                    <select name="tipo_contrato_edit" id="tipo_contrato_edit" class="form-control" style="">
                                        <option value=''>Indique Tipo</option>
                                        <option value='1'>Contrato Indefinido</option>
                                        <option value='2'>Contrato a Plazo Fijo</option>
                                    </select>
                                </div>                                
                            </div>
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="tipo_prestacion_edit">Tipo de Prestación:</label>
                                    <select name="tipo_prestacion_edit" id="tipo_prestacion_edit" class="form-control" style="">
                                        <option value=''>Indique Tipo</option>
                                        <option value='1'>Indefinido</option>
                                        <option value='2'>Contra Hito</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label" for="sueldo_edit">Sueldo:</label>
                                    <input type="number" name="sueldo_edit" id="sueldo_edit" class="form-control" onpaste="return false;" min="0">
                                </div>                             
                            </div>  
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="moneda_edit">Moneda:</label>
                                    <select name="moneda_edit" id="moneda_edit" class="form-control" style="">
                                        <option value=''>Indique Moneda</option>
                                        <option value='1'>CLP</option>
                                        <option value='2'>USD</option>
                                        <option value='2'>EUR</option>
                                    </select>
                                </div>
                            </div>                          
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left MensajeModal"></div>
                        <input disabled id="EditarContrato" name="EditarContrato" class="btn btn-primary" type="submit" value="Editar">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- MODAL ELIMINAR CONTRATO -->
        <div class="modal fade" id="ModalDeleteContrato" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-trash"></i> Eliminar Contrato <span id="idContrato_Delete"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="contratoForm_delete" action="" method="POST">
                            <input type="hidden" name="llavegrabar" value="Eliminar_Contrato">
                            <input type="hidden" name="idContratoEliminar" id="idContratoEliminar">
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="empleado_delete">Empleado:</label>
                                    <select name="empleado_delete" id="empleado_delete" class="form-control" style="" disabled>
                                        <option value=''>Indique Empleado</option>
                                        <?php
                                            $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='empleado'");
                                            while ($row = mysqli_fetch_array($select)) {
                                                $id = $row['id']; 
                                                $nombres = $row['nombre'];
                                                    
                                                echo "<option value='$id'>$nombres</option>";
                                            }
                                        ?>
                                    </select>
                                </div>                              
                                <div class="col-sm-6">
                                    <label class="control-label" for="tipo_contrato_delete">Tipo de Contrato:</label>
                                    <select name="tipo_contrato_delete" id="tipo_contrato_delete" class="form-control" style="" disabled>
                                        <option value=''>Indique Tipo</option>
                                        <option value='1'>Contrato Indefinido</option>
                                        <option value='2'>Contrato a Plazo Fijo</option>
                                    </select>
                                </div>                                
                            </div>
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="tipo_prestacion_delete">Tipo de Prestación:</label>
                                    <select name="tipo_prestacion_delete" id="tipo_prestacion_delete" class="form-control" style="" disabled>
                                        <option value=''>Indique Tipo</option>
                                        <option value='1'>Indefinido</option>
                                        <option value='2'>Contra Hito</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label" for="sueldo_delete">Sueldo:</label>
                                    <input type="number" name="sueldo_delete" id="sueldo_delete" class="form-control" onpaste="return false;" min="0" disabled>
                                </div>                             
                            </div>  
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="moneda_delete">Moneda:</label>
                                    <select name="moneda_delete" id="moneda_delete" class="form-control" style="" disabled>
                                        <option value=''>Indique Moneda</option>
                                        <option value='1'>CLP</option>
                                        <option value='2'>USD</option>
                                        <option value='2'>EUR</option>
                                    </select>
                                </div>
                            </div>                          
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left MensajeModal"></div>
                        <input id="EliminarContrato" name="EliminarContrato" class="btn btn-danger" type="submit" value="Eliminar">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
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
    <script src="assets/js/crud_contratos.js"></script>