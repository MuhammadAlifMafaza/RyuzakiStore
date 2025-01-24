<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomerModel; // Pastikan Anda memiliki model ini untuk berinteraksi dengan database

class CustomerController extends Controller
{
    protected $session;
    protected $customerModel;

    public function __construct()
    {
        $this->session = session(); // Inisialisasi session
        $this->customerModel = new CustomerModel(); // Inisialisasi model customer
    }

    /**
     * Halaman utama customer
     */
    public function index()
    {
        $data = [
            'isLoggedIn' => $this->session->get('isLoggedIn'), // Cek apakah user login
            'username' => $this->session->get('username'), // Nama user (jika login)
        ];

        return view('customer/home', $data);
    }

    /**
     * Halaman profil customer
     */
    public function profile()
    {
        if (!$this->session->get('isLoggedIn')) {
            // Jika user belum login, redirect ke halaman login
            return redirect()->to('/login');
        }

        // Ambil data user dari database
        $customerId = $this->session->get('user_id'); // ID user dari session
        $customer = $this->customerModel->find($customerId); // Cari data customer

        $data = [
            'isLoggedIn' => true,
            'customer' => $customer, // Data customer yang diambil dari database
        ];

        return view('customer/profile', $data);
    }

    /**
     * Logout customer
     */
    public function logout()
    {
        $this->session->destroy(); // Hapus semua data session
        return redirect()->to('/login'); // Redirect ke halaman login
    }
}
