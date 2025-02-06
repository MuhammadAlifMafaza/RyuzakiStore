<?php

namespace App\Models;

use CodeIgniter\Model;

class OwnerModel extends Model
{
    protected $table = 'owner';
    protected $primaryKey = 'id_owner';
    protected $allowedFields = [
        'id_owner', 'username', 'password', 'full_name', 'img_profile', 'email', 
        'phone_number', 'store_name', 'store_address', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
}
