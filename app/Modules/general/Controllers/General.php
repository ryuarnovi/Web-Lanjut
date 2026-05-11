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
        return view('Modules\General\Views\Contact', ['title' => 'Kontak klinik- KlinikOS 2.0']);
    }

}
