<?= $this->include('home/layout/header') ?>
<h2 class="text-2xl font-semibold mb-6 px-6 mt-4" style="padding-left: 4rem;">Checkout</h2>
<div class="max-w-6xl mx-auto bg-white p-4 rounded-lg shadow-lg flex flex-col lg:flex-row gap-4 mt-4">
    <!-- Section: Checkout Details -->
    <div class="w-full lg:w-3/5">
        <!-- Shipping Address -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="font-semibold text-lg">ALAMAT PENGIRIMAN</h3>
            <p class="text-sm text-gray-700">Jl. Prisma 1 No.4, Krapyak Lor, Kec. Pekalongan Utara, Kota Pekalongan, Jawa Tengah 51147</p>
            <button class="mt-2 px-4 py-2 bg-gray-300 text-sm rounded hover:bg-gray-400">Ganti</button>
        </div>

        <!-- Product List -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="font-semibold text-lg mb-4">Rincian Produk</h3>

            <!-- Product Item -->
            <div class="border-b pb-4 flex gap-4 mb-4">
                <img src="https://via.placeholder.com/80" class="rounded-lg" alt="Product Image">
                <div class="flex-1">
                    <p class="font-medium">MSI Thin A15 B7VE Ryzen 5-7535HS RTX4050 8GB 512GB 15.6" FHD 144Hz</p>
                    <p class="text-sm">1 x <strong class="text-gray-900">Rp12.799.000</strong></p>
                </div>
            </div>

            <!-- Product Item -->
            <div class="border-b pb-4 flex gap-4 mb-4">
                <img src="https://via.placeholder.com/80" class="rounded-lg" alt="Product Image">
                <div class="flex-1">
                    <p class="font-medium">MSI GF63 Thin 12UC i7-12650H RTX3050 15.6" FHD IPS-Level 144Hz BLACK</p>
                    <p class="text-sm">1 x <strong class="text-gray-900">Rp11.099.000</strong></p>
                </div>
            </div>

            <!-- Product Item -->
            <div class="flex gap-4">
                <img src="https://via.placeholder.com/80" class="rounded-lg" alt="Product Image">
                <div class="flex-1">
                    <p class="font-medium">MSI Thin A15 B7UC Ryzen 5-7535HS RTX3050 8GB 512GB 15.6" FHD 144Hz</p>
                    <p class="text-sm">1 x <strong class="text-gray-900">Rp11.799.000</strong></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Transaction Summary -->
    <div class="w-full lg:w-2/5 flex flex-col gap-6">
        <div class="p-4 bg-gray-50 rounded-lg">
            <h3 class="font-semibold text-lg">Cek ringkasan transaksimu, yuk</h3>
            <p class="text-sm">Total Harga (3 Barang): <strong class="text-gray-900">Rp35.697.000</strong></p>
            <p class="text-sm">Total Tagihan: <strong class="text-gray-900">Rp36.014.300</strong></p>
            <button class="mt-4 w-full bg-blue-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600">Bayar Sekarang</button>
        </div>
    </div>
</div>
<?= $this->include('home/layout/footer') ?>
<script src="https://cdn.tailwindcss.com"></script>