<?php

namespace Modules\Resepsionis\Controllers;

use App\Controllers\BaseController;

class Resepsionis extends BaseController
{
    public function pendaftaran()
    {
        return view('Modules\Resepsionis\Views\pendaftaran', ['title' => 'Pendaftaran Pasien - KlinikOS 2.0']);
    }

    public function antrean()
    {
        return view('Modules\Resepsionis\Views\antrean', ['title' => 'Plotting Antrean - KlinikOS 2.0']);
    }
}
