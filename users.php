<?php 
    require 'php/connect_bd.php';
    session_start();
    $active='usuariosC';
    $allowed_roles = ['Administrator'];

    // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['id'])){
        header("location: index.php");
        exit();
    } 
    if (!in_array($_SESSION['rol'], $allowed_roles)) {
    header("location: index.php");
    exit();
    }
    else{
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
                                case 'EDITAR_Usuario':
                                    $idUserEditar = $_REQUEST['idUserEditar'];
                                    $nombre_edit = $_REQUEST['nombre_completo_edit'];
                                    $correo_edit = $_REQUEST['correo_edit'];
                                    $usuario_edit = $_REQUEST['usuario_edit'];
                                    $rol_user_edit = $_REQUEST['rol_user_edit'];
                                    $contrasena_edit = hash('sha512', $_REQUEST['contrasena_edit']);
    
                                    $sqledit1 = "UPDATE usuarios SET nombre ='$nombre_edit', correo = '$correo_edit', usuario = '$usuario_edit', rol = '$rol_user_edit', contrasena = '$contrasena_edit' WHERE id = '$idUserEditar'";
                                    $conexion->query($sqledit1);
                                    
                                    $sqledit2 = "UPDATE cambio_usuario_contrasena SET usuario = '$usuario_edit', contrasena = '$contrasena_edit' WHERE id_usuario = '$idUserEditar' AND ciclo = (SELECT MAX(ciclo) FROM cambio_usuario_contrasena WHERE id_usuario = '$idUserEditar')";
                                    $conexion->query($sqledit2);
                                    break;
                                case 'Eliminar_Usuario':
                                    $idUserEliminar = $_REQUEST['idUserEliminar'];

                                    $sqldelete = "DELETE FROM usuarios WHERE id = '$idUserEliminar'";
                                    $conexion->query($sqldelete);
                                    break;
                            }
                        ?>


                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Users</h1>

                        <?php 
                            $consulta = "SELECT id, nombre, correo, usuario, rol FROM usuarios";
                            $ejecucion = mysqli_query($conexion, $consulta);
                        ?>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-11">
                                        <h6 class="m-0 font-weight-bold text-primary mb-2">Users Table</h6>
                                        <?php include 'php/insert_user.php';?>
                                    </div>
                                    <div class="col-1">
                                        <button type="submit" id="adduser" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalAddUser"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($obj = mysqli_fetch_array($ejecucion)):?>
                                                <tr>
                                                    <td><?= $obj['id']?></td>
                                                    <td><?= $obj['nombre']?></td>
                                                    <td><?= $obj['correo']?></td>
                                                    <td><?= $obj['usuario']?></td>
                                                    <td><?= $obj['rol']?></td>
                                                    <td>
                                                    <a id="btn_edit" href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#ModalEditUser" data-id="<?= $obj['id']?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a id="btn_delete" href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#ModalDeleteUser" data-id="<?= $obj['id']?>">
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
        <!-- MODAL AGREGAR USUARIO -->
        <div class="modal fade" id="ModalAddUser" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-file"></i> User Registration</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="usuarioForm_add" action="" method="POST">
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="nombre_completo">Full Name:</label>
                                <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" onpaste="return false;">
                            </div>                               
                            <div class="col-sm-6">
                                <label class="control-label" for="correo">Email Address:</label>
                                <input type="text" name="correo" id="correo" class="form-control" onpaste="return false;">
                            </div>                               
                        </div>
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="usuario">Username:</label>
                                <input type="text" name="usuario" id="usuario" class="form-control" onpaste="return false;">
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="rol_user">Role Type:</label>
                                <select name="rol_user" id="rol_user" class="form-control" style="">
                                    <option value=''>SELECT ROLE</option>
                                    <option value='Administrator'>Administrator</option>
                                    <option value='Employee'>Employee</option>
                                    <option value='Operations'>Operations</option>
                                    <option value='Production'>Production</option>
                                    <option value='PCQI'>PCQI</option>
                                    <option value='Compliance'>Compliance</option>
                                    <option value='QA'>QA</option>
                                </select>
                            </div>                               
                        </div>  
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="contrasena">Password:</label>
                                <input type="text" name="contrasena" id="contrasena" class="form-control" onpaste="return false;">
                            </div> 
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <input disabled id="GuardarUsuario" name="GuardarUsuario" class="btn btn-primary" type="submit" value="Save">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- MODAL EDITAR USUARIO -->
        <div class="modal fade" id="ModalEditUser" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-edit"></i> Edit User <span id="idUsuario_Editar"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="usuarioForm_edit" action="" method="POST">
                            <input type="hidden" name="llavegrabar" value="EDITAR_Usuario">
                            <input type="hidden" name="idUserEditar" id="idUserEditar">
                            <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="nombre_completo_edit">Full Name:</label>
                                <input type="text" name="nombre_completo_edit" id="nombre_completo_edit" class="form-control" onpaste="return false;">
                            </div>                               
                            <div class="col-sm-6">
                                <label class="control-label" for="correo_edit">Email Address:</label>
                                <input type="text" name="correo_edit" id="correo_edit" class="form-control" onpaste="return false;">
                            </div>                               
                        </div>
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="usuario_edit">Username:</label>
                                <input type="text" name="usuario_edit" id="usuario_edit" class="form-control" onpaste="return false;">
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="rol_user_edit">Role Type:</label>
                                <select name="rol_user_edit" id="rol_user_edit" class="form-control" style="">
                                    <option value=''>SELECT ROLE</option>
                                    <option value='Administrator'>Administrator</option>
                                    <option value='Employee'>Employee</option>
                                    <option value='Operations'>Operations</option>
                                    <option value='Production'>Production</option>
                                    <option value='PCQI'>PCQI</option>
                                    <option value='Compliance'>Compliance</option>
                                    <option value='QA'>QA</option>
                                </select>
                            </div>                               
                        </div>  
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="contrasena_edit">Password:</label>
                                <input type="password" name="contrasena_edit" id="contrasena_edit" class="form-control" onpaste="return false;">
                            </div> 
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left MensajeModal"></div>
                        <input disabled id="EditarUsuario" name="EditarUsuario" class="btn btn-primary" type="submit" value="Update">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- MODAL ELIMINAR USUARIO -->
        <div class="modal fade" id="ModalDeleteUser" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" ><i class="fa fa-trash"></i> Delete User <span id="idUsuario_Delete"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="usuarioForm_delete" action="" method="POST">
                            <input type="hidden" name="llavegrabar" value="Eliminar_Usuario">
                            <input type="hidden" name="idUserEliminar" id="idUserEliminar">
                            <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="nombre_completo_delete">Full Name:</label>
                                <input type="text" name="nombre_completo_delete" id="nombre_completo_delete" class="form-control" onpaste="return false;" disabled>
                            </div>                               
                            <div class="col-sm-6">
                                <label class="control-label" for="correo_delete">Email Address:</label>
                                <input type="text" name="correo_delete" id="correo_delete" class="form-control" onpaste="return false;" disabled>
                            </div>                               
                        </div>
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="usuario_delete">Username:</label>
                                <input type="text" name="usuario_delete" id="usuario_delete" class="form-control" onpaste="return false;" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="rol_user_delete">Role Type:</label>
                                <select name="rol_user_delete" id="rol_user_delete" class="form-control" style="" disabled>
                                    <option value=''>SELECT ROLE</option>
                                    <option value='Administrator'>Administrator</option>
                                    <option value='Employee'>Employee</option>
                                    <option value='Operations'>Operations</option>
                                    <option value='Production'>Production</option>
                                    <option value='PCQI'>PCQI</option>
                                    <option value='Compliance'>Compliance</option>
                                    <option value='QA'>QA</option>
                                </select>
                            </div>                               
                        </div>  
                        <div class="row pt-15">
                            <div class="col-sm-6">
                                <label class="control-label" for="contrasena_delete">Password:</label>
                                <input type="password" name="contrasena_delete" id="contrasena_delete" class="form-control" onpaste="return false;" disabled>
                            </div> 
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <div class="pull-left MensajeModal"></div>
                        <input id="EliminarUsuario" name="EliminarUsuario" class="btn btn-danger" type="submit" value="Delete">
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
    <script src="assets/js/crud_users.js"></script>