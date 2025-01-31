<?php

namespace App\Models;

use CodeIgniter\Model;

class OwnerModel extends Model
{
    protected $table = 'owner';
    protected $primaryKey = 'id_owner';
    protected $allowedFields = ['id_owner', 'username', 'password', 'email', 'full_name', 'phone_number', 'store_name', 'store_address'];
}
