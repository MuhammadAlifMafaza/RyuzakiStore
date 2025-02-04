<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/customer.min.css') ?>" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand" href="/">Ryuzaki-Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item position-relative">
                        <a class="nav-link fas fa-fw fa-shopping-cart" href="/cart">
                            Cart
                            <span class="cart-count">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div class="container mt-5">
        <div id="carouselExampleIndicators" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= base_url('assets/img/slide1.gif') ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('assets/img/slide2.jpg') ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('assets/img/slide3.jpg') ?>" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Search by Category -->
        <div class="search-bar mb-4"> <!-- Menambahkan margin bawah -->
            <label for="category" class="search-label">Categories</label>
            <select id="category" class="search-category">
                <option value="all">All</option>
                <option value="electronics">Electronics</option>
                <option value="fashion">Fashion</option>
                <option value="books">Books</option>
            </select>
            <input type="text" class="search-input" placeholder="Search products...">
            <button class="search-button">Go</button>
        </div>

        <?php
        $products = (new \App\Models\ProductModel())->findAll(); // Ambil semua data produk
        ?>

        <!-- Product Cards -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <a href="<?= base_url('/products/' . $product['id_product']) ?>" class="card shadow-sm text-decoration-none">
                        <!-- Carousel untuk Gambar Produk -->
                        <div id="productCarousel<?= esc($product['id_product']) ?>" class="carousel slide product-carousel" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $images = explode(',', $product['image']); // Jika gambar disimpan dalam format string dengan koma
                                foreach ($images as $index => $image):
                                    $imagePath = trim($image);
                                    if (!str_starts_with($imagePath, 'uploads/')) {
                                        $imagePath = 'uploads/img/products/' . $imagePath;
                                    }
                                ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <img src="<?= base_url($imagePath) ?>" class="d-block w-100 product-image" alt="Product Image">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Detail Produk -->
                        <div class="card-body text-center">
                            <p class="product-category text-muted small mb-1"><?= esc($product['category']) ?></p>
                            <h5 class="product-name mb-2 font-weight-bold text-dark">
                                <?= esc($product['product_name']) ?>
                            </h5>
                            <p class="product-price text-primary fw-bold">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>


        <!-- Footer -->
        <footer>
            <div class="container">
                <p>&copy; 2025 Ryuzaki-Store. All rights reserved.</p>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cartCountElement = document.querySelector('.cart-count');
                let cartCount = 3; // Example value
                cartCountElement.textContent = cartCount;
            });
        </script>
</body>

</html>