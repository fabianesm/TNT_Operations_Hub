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
                            <h1 class="h3 mb-0 text-gray-800">Home</h1>
                        </div>

                        <!-- Content Row -->
                        <div class="row">
                            <!-- Usuarios Card Example -->
                            <?php 
                            $consulta = "SELECT count(*) AS cantidad FROM usuarios";
                            $ejecucion = mysqli_query($conexion, $consulta);
                            $obj = mysqli_fetch_array($ejecucion);
                            if($_SESSION['rol']=="Administrator"):
                            ?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Users</div>
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
                            $consulta = "SELECT count(*) AS cantidad FROM batch_records";
                            $ejecucion = mysqli_query($conexion, $consulta);
                            $obj = mysqli_fetch_array($ejecucion);
                            if($_SESSION['rol']=="Administrator" || $_SESSION['rol']=="Production" || $_SESSION['rol']=="QA"):
                            ?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Work Orders</div>
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
                                                    Equipment Control</div>
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
                                        <div class="card bg-success text-white shadow">
                                            <div class="card-body">
                                                <i class="fas fa-chart-line fa-2x text-white-50 mb-2"></i>
                                                <div class="text-white font-weight-bold">Productivity Increase</div>
                                                <div class="text-white-50 small">+70% operational efficiency</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card bg-warning text-white shadow">
                                            <div class="card-body">
                                                <i class="fas fa-exclamation-triangle fa-2x text-white-50 mb-2"></i>
                                                <div class="text-white font-weight-bold">Smart Alerts</div>
                                                <div class="text-white-50 small">Problem prevention</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card bg-danger text-white shadow">
                                            <div class="card-body">
                                                <i class="fas fa-shield-alt fa-2x text-white-50 mb-2"></i>
                                                <div class="text-white font-weight-bold">Critical Security</div>
                                                <div class="text-white-50 small">Data protection</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card bg-dark text-white shadow">
                                            <div class="card-body">
                                                <i class="fas fa-database fa-2x text-white-50 mb-2"></i>
                                                <div class="text-white font-weight-bold">Database</div>
                                                <div class="text-white-50 small">Centralized and secure</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6 mb-4">
                                <!-- Approach -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <i class="fas fa-rocket mr-2"></i>Projected Return on Investment
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center mb-3">
                                            <h3 class="text-success font-weight-bold">300% ROI</h3>
                                            <p class="text-muted">in the first year of implementation</p>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <div class="text-primary font-weight-bold">$15,000</div>
                                                <small class="text-muted">Staff cost savings</small>
                                            </div>
                                            <div class="col-4">
                                                <div class="text-warning font-weight-bold">$30,000</div>
                                                <small class="text-muted">Time reduction</small>
                                            </div>
                                            <div class="col-4">
                                                <div class="text-success font-weight-bold">$20,000</div>
                                                <small class="text-muted">Fewer errors</small>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="mb-0"><strong>Estimated annual savings total: $65,000</strong></p>
                                    </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <!-- Digital Transformation -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <i class="fas fa-digital-tachograph mr-2"></i>Why Does TNT Need This Digital Transformation?
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-3">Organizations that optimize their processes through technology <strong>gain competitive advantage, reduce costs, and operate more efficiently.</strong></p>
                                        
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <div class="text-center text-danger">
                                                    <i class="fas fa-folder fa-2x mb-2"></i>
                                                    <h6 class="font-weight-bold">Current Situation</h6>
                                                    <ul class="list-unstyled small text-left">
                                                        <li><i class="fas fa-times text-danger mr-1"></i> Paper-based orders</li>
                                                        <li><i class="fas fa-times text-danger mr-1"></i> Physical folders</li>
                                                        <li><i class="fas fa-times text-danger mr-1"></i> Manual searching</li>
                                                        <li><i class="fas fa-times text-danger mr-1"></i> High operational costs</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center text-success">
                                                    <i class="fas fa-laptop fa-2x mb-2"></i>
                                                    <h6 class="font-weight-bold">With Digitalization</h6>
                                                    <ul class="list-unstyled small text-left">
                                                        <li><i class="fas fa-check text-success mr-1"></i> Access from any device</li>
                                                        <li><i class="fas fa-check text-success mr-1"></i> Automatically validated data</li>
                                                        <li><i class="fas fa-check text-success mr-1"></i> Search in seconds</li>
                                                        <li><i class="fas fa-check text-success mr-1"></i> Continuous savings</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <!-- Beneficios Inmediatos -->
                                <div class="card shadow mb-4" style="height: 21rem;">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <i class="fas fa-star mr-2"></i>Benefits
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <i class="fas fa-check text-success mr-2"></i>
                                            <strong>70% less time</strong> in order processing
                                        </div>
                                        <div class="mb-2">
                                            <i class="fas fa-check text-success mr-2"></i>
                                            <strong>Total elimination</strong> of manual input errors
                                        </div>
                                        <div class="mb-2">
                                            <i class="fas fa-check text-success mr-2"></i>
                                            <strong>Real-time reports</strong> for decision making
                                        </div>
                                        <div class="mb-2">
                                            <i class="fas fa-check text-success mr-2"></i>
                                            <strong>Full control</strong> from any device
                                        </div>
                                        <div class="mb-0">
                                            <i class="fas fa-check text-success mr-2"></i>
                                            <strong>Automatic compliance</strong> with regulations
                                        </div>
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

        <?php 
        include 'php/logout_modal.php';
        include 'php/footer.php';
        ?>

<?php else :?>

<?php include 'php/header.php';?>

<main>
    <div class="contenedor">
        <div style="text-align: center; margin-bottom: 1.875rem; margin-top: -0.938rem;">
            <img src="assets/images/logo.png" alt="TNT Logo" style="max-width: 120px;">
        </div>
        <div class="caja_trasera">
            <div class="login">
                <h3>Already have an account?</h3>
                <p>Sign in to access the page</p>
                <button id="btn_login">Sign In</button>
            </div>
            <div class="register">
                <h3>Don't have an account yet?</h3>
                <p>Register so you can sign in</p>
                <button id="btn_register">Register</button>
            </div>
        </div>

        <!--Formulario de Login y Register-->
        <div class="contenedor_login_register">
            <!--Login-->
            <form method="POST" class="form_login" action="">
                <h2>Sign In</h2>
                <?php include "php/login_usuario.php";?>
                <?php include "php/registro_usuario.php";?>
                <input type="text" placeholder="Email / Username" name="correo_usuario" required="required">
                <input type="password" placeholder="Password" name="contrasena" required="required">
                <input name="btningresar" class="btn boton" type="submit" value="Login">
                <p class="ManualU"><a href="forgot_password.php">I forgot my password</a></p>
            </form>

            <!--Register-->
            <form method="POST" class="form_register">
                <h2>Register</h2>
                <input type="text" placeholder="Full Name" name="nombre_completo" required="required">
                <input id="input_correo" type="text" placeholder="Email Address" name="correo_electronico" required="required">
                <input type="text" placeholder="Username" name="usuario" required="required">
                <input type="password" placeholder="Password" name="password" required="required">
                <input id="btnregistrarse" name="btnregistrarse" class="btn boton" type="submit" value="Register">
            </form>
        </div>
    </div>
</main>
<script src="assets/js/script.js"></script>
<?php include 'php/footer.php';?>

<?php endif?>