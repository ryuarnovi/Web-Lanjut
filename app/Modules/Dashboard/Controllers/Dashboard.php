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

    public function getDashboardStats()
    {
        $todayQueues = $this->db->query("SELECT COUNT(*) as c FROM queues WHERE queue_date = CURDATE()")->getRow()->c;
        $totalPasien = $this->db->query("SELECT COUNT(*) as c FROM patients")->getRow()->c;
        $waitingQueues = $this->db->query("SELECT COUNT(*) as c FROM queues WHERE status = 'waiting'")->getRow()->c;
        $todayRevenue = $this->db->query("SELECT COALESCE(SUM(total_amount),0) as total FROM payments WHERE DATE(payment_date) = CURDATE() AND status = 'paid'")->getRow()->total;

        return $this->response->setJSON([
            'data' => [
                'kunjungan' => (int) $todayQueues,
                'total_pasien' => (int) $totalPasien,
                'antrean' => (int) $waitingQueues,
                'pendapatan' => (int) $todayRevenue,
            ]
        ]);
    }
}
