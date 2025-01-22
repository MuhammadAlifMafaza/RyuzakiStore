<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="admin/dashboard" class="brand-link">
    <img src="<?= base_url('AdminLTE-3.2.0/dist/img/RyugazakiLogo.png') ?>" alt="Ryugazaki Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Ryugazaki Store</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url('AdminLTE-3.2.0/dist/img/potrait.jpg') ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a class="d-block">Muhammad Alif Mafaza</a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Dashboard</li>
        <li class="nav-item">
          <a href="index.php?page=home" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-header">Barang</li>
        <li class="nav-item">
          <a href="index.php?page=barang" class="nav-link">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p>Barang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=pelanggan" class="nav-link">
            <i class="nav-icon far fa-circle text-warning"></i>
            <p>Pelanggan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=transaksi" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Transaksi</p>
          </a>
        </li>
        <!-- Tombol Logout -->
        <li class="nav-item">
          <a href="<?= site_url('auth/logout') ?>" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"> 
              <p>Logout</p>
            </i>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>