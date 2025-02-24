<div>
    <?= $this->include('home/layout/header') ?>
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

        <!-- Search Box -->
        <div class="search-bar-container">
            <div class="search-bar">
                <label for="category" class="search-label">Categories</label>
                <select id="category" class="search-category">
                    <option value="all">All</option>
                    <option value="Atasan Pria">Atasan Pria</option>
                    <option value="Atasan Wanita">Atasan Wanita</option>
                    <option value="Bawahan Pria">Bawahan Pria</option>
                    <option value="Bawahan Wanita">Bawahan Wanita</option>
                </select>
                <input type="text" class="search-input" placeholder="Search for products...">
                <button class="search-button"><i class="fas fa-search"></i></button>
            </div>
        </div>


        <?php
        $products = (new \App\Models\ProductModel())->findAll(); // Ambil semua data produk
        ?>
        <!-- Product Cards -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <a href="<?= base_url('/products/' . esc($product['id_product'])) ?>" class="card shadow-sm text-decoration-none">
                        <!-- Carousel untuk Gambar Produk -->
                        <div id="productCarousel<?= esc($product['id_product']) ?>" class="carousel slide product-carousel" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <?php
                                $images = explode(',', $product['image']); // Jika gambar disimpan dalam format string dengan koma
                                foreach ($images as $index => $image): ?>
                                    <button type="button" data-bs-target="#productCarousel<?= esc($product['id_product']) ?>"
                                        data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="true"></button>
                                <?php endforeach; ?>
                            </div>
                            <div class="carousel-inner">
                                <?php
                                foreach ($images as $index => $image):
                                    $imagePath = trim($image);
                                    if (!str_starts_with($imagePath, 'uploads/')) {
                                        $imagePath = 'uploads/img/products/' . $imagePath;
                                    }
                                ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <img src="<?= base_url($imagePath) ?>" class="d-block w-100 product-image" alt="<?= esc($product['product_name']) ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- Tombol Navigasi Carousel -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel<?= esc($product['id_product']) ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel<?= esc($product['id_product']) ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
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
        <?= $this->include('home/layout/footer') ?>
    </div>