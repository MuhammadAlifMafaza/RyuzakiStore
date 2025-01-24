<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil role dari session
        $role = session()->get('role');

        // Pastikan pengguna sudah login
        if (!$role) {
            return redirect()->to('/login');
        }

        // Pastikan role sesuai dengan yang dibutuhkan
        if (in_array($role, $arguments)) {
            return;
        }

        // Jika role tidak cocok, redirect ke halaman home
        return redirect()->to('/');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi setelah request
    }
}
