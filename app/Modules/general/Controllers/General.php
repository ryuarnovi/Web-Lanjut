<?php

namespace Modules\General\Controllers;

use App\Controllers\BaseController;

class general extends BaseController
{
    public function General()
    {
        return view('Modules\General\Views\General', ['title' => 'Home Profile - KlinikOS 2.0']);
    }

    public function Service()
    {
        return view('Modules\General\Views\Service', ['title' => 'Layanan klinik- KlinikOS 2.0']);
    }

    public function About(){
        return view('Modules\General\Views\About', ['title' => 'Tentang klinik- KlinikOS 2.0']);
    }

    public function Contact(){
        $db = \Config\Database::connect();
        $doctors = $db->query("SELECT id, full_name, specialization FROM users WHERE role = 'dokter' AND is_active = 1 ORDER BY full_name ASC")->getResultArray();
        return view('Modules\General\Views\Contact', [
            'title' => 'Kontak klinik- KlinikOS 2.0',
            'doctors' => $doctors,
        ]);
    }

}
