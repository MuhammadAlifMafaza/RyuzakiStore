<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomerModel;
use App\Models\ProductModel;

class CustomerController extends Controller
{
    protected $session;
    protected $CustomerModel;
    protected $ProductModel;

    public function __construct()
    {
        $this->session = session();
        $this->CustomerModel = new CustomerModel();
    }

    // halaman utama customer
    public function index()
    {
        return view('customer/home');
    }

    // checkout barang
    public function checkout()
    {
        // Pastikan hanya customer yang bisa mengakses halaman ini
        if (session()->get('role') !== 'customer') {
            session()->setFlashdata('msg', 'Anda harus login sebagai customer untuk mengakses halaman ini.');
            return redirect()->to('/login');
        }

        // Tampilkan halaman checkout
        return view('customer/checkout');
    }

    // halaman profile
    public function profile()
    {
        if (!$this->session->get('isLoggedIn')) {
            // Jika user belum login, redirect ke halaman login
            return redirect()->to('/login');
        }

        // Ambil ID user dari session
        $customerId = $this->session->get('user_id'); // ID user dari session

        // Ambil data pengguna dari tabel users
        $user = $this->CustomerModel->find($customerId);

        // Ambil data detail pelanggan dari tabel customer_details
        $customerDetails = $this->CustomerModel->getCustomerDetails($customerId);

        // Gabungkan data pengguna dan detail pelanggan
        $data = [
            'isLoggedIn' => true,
            'user' => $user, // Data user yang diambil dari tabel users
            'customerDetails' => $customerDetails, // Data detail pelanggan
        ];

        return view('customer/profile', $data);
    }

    public function updateProfile()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Ambil ID user dari session
        $customerId = $this->session->get('user_id');

        // Ambil data yang dikirim dari form
        $userData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $customerDetailsData = [
            'full_name' => $this->request->getPost('full_name'),
            'phone_number' => $this->request->getPost('phone_number'),
            'address' => $this->request->getPost('address'),
            'membership_level' => $this->request->getPost('membership_level'),
            'total_spent' => $this->request->getPost('total_spent')
        ];

        // Update data user dan detail customer
        $updateStatus = $this->CustomerModel->updateUserDetails($customerId, $userData, $customerDetailsData);

        if ($updateStatus) {
            // Jika update berhasil
            return redirect()->to('/customer/profile')->with('success', 'Profile updated successfully!');
        } else {
            // Jika update gagal
            return redirect()->to('/customer/profile')->with('error', 'Failed to update profile!');
        }
    }
}
