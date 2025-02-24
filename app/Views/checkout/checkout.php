<?php
$userId = session()->get('id_customer');

$customerAddress = "";
?>

<?= $this->include('home/layout/header') ?>

<!-- Form checkout: form ini akan mengirimkan data ke endpoint processCheckout -->
<form action="<?= base_url('checkout/process') ?>" method="post">
    <h2 class="text-2xl font-semibold mb-6 px-6 mt-4" style="padding-left: 4rem;">Checkout</h2>
    <div class="max-w-6xl mx-auto bg-white p-4 rounded-lg shadow-lg flex flex-col lg:flex-row gap-4 mt-4">
        <!-- Section: Checkout Details -->
        <div class="w-full lg:w-3/5">
            <!-- Shipping Address Section -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg" id="shipping-address-section">
                <h3 class="font-semibold text-lg">ALAMAT PENGIRIMAN</h3>
                <!-- Tampilan alamat default -->
                <div id="address-display">
                    <p class="text-sm text-gray-700">
                        <?= ($customerAddress !== "") ? esc($customerAddress) : "Belum ada alamat" ?>
                    </p>
                    <button type="button" id="edit-address-button" class="mt-2 px-4 py-2 bg-gray-300 text-sm rounded hover:bg-gray-400">Ganti</button>
                </div>
                <!-- Form edit alamat, tersembunyi secara default -->
                <div id="address-edit" class="hidden">
                    <textarea name="destination_address" id="destination_address" class="w-full p-2 border rounded" placeholder="Masukkan alamat pengiriman..." required><?= esc($customerAddress) ?></textarea>
                    <div class="mt-2 flex gap-2">
                        <button type="button" id="save-address-button" class="px-4 py-2 bg-green-300 text-sm rounded hover:bg-green-400">Simpan</button>
                        <button type="button" id="cancel-edit-button" class="px-4 py-2 bg-red-300 text-sm rounded hover:bg-red-400">Batal</button>
                    </div>
                </div>
            </div>

            <!-- Product List Section -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <h3 class="font-semibold text-lg mb-4">Rincian Produk</h3>
                <?php
                // Ambil data keranjang untuk user yang sedang login
                $cartModel    = new \App\Models\CartModel();
                $productModel = new \App\Models\ProductModel();
                $cartItems    = $cartModel->getCartByCustomerId($userId);
                $total        = 0;
                ?>
                <?php if (!empty($cartItems)): ?>
                    <?php foreach ($cartItems as $item):
                        $product = $productModel->find($item['id_product']);
                        if (!$product) continue;
                        $subtotal = $product['price'] * $item['quantity'];
                        $total += $subtotal;
                        $images = explode(',', $product['image']);
                        $imagePath = trim($images[0]);
                        if (!str_starts_with($imagePath, 'uploads/')) {
                            $imagePath = 'uploads/img/products/' . $imagePath;
                        }
                        $finalImage = base_url($imagePath);
                    ?>
                        <div class="border-b pb-4 flex gap-4 mb-4">
                            <img src="<?= $finalImage ?>" class="rounded-lg w-20 h-20 object-cover" alt="<?= esc($product['product_name']) ?>">
                            <div class="flex-1">
                                <p class="font-medium"><?= esc($product['product_name']) ?></p>
                                <p class="text-sm"><?= $item['quantity'] ?> x <strong class="text-gray-900">Rp<?= number_format($product['price'], 0, ',', '.') ?></strong></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-sm text-gray-700">Keranjang Anda kosong.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Section: Transaction Summary -->
        <div class="w-full lg:w-2/5 flex flex-col gap-6">
            <div class="p-4 bg-gray-50 rounded-lg">
                <h3 class="font-semibold text-lg">Cek ringkasan transaksimu, yuk</h3>
                <p class="text-sm">Total Harga (<?= count($cartItems) ?> Barang): <strong class="text-gray-900">Rp<?= number_format($total, 0, ',', '.') ?></strong></p>
                <p class="text-sm">Total Tagihan: <strong class="text-gray-900">Rp<?= number_format($total, 0, ',', '.') ?></strong></p>
                <button type="submit" class="mt-4 w-full bg-blue-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600">Bayar Sekarang</button>
            </div>
        </div>
    </div>
</form>

<?= $this->include('home/layout/footer') ?>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    // Elemen untuk mengelola alamat pengiriman
    const editButton = document.getElementById('edit-address-button');
    const cancelEditButton = document.getElementById('cancel-edit-button');
    const saveAddressButton = document.getElementById('save-address-button');
    const addressDisplay = document.getElementById('address-display');
    const addressEdit = document.getElementById('address-edit');
    const destinationAddress = document.getElementById('destination_address');

    // Saat tombol "Ganti" diklik, tampilkan form edit alamat
    editButton.addEventListener('click', function() {
        addressDisplay.classList.add('hidden');
        addressEdit.classList.remove('hidden');
    });

    // Tombol "Batal" mengembalikan tampilan ke mode read-only tanpa menyimpan perubahan
    cancelEditButton.addEventListener('click', function() {
        addressEdit.classList.add('hidden');
        addressDisplay.classList.remove('hidden');
        // Reset textarea ke nilai awal (kosong, karena tidak ada data alamat)
        destinationAddress.value = "";
    });

    // Tombol "Simpan" memperbarui tampilan alamat dengan nilai dari textarea
    saveAddressButton.addEventListener('click', function() {
        const newAddress = destinationAddress.value.trim();
        if (newAddress === "") {
            alert("Alamat tidak boleh kosong.");
            return;
        }
        // Update tampilan alamat dengan nilai baru
        addressDisplay.querySelector('p').textContent = newAddress;
        addressEdit.classList.add('hidden');
        addressDisplay.classList.remove('hidden');
    });
</script>