<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function index()
    {
        // Tampilkan halaman dashboard admin
        return view('admin/dashboard');
    }
}