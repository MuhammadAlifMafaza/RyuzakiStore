<?php

namespace App\Models;

use CodeIgniter\Model;

class UserCustomerModel extends Model
{
    protected $table = 'users'; // Nama tabel utama
    protected $primaryKey = 'id_user';

    /**
     * Fungsi untuk mendapatkan data gabungan antara tabel `users` dan `customer_details`
     * 
     * @param string|null $id_user
     * @return array|null
     */
    public function getUserWithDetails($id_user = null)
    {
        $builder = $this->db->table('users')
            ->select('users.id_user, users.username, users.email, users.role, customer_details.full_name, customer_details.phone_number, customer_details.address, customer_details.membership_level, customer_details.total_spent')
            ->join('customer_details', 'customer_details.id_user = users.id_user', 'left');

        if ($id_user) {
            $builder->where('users.id_user', $id_user);
            return $builder->get()->getRowArray(); // Mengambil satu baris data
        }

        return $builder->get()->getResultArray(); // Mengambil semua baris data
    }

    /**
     * Fungsi untuk menambahkan data ke dalam kedua tabel (users & customer_details)
     * 
     * @param array $userData
     * @param array $customerData
     * @return bool
     */
    public function insertUserAndDetails(array $userData, array $customerData)
    {
        $this->db->transStart(); // Memulai transaksi

        // Masukkan data ke tabel `users`
        $this->db->table('users')->insert($userData);

        // Masukkan data ke tabel `customer_details`
        $this->db->table('customer_details')->insert($customerData);

        $this->db->transComplete(); // Selesaikan transaksi

        return $this->db->transStatus(); // Kembalikan status transaksi
    }

    /**
     * Fungsi untuk mengupdate data user dan detail customer
     * 
     * @param string $id_user
     * @param array $userData
     * @param array $customerData
     * @return bool
     */
    public function updateUserAndDetails($id_user, array $userData, array $customerData)
    {
        $this->db->transStart(); // Memulai transaksi

        // Update data pada tabel `users`
        $this->db->table('users')->update($userData, ['id_user' => $id_user]);

        // Update data pada tabel `customer_details`
        $this->db->table('customer_details')->update($customerData, ['id_user' => $id_user]);

        $this->db->transComplete(); // Selesaikan transaksi

        return $this->db->transStatus(); // Kembalikan status transaksi
    }
}
