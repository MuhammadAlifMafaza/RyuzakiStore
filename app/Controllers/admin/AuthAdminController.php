<?php

namespace App\Controllers\Admin;

use App\Models\AdminModel;
use App\Models\OwnerModel;
use CodeIgniter\Controller;

class AuthAdminController extends Controller
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

        // Cek di tabel admin
        $adminModel = new AdminModel();
        $admin = $adminModel->where('email', $login)->orWhere('username', $login)->first();

        if ($admin && password_verify($password, $admin['password'])) {
            session()->set([
                'user_id'    => $admin['id_admin'],
                'username'   => $admin['username'],
                'full_name'  => $admin['full_name'],
                'role'       => 'admin',
                'is_logged_in' => true,
            ]);
            return redirect()->to('/admin');
        }

        // Cek di tabel owner
        $ownerModel = new OwnerModel();
        $owner = $ownerModel->where('email', $login)->orWhere('username', $login)->first();

        if ($owner && password_verify($password, $owner['password'])) {
            session()->set([
                'user_id'    => $owner['id_owner'],
                'username'   => $owner['username'],
                'full_name'  => $owner['full_name'],
                'role'       => 'owner',
                'is_logged_in' => true,
            ]);
            return redirect()->to('/owner');
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
        $role = $this->request->getPost('role'); // 'admin' atau 'owner'
        $username = $this->request->getPost('username');
        $full_name = $this->request->getPost('full_name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');
        $phone_number = $this->request->getPost('phone_number');
        $created_at = date('Y-m-d H:i:s'); // Waktu pembuatan akun

        if (!$role || !$username || !$full_name || !$email || !$password || !$confirmPassword) {
            return redirect()->back()->with('error', 'Semua field wajib diisi.');
        }

        if ($password !== $confirmPassword) {
            return redirect()->back()->with('error', 'Password dan Konfirmasi Password tidak sama.');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $dateCode = date('Ymd');
        $randomCode = strtoupper(bin2hex(random_bytes(2))); // 4 karakter unik

        if ($role === 'admin') {
            $adminModel = new AdminModel();

            if ($adminModel->where('email', $email)->orWhere('username', $username)->first()) {
                return redirect()->back()->with('error', 'Email atau Username sudah terdaftar.');
            }

            $admin_id = "ADM$dateCode$randomCode";

            $adminModel->save([
                'id_admin'     => $admin_id,
                'username'     => $username,
                'full_name'    => $full_name,
                'email'        => $email,
                'password'     => $hashedPassword,
                'phone_number' => $phone_number,
                'created_at'   => $created_at
            ]);

            return redirect()->to('/adminAuth/login')->with('success', "Registrasi Admin berhasil! ID Anda: $admin_id");
        }

        if ($role === 'owner') {
            $ownerModel = new OwnerModel();

            if ($ownerModel->where('email', $email)->orWhere('username', $username)->first()) {
                return redirect()->back()->with('error', 'Email atau Username sudah terdaftar.');
            }

            $owner_id = "OWN$dateCode$randomCode";

            $ownerModel->save([
                'id_owner'      => $owner_id,
                'username'      => $username,
                'full_name'     => $full_name,
                'email'         => $email,
                'password'      => $hashedPassword,
                'phone_number'  => $phone_number,
                'created_at'    => $created_at
            ]);

            return redirect()->to('/adminAuth/login')->with('success', "Registrasi Owner berhasil! ID Anda: $owner_id");
        }

        return redirect()->back()->with('error', 'Role tidak valid.');
    }
}
