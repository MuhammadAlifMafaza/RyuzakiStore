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

                <?php
                $cartModel = new \App\Models\CartModel();
                $productModel = new \App\Models\ProductModel();
                $userId = session()->get('id_user');
                $cartItems = $cartModel->getCartByUserId($userId);
                $totalPrice = 0;
                ?>

                <?php foreach ($cartItems as $item):
                    $product = $productModel->find($item['id_product']);
                    $subtotal = $product['price'] * $item['quantity'];
                    $totalPrice += $subtotal;
                ?>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <input type="checkbox" class="product-checkbox" data-price="<?= $subtotal ?>">
                        <img src="<?= base_url('uploads/img/products/' . $product['image']) ?>" width="80" class="mx-3">
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
                            <a href="<?= base_url('cart/remove/' . $item['id_cart']) ?>" class="text-danger ms-3"><i class="fas fa-trash-alt"></i></a>
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
                    <p class="fw-bold text-primary" id="total-price">Rp <?= number_format($totalPrice, 0, ',', '.') ?></p>
                </div>
                <a href="<?= base_url('checkout') ?>" class="btn btn-success w-100">Beli (<?= count($cartItems) ?>)</a>
            </div>
        </div>
    </div>
</div>

<?= $this->include('home/layout/footer') ?>

<script>
    document.querySelectorAll(".increase-qty, .decrease-qty").forEach(button => {
        button.addEventListener("click", function() {
            let input = this.closest(".d-flex").querySelector(".quantity");
            let maxStock = parseInt(input.getAttribute("max"));
            let newQty = parseInt(input.value);

            if (this.classList.contains("increase-qty") && newQty < maxStock) {
                newQty++;
            } else if (this.classList.contains("decrease-qty") && newQty > 1) {
                newQty--;
            }

            input.value = newQty;
            updateCartQuantity(input.dataset.id, newQty);
        });
    });

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
            }).then(response => response.json())
            .then(data => location.reload());
    }

    document.addEventListener("DOMContentLoaded", function() {
        let checkboxes = document.querySelectorAll(".product-checkbox");
        let selectAll = document.getElementById("select-all");
        let totalPriceElem = document.getElementById("total-price");

        selectAll.addEventListener("change", function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateTotal();
        });

        document.body.addEventListener("change", function(e) {
            if (e.target.classList.contains("product-checkbox")) updateTotal();
        });

        function updateTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) total += parseFloat(cb.dataset.price);
            });
            totalPriceElem.textContent = "Rp " + total.toLocaleString("id-ID");
        }
    });
</script>