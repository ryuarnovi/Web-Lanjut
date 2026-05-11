<?php

namespace Modules\Kasir\Controllers;

use App\Controllers\BaseController;

class Kasir extends BaseController
{
    public function billing()
    {
        return view('Modules\Kasir\Views\billing', ['title' => 'Billing & Pembayaran - KlinikOS 2.0']);
    }

    public function data()
    {
        return view('Modules\Kasir\Views\data', ['title' => 'Daftar Tagihan - KlinikOS 2.0']);
    }

    public function form()
    {
        return view('Modules\Kasir\Views\form', ['title' => 'Buat Tagihan Manual - KlinikOS 2.0']);
    }
}
