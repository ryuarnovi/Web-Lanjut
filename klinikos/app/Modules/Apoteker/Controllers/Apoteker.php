<?php
namespace App\Modules\Apoteker\Controllers;

use App\Controllers\BaseController;

class Apoteker extends BaseController
{
    private function render(string $view, array $data = [])
    {
        $content = view("App\\Modules\\Apoteker\\Views\\{$view}", $data);
        return view('App\Modules\Shared\Views\layout', array_merge($data, ['content' => $content]));
    }

    public function index() { return $this->stok(); }
    public function stok()     { return $this->render('stok',     ['title' => 'Stok Obat']); }
    public function form()     { return $this->render('form',     ['title' => 'Tambah / Edit Obat']); }
    public function resep()    { return $this->render('resep',    ['title' => 'Penebusan Resep']); }
    public function supplier() { return $this->render('supplier', ['title' => 'Supplier Obat']); }
}
