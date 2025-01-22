<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiara Brand</title>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('bootstrap-5.2.3/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        .carousel-item img {
            height: 400px;
            object-fit: cover;
            object-position: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">Ryugazaki Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Keranjang</a></li>
                    <li class="nav-item"><a class="btn btn-primary" href="/login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Carousel -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1920x400?text=Slide+1" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Welcome to Tiara Brand</h5>
                    <p>Produk original dengan harga bersahabat.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1920x400?text=Slide+2" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Temukan Gaya Anda</h5>
                    <p>Tampil beda dan keren dengan berbagai produk kami.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1920x400?text=Slide+3" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Belanja Mudah dan Aman</h5>
                    <p>Berbagai kemudahan belanja untuk Anda.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Categories Section -->
    <div class="container category-section mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Categories</h3>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search Produk" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-outline-primary w-100">All</button>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card product-card shadow-sm">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Product">
                    <div class="card-body">
                        <h5 class="card-title">Product Name</h5>
                        <p class="card-text">Rp 100.000</p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('bootstrap-5.2.3/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
