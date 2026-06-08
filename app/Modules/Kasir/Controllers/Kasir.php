<?php

namespace Modules\Kasir\Controllers;

use App\Controllers\BaseController;

class Kasir extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ============ VIEW METHODS ============

    public function billing()
    {
        return view('Modules\Kasir\Views\billing', ['title' => 'Billing & Pembayaran - KlinikOS 2.0']);
    }

    public function data()
    {
        return view('Modules\Kasir\Views\data', ['title' => 'Daftar Tagihan - KlinikOS 2.0']);
    }

    public function form()
    {
        return view('Modules\Kasir\Views\form', ['title' => 'Buat Tagihan Manual - KlinikOS 2.0']);
    }

    public function riwayat()
    {
        return view('Modules\Kasir\Views\riwayat', ['title' => 'Riwayat Transaksi - KlinikOS 2.0']);
    }

    // ============ PAYMENTS API ============

    public function createPayment()
    {
        $input = $this->request->getJSON(true);

        $this->db->query("INSERT INTO payments (payment_code, patient_id, medical_record_id, prescription_id, total_amount, payment_method, paid_amount, change_amount, status, processed_by, payment_date, doctor_fee, medicine_cost, admin_fee, discount, tax, notes) VALUES (?, ?, ?, ?, ?, ?, ?, 0, 'unpaid', ?, NOW(), ?, ?, ?, ?, ?, ?)", [
            $input['invoice_number'],
            $input['patient_id'],
            $input['medical_record_id'] ?? null,
            $input['prescription_id'] ?? null,
            $input['total'],
            $input['payment_method'],
            $input['paid_amount'] ?? 0,
            $input['processed_by'] ?? session()->get('user_id'),
            $input['doctor_fee'] ?? 0,
            $input['medicine_cost'] ?? 0,
            $input['admin_fee'] ?? 0,
            $input['discount'] ?? 0,
            $input['tax'] ?? 0,
            $input['notes'] ?? null,
        ]);

        $id = $this->db->insertID();
        if (!$id) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Gagal membuat pembayaran']);
        }

        $this->logActivity('CREATE', 'payments', $id, 'Membuat invoice baru ' . $input['invoice_number']);
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Payment created', 'data' => $id]);
    }

    public function listPayments()
    {
        $query = $this->db->query("SELECT p.id, p.payment_code as invoice_number, p.patient_id, p.medical_record_id, p.prescription_id, p.payment_date, p.total_amount as total, p.payment_method, p.paid_amount, p.change_amount, p.status, p.processed_by, p.doctor_fee, p.tindakan_fee, p.medicine_cost, p.admin_fee, p.discount, p.tax, p.notes, pa.full_name as patient_name, pr.prescription_code, u.full_name as processed_by_name FROM payments p LEFT JOIN patients pa ON p.patient_id = pa.id LEFT JOIN prescriptions pr ON p.prescription_id = pr.id LEFT JOIN users u ON p.processed_by = u.id ORDER BY p.payment_date DESC");

        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function updatePayment($id)
    {
        $input = $this->request->getJSON(true);

        $fields = [];
        if (isset($input['status'])) $fields['status'] = $input['status'];
        if (isset($input['paid_amount'])) $fields['paid_amount'] = $input['paid_amount'];
        if (isset($input['change_amount'])) $fields['change_amount'] = $input['change_amount'];
        if (isset($input['payment_method'])) $fields['payment_method'] = $input['payment_method'];
        if (isset($input['processed_by'])) $fields['processed_by'] = $input['processed_by'];
        if (isset($input['discount'])) $fields['discount'] = $input['discount'];
        if (isset($input['tax'])) $fields['tax'] = $input['tax'];
        if (isset($input['total_amount'])) $fields['total_amount'] = $input['total_amount'];
        if (isset($input['notes'])) $fields['notes'] = $input['notes'];

        if (empty($fields)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'No data to update']);
        }

        $set = [];
        $params = [];
        foreach ($fields as $col => $val) {
            $set[] = "$col = ?";
            $params[] = $val;
        }
        $params[] = (int) $id;

        $this->db->query("UPDATE payments SET " . implode(', ', $set) . " WHERE id = ?", $params);

        if ($this->db->affectedRows() === 0) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Payment not found']);
        }

        $this->logActivity('UPDATE', 'payments', (int) $id, 'Memperbarui invoice/pembayaran ID ' . $id);
        return $this->response->setJSON(['message' => 'Payment updated']);
    }

    public function deletePayment($id)
    {
        $this->db->query("DELETE FROM payments WHERE id = ?", [(int) $id]);

        if ($this->db->affectedRows() === 0) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Payment not found']);
        }

        $this->logActivity('DELETE', 'payments', (int) $id, 'Menghapus invoice ID ' . $id);
        return $this->response->setJSON(['message' => 'Payment deleted']);
    }

    // ============ MIDTRANS API ============

    public function midtransPaymentStatus($orderID)
    {
        $serverKey = getenv('MIDTRANS_SERVER_KEY');
        $env = getenv('MIDTRANS_ENV');
        $baseURL = strtolower($env) === 'production' ? 'https://api.midtrans.com/v2/' : 'https://api.sandbox.midtrans.com/v2/';

        $url = $baseURL . $orderID . '/status';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $serverKey . ':');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return $this->response->setStatusCode($httpCode)->setJSON(['error' => $response]);
        }

        $result = json_decode($response, true);
        return $this->response->setJSON($result);
    }

    public function createMidtransSnap()
    {
        $input = $this->request->getJSON(true);

        $serverKey = getenv('MIDTRANS_SERVER_KEY');
        $clientKey = getenv('MIDTRANS_CLIENT_KEY');
        $env = getenv('MIDTRANS_ENV');
        $isProduction = strtolower($env) === 'production';

        $payload = [
            'transaction_details' => [
                'order_id' => $input['order_id'],
                'gross_amount' => (int) $input['gross_amount'],
            ],
            'customer_details' => [
                'first_name' => $input['customer']['first_name'] ?? '',
                'email' => $input['customer']['email'] ?? '',
            ],
        ];

        $url = $isProduction ? 'https://app.midtrans.com/snap/v1/transactions' : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_USERPWD, $serverKey . ':');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 201) {
            $err = json_decode($response, true);
            return $this->response->setStatusCode(502)->setJSON([
                'error' => 'Midtrans payment gateway error',
                'detail' => $err['error_messages'][0] ?? $response,
            ]);
        }

        $result = json_decode($response, true);
        return $this->response->setJSON([
            'snap_token' => $result['token'],
            'redirect_url' => $result['redirect_url'],
        ]);
    }

    public function midtransWebhook()
    {
        $notif = $this->request->getJSON(true);

        $orderID = $notif['order_id'] ?? '';
        $transactionStatus = $notif['transaction_status'] ?? '';

        switch ($transactionStatus) {
            case 'settlement':
            case 'capture':
                $status = 'paid';
                break;
            case 'pending':
                $status = 'unpaid';
                break;
            case 'cancel':
            case 'deny':
            case 'expire':
                $status = 'cancelled';
                break;
            default:
                $status = 'unpaid';
        }

        $this->db->query("UPDATE payments SET status = ? WHERE payment_code = ?", [$status, $orderID]);
        return $this->response->setJSON(['message' => 'Payment status updated']);
    }

    // ============ ACTIVITY LOG HELPER ============

    private function logActivity($action, $entity, $entityID, $description)
    {
        $userID = session()->get('user_id') ?? 0;
        $ip = $this->request->getIPAddress();
        $this->db->query("INSERT INTO activity_logs (user_id, action, entity, entity_id, description, ip_address, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())", [
            $userID, $action, $entity, $entityID, $description, $ip,
        ]);
    }
}
