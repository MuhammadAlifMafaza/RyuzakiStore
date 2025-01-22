<?php

namespace App\Controllers;

use App\Models\auth\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login'); // Menampilkan halaman login
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();

        // Ambil data dari form
        $identifier = $this->request->getPost('identifier');
        $password = $this->request->getPost('password');

        // Validasi input
        if (empty($identifier) || empty($password)) {
            $session->setFlashdata('msg', 'Semua kolom wajib diisi.');
            return redirect()->to('/login')->withInput();
        }

        // Cari pengguna berdasarkan email atau username
        $user = $model->where('email', $identifier)
                      ->orWhere('username', $identifier)
                      ->first();

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Simpan sesi pengguna
                $session->set([
                    'loggedIn' => true,
                    'userId' => $user['id_user'],
                    'role' => $user['role'],
                ]);

                // Redirect ke halaman sesuai role
                return redirect()->to('/' . $user['role'] . '/dashboard');
            } else {
                $session->setFlashdata('msg', 'Password salah.');
                return redirect()->to('/login')->withInput();
            }
        } else {
            $session->setFlashdata('msg', 'Email atau Username tidak ditemukan.');
            return redirect()->to('/login')->withInput();
        }
    }

    public function logout()
    {
        session()->destroy(); // Hapus semua sesi
        return redirect()->to('/login')->with('msg', 'Anda berhasil logout.');
    }
}
