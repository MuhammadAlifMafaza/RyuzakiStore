<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $allowedFields = ['username', 'email', 'password', 'role', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Melakukan Generate ID Unik berdasarkan role
    public function generateUniqueId($role)
    {
        $prefix = '';
        switch ($role) {
            case 'admin':
                $prefix = 'ADM';
                break;
            case 'owner':
                $prefix = 'OWN';
                break;
            case 'customer':
                $prefix = 'CST';
                break;
        }

        $lastRecord = $this->orderBy('id_user', 'DESC')->first();
        $lastId = $lastRecord ? intval(substr($lastRecord['id_user'], 3)) : 0;
        $newId = $lastId + 1;

        return $prefix . str_pad($newId, 4, '0', STR_PAD_LEFT); // Contoh: ADM0001
    }
}
