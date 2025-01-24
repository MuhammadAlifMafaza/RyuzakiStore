<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserCustomerModel; // Menggunakan model yang sudah dibuat

class CustomerController extends Controller
{
    protected $session;
    protected $userCustomerModel;

    public function __construct()
    {
        $this->session = session(); // Inisialisasi session
        $this->userCustomerModel = new UserCustomerModel(); // Inisialisasi model UserCustomer
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

        // Ambil ID user dari session
        $customerId = $this->session->get('user_id'); // ID user dari session
        
        // Ambil data pengguna dari tabel users
        $user = $this->userCustomerModel->find($customerId);

        // Ambil data detail pelanggan dari tabel customer_details
        $customerDetails = $this->userCustomerModel->getCustomerDetails($customerId);

        // Gabungkan data pengguna dan detail pelanggan
        $data = [
            'isLoggedIn' => true,
            'user' => $user, // Data user yang diambil dari tabel users
            'customerDetails' => $customerDetails, // Data detail pelanggan
        ];

        return view('customer/profile', $data);
    }

    /**
     * Update profil customer
     */
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
        $updateStatus = $this->userCustomerModel->updateUserDetails($customerId, $userData, $customerDetailsData);

        if ($updateStatus) {
            // Jika update berhasil
            return redirect()->to('/customer/profile')->with('success', 'Profile updated successfully!');
        } else {
            // Jika update gagal
            return redirect()->to('/customer/profile')->with('error', 'Failed to update profile!');
        }
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
