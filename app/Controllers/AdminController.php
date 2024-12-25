<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function index()
    {
        // Pastikan pengguna sudah login dan memiliki peran admin
        if (!session()->get('loggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        // Tampilkan tampilan dashboard admin
        return view('admin/dashboard'); // Pastikan Anda memiliki tampilan ini
    }
}