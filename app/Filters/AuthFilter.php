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

        // 1. Periksa apakah pengguna sudah login
        if (!$session->has('loggedIn') || !$session->get('loggedIn')) {
            return redirect()->to('/login')->with('msg', 'Silakan login terlebih dahulu.');
        }

        // 2. Periksa apakah role pengguna sesuai dengan argumen filter
        $userRole = $session->get('role');
        if (!empty($arguments) && !in_array($userRole, $arguments)) {
            return redirect()->to('/unauthorized')->with('msg', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        // 3. Validasi URI sesuai dengan role pengguna
        $uri = service('uri');
        $firstSegment = $uri->getSegment(1); // Ambil segmen pertama dari URI
        $validSegments = [
            'admin' => 'admin',
            'owner' => 'owner',
            'customer' => 'customer'
        ];

        if (isset($validSegments[$userRole]) && $firstSegment !== $validSegments[$userRole]) {
            return redirect()->to('/unauthorized')->with('msg', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada yang perlu dilakukan setelah request selesai
    }
}
