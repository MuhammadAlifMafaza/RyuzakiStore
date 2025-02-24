<!-- File: app/Views/order_detail.php -->

<?= $this->include('home/layout/header') ?>

<div class="max-w-6xl mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Detail Transaksi</h2>

    <!-- Informasi Order -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h3 class="font-bold text-lg mb-2">Informasi Order</h3>
        <p><strong>ID Order:</strong> <?= esc($order['id_order']) ?></p>
        <p><strong>Tanggal Order:</strong> <?= esc($order['order_date']) ?></p>
        <p><strong>Status:</strong> <?= esc($order['status']) ?></p>
        <p><strong>Alamat Pengiriman:</strong> <?= esc($order['destination_address']) ?></p>
    </div>

    <!-- Daftar Produk pada Order -->
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-bold text-lg mb-2">Daftar Produk</h3>
        <?php if (!empty($orderItems)): ?>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="border p-2">Produk</th>
                        <th class="border p-2">Nama</th>
                        <th class="border p-2">Jumlah</th>
                        <th class="border p-2">Harga</th>
                        <th class="border p-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderItems as $item): ?>
                        <tr>
                            <td class="border p-2">
                                <?php if ($item['product_image']): ?>
                                    <img src="<?= esc($item['product_image']) ?>" alt="<?= esc($item['product_name']) ?>" class="w-16 h-16 object-cover">
                                <?php else: ?>
                                    <span>Tidak ada gambar</span>
                                <?php endif; ?>
                            </td>
                            <td class="border p-2"><?= esc($item['product_name']) ?></td>
                            <td class="border p-2"><?= esc($item['quantity']) ?></td>
                            <td class="border p-2">Rp<?= number_format($item['price'], 0, ',', '.') ?></td>
                            <td class="border p-2">Rp<?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Order tidak memiliki item produk.</p>
        <?php endif; ?>
        <!-- Total Order -->
        <div class="mt-4 text-right">
            <p class="text-lg font-bold">Total: Rp<?= number_format($order['total_amount'], 0, ',', '.') ?></p>
        </div>
    </div>
</div>

<?= $this->include('home/layout/footer') ?>