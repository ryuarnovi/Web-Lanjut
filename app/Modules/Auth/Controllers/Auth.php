<?php

namespace Modules\Auth\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('Modules\Auth\Views\login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Mock users database
        $users = [
            'admin' => [
                'password' => 'admin',
                'name'     => 'Dr. Rizki Ardiansyah',
                'role'     => 'admin',
            ],
            'resepsionis' => [
                'password' => 'resepsionis',
                'name'     => 'Sarah Resepsionis',
                'role'     => 'resepsionis',
            ],
            'dokter' => [
                'password' => 'dokter',
                'name'     => 'Dr. Andi Medis',
                'role'     => 'dokter',
            ],
            'apoteker' => [
                'password' => 'apoteker',
                'name'     => 'Budi Farmasi',
                'role'     => 'apoteker',
            ],
            'kasir' => [
                'password' => 'kasir',
                'name'     => 'Ani Keuangan',
                'role'     => 'kasir',
            ],
        ];

        if (isset($users[$username]) && $users[$username]['password'] === $password) {
            $user = $users[$username];
            $sessionData = [
                'username'  => $username,
                'name'      => $user['name'],
                'role'      => $user['role'],
                'logged_in' => true,
            ];
            session()->set($sessionData);

            // Role-based redirection
            switch($user['role']) {
                case 'resepsionis': return redirect()->to(base_url('resepsionis/pendaftaran'));
                case 'dokter':       return redirect()->to(base_url('dokter/antrean'));
                case 'apoteker':     return redirect()->to(base_url('apoteker/resep'));
                case 'kasir':        return redirect()->to(base_url('kasir/data'));
                default:             return redirect()->to(base_url('dashboard'));
            }
        } else {
            return redirect()->back()->with('error', 'Username atau Password salah!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
