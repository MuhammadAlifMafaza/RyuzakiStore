<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 1. Periksa apakah role "customer" diizinkan tanpa login
        if (in_array('customer', $arguments ?? [])) {
            return; // Jika role customer diizinkan tanpa login, lewati pemeriksaan
        }

        // 2. Periksa apakah pengguna sudah login
        if (!$session->has('loggedIn') || !$session->get('loggedIn')) {
            return redirect()->to('/auth/login')->with('msg', 'Silakan login terlebih dahulu.');
        }

        // 3. Periksa apakah role pengguna sesuai dengan argumen filter
        if (!empty($arguments) && !in_array($session->get('role'), $arguments)) {
            return redirect()->to('/auth/login')->with('msg', 'Anda tidak memiliki akses ke halaman tersebut.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada yang perlu dilakukan setelah request selesai
    }
}
