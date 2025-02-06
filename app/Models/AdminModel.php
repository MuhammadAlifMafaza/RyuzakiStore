<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = [
        'id_admin',
        'username',
        'password',
        'full_name',
        'img_profile',
        'email',
        'phone_number',
        'address',
        'department',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true; // Menggunakan timestamp
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Untuk mencari berdasarkan ID Admin
    public function getAdmin($id_admin = false)
    {
        if ($id_admin === false) {
            return $this->findAll();
        }

        return $this->where(['id_admin' => $id_admin])->first();
    }
}