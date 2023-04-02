<?php
    require 'php/connect_bd.php';
    session_start();
    $active='home';

    if (isset($_SESSION['id'])) : 
        include 'php/header.php';
?>
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

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Inicio</h1>
                        </div>

                        <!-- Content Row -->
                        <div class="row">
                            <!-- Usuarios Card Example -->
                            <?php 
                            $consulta = "SELECT count(*) AS cantidad FROM usuarios";
                            $ejecucion = mysqli_query($conexion, $consulta);
                            $obj = mysqli_fetch_array($ejecucion);
                            if($_SESSION['rol']=="admin"):
                            ?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Usuarios</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $obj['cantidad']?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif?>

                            <!-- productos Card Example -->
                            <?php 
                            $consulta = "SELECT count(*) AS cantidad FROM contratos";
                            $ejecucion = mysqli_query($conexion, $consulta);
                            $obj = mysqli_fetch_array($ejecucion);
                            if($_SESSION['rol']=="admin" || $_SESSION['rol']=="gerente"):
                            ?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Usuarios con contrato</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $obj['cantidad']?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif?>

                            <!-- ventas Card Example -->
                            <?php 
                            $consulta = "SELECT count(*) AS cantidad FROM permisos";
                            $ejecucion = mysqli_query($conexion, $consulta);
                            $obj = mysqli_fetch_array($ejecucion);
                            ?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Permisos Administrativos</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $obj['cantidad']?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Row -->
                        <div class="row">

                            <!-- Content Column -->
                            <div class="col-lg-6 mb-4">

                                <!-- Color System -->
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <div class="card bg-primary text-white shadow">
                                            <div class="card-body">
                                                Primary
                                                <div class="text-white-50 small">#4e73df</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card bg-success text-white shadow">
                                            <div class="card-body">
                                                Success
                                                <div class="text-white-50 small">#1cc88a</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card bg-info text-white shadow">
                                            <div class="card-body">
                                                Info
                                                <div class="text-white-50 small">#36b9cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card bg-warning text-white shadow">
                                            <div class="card-body">
                                                Warning
                                                <div class="text-white-50 small">#f6c23e</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card bg-danger text-white shadow">
                                            <div class="card-body">
                                                Danger
                                                <div class="text-white-50 small">#e74a3b</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card bg-secondary text-white shadow">
                                            <div class="card-body">
                                                Secondary
                                                <div class="text-white-50 small">#858796</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card bg-light text-black shadow">
                                            <div class="card-body">
                                                Light
                                                <div class="text-black-50 small">#f8f9fc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card bg-dark text-white shadow">
                                            <div class="card-body">
                                                Dark
                                                <div class="text-white-50 small">#5a5c69</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6 mb-4">

                                <!-- Approach -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Titulo</h6>
                                    </div>
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem exercitationem nesciunt ipsa, magnam nisi explicabo nostrum molestiae cumque necessitatibus vitae, amet, aut ipsum. Distinctio provident quae aliquid rerum, soluta praesentium.</p>
                                    </div>
                                </div>
                                <!-- Approach -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Titulo</h6>
                                    </div>
                                    <div class="card-body">
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum iste nam harum. Eius iste esse dolorum, beatae dolore minus facilis consequatur quasi natus recusandae accusamus atque quaerat dolorem dignissimos fuga?</p>
                                    </div>
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
                            <span>Copyright &copy; Fabian Soto 2023</span>
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

        <?php 
        include 'php/logout_modal.php';
        include 'php/footer.php';
        ?>

<?php else :?>

<?php include 'php/header.php';?>

<main>
    <div class="contenedor">
        <div class="caja_trasera">
            <div class="login">
                <h3>¿Ya tienes una cuenta?</h3>
                <p>Inicia sesión para entrar en la página</p>
                <button id="btn_login">Iniciar Sesión</button>
            </div>
            <div class="register">
                <h3>¿Aún no tienes una cuenta?</h3>
                <p>Regístrate para que puedas iniciar sesión</p>
                <button id="btn_register">Regístrarse</button>
            </div>
        </div>

        <!--Formulario de Login y Register-->
        <div class="contenedor_login_register">
            <!--Login-->
            <form method="POST" class="form_login" action="">
                <h2>Iniciar Sesión</h2>
                <?php include "php/login_usuario.php";?>
                <?php include "php/registro_usuario.php";?>
                <input type="text" placeholder="Correo Electrónico / Usuario" name="correo_usuario" required="required">
                <input type="password" placeholder="Contraseña" name="contrasena" required="required">
                <input name="btningresar" class="btn boton" type="submit" value="Entrar">
                <p class="ManualU"><a href="manual_usuarios.php">Manual de Usuario</a></p>
            </form>

            <!--Register-->
            <form method="POST" class="form_register">
                <h2>Regístrarse</h2>
                <input type="text" placeholder="Nombre completo" name="nombre_completo" required="required">
                <input id="input_correo" type="text" placeholder="Correo Electrónico" name="correo_electronico" required="required">
                <input type="text" placeholder="Usuario" name="usuario" required="required">
                <input type="password" placeholder="Contraseña" name="password" required="required">
                <input id="btnregistrarse" name="btnregistrarse" class="btn boton" type="submit" value="Regístrarse">
                <p class="ManualU"><a href="manual_usuarios.php">Manual de Usuario</a></p>
            </form>
        </div>
    </div>
</main>
<script src="assets/js/script.js"></script>
<?php include 'php/footer.php';?>

<?php endif?>