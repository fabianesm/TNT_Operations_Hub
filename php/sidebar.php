<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink fa-2x"></i>
    </div>
    <div class="sidebar-brand-text mx-3">TNT Operations Hub</div>
</a> -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php" style="height: 6.375rem;">
    <img src="assets/images/logo.png" alt="TNT Operations Hub Logo" class="sidebar-logo">
</a>


<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Inicio -->
<li class="nav-item <?php if($active=='home'){echo 'active';}?>">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Home</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Modules
</div>

 <!-- Nav Item - usuarios -->
 <?php if($_SESSION['rol']=="Administrator"):?>
 <li class="nav-item <?php if($active=='usuariosC'){echo 'active';}?>">
    <a class="nav-link" href="users.php">
        <i class="fa fa-users"></i>
        <span>User Management</span>
    </a>
</li>
<?php endif?>

<?php if($_SESSION['rol']=="Administrator" || $_SESSION['rol']=="Production" || $_SESSION['rol']=="QA"):?>
 <!-- Nav Item - contratos -->
 <li class="nav-item <?php if($active=='contratos'){echo 'active';}?>">
    <a class="nav-link" href="contratos.php">
        <i class="fas fa-clipboard-list"></i>
        <span>Batch Records</span>
    </a>
</li>
<?php endif?>

 <!-- Nav Item - control_equipos -->
 <li class="nav-item <?php if($active=='control_equipos'){echo 'active';}?>">
    <a class="nav-link" href="control_equipos.php">
        <i class="fas fa-folder"></i>
        <span>Equipment Control</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<!-- <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div> -->

</ul>
<!-- End of Sidebar -->