<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class OwnerController extends Controller
{
    public function dashboard()
    {
        return view('owner/dashboard'); // Dashboard owner
    }

    public function settings()
    {
        return view('owner/settings'); // Halaman pengaturan owner
    }

    public function users()
    {
        return view('owner/users'); // Halaman manajemen pengguna
    }
    public function reports()
    {
        return view('owner/reports'); // Halaman laporan owner
    }
}
