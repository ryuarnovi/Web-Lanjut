<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ============ VIEW METHODS ============

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

    public function users()
    {
        return view('Modules\Dashboard\Views\users', ['title' => 'Manajemen User - KlinikOS 2.0']);
    }

    public function logs()
    {
        return view('Modules\Dashboard\Views\logs', ['title' => 'Log Aktivitas - KlinikOS 2.0']);
    }

    // ============ SETTINGS API ============

    public function getSettings()
    {
        $query = $this->db->query("SELECT `key`, `value` FROM settings");
        $rows = $query->getResultArray();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['key']] = $row['value'];
        }
        return $this->response->setJSON(['data' => $settings]);
    }

    public function saveSettings()
    {
        $input = $this->request->getJSON(true);
        if (empty($input)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'No data']);
        }
        foreach ($input as $key => $value) {
            $existing = $this->db->query("SELECT id FROM settings WHERE `key` = ?", [$key])->getRow();
            if ($existing) {
                $this->db->query("UPDATE settings SET `value` = ? WHERE `key` = ?", [$value, $key]);
            } else {
                $this->db->query("INSERT INTO settings (`key`, `value`) VALUES (?, ?)", [$key, $value]);
            }
        }
        return $this->response->setJSON(['message' => 'Settings saved']);
    }

    // ============ DASHBOARD STATS API (upgraded) ============

    public function getDashboardStats()
    {
        $today = date('Y-m-d');

        $stats = [
            'total_patients'  => $this->safeCount('patients'),
            'total_doctors'   => $this->safeCount('users', ['role' => 'dokter', 'is_active' => 1]),
            'total_drugs'     => $this->safeCount('drugs'),
            'queue_today'     => $this->safeCount('queues', ['queue_date' => $today]),
            'low_stock_drugs' => 0,
            'revenue_today'   => 0,
            // Legacy keys for existing home.php compatibility
            'kunjungan'       => $this->safeCount('queues', ['queue_date' => $today]),
            'total_pasien'    => $this->safeCount('patients'),
            'antrean'         => $this->safeCount('queues', ['status' => 'waiting']),
            'pendapatan'      => 0,
        ];

        try {
            $stats['low_stock_drugs'] = (int) $this->db->query(
                "SELECT COUNT(*) as c FROM drugs WHERE stok_obat <= min_stock"
            )->getRow()->c;
        } catch (\Throwable $e) {}

        try {
            $rev = $this->db->query(
                "SELECT COALESCE(SUM(total_amount), 0) as total FROM payments WHERE DATE(payment_date) = ? AND status = 'paid'",
                [$today]
            )->getRow()->total;
            $stats['revenue_today'] = (float) $rev;
            $stats['pendapatan'] = (int) $rev;
        } catch (\Throwable $e) {}

        // 7-day trend data
        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = date('Y-m-d', strtotime("-$i days"));
            $visits = $this->safeCount('queues', ['queue_date' => $d]);
            $rev = 0.0;
            try {
                $rev = (float) ($this->db->query(
                    "SELECT COALESCE(SUM(total_amount), 0) as s FROM payments WHERE DATE(payment_date) = ? AND status = 'paid'",
                    [$d]
                )->getRow()->s ?? 0);
            } catch (\Throwable $e) {}
            $trend[] = ['date' => $d, 'visits' => $visits, 'revenue' => $rev];
        }
        $stats['trend'] = $trend;

        return $this->response->setJSON(['data' => $stats]);
    }

    // ============ ACTIVITY LOGS API ============

    public function apiLogs()
    {
        try {
            $rows = $this->db->query(
                "SELECT al.*, u.username, u.full_name as user_name
                 FROM activity_logs al
                 LEFT JOIN users u ON u.id = al.user_id
                 ORDER BY al.created_at DESC
                 LIMIT 200"
            )->getResultArray();
            return $this->response->setJSON(['data' => $rows]);
        } catch (\Throwable $e) {
            return $this->response->setJSON(['data' => []]);
        }
    }

    // ============ HELPER ============

    private function safeCount(string $table, array $where = []): int
    {
        try {
            $sql = "SELECT COUNT(*) as c FROM $table";
            $params = [];
            if (!empty($where)) {
                $conditions = [];
                foreach ($where as $col => $val) {
                    $conditions[] = "$col = ?";
                    $params[] = $val;
                }
                $sql .= " WHERE " . implode(' AND ', $conditions);
            }
            return (int) $this->db->query($sql, $params)->getRow()->c;
        } catch (\Throwable $e) {
            return 0;
        }
    }
}
