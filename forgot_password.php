<?php include('php/header.php');?>
   <!-- Page Wrapper -->
   <div id="wrapper">

<?php include 'php/sidebarMU.php';?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content" class="mt-3">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Manual de Usuario FS ERP</h1>
            </div>

            <!-- Content Row -->
            <div class="row" id="registro_y_login">
                <div class="col-lg-12 mb-4">
                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Login/Registro de Usuarios</h6>
                        </div>
                        <div class="card-body">
                            <p>Cuando un usuario ingresa por primera vez a la página web, lo primero que se encuentra es un formulario flotante que solicita iniciar sesión para poder acceder al sistema. Este formulario cuenta con un par de campos de texto donde el usuario debe ingresar su usuario/correo electrónico y su contraseña. Además, también tiene un botón para acceder al formulario de registro de usuarios, el cual se encuentra a la derecha.</p>
                            <p class="text-center"><img src="https://i.ibb.co/Bf1BcQP/Screenshot-2.png" alt="Login de usuarios"></p>
                            <p>Para iniciar sesión, el usuario debe ingresar su usuario o correo electrónico y su contraseña en los campos correspondientes y presionar el botón de "Entrar". Si los datos ingresados son correctos, la página lo redirigirá a la página principal del sistema, donde podrá acceder a todas las funcionalidades disponibles.</p>
                            <p>En caso de que el usuario no tenga una cuenta en la página, puede registrarse presionando el botón de "Regístrarse". Este botón lo llevará al formulario de registro de usuarios, donde deberá ingresar sus datos personales, incluyendo su nombre completo, correo electrónico, usuario y contraseña. Una vez que haya ingresado toda la información necesaria, deberá presionar el botón de "Regístrarse" para completar el proceso de registro.</p>
                            <p class="text-center"><img src="https://i.ibb.co/y8NxNqF/Screenshot-3.png" alt="Registro de usuarios"></p>
                            <p>Es importante mencionar que la página web cuenta con un sistema de seguridad para proteger la información de los usuarios. Después de 15 días de haber creado el usuario, el sistema redirigirá al usuario a la página de cambio de contraseña antes de permitirle acceder al sistema nuevamente. De esta manera, se garantiza que la contraseña sea cambiada regularmente y se evita que los usuarios utilicen contraseñas débiles o fácilmente adivinables.</p>
                            <p>En la página de cambio de contraseña, el usuario deberá ingresar su nuevo usuario (Puede ser el mismo,no es obligatorio cambiar de usuario) y luego ingresar la nueva contraseña. Es importante mencionar que la nueva contraseña no puede ser igual a la anterior.</p>
                            <p>Una vez que el usuario ha cambiado su contraseña, se le redirigirá automáticamente a la página principal de inicio de sesión, donde podrá acceder con sus nuevas credenciales al sistema.</p>
                            <p class="text-center"><img src="https://i.ibb.co/nbZk50C/Screenshot-4.png" alt="Cambio de contraseña"></p>
                            <p>Página principal:</p>
                            <p class="text-center"><img src="https://i.ibb.co/nRcSH3v/Screenshot-5.png"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="usuarios">
                <div class="col-lg-12 mb-4">
                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Módulo Usuarios</h6>
                        </div>
                        <div class="card-body">
                            <p>Este módulo es exclusivo para el usuario administrador y le permite agregar, editar y eliminar usuarios del sistema. A continuación, se detallan los pasos necesarios para realizar cada una de estas acciones.</p>
                            <p class="text-center"><img src="https://i.ibb.co/grLjnPR/Screenshot-9.png"></p>
                            <p><strong>Agregar Usuario:</strong></p>
                            <p>Para agregar un nuevo usuario al sistema, el usuario administrador debe seguir los siguientes pasos:</p>
                            <p><ol>
                                <li>Haga clic en el botón "+" ubicado en la parte derecha del modulo.</li>
                                <li>Se abrirá un modal Ingrese la información del usuario en los campos correspondientes.
                                <p class="text-center"><img src="https://i.ibb.co/Kzg0Kj3/Screenshot-10.png" ></p> 
                                </li>
                                <li>Haga clic en el botón "Guardar" para agregar el usuario al sistema.</li>
                            </ol></p>
                            <p><strong>Editar Usuario:</strong></p>
                            <p>Para editar la información de un usuario existente en el sistema, el usuario administrador debe seguir los siguientes pasos:</p>
                            <p><ol>
                                <li>Seleccione el usuario que desea editar en la tabla y haga clic en el botón del lápiz.</li>
                                <li>Se abrirá un modal con la información del usuario. Edite la información del usuario en los campos correspondientes.
                                <p class="text-center"><img src="https://i.ibb.co/hLsmhY8/Screenshot-11.png" ></p> 
                                </li>
                                <li>Haga clic en el botón "Editar" para guardar los cambios realizados.</li>
                            </ol></p>
                            <p><strong>Eliminar Usuario:</strong></p>
                            <p>Para eliminar un usuario existente en el sistema, el usuario administrador debe seguir los siguientes pasos:</p>
                            <p><ol>
                                <li>Seleccione el usuario que desea eliminar en la tabla y haga clic en el botón de la papelera.</li>
                                <li>Se abrirá un modal con la información del usuario, los campos estarán bloqueados no se pueden editar.
                                <p class="text-center"><img src="https://i.ibb.co/yQJYG0H/Screenshot-12.png" ></p> 
                                </li>
                                <li>Haga clic en el botón "Eliminar" para eliminar al usuario.</li>
                            </ol></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="contratos">
                <div class="col-lg-12 mb-4">
                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Módulo Contratos</h6>
                        </div>
                        <div class="card-body">
                            <p>Este módulo es exclusivo para el usuario gerente pero el administrador también puede usarlo y les permite agregar, editar y eliminar contratos a los usuarios con rol empleado del sistema. A continuación, se detallan los pasos necesarios para realizar cada una de estas acciones.</p>
                            <p class="text-center"><img src="https://i.ibb.co/QQGkLYc/Screenshot-13.png"></p>
                            <p><strong>Agregar Contrato:</strong></p>
                            <p>Para agregar un nuevo contrato al sistema, el usuario debe seguir los siguientes pasos:</p>
                            <p><ol>
                                <li>Haga clic en el botón "+" ubicado en la parte derecha del modulo.</li>
                                <li>Se abrirá un modal Ingrese la información en los campos correspondientes.
                                <p class="text-center"><img src="https://i.ibb.co/vD23fvv/Screenshot-14.png"></p> 
                                </li>
                                <li>Haga clic en el botón "Guardar" para agregar el contrato al sistema.</li>
                            </ol></p>
                            <p><strong>Editar Contrato:</strong></p>
                            <p>Para editar la información de un contrato existente en el sistema, el usuario debe seguir los siguientes pasos:</p>
                            <p><ol>
                                <li>Seleccione el contrato que desea editar en la tabla y haga clic en el botón del lápiz.</li>
                                <li>Se abrirá un modal con la información del contrato. Edite la información en los campos correspondientes.
                                <p class="text-center"><img src="https://i.ibb.co/41j233w/Screenshot-15.png" ></p> 
                                </li>
                                <li>Haga clic en el botón "Editar" para guardar los cambios realizados.</li>
                            </ol></p>
                            <p><strong>Eliminar Contrato:</strong></p>
                            <p>Para eliminar un contrato existente en el sistema, el usuario debe seguir los siguientes pasos:</p>
                            <p><ol>
                                <li>Seleccione el contrato que desea eliminar en la tabla y haga clic en el botón de la papelera.</li>
                                <li>Se abrirá un modal con la información del contrato, los campos estarán bloqueados no se pueden editar.
                                <p class="text-center"><img src="https://i.ibb.co/Vmb3GpK/Screenshot-16.png" ></p> 
                                </li>
                                <li>Haga clic en el botón "Eliminar" para eliminar el contrato.</li>
                            </ol></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="permisos">
                <div class="col-lg-12 mb-4">
                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Módulo Permisos Administrativos</h6>
                        </div>
                        <div class="card-body">
                            <p>Este módulo es exclusivo para el usuario empleado pero el administrador también puede usarlo y les permite agregar, editar y eliminar permisos administrativos a los usuarios con rol empleado del sistema. A continuación, se detallan los pasos necesarios para realizar cada una de estas acciones.</p>
                            <p class="text-center"><img src="https://i.ibb.co/TPHjxQk/Screenshot-17.png"></p>
                            <p><strong>Agregar Permiso:</strong></p>
                            <p>Para agregar un nuevo permiso al sistema, el usuario debe seguir los siguientes pasos:</p>
                            <p><ol>
                                <li>Haga clic en el botón "+" ubicado en la parte derecha del modulo.</li>
                                <li>Se abrirá un modal Ingrese la información en los campos correspondientes.
                                <p class="text-center"><img src="https://i.ibb.co/ZM6wMp3/Screenshot-18.png"></p> 
                                </li>
                                <li>Haga clic en el botón "Guardar" para agregar el permiso al sistema.</li>
                            </ol></p>
                            <p><strong>Editar Permiso:</strong></p>
                            <p>Para editar la información de un permiso existente en el sistema, el usuario debe seguir los siguientes pasos:</p>
                            <p><ol>
                                <li>Seleccione el permiso que desea editar en la tabla y haga clic en el botón del lápiz.</li>
                                <li>Se abrirá un modal con la información del permiso. Edite la información en los campos correspondientes.
                                <p class="text-center"><img src="https://i.ibb.co/GPxnwzW/Screenshot-19.png" ></p> 
                                </li>
                                <li>Haga clic en el botón "Editar" para guardar los cambios realizados.</li>
                            </ol></p>
                            <p><strong>Eliminar Permiso:</strong></p>
                            <p>Para eliminar un permiso existente en el sistema, el usuario debe seguir los siguientes pasos:</p>
                            <p><ol>
                                <li>Seleccione el permiso que desea eliminar en la tabla y haga clic en el botón de la papelera.</li>
                                <li>Se abrirá un modal con la información del permiso, los campos estarán bloqueados no se pueden editar.
                                <p class="text-center"><img src="https://i.ibb.co/3W2rJTS/Screenshot-20.png" ></p> 
                                </li>
                                <li>Haga clic en el botón "Eliminar" para eliminar el permiso.</li>
                            </ol></p>
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
<?php include('php/footer.php');?>