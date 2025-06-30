<?php include('php/header.php');?>

<main>
    <div class="contenedor">
        <div style="text-align: center; margin-bottom: 1.875rem; margin-top: -0.938rem;">
            <img src="assets/images/logo.png" alt="TNT Logo" style="max-width: 120px;">
        </div>
        <div class="caja_trasera">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
                <h3>Forgot your password?</h3>
                <p>Enter your email or username and we’ll help you reset it.</p>
            </div>
        </div>

        <div class="contenedor_login_register">
            <form method="POST" class="form_login" action="">
                <h2>Recover Password</h2>
                <?php include "php/recover_password.php";?>
                <input type="text" placeholder="Email or Username" name="usuario_olvidado" required="required">
                <input name="btnsend" class="btn boton" type="submit" value="Send Recovery Link">
                <p class="ManualU"><a href="index.php">Sign In</a></p>
            </form>
        </div>
    </div>
</main>

<?php include('php/footer.php');?>