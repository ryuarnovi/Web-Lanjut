<?php

namespace Modules\Apoteker\Controllers;

use App\Controllers\BaseController;

class Apoteker extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ============ VIEW METHODS ============

    public function resep()
    {
        return view('Modules\Apoteker\Views\resep', ['title' => 'Penebusan Obat - KlinikOS 2.0']);
    }

    public function stok()
    {
        return view('Modules\Apoteker\Views\stok', ['title' => 'Stok Obat & Inventaris - KlinikOS 2.0']);
    }

    public function form()
    {
        return view('Modules\Apoteker\Views\form', ['title' => 'Tambah Stok Obat - KlinikOS 2.0']);
    }

    // ============ DRUG API ============

    public function createDrug()
    {
        $input = $this->request->getJSON(true);

        $kodeObat = $input['sku'] ?? '';
        if (empty($kodeObat)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'SKU wajib diisi']);
        }

        $this->db->query("INSERT INTO drugs (kode_obat, nama_obat, deskripsi, fungsi_obat, efek_samping, kategori_obat, merek_obat, dosis_obat, golongan_obat, bentuk_obat, unit, stok_obat, min_stock, harga_jual_eceran, harga_jual_grosir, expiry_date, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())", [
            $kodeObat,
            $input['name'] ?? '',
            $input['description'] ?? null,
            $input['function'] ?? null,
            $input['side_effects'] ?? null,
            $input['category'] ?? null,
            $input['brand'] ?? null,
            $input['dosage'] ?? null,
            $input['group'] ?? null,
            $input['shape'] ?? null,
            $input['unit'] ?? '',
            $input['stock'] ?? 0,
            $input['min_stock'] ?? 0,
            $input['sell_price'] ?? 0,
            $input['buy_price'] ?? 0,
            $input['expiry_date'] ?? null,
        ]);

        $id = $this->db->insertID();
        if (!$id) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Gagal membuat obat: ' . $this->db->error()]);
        }

        $this->logActivity('CREATE', 'drugs', $id, 'Membuat obat baru ' . $kodeObat);
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Drug created successfully', 'data' => $id]);
    }

    public function listDrugs()
    {
        $query = $this->db->query("SELECT id, kode_obat, nama_obat, deskripsi, unit, stok_obat, harga_jual_eceran FROM drugs");
        $drugs = $query->getResultArray();
        return $this->response->setJSON(['data' => $drugs]);
    }

    public function listDrugsDetail()
    {
        $query = $this->db->query("SELECT id, kode_obat, nama_obat, deskripsi, fungsi_obat, efek_samping, kategori_obat, merek_obat, dosis_obat, golongan_obat, bentuk_obat, unit, stok_obat, min_stock, harga_jual_eceran, harga_jual_grosir, expiry_date, created_at, updated_at FROM drugs");
        $drugs = $query->getResultArray();
        return $this->response->setJSON(['data' => $drugs]);
    }

    public function getDrug($sku)
    {
        $drug = $this->db->query("SELECT id, kode_obat, nama_obat, deskripsi, fungsi_obat, efek_samping, kategori_obat, merek_obat, dosis_obat, golongan_obat, bentuk_obat, unit, stok_obat, min_stock, harga_jual_eceran, harga_jual_grosir, expiry_date, created_at, updated_at FROM drugs WHERE kode_obat = ?", [$sku])->getRowArray();

        if (!$drug) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Drug not found']);
        }
        return $this->response->setJSON(['data' => $drug]);
    }

    public function updateDrug($id)
    {
        $input = $this->request->getJSON(true);
        $id = (int) $id;
        if ($id <= 0) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid drug ID']);
        }

        $fields = [
            'kode_obat'         => $input['sku'] ?? null,
            'nama_obat'         => $input['name'] ?? null,
            'deskripsi'         => $input['description'] ?? null,
            'fungsi_obat'       => $input['function'] ?? null,
            'efek_samping'      => $input['side_effects'] ?? null,
            'kategori_obat'     => $input['category'] ?? null,
            'merek_obat'        => $input['brand'] ?? null,
            'dosis_obat'        => $input['dosage'] ?? null,
            'golongan_obat'     => $input['group'] ?? null,
            'bentuk_obat'       => $input['shape'] ?? null,
            'unit'              => $input['unit'] ?? null,
            'stok_obat'         => $input['stock'] ?? null,
            'min_stock'         => $input['min_stock'] ?? null,
            'harga_jual_eceran' => $input['sell_price'] ?? null,
            'harga_jual_grosir' => $input['buy_price'] ?? null,
            'expiry_date'       => $input['expiry_date'] ?? null,
        ];

        $set = [];
        $params = [];
        foreach ($fields as $col => $val) {
            if ($val !== null) {
                $set[] = "$col = ?";
                $params[] = $val;
            }
        }

        if (empty($set)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'No data to update']);
        }

        $params[] = $id;
        $this->db->query("UPDATE drugs SET " . implode(', ', $set) . ", updated_at = NOW() WHERE id = ?", $params);

        if ($this->db->affectedRows() === 0) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Drug not found']);
        }

        $this->logActivity('UPDATE', 'drugs', $id, 'Memperbarui obat');
        return $this->response->setJSON(['message' => 'Drug updated successfully']);
    }

    public function deleteDrug($id)
    {
        $id = (int) $id;
        $this->db->query("DELETE FROM drugs WHERE id = ?", [$id]);

        if ($this->db->affectedRows() === 0) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Drug not found']);
        }

        $this->logActivity('DELETE', 'drugs', $id, 'Menghapus obat');
        return $this->response->setJSON(['message' => 'Drug deleted successfully']);
    }

    public function lowStockDrugs()
    {
        $threshold = $this->request->getGet('threshold') ?? 10;
        $query = $this->db->query("SELECT id, kode_obat, nama_obat, stok_obat, min_stock, unit FROM drugs WHERE stok_obat <= ? OR stok_obat <= min_stock", [(int) $threshold]);
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    // ============ PRESCRIPTION API ============

    public function createPrescription()
    {
        $input = $this->request->getJSON(true);

        $prescriptionCode = $input['prescription_code'] ?? ('RX' . substr(time(), 4));
        $patientID = $input['patient_id'] ?? 0;
        $doctorID = $input['doctor_id'] ?? 0;

        if (!$patientID || !$doctorID) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'patient_id dan doctor_id wajib']);
        }

        $this->db->transBegin();

        $medRecID = !empty($input['medical_record_id']) ? (int) $input['medical_record_id'] : null;
        $this->db->query("INSERT INTO prescriptions (prescription_code, medical_record_id, patient_id, doctor_id, notes, prescription_date, status) VALUES (?, ?, ?, ?, ?, NOW(), 'pending')", [
            $prescriptionCode, $medRecID, $patientID, $doctorID, $input['notes'] ?? null,
        ]);

        $prescriptionID = $this->db->insertID();
        if (!$prescriptionID) {
            $this->db->transRollback();
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Gagal membuat resep']);
        }

        if (!empty($input['items'])) {
            foreach ($input['items'] as $item) {
                $this->db->query("INSERT INTO prescription_items (prescription_id, drug_id, quantity, dosage_instruction) VALUES (?, ?, ?, ?)", [
                    $prescriptionID, $item['drug_id'], $item['qty'] ?? $item['quantity'], $item['dosage'] ?? null,
                ]);
                if ($this->db->affectedRows() === 0) {
                    $this->db->transRollback();
                    return $this->response->setStatusCode(500)->setJSON(['error' => 'Gagal membuat item resep']);
                }
            }
        }

        $this->db->transCommit();

        $this->logActivity('CREATE', 'prescriptions', $prescriptionID, 'Membuat resep baru ' . $prescriptionCode);
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Prescription created', 'data' => $prescriptionID]);
    }

    public function listPrescriptions()
    {
        $query = $this->db->query("SELECT id, prescription_code, medical_record_id, patient_id, doctor_id, prescription_date, status, notes, processed_by, processed_at, dispensed_at FROM prescriptions ORDER BY prescription_date DESC");
        $prescriptions = $query->getResultArray();

        foreach ($prescriptions as &$p) {
            $pName = $this->db->query("SELECT full_name FROM patients WHERE id = ?", [$p['patient_id']])->getRowArray();
            $p['patient_name'] = $pName['full_name'] ?? null;

            $dName = $this->db->query("SELECT full_name FROM users WHERE id = ?", [$p['doctor_id']])->getRowArray();
            $p['doctor_name'] = $dName['full_name'] ?? null;

            $items = $this->db->query("SELECT pi.id, pi.drug_id, d.nama_obat as drug_name, pi.quantity as qty, pi.dosage_instruction as dosage, d.unit FROM prescription_items pi JOIN drugs d ON pi.drug_id = d.id WHERE pi.prescription_id = ?", [$p['id']])->getResultArray();
            $p['items'] = $items;
        }

        return $this->response->setJSON(['data' => $prescriptions]);
    }

    public function updatePrescription($id)
    {
        $input = $this->request->getJSON(true);

        $fields = [];
        if (isset($input['status'])) $fields['status'] = $input['status'];
        if (isset($input['notes'])) $fields['notes'] = $input['notes'];
        if (isset($input['processed_by'])) $fields['processed_by'] = $input['processed_by'];
        if (isset($input['processed_at'])) $fields['processed_at'] = $input['processed_at'];
        if (isset($input['dispensed_at'])) $fields['dispensed_at'] = $input['dispensed_at'];

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

        $this->db->query("UPDATE prescriptions SET " . implode(', ', $set) . " WHERE id = ?", $params);

        $this->logActivity('UPDATE', 'prescriptions', (int) $id, 'Memperbarui resep ID ' . $id);
        return $this->response->setJSON(['message' => 'Prescription updated']);
    }

    public function deletePrescription($id)
    {
        $this->db->query("DELETE FROM prescriptions WHERE id = ?", [(int) $id]);
        return $this->response->setJSON(['message' => 'Prescription deleted']);
    }

    // ============ PRESCRIPTION ITEM API ============

    public function createPrescriptionItem()
    {
        $input = $this->request->getJSON(true);

        $this->db->query("INSERT INTO prescription_items (prescription_id, drug_id, quantity, dosage_instruction) VALUES (?, ?, ?, ?)", [
            $input['prescription_id'], $input['drug_id'], $input['quantity'], $input['dosage_instruction'] ?? null,
        ]);

        $id = $this->db->insertID();
        if (!$id) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Failed to create prescription item']);
        }

        return $this->response->setStatusCode(201)->setJSON(['message' => 'Prescription item created', 'data' => $id]);
    }

    public function listPrescriptionItems()
    {
        $query = $this->db->query("SELECT pi.id, pi.prescription_id, pi.drug_id, d.nama_obat as drug_name, pi.quantity as qty, pi.dosage_instruction as dosage FROM prescription_items pi JOIN drugs d ON pi.drug_id = d.id ORDER BY pi.id DESC");
        return $this->response->setJSON(['data' => $query->getResultArray()]);
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
