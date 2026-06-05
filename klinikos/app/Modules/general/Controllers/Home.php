<?php
namespace App\Modules\general\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()   { return view('App\Modules\general\Views\home',    ['title' => 'Beranda']); }
    public function about()   { return view('App\Modules\general\Views\about',   ['title' => 'Tentang Kami']); }
    public function service() { return view('App\Modules\general\Views\service', ['title' => 'Layanan']); }
    public function contact() { return view('App\Modules\general\Views\contact', ['title' => 'Kontak']); }
}
