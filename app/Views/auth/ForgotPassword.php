<!-- forgot_password_step1.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Include SB Admin 2 CSS -->
    <!-- Add SB Admin 2 CSS -->
    <link href="<?= base_url('/sb-admin2/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/sb-admin2/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/sb-admin2/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="/verify-user" method="post">
            <div class="form-group">
                <label for="username_or_email">Username or Email</label>
                <input type="text" class="form-control" id="username_or_email" name="username_or_email" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Add SB Admin 2 JS -->
    <script src="<?= base_url('/sb-admin2/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('/sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('/sb-admin2/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('/sb-admin2/js/sb-admin-2.min.js') ?>"></script>
</body>

</html>