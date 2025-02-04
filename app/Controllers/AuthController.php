<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CustomerModel;
use App\Models\OwnerModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    /* Menampilkan halaman login */
    public function login()
    {
        return view('auth/login');
    }

    /* Memproses login pengguna */
    public function processLogin()
    {
        $login = $this->request->getPost('login'); // Bisa berupa email atau username
        $password = $this->request->getPost('password');

        if (!$login || !$password) {
            return redirect()->back()->with('error', 'Username/Email dan Password wajib diisi.');
        }

        // Cek di tabel admin berdasarkan email atau username
        $CustomerModel = new CustomerModel();
        $admin = $CustomerModel->where('email', $login)->orWhere('username', $login)->first();
        
        if ($admin && password_verify($password, $admin['password'])) {
            session()->set([
                'user_id' => $admin['id_admin'],
                'username' => $admin['username'],
                'full_name' => $admin['full_name'],
                'role' => 'admin',
                'is_logged_in' => true,
            ]);
            return redirect()->to('/admin');
        }

        return redirect()->back()->with('error', 'Username/Email atau Password salah.');
    }

    /* Mengakhiri sesi login */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/adminAuth/login');
    }

    /* Menampilkan halaman registrasi */
    public function register()
    {
        return view('auth/register');
    }

    /* Memproses registrasi pengguna baru */
    public function processRegister()
    {
        $username = $this->request->getPost('username');
        $full_name = $this->request->getPost('full_name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if (!$username || !$full_name || !$email || !$password || !$confirmPassword) {
            return redirect()->back()->with('error', 'Semua field wajib diisi.');
        }

        if ($password !== $confirmPassword) {
            return redirect()->back()->with('error', 'Password dan Konfirmasi Password tidak sama.');
        }

        $CustomerModel = new CustomerModel();

        if ($CustomerModel->where('email', $email)->orWhere('username', $username)->first()) {
            return redirect()->back()->with('error', 'Email atau Username sudah terdaftar.');
        }

        $CustomerModel->save([
            'id_admin' => uniqid(),
            'username' => $username,
            'full_name' => $full_name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/adminAuth/login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
