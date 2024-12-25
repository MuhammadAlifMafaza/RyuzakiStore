<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        // Pastikan pengguna sudah login dan memiliki peran customer
        if (!session()->get('loggedIn') || session()->get('role') !== 'customer') {
            return redirect()->to('/login');
        }

        // Tampilkan tampilan dashboard customer
        return view('customer/home'); // Pastikan Anda memiliki tampilan ini
    }
}