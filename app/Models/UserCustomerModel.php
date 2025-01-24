<?php

namespace App\Models;

use CodeIgniter\Model;

class UserCustomerModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_user', 'username', 'email', 'password', 'role', 'created_at', 'updated_at'];
 
    // Relasi dengan tabel customer_details
    protected $customerDetailsTable = 'customer_details';

    // Menentukan relasi dengan customer_details
    public function getCustomerDetails($id_user)
    {
        return $this->db->table($this->customerDetailsTable)
            ->where('id_user', $id_user)
            ->get()
            ->getRowArray();
    }

    public function createUserWithDetails($userData, $customerDetailsData)
    {
        // Mulai transaksi untuk memastikan konsistensi
        $this->db->transStart();

        // Menyimpan data user
        $this->insert($userData);

        // Menambahkan detail pelanggan setelah user dibuat
        $customerDetailsData['id_user'] = $userData['id_user'];  // Pastikan id_user diisi
        $this->db->table($this->customerDetailsTable)->insert($customerDetailsData);

        // Menyelesaikan transaksi
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            // Jika transaksi gagal, rollback dan kembalikan false
            return false;
        }

        return true;
    }

    public function updateUserDetails($id_user, $userData, $customerDetailsData)
    {
        // Mulai transaksi untuk memastikan konsistensi
        $this->db->transStart();

        // Update data user
        $this->update($id_user, $userData);

        // Update data detail pelanggan
        $this->db->table($this->customerDetailsTable)
            ->where('id_user', $id_user)
            ->update($customerDetailsData);

        // Menyelesaikan transaksi
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            // Jika transaksi gagal, rollback dan kembalikan false
            return false;
        }

        return true;
    }

    public function deleteUserWithDetails($id_user)
    {
        // Mulai transaksi untuk memastikan konsistensi
        $this->db->transStart();

        // Hapus data detail pelanggan
        $this->db->table($this->customerDetailsTable)
            ->where('id_user', $id_user)
            ->delete();

        // Hapus data user
        $this->delete($id_user);

        // Menyelesaikan transaksi
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            // Jika transaksi gagal, rollback dan kembalikan false
            return false;
        }

        return true;
    }
}
