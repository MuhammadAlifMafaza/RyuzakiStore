<!-- home/auth/register -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RyuzakiStore</title>
    <link href="<?= base_url('sb-admin2/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('sb-admin2/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                        </div>

                        <!-- Notifikasi Flashdata -->
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form class="user" method="POST" action="<?= site_url('customerAuth/processRegister') ?>">
                            <?= csrf_field() ?>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="username" placeholder="Username" value="<?= old('username') ?>" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="full_name" placeholder="Nama Lengkap" value="<?= old('full_name') ?>" required>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" value="<?= old('email') ?>" required>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                            </div>

                            <div class="form-group">
                                <!-- Sesuaikan nama field dengan controller: 'confirm_password' -->
                                <input type="password" class="form-control form-control-user" name="confirm_password" placeholder="Konfirmasi Password" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="phone_number" placeholder="Nomor Telepon" value="<?= old('phone_number') ?>">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control form-control-user" name="address" placeholder="Alamat"><?= old('address') ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">Register Akun</button>
                        </form>

                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= site_url('forgot-password'); ?>">Lupa Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= site_url('customerAuth/login'); ?>">Sudah Punya Akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('sb-admin2/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>