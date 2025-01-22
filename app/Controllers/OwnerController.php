<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class OwnerController extends Controller
{
    public function index()
    {
        // Tampilkan halaman dashboard owner
        return view('owner/dashboard');
    }
}
