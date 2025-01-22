<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        // Tampilkan tampilan dashboard customer
        return view('customer/home'); // Pastikan Anda memiliki tampilan ini
    }

    public function login()
    {
        // Logika untuk menampilkan halaman login
        return view('auth/Login'); // Pastikan Anda memiliki tampilan ini
    }

    public function doLogin()
    {
        // Logika untuk memproses login
        // Misalnya, memeriksa kredensial pengguna dan menyimpan sesi jika berhasil
        // Setelah login berhasil, redirect ke halaman dashboard customer
    }
}