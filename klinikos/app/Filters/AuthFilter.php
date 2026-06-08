<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
 * Auth + RBAC Filter
 * Usage in Routes.php:
 *   ['filter' => 'auth']                        -> must be logged in
 *   ['filter' => 'auth:admin,dokter']           -> must be admin OR dokter
 */
class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            // API => 401 JSON, web => redirect
            if (strpos($request->getUri()->getPath(), 'api/') !== false) {
                return service('response')
                    ->setStatusCode(401)
                    ->setJSON(['status' => 'error', 'message' => 'Unauthorized']);
            }
            return redirect()->to('/login');
        }

        if (!empty($arguments)) {
            $userRole = $session->get('role');
            if (!in_array($userRole, $arguments, true)) {
                if (strpos($request->getUri()->getPath(), 'api/') !== false) {
                    return service('response')
                        ->setStatusCode(403)
                        ->setJSON(['status' => 'error', 'message' => 'Forbidden']);
                }
                return service('response')
                    ->setStatusCode(403)
                    ->setBody('403 Forbidden — Anda tidak punya akses ke halaman ini.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
