<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Add SB Admin 2 CSS -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
</head>
<body class="bg-gradient-primary">

<div class="container">

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Forgot Password</h1>
                                </div>

                                <form action="<?= site_url('/auth/forgot-password') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <label for="email_or_username">Email or Username</label>
                                        <input type="text" id="email_or_username" name="email_or_username" class="form-control form-control-user" value="<?= old('email_or_username') ?>" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button>

                                    <?php if(session()->getFlashdata('error')): ?>
                                        <div class="alert alert-danger mt-3"><?= session()->getFlashdata('error') ?></div>
                                    <?php endif; ?>

                                </form>

                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= site_url('/login') ?>">Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Add SB Admin 2 JS -->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
<script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>

</body>
</html>
