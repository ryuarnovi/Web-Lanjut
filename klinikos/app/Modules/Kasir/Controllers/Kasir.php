<?php
namespace App\Modules\Kasir\Controllers;

use App\Controllers\BaseController;

class Kasir extends BaseController
{
    private function render(string $view, array $data = [])
    {
        $content = view("App\\Modules\\Kasir\\Views\\{$view}", $data);
        return view('App\Modules\Shared\Views\layout', array_merge($data, ['content' => $content]));
    }

    public function index() { return $this->billing(); }
    public function billing() { return $this->render('billing', ['title' => 'Billing & Pembayaran']); }
    public function riwayat() { return $this->render('riwayat', ['title' => 'Riwayat Transaksi']); }
}
