<?php

namespace Modules\Dokter\Controllers;

use App\Controllers\BaseController;

class Dokter extends BaseController
{
    public function antrean()
    {
        return view('Modules\Dokter\Views\antrean', ['title' => 'Daftar Tunggu Pasien - KlinikOS 2.0']);
    }

    public function soap()
    {
        return view('Modules\Dokter\Views\soap', ['title' => 'Rekam Medis (SOAP) - KlinikOS 2.0']);
    }
}
