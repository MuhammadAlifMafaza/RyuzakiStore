<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Menu</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('departemen'); ?>">
            <i class="fas fa-fw fa-building"></i>
            <span>Departemen</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('cuti'); ?>">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Tipe Cuti</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('karyawan'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Karyawan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('laporancuti'); ?>">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Manajemen Cuti</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
</ul>
