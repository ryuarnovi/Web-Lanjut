<?php
namespace App\Modules\Resepsionis\Controllers;

use App\Controllers\BaseController;

class Resepsionis extends BaseController
{
    private function render(string $view, array $data = [])
    {
        $content = view("App\\Modules\\Resepsionis\\Views\\{$view}", $data);
        return view('App\Modules\Shared\Views\layout', array_merge($data, ['content' => $content]));
    }

    public function index() { return $this->pendaftaran(); }
    public function pendaftaran() { return $this->render('pendaftaran', ['title' => 'Pendaftaran Pasien']); }
    public function antrean()     { return $this->render('antrean',     ['title' => 'Antrean Pasien']); }
}
