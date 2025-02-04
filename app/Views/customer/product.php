<?= $this->include('customer/layout/header') ?>
<div class="container my-5">
    <div class="row product-container mx-auto">
        <div class="col-md-6 product-image">
            <img src="<?= base_url("assets\img\Celana-Panjang-Regular-Fit.jpg") ?>" alt="Peplum Silky Gold">
        </div>
        <div class="col-md-6">
            <h1>Peplum Silky Gold</h1>
            <p><strong>Kategori:</strong> <span class="category">Atasan Wanita</span></p>
            <p><strong>Tags:</strong> <span class="tag casual">Casual</span> <span class="tag pakaian-wanita">Pakaian Wanita</span></p>

            <p class="price">Rp 200.000</p>
            <p class="description">Pakaian ini dibuat dengan material Brokat dan Organza</p>
            <p><strong>Stok tersisa:</strong> 100</p>

            <!-- Form for quantity selection -->
            <div class="d-flex align-items-center mt-3">
                <label for="quantity" class="me-3">Jumlah:</label>
                <div class="input-group" style="width: 150px;">
                    <button class="btn btn-outline-secondary" type="button" id="decrease-btn">-</button>
                    <input type="number" id="quantity" class="form-control text-center" value="1" min="0" readonly>
                    <button class="btn btn-outline-secondary" type="button" id="increase-btn">+</button>
                </div>
            </div>
            <p id="warning-message" class="text-danger mt-2" style="display: none;">Min. beli 1!</p>
            <button class="btn btn-primary w-100 mt-3">Tambah ke Keranjang 🛒</button>
        </div>
    </div>
</div>
<?= $this->include('customer/layout/footer') ?>