<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    // Fungsi untuk registrasi akun
    public function register()
    {
        $validation = \Config\Services::validation();
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            // Validasi input
            $validation->setRules([
                'username' => 'required|min_length[3]|max_length[255]|is_unique[users.username]',
                'email'    => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]',
            ]);

            if (!$validation->run($data)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            // Hash password
            $userModel = new UserModel();
            $userData = [
                'username' => $data['username'],
                'email'    => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                'role'     => 'user', // Atur sesuai dengan role yang diinginkan
                'created_at' => date('Y-m-d H:i:s'),
            ];

            if ($userModel->save($userData)) {
                return redirect()->to('/login')->with('message', 'Registration successful!');
            } else {
                return redirect()->back()->with('error', 'Failed to register. Please try again.');
            }
        }

        return view('auth/register');
    }

    // Fungsi untuk menampilkan halaman login
    public function login()
    {
        return view('auth/login'); // Menampilkan form login
    }

    // Fungsi untuk memproses login
    public function loginProcess()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $validation = \Config\Services::validation();

            // Validasi input
            $validation->setRules([
                'username_or_email' => 'required',
                'password' => 'required|min_length[8]',
            ]);

            if (!$validation->run($data)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $userModel = new UserModel();
            $user = null;

            // Cek apakah input yang diberikan adalah email atau username
            if (filter_var($data['username_or_email'], FILTER_VALIDATE_EMAIL)) {
                // Jika email, cari berdasarkan email
                $user = $userModel->where('email', $data['username_or_email'])->first();
            } else {
                // Jika bukan email, anggap itu username
                $user = $userModel->where('username', $data['username_or_email'])->first();
            }

            // Cek apakah user ditemukan dan password cocok
            if ($user && password_verify($data['password'], $user['password'])) {
                // Set session untuk user
                session()->set('user_id', $user['id_user']);
                session()->set('username', $user['username']);
                session()->set('role', $user['role']);  // Menyimpan role dalam session

                // Pengarahan berdasarkan role
                switch ($user['role']) {
                    case 'admin':
                        return redirect()->to('/admin');  // Pengguna admin diarahkan ke /admin
                    case 'owner':
                        return redirect()->to('/owner');  // Pengguna owner diarahkan ke /owner
                    case 'user':
                    default:
                        return redirect()->to('/customer');  // Pengguna customer diarahkan ke /customer
                }
            } else {
                return redirect()->back()->with('error', 'Invalid credentials');
            }
        }

        return redirect()->to('/login'); // Jika bukan post, arahkan kembali ke halaman login
    }

    // Fungsi untuk logout
    public function logout()
    {
        session()->destroy(); // Menghapus semua session
        return redirect()->to('/login')->with('message', 'Logged out successfully');
    }
}
