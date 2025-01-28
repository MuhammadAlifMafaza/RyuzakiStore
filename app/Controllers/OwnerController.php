<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class OwnerController extends Controller
{
    public function index()
    {
        return view('owner/index'); // Halaman utama owner
    }

    public function dashboard()
    {
        return view('owner/dashboard'); // Dashboard owner
    }

    public function reports()
    {
        return view('owner/reports'); // Halaman laporan owner
    }
}
