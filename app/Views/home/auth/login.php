<!-- home/auth/login -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RyuzakiStore</title>
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
                            <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                        </div>

                        <!-- Notifikasi Error -->
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form class="user" action="<?= site_url('customerAuth/processLogin') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="login" placeholder="Username atau Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                        </form>

                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= site_url('forgot-password'); ?>">Lupa Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= site_url('customerAuth/register'); ?>">Buat Akun Baru!</a>
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