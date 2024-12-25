<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        // Pastikan pengguna sudah login
        if (!session()->get('loggedIn')) {
            return redirect()->to('/login');
        }

        // Tampilkan tampilan dashboard
        return view('dashboard');
    }
}