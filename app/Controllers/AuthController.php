<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $validation = \Config\Services::validation();
        $input = $this->request->getPost();

        // Validate input
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required',
        ])) {
            return view('auth/login', ['validation' => $this->validator]);
        }

        $customerModel = new CustomerModel();
        $customer = $customerModel->where('username', $input['username'])->first();

        if ($customer && password_verify($input['password'], $customer['password'])) {
            // User authenticated, store session data
            session()->set([
                'id_customer'   => $customer['id_customer'],
                'username'      => $customer['username'],
                'email'         => $customer['email'],
                'logged_in'     => true,
            ]);

            return redirect()->to('/'); // Redirect to the home/dashboard page
        }

        // Invalid login attempt
        return view('auth/login', ['error' => 'Invalid credentials']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
    {
        $validation = \Config\Services::validation();

        // Validate input
        $input = $this->request->getPost();
        if (!$this->validate([
            'username' => 'required|is_unique[customer.username]',
            'email'    => 'required|valid_email|is_unique[customer.email]',
            'password' => 'required|min_length[6]',
            'full_name' => 'required',
        ])) {
            return view('auth/register', ['validation' => $this->validator]);
        }

        $customerModel = new CustomerModel();

        // Generate ID with a custom format: CUST + timestamp to ensure uniqueness
        $id_customer = 'CUST' . strtoupper(uniqid('')); // Menggunakan uniqid() dengan prefix 'CUST'

        $data = [
            'id_customer'    => $id_customer, // ID baru dengan format CUSTXXXXXX
            'username'       => $input['username'],
            'email'          => $input['email'],
            'password'       => password_hash($input['password'], PASSWORD_DEFAULT), // Encrypt password
            'full_name'      => $input['full_name'],
            'created_at'     => Time::now(),
            'updated_at'     => Time::now(),
        ];

        if ($customerModel->save($data)) {
            return redirect()->to('/login');
        }

        return view('auth/register');
    }

    public function forgotPasswordStep1()
    {
        // Halaman form untuk input username atau email
        return view('auth/ForgotPassword');
    }

    public function verifyUser()
    {
        $input = $this->request->getPost();
        $validation = \Config\Services::validation();

        if (!$this->validate([
            'username_or_email' => 'required',
        ])) {
            return view('forgot_password_step1', ['validation' => $this->validator]);
        }

        $customerModel = new CustomerModel();
        $usernameOrEmail = $input['username_or_email'];

        // Mencari berdasarkan username atau email
        $customer = $customerModel->where('username', $usernameOrEmail)
            ->orWhere('email', $usernameOrEmail)
            ->first();

        if ($customer) {
            // Jika data ditemukan, arahkan ke halaman reset password
            return redirect()->to('/reset-password/' . $customer['id_customer']);
        }

        // Jika data tidak ditemukan
        return view('forgot_password_step1', ['error' => 'Username atau Email tidak ditemukan']);
    }

    public function resetPassword($id_customer)
    {
        $customerModel = new CustomerModel();
        $customer = $customerModel->find($id_customer);

        if (!$customer) {
            return redirect()->to('/forgot-password')->with('error', 'Akun tidak ditemukan');
        }

        return view('auth/ResetPassword', ['id_customer' => $id_customer]);
    }

    public function updatePassword()
    {
        $input = $this->request->getPost();
        $validation = \Config\Services::validation();

        // Validasi password dan konfirmasi password
        if (!$this->validate([
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ])) {
            return view('reset_password', ['validation' => $this->validator, 'id_customer' => $input['id_customer']]);
        }

        $customerModel = new CustomerModel();
        $data = [
            'password' => password_hash($input['password'], PASSWORD_DEFAULT), // Enkripsi password
            'updated_at' => Time::now(),
        ];

        // Coba update password
        if ($customerModel->update($input['id_customer'], $data)) {
            return redirect()->to('/login')->with('message', 'Password berhasil diperbarui');
        } else {
            return redirect()->to('/reset-password/' . $input['id_customer'])->with('error', 'Terjadi kesalahan saat memperbarui password');
        }
    }
}
