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

        // Mock login - in a real app, verify against database
        if ($username === 'admin' && $password === 'admin') {
            $sessionData = [
                'username'  => 'admin',
                'name'      => 'Dr. Rizki Ardiansyah',
                'role'      => 'admin',
                'logged_in' => true,
            ];
            session()->set($sessionData);

            // Role-based redirection
            switch($sessionData['role']) {
                case 'resepsionis': return redirect()->to(base_url('resepsionis/pendaftaran'));
                case 'dokter':       return redirect()->to(base_url('dokter/antrean'));
                case 'apoteker':     return redirect()->to(base_url('apoteker/stok'));
                case 'kasir':        return redirect()->to(base_url('kasir/billing'));
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
