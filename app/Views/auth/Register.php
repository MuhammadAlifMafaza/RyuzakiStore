<!-- views/auth/register -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RyuzakiStore</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="https://startbootstrap.github.io/startbootstrap-sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <h1 class="h4 text-gray-900 mb-4">Membuat Akun Baru!</h1>
                                    <form class="user" method="POST" action="<?= site_url('adminAuth/processRegister') ?>">
                                        <?= csrf_field() ?>

                                        <!-- Role -->
                                        <div class="form-group">
                                            <select class="form-control form-control-user" name="role" required>
                                                <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
                                                <option value="owner" <?= old('role') === 'owner' ? 'selected' : '' ?>>Owner</option>
                                            </select>
                                            <?php if (isset($validation) && $validation->getError('role')): ?>
                                                <div class="text-danger small"><?= $validation->getError('role') ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Username -->
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= old('username') ?>" required>
                                            <?php if (isset($validation) && $validation->getError('username')): ?>
                                                <div class="text-danger small"><?= $validation->getError('username') ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= old('email') ?>" required>
                                            <?php if (isset($validation) && $validation->getError('email')): ?>
                                                <div class="text-danger small"><?= $validation->getError('email') ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                                            <?php if (isset($validation) && $validation->getError('password')): ?>
                                                <div class="text-danger small"><?= $validation->getError('password') ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Repeat Password -->
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="repeat_password" name="repeat_password" placeholder="Repeat Password" required>
                                            <?php if (isset($validation) && $validation->getError('repeat_password')): ?>
                                                <div class="text-danger small"><?= $validation->getError('repeat_password') ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">Register Akun</button>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= site_url('forgot-password'); ?>">Lupa Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= site_url('login'); ?>">Sudah Punya Akun? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/js/sb-admin-2.min.js"></script>
</body>

</html>