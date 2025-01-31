<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peplum Silky Gold</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('\assets\css\product.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('sb-admin2/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="<?= base_url("assets\img\Logo_RZ-nobg.png") ?>" alt="Brand Logo">
                <span class="ms-2">Ryuzaki Store</span>
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cart">🛒 Keranjang <span class="badge bg-danger">0</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <div class="d-flex align-items-center">
                        <!-- Card untuk Dashboard -->
                        <div class="card dashboard-card">
                            <a class="nav-link" href="/dashboard">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </div>
                        <!-- Card untuk Logout -->
                        <div class="card logout-card">
                            <a class="nav-link" href="/logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>