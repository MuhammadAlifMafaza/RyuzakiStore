<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    protected $allowedFields = [
        'id_order', 'id_customer', 'order_date', 'destination_address', 'status', 'total_amount'
    ];

    protected $useTimestamps = true;

    // Fungsi untuk mendapatkan pendapatan per bulan
    public function getMonthlyRevenue()
    {
        return $this->select("DATE_FORMAT(created_at, '%Y-%m') AS month, SUM(total_price) AS revenue")
                    ->groupBy('month')
                    ->orderBy('month', 'ASC')
                    ->findAll();
    }

    // Fungsi untuk mendapatkan statistik status order
    public function getOrderStats()
    {
        return $this->select("status, COUNT(id) AS total")
                    ->groupBy('status')
                    ->findAll();
    }
    
    /* Membuat order baru */
    public function createOrder($orderData)
    {
        $this->insert($orderData);  // Menambahkan order ke database
        return $this->getInsertID(); // Mengembalikan ID order yang baru dibuat
    }

    /* Mengupdate status pesanan */
    public function updateOrderStatus($id_order, $status)
    {
        return $this->update($id_order, ['status' => $status]); // Update status pesanan
    }

    /**
     * Mendapatkan pesanan berdasarkan user ID
     */
    public function getOrdersByCustomerId($id_customer)
    {
        return $this->where('id_customer', $id_customer)->findAll();
    }
}
