<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SuperAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Si el usuario no ha iniciado sesión, redirija a la página de inicio de sesión
        if (!session()->get('acceso')) {
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No es necesario realizar ninguna acción después del procesamiento del controlador.
    }


}

