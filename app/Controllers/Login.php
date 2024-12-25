<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function login()
    {
        return view('auth/login');
    }
    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();

        // Ambil input dari form
        $identifier = $this->request->getPost('identifier'); // Menggunakan satu input untuk email atau username
        $password = $this->request->getPost('password');

        // Cari pengguna berdasarkan email atau username
        $user = $model->where('email', $identifier)->orWhere('username', $identifier)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set('loggedIn', true);
                $session->set('userId', $user['id']);
                $session->set('role', $user['role']);

                // Redirect ke dashboard berdasarkan role
                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin/dashboard'); // Redirect ke dashboard admin
                } elseif ($user['role'] === 'customer') {
                    return redirect()->to('/customer/dashboard'); // Redirect ke dashboard customer
                }
            } else {
                $session->setFlashdata('msg', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email atau Username tidak ditemukan');
            return redirect()->to('/login');
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
