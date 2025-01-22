<?php

namespace App\Models\auth;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'email', 'password', 'role', 'created_at', 'updated_at'];
}