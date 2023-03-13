<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink fa-2x"></i>
    </div>
    <div class="sidebar-brand-text mx-3">FS ERP</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Inicio -->
<li class="nav-item <?php if($active=='home'){echo 'active';}?>">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Inicio</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Módulos
</div>

 <!-- Nav Item - usuarios -->
 <?php if($_SESSION['rol']=="admin"):?>
 <li class="nav-item <?php if($active=='usuariosC'){echo 'active';}?>">
    <a class="nav-link" href="usuarios.php">
        <i class="fa fa-users"></i>
        <span>Usuarios</span>
    </a>
</li>
<?php endif?>

<?php if($_SESSION['rol']=="admin" || $_SESSION['rol']=="gerente"):?>
 <!-- Nav Item - contratos -->
 <li class="nav-item <?php if($active=='contratos'){echo 'active';}?>">
    <a class="nav-link" href="contratos.php">
        <i class="fas fa-clipboard-list"></i>
        <span>Contratos</span>
    </a>
</li>
<?php endif?>

 <!-- Nav Item - permisos_administrativos -->
 <li class="nav-item <?php if($active=='permisos_administrativos'){echo 'active';}?>">
    <a class="nav-link" href="permisos_administrativos.php">
        <i class="fas fa-folder"></i>
        <span>Permisos Administrativos</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->