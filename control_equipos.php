<?php 
    require 'php/connect_bd.php';
    session_start();
    $active='control_equipos';

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
                                case 'EDITAR_Permiso':
                                    $idPermisoEditar = $_REQUEST['idPermisoEditar'];
                                    $motivo_edit = $_REQUEST['motivo_edit'];
                                    $empleado_edit = $_REQUEST['empleado_edit'];
                                    $jefatura_edit = $_REQUEST['jefatura_edit'];
                                    $dias_edit = $_REQUEST['dias_edit'];
                                    $descripcion_edit = $_REQUEST['descripcion_edit'];
    
                                    $sqledit = "UPDATE permisos SET motivo ='$motivo_edit', empleado = '$empleado_edit', jefatura = '$jefatura_edit', dias = '$dias_edit', descripcion = '$descripcion_edit' WHERE id = '$idPermisoEditar'";
                                    $conexion->query($sqledit);
                                    break;
                                case 'Eliminar_Permiso':
                                    $idPermisoEliminar = $_REQUEST['idPermisoEliminar'];

                                    $sqldelete = "DELETE FROM permisos WHERE id = '$idPermisoEliminar'";
                                    $conexion->query($sqldelete);
                                    break;
                            }
                        ?>


                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Control de Equipos</h1>

                        <?php 
                            $consulta = "SELECT p.id, motivo, u2.nombre 'empleado',u.nombre 'jefatura', dias, descripcion FROM permisos p INNER JOIN usuarios u ON u.id = p.jefatura INNER JOIN usuarios u2 ON u2.id=p.empleado;";
                            $ejecucion = mysqli_query($conexion, $consulta);
                        ?>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-11">
                                        <h6 class="m-0 font-weight-bold text-primary mb-2">Tabla de Permisos</h6>
                                        <?php include 'php/insert_permisos.php';?>
                                    </div>
                                    <div class="col-1">
                                        <button type="submit" id="addpermiso" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalAddPermiso"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Motivo</th>
                                                <th>Empleado</th>
                                                <th>Jefatura</th>
                                                <th>Días de permiso</th>
                                                <th>Descripción</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Motivo</th>
                                                <th>Jefatura</th>
                                                <th>Empleado</th>
                                                <th>Días de permiso</th>
                                                <th>Descripción</th>
                                                <th>Acción</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php while($obj = mysqli_fetch_array($ejecucion)):?>
                                                <tr>
                                                    <td><?= $obj['id']?></td>
                                                    <td><?php 
                                                        switch ($obj['motivo']) {
                                                            case 1:
                                                                echo "Vacaciones";
                                                                break;
                                                            case 2:
                                                                echo "Asuntos Personales";
                                                                break;
                                                            case 3:
                                                                echo "Enfermedad";
                                                                break;
                                                        }
                                                    ?></td>
                                                    <td><?= $obj['jefatura']?></td>
                                                    <td><?= $obj['empleado']?></td>
                                                    <td><?= $obj['dias']?></td>
                                                    <td><?= $obj['descripcion']?></td>
                                                    <td>
                                                    <a id="btn_edit" href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#ModalEditPermiso" data-id="<?= $obj['id']?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a id="btn_delete" href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#ModalDeletePermiso" data-id="<?= $obj['id']?>">
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
        <!-- MODAL AGREGAR PERMISO -->
        <div class="modal fade" id="ModalAddPermiso" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-file"></i> Ingreso de Permiso</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="permisoForm_add" action="" method="POST">
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="motivo">Motivo:</label>
                                <select name="motivo" id="motivo" class="form-control" >
                                    <option value=''>Indique Motivo</option>
                                    <option value='1'>Vacaciones</option>
                                    <option value='2'>Asuntos Personales</option>
                                    <option value='3'>Enfermedad</option>
                                </select>
                            </div>      
                            <div class="col-sm-6">
                                <label class="control-label" for="jefatura">Jefatura:</label>
                                <select name="jefatura" id="jefatura" class="form-control" >
                                    <option value=''>Indique Jefatura</option>
                                    <?php
                                        $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='gerente'");
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
                                <label class="control-label" for="empleado">Empleado:</label>
                                <select name="empleado" id="empleado" class="form-control" >
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
                                <label class="control-label" for="dias">Días de Permiso:</label>
                                <input type="number" name="dias" id="dias" class="form-control" onpaste="return false;" min="0" max="4">
                            </div>                             
                        </div>  
                        <div class="row pt-15">
                            <div class="col-sm-12">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left MensajeModal"></div>
                        <input disabled id="GuardarPermiso" name="GuardarPermiso" class="btn btn-primary" type="submit" value="Grabar">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- MODAL EDITAR Permiso -->
        <div class="modal fade" id="ModalEditPermiso" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-edit"></i> Editar Permiso <span id="idPermiso_Editar"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="permisoForm_edit" action="" method="POST">
                            <input type="hidden" name="llavegrabar" value="EDITAR_Permiso">
                            <input type="hidden" name="idPermisoEditar" id="idPermisoEditar">
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="motivo_edit">Motivo:</label>
                                    <select name="motivo_edit" id="motivo_edit" class="form-control" >
                                        <option value=''>Indique Motivo</option>
                                        <option value='1'>Vacaciones</option>
                                        <option value='2'>Asuntos Personales</option>
                                        <option value='3'>Enfermedad</option>
                                    </select>
                                </div>      
                                <div class="col-sm-6">
                                    <label class="control-label" for="jefatura_edit">Jefatura:</label>
                                    <select name="jefatura_edit" id="jefatura_edit" class="form-control" >
                                        <option value=''>Indique Jefatura</option>
                                        <?php
                                            $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='gerente'");
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
                                    <label class="control-label" for="empleado_edit">Empleado:</label>
                                    <select name="empleado_edit" id="empleado_edit" class="form-control" >
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
                                    <label class="control-label" for="dias_edit">Días de Permiso:</label>
                                    <input type="number" name="dias_edit" id="dias_edit" class="form-control" onpaste="return false;" min="0" max="4">
                                </div>                             
                            </div>  
                            <div class="row pt-15">
                                <div class="col-sm-12">
                                    <label for="descripcion_edit">Descripción:</label>
                                    <textarea class="form-control" id="descripcion_edit" name="descripcion_edit" rows="3"></textarea>
                                </div>
                            </div>                            
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left MensajeModal"></div>
                        <input disabled id="EditarPermiso" name="EditarPermiso" class="btn btn-primary" type="submit" value="Editar">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- MODAL ELIMINAR PERMISO -->
        <div class="modal fade" id="ModalDeletePermiso" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-trash"></i> Eliminar Permiso <span id="idPermiso_Delete"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="permisoForm_delete" action="" method="POST">
                            <input type="hidden" name="llavegrabar" value="Eliminar_Permiso">
                            <input type="hidden" name="idPermisoEliminar" id="idPermisoEliminar">
                            <div class="row pt-15">
                                <div class="col-sm-6">
                                    <label class="control-label" for="motivo_delete">Motivo:</label>
                                    <select name="motivo_delete" id="motivo_delete" class="form-control"  disabled>
                                        <option value=''>Indique Motivo</option>
                                        <option value='1'>Vacaciones</option>
                                        <option value='2'>Asuntos Personales</option>
                                        <option value='3'>Enfermedad</option>
                                    </select>
                                </div>      
                                <div class="col-sm-6">
                                    <label class="control-label" for="jefatura_delete">Jefatura:</label>
                                    <select name="jefatura_delete" id="jefatura_delete" class="form-control"  disabled>
                                        <option value=''>Indique Jefatura</option>
                                        <?php
                                            $select = $conexion->query("SELECT id, nombre FROM usuarios WHERE rol='gerente'");
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
                                    <label class="control-label" for="empleado_delete">Empleado:</label>
                                    <select name="empleado_delete" id="empleado_delete" class="form-control" disabled>
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
                                    <label class="control-label" for="dias_delete">Días de Permiso:</label>
                                    <input type="number" name="dias_delete" id="dias_delete" class="form-control" onpaste="return false;" min="0" max="4" disabled>
                                </div>                             
                            </div>  
                            <div class="row pt-15">
                                <div class="col-sm-12">
                                    <label for="descripcion_delete">Descripción:</label>
                                    <textarea class="form-control" id="descripcion_delete" name="descripcion_delete" rows="3" disabled></textarea>
                                </div>
                            </div>                        
                    </div>
                    <div class="modal-footer">
                        <input id="EliminarPermiso" name="EliminarPermiso" class="btn btn-danger" type="submit" value="Eliminar">
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
    <script src="assets/js/crud_control_equipos.js"></script>