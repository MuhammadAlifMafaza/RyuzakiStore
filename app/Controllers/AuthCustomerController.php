<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Controller;

class AuthCustomerController extends Controller
{
    /* Menampilkan halaman login */
    public function login()
    {
        return view('home/auth/Login');
    }

    /* Memproses login customer */
    public function processLogin()
    {
        $login = $this->request->getPost('login'); // Bisa berupa email atau username
        $password = $this->request->getPost('password');

        if (!$login || !$password) {
            return redirect()->back()->with('error', 'Username/Email dan Password wajib diisi.');
        }

        // Cek di tabel customer
        $customerModel = new CustomerModel();
        $customer = $customerModel->where('email', $login)->orWhere('username', $login)->first();

        if ($customer && password_verify($password, $customer['password'])) {
            session()->set([
                'user_id'    => $customer['id_customer'],
                'username'   => $customer['username'],
                'full_name'  => $customer['full_name'],
                'role'       => 'customer',
                'is_logged_in' => true,
            ]);
            return redirect()->to('home');
        }

        return redirect()->back()->with('error', 'Username/Email atau Password salah.');
    }

    /* Mengakhiri sesi login */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/customerAuth/login');
    }

    /* Menampilkan halaman registrasi */
    public function register()
    {
        return view('home/auth/register');
    }

    /* Memproses registrasi customer baru */
    public function processRegister()
    {
        $username = $this->request->getPost('username');
        $full_name = $this->request->getPost('full_name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');
        $phone_number = $this->request->getPost('phone_number');
        $address = $this->request->getPost('address');
        $created_at = date('Y-m-d H:i:s');

        if (!$username || !$full_name || !$email || !$password || !$confirmPassword) {
            return redirect()->back()->with('error', 'Semua field wajib diisi.');
        }

        if ($password !== $confirmPassword) {
            return redirect()->back()->with('error', 'Password dan Konfirmasi Password tidak sama.');
        }

        $customerModel = new CustomerModel();

        if ($customerModel->where('email', $email)->orWhere('username', $username)->first()) {
            return redirect()->back()->with('error', 'Email atau Username sudah terdaftar.');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $datePart = date('Ymd');
        $randomPart = strtoupper(bin2hex(random_bytes(2))); // menghasilkan 4 karakter acak
        $customer_id = sprintf("CUS-%s-%s", $datePart, $randomPart);

        $customerModel->save([
            'id_customer'      => $customer_id,
            'username'         => $username,
            'full_name'        => $full_name,
            'email'            => $email,
            'password'         => $hashedPassword,
            'phone_number'     => $phone_number,
            'address'          => $address,
            'membership_level' => 'bronze',
            'total_spent'      => 0.00,
            // 'created_at'       => $created_at
        ]);

        $data = [
            'id_customer'      => $customer_id,
            'username'         => $username,
            'full_name'        => $full_name,
            'email'            => $email,
            'password'         => $hashedPassword,
            'phone_number'     => $phone_number,
            'address'          => $address,
            'membership_level' => 'bronze',
            'total_spent'      => 0.00
        ];

        if (!$customerModel->save($data)) {
            log_message('error', 'Error saat menyimpan data: ' . print_r($customerModel->errors(), true));
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to('/customerAuth/login')->with('success', "Registrasi berhasil! ID Anda: $customer_id");
    }
}
