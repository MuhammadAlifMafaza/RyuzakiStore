<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AdminController extends Controller
{
     public function index()
    {
        return view('admin/index'); // Halaman utama admin
    }

    public function dashboard()
    {
        return view('admin/dashboard'); // Dashboard admin
    }

    public function settings()
    {
        return view('admin/settings'); // Halaman pengaturan admin
    }

    public function users()
    {
        return view('admin/users'); // Halaman manajemen pengguna
    }
}
