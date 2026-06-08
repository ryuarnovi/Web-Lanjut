<?php
namespace App\Modules\Dokter\Controllers;

use App\Controllers\BaseController;

class Dokter extends BaseController
{
    private function render(string $view, array $data = [])
    {
        $content = view("App\\Modules\\Dokter\\Views\\{$view}", $data);
        return view('App\Modules\Shared\Views\layout', array_merge($data, ['content' => $content]));
    }

    public function index() { return $this->antrean(); }
    public function antrean()       { return $this->render('antrean', ['title' => 'Antrean Pasien']); }
    public function soap($queueId)  { return $this->render('soap', ['title' => 'Pemeriksaan SOAP', 'queueId' => (int)$queueId]); }
}
