<?php
namespace App\Modules\Perawat\Controllers;

use App\Controllers\BaseController;

class Perawat extends BaseController
{
    private function render(string $view, array $data = [])
    {
        $content = view("App\\Modules\\Perawat\\Views\\{$view}", $data);
        return view('App\Modules\Shared\Views\layout', array_merge($data, ['content' => $content]));
    }

    public function index() { return $this->antrean(); }
    public function antrean()         { return $this->render('antrean', ['title' => 'Antrean Triase']); }
    public function triase($queueId)  { return $this->render('triase', ['title' => 'Triase Pasien', 'queueId' => (int)$queueId]); }
}
