<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        // Tampilkan tampilan halaman utama customer
        return view('customer/home'); // Pastikan Anda memiliki tampilan ini
    }

    public function profile()
    {
        // Logika untuk menampilkan profil customer
        return view('customer/profile'); // Pastikan Anda memiliki tampilan ini
    }

    
}
