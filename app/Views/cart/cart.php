<?= $this->include('home/layout/header') ?>

<div class="container my-5">
    <h2 class="fw-bold">Keranjang</h2>

    <div class="row">
        <!-- Daftar Produk di Keranjang -->
        <div class="col-md-8">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <input type="checkbox" id="select-all">
                        <label for="select-all"><strong>Pilih Semua</strong></label>
                    </div>
                    <a href="#" class="text-danger">Hapus</a>
                </div>

                <?php foreach ($cartItems as $item):
                    // Ambil data produk berdasarkan id_product pada item keranjang
                    $product = (new \App\Models\ProductModel())->find($item['id_product']);
                    if (!$product) continue; // Skip jika produk tidak ditemukan

                    // Jika produk memiliki lebih dari satu gambar (dipisahkan dengan koma),
                    // gunakan gambar pertama sebagai thumbnail.
                    $images = explode(',', $product['image']);
                    $imagePath = trim($images[0]);
                    if (!str_starts_with($imagePath, 'uploads/')) {
                        $imagePath = 'uploads/img/products/' . $imagePath;
                    }

                    // Hitung subtotal awal untuk item ini
                    $subtotal = $product['price'] * $item['quantity'];
                ?>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <!-- Checkbox dengan data-price (subtotal) dan data-unit (harga satuan) -->
                        <input type="checkbox" class="product-checkbox" data-price="<?= $subtotal ?>" data-unit="<?= $product['price'] ?>">
                        <img src="<?= base_url($imagePath) ?>" width="80" class="mx-3" alt="<?= esc($product['product_name']) ?>">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold"><?= esc($product['product_name']) ?></h6>
                            <p class="text-muted small"><?= esc($product['category']) ?></p>
                            <p class="text-primary fw-bold">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-outline-secondary btn-sm decrease-qty">-</button>
                            <input type="number" class="form-control text-center mx-2 quantity"
                                value="<?= $item['quantity'] ?>" min="1"
                                max="<?= $product['stock_quantity'] ?>"
                                data-id="<?= $item['id_cart'] ?>" style="width: 50px;">
                            <button class="btn btn-outline-secondary btn-sm increase-qty">+</button>
                            <a href="<?= base_url('cart/remove/' . $item['id_cart']) ?>" class="text-danger ms-3">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Ringkasan Belanja -->
        <div class="col-md-4">
            <div class="card p-3">
                <h5 class="fw-bold">Ringkasan Belanja</h5>
                <div class="d-flex justify-content-between">
                    <p>Total</p>
                    <!-- Nilai awal di-set 0 karena total hanya dihitung dari item yang dicentang -->
                    <p class="fw-bold text-primary" id="total-price">Rp 0</p>
                </div>
                <a href="<?= base_url('checkout') ?>" id="checkout-button" class="btn btn-success w-100">
                    Beli (<?= count($cartItems) ?>)
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->include('home/layout/footer') ?>
<!-- JavaScript untuk update quantity secara realtime dan perhitungan total -->
<script>
    // Event listener untuk tombol increase dan decrease
    document.querySelectorAll(".increase-qty, .decrease-qty").forEach(button => {
        button.addEventListener("click", function() {
            // Cari input quantity di baris yang sama
            let input = this.closest(".d-flex").querySelector(".quantity");
            let maxStock = parseInt(input.getAttribute("max"));
            let newQty = parseInt(input.value);

            if (this.classList.contains("increase-qty") && newQty < maxStock) {
                newQty++;
            } else if (this.classList.contains("decrease-qty") && newQty > 1) {
                newQty--;
            }
            input.value = newQty;

            // Update subtotal untuk baris ini secara realtime:
            // Cari container baris (misalnya, dengan kelas border-bottom)
            let container = this.closest(".border-bottom");
            // Dapatkan checkbox yang menyimpan data harga
            let checkbox = container.querySelector(".product-checkbox");
            // Ambil unit price dari atribut data-unit
            let unitPrice = parseFloat(checkbox.getAttribute("data-unit"));
            // Hitung subtotal baru
            let newSubtotal = unitPrice * newQty;
            // Update atribut data-price dengan subtotal baru
            checkbox.setAttribute("data-price", newSubtotal);

            // Perbarui total keseluruhan
            updateTotal();

            // Lakukan update ke server via AJAX
            updateCartQuantity(input.dataset.id, newQty);
        });
    });

    // Fungsi untuk update quantity via AJAX
    function updateCartQuantity(id_cart, quantity) {
        fetch("<?= base_url('cart/update_quantity') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id_cart,
                    quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Jika update sukses, kita sudah update UI sebelumnya secara realtime.
                    // Opsional: updateTotal(); (jika diperlukan)
                } else {
                    alert(data.error || "Terjadi kesalahan saat mengupdate kuantitas.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
    }

    // Fungsi untuk menghitung ulang total harga berdasarkan item yang dicentang
    function updateTotal() {
        let checkboxes = document.querySelectorAll(".product-checkbox");
        let totalPriceElem = document.getElementById("total-price");
        let total = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) {
                total += parseFloat(cb.getAttribute("data-price"));
            }
        });
        totalPriceElem.textContent = "Rp " + total.toLocaleString("id-ID");
    }

    // Event listener untuk checkbox "select all" dan masing-masing checkbox
    document.addEventListener("DOMContentLoaded", function() {
        let checkboxes = document.querySelectorAll(".product-checkbox");
        let selectAll = document.getElementById("select-all");

        selectAll.addEventListener("change", function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateTotal();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener("change", updateTotal);
        });
    });

    // Validasi checkout: pastikan setidaknya satu checkbox dicentang sebelum melanjutkan transaksi
    document.getElementById("checkout-button").addEventListener("click", function(e) {
        let checkboxes = document.querySelectorAll(".product-checkbox");
        let isAnyChecked = false;
        checkboxes.forEach(cb => {
            if (cb.checked) isAnyChecked = true;
        });
        if (!isAnyChecked) {
            e.preventDefault();
            alert("Silakan centang minimal satu produk untuk melanjutkan transaksi.");
        }
    });
</script>