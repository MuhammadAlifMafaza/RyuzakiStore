<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $identifier = $this->request->getPost('identifier');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $identifier)
            ->orWhere('email', $identifier)
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id_user' => $user['id_user'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true,
            ]);

            // mengarahkan kehalaman masing2 berdasarkan role
            switch ($user['role']) {
                case 'admin':
                    return redirect()->to('/admin/dashboard'); // Halaman admin
                case 'owner':
                    return redirect()->to('/owner/dashboard'); // Halaman owner
                case 'customer':
                    return redirect()->to('/customer/home'); // Halaman customer
                default:
                    session()->setFlashdata('msg', 'Role tidak dikenali!');
                    return redirect()->to('/login');
            }
        }

        session()->setFlashdata('msg', 'Username atau Email dan Password yang anda masukkan salah!');
        return redirect()->back()->withInput();
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

    public function registerProcess()
    {
        $rules = [
            'username' => 'required|min_length[8]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[4]',
            'repeat_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $role = $this->request->getPost('role') ?? 'customer'; // Role default adalah 'customer'
        $userModel = new UserModel();

        // Generate unique ID based on role
        $idUser = $userModel->generateUniqueId($role);

        $userModel->save([
            'id_user' => $idUser,
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $role,
        ]);

        session()->setFlashdata('success', 'Pendaftaran berhasil. Silakan login.');
        return redirect()->to('/login');
    }
}
