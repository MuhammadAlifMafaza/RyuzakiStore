<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table         = 'cart';
    protected $primaryKey    = 'id_cart';
    protected $allowedFields = ['id_cart', 'id_customer', 'id_product', 'quantity', 'created_at'];

    protected $useTimestamps = false;

    /* Menambahkan item ke dalam cart */
    public function addToCart($cartData)
    {
        // Cek jika item sudah ada di cart untuk customer dan produk yang sama
        $existingItem = $this->where('id_customer', $cartData['id_customer'])
            ->where('id_product', $cartData['id_product'])
            ->first();

        if ($existingItem) {
            // Jika item sudah ada, update kuantitasnya
            $newQuantity = $existingItem['quantity'] + $cartData['quantity'];
            return $this->update($existingItem['id_cart'], ['quantity' => $newQuantity]);
        } else {
            // Jika item belum ada, tambahkan data baru ke cart
            return $this->insert($cartData);
        }
    }

    /* Mengambil semua item cart untuk customer tertentu */
    public function getCartByCustomerId($customerId)
    {
        return $this->select('cart.*, products.product_name, products.price, products.image')
            ->join('products', 'products.id_product = cart.id_product')
            ->where('id_customer', $customerId)
            ->findAll();
    }

    /* Menghapus item dari cart berdasarkan id_cart */
    public function removeFromCart($cartId)
    {
        return $this->delete($cartId);
    }

    /* Mengupdate kuantitas item dalam cart */
    public function updateQuantity($cartId, $quantity)
    {
        return $this->update($cartId, ['quantity' => $quantity]);
    }

    /* Menghapus semua item dalam cart untuk customer tertentu */
    public function clearCartByCustomerId($customerId)
    {
        return $this->where('id_customer', $customerId)->delete();
    }
}
