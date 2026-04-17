<?php

namespace Modules\Apoteker\Controllers;

use App\Controllers\BaseController;

class Apoteker extends BaseController
{
    public function resep()
    {
        return view('Modules\Apoteker\Views\resep', ['title' => 'Penebusan Obat - KlinikOS 2.0']);
    }

    public function stok()
    {
        return view('Modules\Apoteker\Views\stok', ['title' => 'Stok Obat & Inventaris - KlinikOS 2.0']);
    }
}
