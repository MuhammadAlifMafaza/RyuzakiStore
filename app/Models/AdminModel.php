<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = [
        'id_admin', 'username', 'password', 'full_name', 'email', 
        'phone_number', 'address', 'department', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
}
