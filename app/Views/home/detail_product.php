<?= $this->include('home/layout/header') ?>

<div class="container my-5">
    <div class="row product-container mx-auto">
        <div class="col-md-6 product-image">
            <!-- Carousel untuk banyak gambar -->
            <div id="productDetailCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $images = explode(',', $product['image']);
                    foreach ($images as $index => $image):
                        $imagePath = trim($image);
                        if (!str_starts_with($imagePath, 'uploads/')) {
                            $imagePath = 'uploads/img/products/' . $imagePath;
                        }
                    ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <img src="<?= base_url($imagePath) ?>" class="d-block w-100" alt="<?= esc($product['product_name']) ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productDetailCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productDetailCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
        <div class="col-md-6">
            <h1><?= esc($product['product_name']) ?></h1>
            <p><strong>Kategori:</strong> <span class="category"><?= esc($product['category']) ?></span></p>
            <p><strong>Tags:</strong> <?= esc($product['tags']) ?></p>
            <p class="price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
            <p class="description"><?= esc($product['description']) ?></p>
            <p><strong>Stok tersisa:</strong> <?= esc($product['stock_quantity']) ?></p>

            <!-- Form Tambah ke Keranjang -->
            <form action="<?= base_url('cart/addToCart/' . $product['id_product']) ?>" method="post">
                <div class="d-flex align-items-center mt-3">
                    <label for="quantity" class="me-3">Jumlah:</label>
                    <div class="input-group" style="width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" id="decrease-btn">-</button>
                        <input type="number" id="quantity" name="quantity" class="form-control text-center" value="1" min="1">
                        <button class="btn btn-outline-secondary" type="button" id="increase-btn">+</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Tambah ke Keranjang 🛒</button>
            </form>
        </div>
    </div>
</div>

<?= $this->include('home/layout/footer') ?>

<!-- JavaScript untuk mengatur tombol increase/decrease -->
<script>
    document.getElementById("decrease-btn").addEventListener("click", function() {
        let input = document.getElementById("quantity");
        let currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    });
    document.getElementById("increase-btn").addEventListener("click", function() {
        let input = document.getElementById("quantity");
        let currentValue = parseInt(input.value);
        // Jika ingin membatasi sesuai stok, bisa tambahkan validasi di sini:
        input.value = currentValue + 1;
    });
</script>