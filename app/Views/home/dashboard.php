<?= $this->include('layout/header') ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 bg-light" style="min-height: 100vh;">
            <div class="p-4">
                <!-- Foto dan Nama Customer -->
                <div class="text-center mb-4">
                    <img src="/path/to/customer-image.jpg" alt="Customer Image" class="img-thumbnail rounded-circle" style="width: 100px; height: 100px;">
                    <h4 class="mt-2">Nama Customer</h4>
                </div>
                <!-- Menu Navigasi Sidebar -->
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Riwayat Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pengaturan</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Konten Utama: Profile Customer -->
        <div class="col-md-9">
            <div class="p-4">
                <h2>Profile Customer</h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nama Customer</h5>
                        <p class="card-text"><strong>Email:</strong> customer@example.com</p>
                        <p class="card-text"><strong>Telepon:</strong> 08123456789</p>
                        <p class="card-text"><strong>Alamat:</strong> Jalan Raya No.123, Kota</p>
                        <!-- Tambahkan informasi profil lainnya sesuai kebutuhan -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>