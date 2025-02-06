<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('owner/dashboard') ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/img/Logo_nobg.png'); ?>" class="img-fluid" alt="Logo">
        </div>
        <div class="sidebar-brand-text mx-3">Ryuzaki <sup>Store</sup></div>
    </a>
    <!-- Sidebar - Brand -->

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('owner/dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url("/owner/product-list") ?>">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Products</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('') ?>" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Users:</h6>
                <a class="collapse-item" href="<?= base_url('owner/list-DataAdmin') ?>">Admin</a>
                <a class="collapse-item" href="<?= base_url('owner/list-DataCustomer') ?>">Customer</a>
                <a class="collapse-item" href="<?= base_url('owner/list-DataOwner') ?>">Owner</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Transaction</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaction:</h6>
                <a class="collapse-item" href="">Order</a>
                <a class="collapse-item" href="">Cards</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan</span></a>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan Transaksi:</h6>
                <a class="collapse-item" href="<?= base_url('') ?>">Login</a>
                <a class="collapse-item" href="<?= base_url('') ?>">Login</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Laporan Bulanan:</h6>
                <a class="collapse-item" href="<?= base_url('') ?>">Pemasukan</a>
                <a class="collapse-item" href="<?= base_url('') ?>">Pengeluaran</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('') ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->