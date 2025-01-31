<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id_customer';
    protected $allowedFields = [
        'username', 'password', 'email', 'full_name', 'phone_number', 'address', 
        'membership_level', 'total_spent', 'created_at', 'updated_at'
    ];

    
}
