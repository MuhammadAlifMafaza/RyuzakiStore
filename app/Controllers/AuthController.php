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

    public function register()
    {
        $uri = service('uri');
        $defaultRole = null;

        // Tentukan default role berdasarkan URI saat ini
        if ($uri->getSegment(1) === 'admin') {
            $defaultRole = 'admin';
        } elseif ($uri->getSegment(1) === 'owner') {
            $defaultRole = 'owner';
        } elseif ($uri->getSegment(1) === 'customer') {
            $defaultRole = 'customer';
        }

        return view('auth/register', ['defaultRole' => $defaultRole]); // Menampilkan halaman register
    }

    public function registerProcess()
    {
        $session = session();
        $model = new UserModel();

        // Ambil data dari form
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
        ];

        // Validasi input
        if (empty($data['username']) || empty($data['email']) || empty($data['password']) || empty($data['role'])) {
            $session->setFlashdata('msg', 'Semua kolom wajib diisi.');
            return redirect()->to('/register')->withInput();
        }

        // Validasi role
        $validRoles = ['admin', 'owner', 'customer'];
        if (!in_array($data['role'], $validRoles)) {
            $session->setFlashdata('msg', 'Role tidak valid.');
            return redirect()->to('/register')->withInput();
        }

        // Cek apakah email atau username sudah ada
        $existingUser = $model->where('email', $data['email'])
            ->orWhere('username', $data['username'])
            ->first();

        if ($existingUser) {
            $session->setFlashdata('msg', 'Email atau Username sudah digunakan.');
            return redirect()->to('/register')->withInput();
        }

        // Simpan pengguna baru
        $model->insert($data);
        $session->setFlashdata('msg', 'Registrasi berhasil. Silakan login.');
        return redirect()->to('/login');
    }

    public function unauthorized()
    {
        return view('errors/unauthorized'); // Menampilkan halaman unauthorized
    }
}
