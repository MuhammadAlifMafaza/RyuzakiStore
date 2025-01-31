<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userRole = session()->get('role');
        $path = $request->getUri()->getPath();


        if (strpos($path, 'admin') === 0 && $userRole !== 'admin') {
            session()->setFlashdata('msg', 'Anda tidak memiliki akses ke halaman admin.');
            return redirect()->to('/login');
        }
        if (strpos($path, 'owner') === 0 && $userRole !== 'owner') {
            session()->setFlashdata('msg', 'Anda tidak memiliki akses ke halaman owner.');
            return redirect()->to('/login');
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
