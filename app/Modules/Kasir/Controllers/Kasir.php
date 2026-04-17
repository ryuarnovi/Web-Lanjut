<?php

namespace Modules\Kasir\Controllers;

use App\Controllers\BaseController;

class Kasir extends BaseController
{
    public function billing()
    {
        return view('Modules\Kasir\Views\billing', ['title' => 'Billing & Pembayaran - KlinikOS 2.0']);
    }
}
