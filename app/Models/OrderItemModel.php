<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id_order_item';
    protected $allowedFields = ['id_order_item', 'id_order', 'id_product', 'quantity', 'price'];

    /* Menambahkan item ke dalam order */
    public function addOrderItem($orderItemData)
    {
        return $this->insert($orderItemData); // Menambahkan item ke dalam pesanan
    }

    /* Mendapatkan item berdasarkan ID order */
    public function getOrderItemsByOrderId($id_order)
    {
        return $this->where('id_order', $id_order)->findAll(); // Mendapatkan item berdasarkan ID order
    }

    /* Menghitung total harga untuk order item */
    public function calculateTotal($id_order)
    {
        $orderItems = $this->where('id_order', $id_order)->findAll();
        $total = 0;
        foreach ($orderItems as $item) {
            $total += $item['quantity'] * $item['price']; // Menjumlahkan total harga item
        }
        return $total; // Mengembalikan total harga untuk pesanan
    }
}
