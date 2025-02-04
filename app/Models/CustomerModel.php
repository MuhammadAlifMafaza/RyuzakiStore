<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id_customer';
    protected $allowedFields = [
        'username','password','full_name', 'email', 'img_profile',
        'phone_number','address','membership_level',
        'total_spent','created_at','updated_at'
    ];

    protected $useTimestamps = true;
   
    // Method to fetch customer details (optional, if you need it)
    public function getCustomerDetails($id_customer)
    {
        return $this->db->table('customer')
            ->select('full_name, phone_number, address, membership_level, total_spent')
            ->where('id_customer', $id_customer)
            ->get()
            ->getRowArray();
    }

    // Method to update user and customer details
    public function updateUserDetails($customerId, $userData, $customerDetailsData)
    {
        // Start a transaction
        $this->db->transBegin();

        // Update user data
        $this->update($customerId, $userData);

        // Update customer details
        $this->db->table('customer')->where('id_customer', $customerId)->update($customerDetailsData);

        // Commit transaction if no error
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }
}
