<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';
    protected $allowedFields = ['id_cart', 'id_user', 'id_product', 'quantity', 'created_at'];
    protected $useTimestamps = true;

    /* Menambahkan item ke dalam cart */
    public function addToCart($cartData)
    {
        // Cek jika item sudah ada di cart
        $existingItem = $this->where('id_user', $cartData['id_user'])
                             ->where('id_product', $cartData['id_product'])
                             ->first();

        if ($existingItem) {
            // Jika item sudah ada, update kuantitas
            $newQuantity = $existingItem['quantity'] + $cartData['quantity'];
            return $this->update($existingItem['id_cart'], ['quantity' => $newQuantity]);
        } else {
            // Jika item belum ada, tambahkan ke cart
            return $this->insert($cartData);
        }
    }

    /* Mengambil semua item cart untuk pengguna tertentu */
    public function getCartByUserId($userId)
    {
        return $this->where('id_user', $userId)->findAll(); // Ambil semua item berdasarkan user_id
    }

    /* Menghapus item dari cart */
    public function removeFromCart($cartId)
    {
        return $this->delete($cartId); // Menghapus item dari cart berdasarkan id_cart
    }

    /* Mengupdate kuantitas item di cart */
    public function updateQuantity($cartId, $quantity)
    {
        return $this->update($cartId, ['quantity' => $quantity]); // Update kuantitas item di cart
    }

    /* Menghapus semua item dalam cart berdasarkan user_id */
    public function clearCartByUserId($userId)
    {
        return $this->where('id_user', $userId)->delete(); // Menghapus semua item dalam cart berdasarkan user_id
    }
}
