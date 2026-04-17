<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('Modules\Dashboard\Views\home', ['title' => 'Executive Dashboard - KlinikOS 2.0']);
    }

    public function laporan()
    {
        return view('Modules\Dashboard\Views\laporan', ['title' => 'Laporan & BI - KlinikOS 2.0']);
    }

    public function profile()
    {
        return view('Modules\Dashboard\Views\profile', ['title' => 'User Profile - KlinikOS 2.0']);
    }

    public function pengaturan()
    {
        return view('Modules\Dashboard\Views\pengaturan', ['title' => 'System Settings - KlinikOS 2.0']);
    }
}
