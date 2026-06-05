<?php
namespace App\Modules\Dashboard\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $db;
    public function __construct() { $this->db = \Config\Database::connect(); }

    private function render(string $view, array $data = [])
    {
        $content = view("App\\Modules\\Dashboard\\Views\\{$view}", $data);
        return view('App\Modules\Shared\Views\layout', array_merge($data, ['content' => $content]));
    }

    // ============ WEB Pages ============
    public function index()    { return $this->render('index',    ['title' => 'Dashboard Admin']); }
    public function users()    { return $this->render('users',    ['title' => 'Manajemen User']); }
    public function settings() { return $this->render('settings', ['title' => 'Pengaturan Klinik']); }
    public function reports()  { return $this->render('reports',  ['title' => 'Laporan & Analytics']); }
    public function logs()     { return $this->render('logs',     ['title' => 'Log Aktivitas']); }
    public function profile()  { return $this->render('profile',  ['title' => 'Profil Saya']); }

    // ============ API ============
    public function apiStats()
    {
        $today = date('Y-m-d');
        $stats = [
            'total_patients'  => $this->safeCount('patients'),
            'total_doctors'   => $this->safeCount('users', ['role' => 'dokter', 'is_active' => 1]),
            'total_drugs'     => $this->safeCount('drugs'),
            'queue_today'     => $this->safeCount('queues', ['queue_date' => $today]),
            'low_stock_drugs' => 0,
            'revenue_today'   => 0,
        ];
        try { $stats['low_stock_drugs'] = (int)$this->db->table('drugs')->where('stok_obat <= min_stock')->countAllResults(); } catch (\Throwable $e) {}
        try { $stats['revenue_today']   = (float)($this->db->table('payments')->selectSum('total_amount','sum')->where('DATE(payment_date)', $today)->where('status','paid')->get()->getRow('sum') ?? 0); } catch (\Throwable $e) {}

        // 7-day trend
        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = date('Y-m-d', strtotime("-$i days"));
            $visits = (int)$this->safeCount('queues', ['queue_date' => $d]);
            $rev = 0.0;
            try { $rev = (float)($this->db->table('payments')->selectSum('total_amount','s')->where('DATE(payment_date)', $d)->where('status','paid')->get()->getRow('s') ?? 0); } catch (\Throwable $e) {}
            $trend[] = ['date' => $d, 'visits' => $visits, 'revenue' => $rev];
        }
        $stats['trend'] = $trend;

        return $this->response->setJSON(['status' => 'success', 'data' => $stats]);
    }

    public function apiLogs()
    {
        try {
            $rows = $this->db->table('activity_logs al')
                ->select('al.*, u.username, u.full_name')
                ->join('users u', 'u.id = al.user_id', 'left')
                ->orderBy('al.created_at', 'DESC')
                ->limit(200)
                ->get()->getResultArray();
            return $this->response->setJSON(['status' => 'success', 'data' => $rows]);
        } catch (\Throwable $e) {
            return $this->response->setJSON(['status' => 'success', 'data' => []]);
        }
    }

    public function apiSettings()
    {
        try {
            $rows = $this->db->table('settings')->get()->getResultArray();
            $kv = [];
            foreach ($rows as $r) $kv[$r['key'] ?? $r['setting_key']] = $r['value'] ?? $r['setting_value'];
            return $this->response->setJSON(['status' => 'success', 'data' => $kv]);
        } catch (\Throwable $e) {
            return $this->response->setJSON(['status' => 'success', 'data' => new \stdClass()]);
        }
    }

    public function apiSaveSettings()
    {
        $in = $this->request->getJSON(true) ?: [];
        try {
            foreach ($in as $k => $v) {
                $exists = $this->db->table('settings')->where('key', $k)->countAllResults();
                if ($exists) $this->db->table('settings')->where('key', $k)->update(['value' => is_array($v) ? json_encode($v) : (string)$v]);
                else $this->db->table('settings')->insert(['key' => $k, 'value' => is_array($v) ? json_encode($v) : (string)$v]);
            }
            return $this->response->setJSON(['status' => 'success']);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    private function safeCount(string $table, array $where = []): int
    {
        try { $b = $this->db->table($table); if ($where) $b->where($where); return (int)$b->countAllResults(); }
        catch (\Throwable $e) { return 0; }
    }
}
