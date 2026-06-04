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

    public function supplier()
    {
        return view('Modules\Apoteker\Views\supplier', ['title' => 'Manajemen Supplier - KlinikOS 2.0']);
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

    // ============ IMPORT / EXPORT DRUGS ============

    public function downloadTemplate()
    {
        $filename = 'template_import_obat.csv';
        $headers = [
            'kode_obat', 'nama_obat', 'deskripsi', 'fungsi_obat', 'efek_samping',
            'kategori_obat', 'merek_obat', 'dosis_obat', 'golongan_obat', 'bentuk_obat',
            'unit', 'stok_obat', 'min_stock', 'harga_beli', 'harga_jual', 'expiry_date'
        ];

        $example1 = [
            'OBT-001', 'Paracetamol 500mg', 'Obat penurun panas', 'Menurunkan demam', 'Mual, alergi',
            'Analgesik', 'Generic', '500 mg x 3 sehari', 'Obat Bebas', 'Tablet',
            'tablet', '100', '20', '5000', '7500', '2027-12-31'
        ];
        $example2 = [
            'OBT-002', 'Amoxicillin 250mg', 'Antibiotik', 'Mengatasi infeksi bakteri', 'Diare, ruam',
            'Antibiotik', 'Generic', '250 mg x 3 sehari', 'Obat Keras', 'Kapsul',
            'kapsul', '50', '10', '8000', '12000', '2027-06-30'
        ];

        $this->downloadCSV($filename, $headers, [$headers, $example1, $example2]);
    }

    public function exportDrugs()
    {
        $query = $this->db->query("SELECT kode_obat, nama_obat, deskripsi, fungsi_obat, efek_samping, kategori_obat, merek_obat, dosis_obat, golongan_obat, bentuk_obat, unit, stok_obat, min_stock, harga_jual_grosir as harga_beli, harga_jual_eceran as harga_jual, expiry_date FROM drugs ORDER BY kode_obat ASC");
        $drugs = $query->getResultArray();

        $filename = 'data_stok_obat_' . date('Y-m-d') . '.csv';
        $headers = [
            'kode_obat', 'nama_obat', 'deskripsi', 'fungsi_obat', 'efek_samping',
            'kategori_obat', 'merek_obat', 'dosis_obat', 'golongan_obat', 'bentuk_obat',
            'unit', 'stok_obat', 'min_stock', 'harga_beli', 'harga_jual', 'expiry_date'
        ];

        $rows = array_map(function($d) {
            return [
                $d['kode_obat'], $d['nama_obat'], $d['deskripsi'], $d['fungsi_obat'], $d['efek_samping'],
                $d['kategori_obat'], $d['merek_obat'], $d['dosis_obat'], $d['golongan_obat'], $d['bentuk_obat'],
                $d['unit'], $d['stok_obat'], $d['min_stock'], $d['harga_beli'], $d['harga_jual'], $d['expiry_date']
            ];
        }, $drugs);

        $this->downloadCSV($filename, $headers, $rows);
    }

    public function importDrugs()
    {
        $file = $this->request->getFile('file');
        if (!$file || !$file->isValid()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'File tidak valid atau tidak diunggah']);
        }

        $ext = $file->getExtension();
        if (!in_array(strtolower($ext), ['csv', 'txt'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Hanya file CSV yang diizinkan']);
        }

        $handle = fopen($file->getTempName(), 'r');
        if (!$handle) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Gagal membaca file']);
        }

        // Read header row
        $header = fgetcsv($handle);
        if (!$header) {
            fclose($handle);
            return $this->response->setStatusCode(400)->setJSON(['error' => 'File CSV kosong atau tidak valid']);
        }

        // Normalize headers: lowercase, trim, replace spaces/special chars
        $header = array_map(function($h) {
            $h = strtolower(trim($h));
            $h = str_replace([' ', '-'], '_', $h);
            return $h;
        }, $header);

        $expected = ['nama_obat'];
        $missing = array_diff($expected, $header);
        if (!empty($missing)) {
            fclose($handle);
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Kolom wajib tidak ditemukan: ' . implode(', ', $missing) . '. Unduh template untuk format yang benar.']);
        }

        // Map CSV columns to DB columns
        $columnMap = [
            'kode_obat'       => 'kode_obat',
            'nama_obat'       => 'nama_obat',
            'deskripsi'       => 'deskripsi',
            'fungsi_obat'     => 'fungsi_obat',
            'efek_samping'    => 'efek_samping',
            'kategori_obat'   => 'kategori_obat',
            'merek_obat'      => 'merek_obat',
            'dosis_obat'      => 'dosis_obat',
            'golongan_obat'   => 'golongan_obat',
            'bentuk_obat'     => 'bentuk_obat',
            'unit'            => 'unit',
            'stok_obat'       => 'stok_obat',
            'min_stock'       => 'min_stock',
            'harga_beli'      => 'harga_jual_grosir',
            'harga_jual'      => 'harga_jual_eceran',
            'expiry_date'     => 'expiry_date',
        ];

        // Build index map
        $indexMap = [];
        foreach ($header as $i => $col) {
            if (isset($columnMap[$col])) {
                $indexMap[$i] = $columnMap[$col];
            } elseif (in_array($col, ['harga_jual_grosir', 'harga_jual_eceran'])) {
                $indexMap[$i] = $col;
            }
        }

        $this->db->transBegin();
        $imported = 0;
        $updated = 0;
        $errors = [];
        $rowNum = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $rowNum++;
            $data = [];
            foreach ($indexMap as $i => $dbCol) {
                $data[$dbCol] = $row[$i] ?? null;
            }

            $namaObat = trim($data['nama_obat'] ?? '');
            if (empty($namaObat)) {
                $errors[] = "Baris $rowNum: Nama obat wajib diisi";
                continue;
            }

            // Clean numeric fields
            $data['stok_obat'] = !empty($data['stok_obat']) ? (int) preg_replace('/[^0-9\-]/', '', $data['stok_obat']) : 0;
            $data['min_stock'] = !empty($data['min_stock']) ? (int) preg_replace('/[^0-9\-]/', '', $data['min_stock']) : 0;
            $data['harga_jual_grosir'] = !empty($data['harga_jual_grosir']) ? (float) preg_replace('/[^0-9\.\-]/', '', str_replace(',', '', $data['harga_jual_grosir'])) : 0;
            $data['harga_jual_eceran'] = !empty($data['harga_jual_eceran']) ? (float) preg_replace('/[^0-9\.\-]/', '', str_replace(',', '', $data['harga_jual_eceran'])) : 0;

            // Generate SKU if empty
            if (empty($data['kode_obat'])) {
                $todayCount = $this->db->query("SELECT COUNT(*) as c FROM drugs")->getRow()->c;
                $data['kode_obat'] = 'OBT-' . str_pad($todayCount + $imported + 1, 4, '0', STR_PAD_LEFT);
            }

            // Check if drug exists by kode_obat
            $existing = $this->db->query("SELECT id FROM drugs WHERE kode_obat = ?", [$data['kode_obat']])->getRowArray();

            if ($existing) {
                // Update existing drug
                $set = [];
                $params = [];
                foreach ($data as $col => $val) {
                    if ($col !== 'kode_obat') {
                        $set[] = "$col = ?";
                        $params[] = $val;
                    }
                }
                $params[] = $existing['id'];
                $this->db->query("UPDATE drugs SET " . implode(', ', $set) . ", updated_at = NOW() WHERE id = ?", $params);
                $updated++;
            } else {
                // Insert new drug
                $this->db->query("INSERT INTO drugs (kode_obat, nama_obat, deskripsi, fungsi_obat, efek_samping, kategori_obat, merek_obat, dosis_obat, golongan_obat, bentuk_obat, unit, stok_obat, min_stock, harga_jual_grosir, harga_jual_eceran, expiry_date, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())", [
                    $data['kode_obat'], $data['nama_obat'], $data['deskripsi'], $data['fungsi_obat'], $data['efek_samping'],
                    $data['kategori_obat'], $data['merek_obat'], $data['dosis_obat'], $data['golongan_obat'], $data['bentuk_obat'],
                    $data['unit'], $data['stok_obat'], $data['min_stock'], $data['harga_jual_grosir'], $data['harga_jual_eceran'],
                    $data['expiry_date'],
                ]);
                $imported++;
            }
        }

        fclose($handle);

        if (!empty($errors)) {
            $this->db->transRollback();
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Import gagal. Perbaiki error berikut:',
                'details' => $errors
            ]);
        }

        $this->db->transCommit();

        $this->logActivity('IMPORT', 'drugs', 0, "Import CSV: $imported baru, $updated diperbarui");
        return $this->response->setJSON([
            'message' => "Import berhasil! $imported obat baru ditambahkan, $updated obat diperbarui.",
            'imported' => $imported,
            'updated' => $updated
        ]);
    }

    private function downloadCSV($filename, $headers, $rows)
    {
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        // Write BOM for Excel compatibility
        fwrite($output, "\xEF\xBB\xBF");

        // Write rows
        foreach ($rows as $row) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;
    }

    // ============ PRESCRIPTION API ============

    public function createPrescription()
    {
        $input = $this->request->getJSON(true);

        $prescriptionCode = $input['prescription_code'] ?? ('RX' . substr(time(), 4));
        $patientID = $input['patient_id'] ?? 0;
        $doctorID = $input['doctor_id'] ?? 0;
        $medRecID = !empty($input['medical_record_id']) ? (int) $input['medical_record_id'] : null;

        // Fallback doctor_id if falsy
        if (!$doctorID || $doctorID === 'null') {
            $doctorID = session()->get('user_id') ?? 0;
        }

        // Fallback patient_id and doctor_id from medical record if patient_id is falsy
        if (!$patientID && $medRecID) {
            $mr = $this->db->query("SELECT patient_id, doctor_id FROM medical_records WHERE id = ?", [$medRecID])->getRowArray();
            if ($mr) {
                $patientID = $mr['patient_id'];
                if (!$doctorID) {
                    $doctorID = $mr['doctor_id'];
                }
            }
        }

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

        // Automatically create or update consolidated invoice
        $this->syncPayment($prescriptionID);

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

        $this->db->transBegin();

        $prescription = $this->db->query("SELECT * FROM prescriptions WHERE id = ?", [(int) $id])->getRowArray();
        if (!$prescription) {
            $this->db->transRollback();
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Prescription not found']);
        }

        $fields = [];
        if (isset($input['status'])) $fields['status'] = $input['status'];
        if (isset($input['notes'])) $fields['notes'] = $input['notes'];
        if (isset($input['processed_by'])) $fields['processed_by'] = $input['processed_by'];
        if (isset($input['processed_at'])) $fields['processed_at'] = $input['processed_at'];
        if (isset($input['dispensed_at'])) $fields['dispensed_at'] = $input['dispensed_at'];
        if (isset($input['medical_record_id'])) $fields['medical_record_id'] = $input['medical_record_id'];
        if (isset($input['patient_id'])) $fields['patient_id'] = $input['patient_id'];
        if (isset($input['doctor_id'])) $fields['doctor_id'] = $input['doctor_id'];

        // If status changes to completed, perform drug stock dispensing logic
        if (isset($input['status']) && $input['status'] === 'completed' && $prescription['status'] !== 'completed') {
            $items = $this->db->query("SELECT * FROM prescription_items WHERE prescription_id = ?", [(int) $id])->getResultArray();
            foreach ($items as $item) {
                // Deduct stock
                $this->db->query("UPDATE drugs SET stok_obat = GREATEST(0, stok_obat - ?) WHERE id = ?", [
                    (int) $item['quantity'], (int) $item['drug_id']
                ]);
                // Log stock movement
                $this->db->query("INSERT INTO stock_transactions (drug_id, type, quantity, notes, created_by, created_at) VALUES (?, 'out', ?, ?, ?, NOW())", [
                    (int) $item['drug_id'],
                    (int) $item['quantity'],
                    'Penyerahan resep ' . ($prescription['prescription_code'] ?? 'RX-' . $id),
                    session()->get('user_id') ?? 0
                ]);
            }
            $fields['dispensed_at'] = date('Y-m-d H:i:s');
        }

        if (!empty($fields)) {
            $set = [];
            $params = [];
            foreach ($fields as $col => $val) {
                $set[] = "$col = ?";
                $params[] = $val;
            }
            $params[] = (int) $id;
            $this->db->query("UPDATE prescriptions SET " . implode(', ', $set) . " WHERE id = ?", $params);
        }

        // Rewrite prescription items if provided
        if (isset($input['items'])) {
            $this->db->query("DELETE FROM prescription_items WHERE prescription_id = ?", [(int) $id]);
            foreach ($input['items'] as $item) {
                $this->db->query("INSERT INTO prescription_items (prescription_id, drug_id, quantity, dosage_instruction) VALUES (?, ?, ?, ?)", [
                    (int) $id, $item['drug_id'], $item['qty'] ?? $item['quantity'], $item['dosage'] ?? null,
                ]);
            }
        }

        $this->db->transCommit();

        // Sync payment details with the consolidated invoice
        $this->syncPayment($id);

        $this->logActivity('UPDATE', 'prescriptions', (int) $id, 'Memperbarui resep ID ' . $id);
        return $this->response->setJSON(['message' => 'Prescription updated']);
    }

    private function syncPayment($prescriptionID)
    {
        $prescription = $this->db->query("SELECT * FROM prescriptions WHERE id = ?", [(int)$prescriptionID])->getRowArray();
        if (!$prescription) return;
        
        $patientID = $prescription['patient_id'];
        $medRecID = $prescription['medical_record_id'];
        
        // Calculate total medicine cost
        $items = $this->db->query("SELECT pi.quantity, d.harga_jual_eceran FROM prescription_items pi JOIN drugs d ON pi.drug_id = d.id WHERE pi.prescription_id = ?", [(int)$prescriptionID])->getResultArray();
        $medicineCost = 0;
        foreach ($items as $item) {
            $medicineCost += ($item['quantity'] * $item['harga_jual_eceran']);
        }
        
        // Load consultation and procedure fees
        $doctorFee = 50000.00;
        $tindakanFee = 0.00;
        if ($medRecID) {
            $medRec = $this->db->query("SELECT doctor_fee, tindakan_fee FROM medical_records WHERE id = ?", [(int)$medRecID])->getRowArray();
            if ($medRec) {
                $doctorFee = $medRec['doctor_fee'] ?? 50000.00;
                $tindakanFee = $medRec['tindakan_fee'] ?? 0.00;
            }
        }
        
        $adminFee = 10000.00;
        $totalAmount = $doctorFee + $tindakanFee + $adminFee + $medicineCost;
        
        $existing = null;
        if ($medRecID) {
            $existing = $this->db->query("SELECT id FROM payments WHERE medical_record_id = ? AND status = 'unpaid'", [(int)$medRecID])->getRowArray();
        }
        if (!$existing) {
            $existing = $this->db->query("SELECT id FROM payments WHERE patient_id = ? AND DATE(created_at) = CURDATE() AND status = 'unpaid'", [(int)$patientID])->getRowArray();
        }
        
        if ($existing) {
            $this->db->query("UPDATE payments SET prescription_id = ?, doctor_fee = ?, tindakan_fee = ?, medicine_cost = ?, admin_fee = ?, total_amount = ? WHERE id = ?", [
                (int)$prescriptionID, $doctorFee, $tindakanFee, $medicineCost, $adminFee, $totalAmount, (int)$existing['id']
            ]);
        } else {
            $paymentCode = 'INV-' . time() . rand(10, 99);
            $this->db->query("INSERT INTO payments (payment_code, patient_id, medical_record_id, prescription_id, total_amount, payment_method, paid_amount, change_amount, status, doctor_fee, tindakan_fee, medicine_cost, admin_fee, discount, tax, notes, created_at) VALUES (?, ?, ?, ?, ?, 'cash', 0, 0, 'unpaid', ?, ?, ?, ?, 0, 0, 'Auto-generated invoice from prescription', NOW())", [
                $paymentCode, $patientID, $medRecID, (int)$prescriptionID, $totalAmount, $doctorFee, $tindakanFee, $medicineCost, $adminFee
            ]);
        }
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

    // ============ SUPPLIER API ============

    public function listSuppliers()
    {
        $query = $this->db->query("SELECT * FROM suppliers ORDER BY name ASC");
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function createSupplier()
    {
        $input = $this->request->getJSON(true);
        $this->db->query("INSERT INTO suppliers (name, contact_person, phone, email, address, notes, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())", [
            $input['name'],
            $input['contact_person'] ?? null,
            $input['phone'] ?? null,
            $input['email'] ?? null,
            $input['address'] ?? null,
            $input['notes'] ?? null,
        ]);
        $id = $this->db->insertID();
        $this->logActivity('CREATE', 'suppliers', $id, 'Menambahkan supplier ' . $input['name']);
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Supplier created', 'data' => $id]);
    }

    public function updateSupplier($id)
    {
        $input = $this->request->getJSON(true);
        $set = []; $params = [];
        if (isset($input['name'])) { $set[] = "name = ?"; $params[] = $input['name']; }
        if (isset($input['contact_person'])) { $set[] = "contact_person = ?"; $params[] = $input['contact_person']; }
        if (isset($input['phone'])) { $set[] = "phone = ?"; $params[] = $input['phone']; }
        if (isset($input['email'])) { $set[] = "email = ?"; $params[] = $input['email']; }
        if (isset($input['address'])) { $set[] = "address = ?"; $params[] = $input['address']; }
        if (isset($input['notes'])) { $set[] = "notes = ?"; $params[] = $input['notes']; }
        if (empty($set)) return $this->response->setStatusCode(400)->setJSON(['error' => 'No data']);
        $params[] = (int) $id;
        $this->db->query("UPDATE suppliers SET " . implode(', ', $set) . ", updated_at = NOW() WHERE id = ?", $params);
        $this->logActivity('UPDATE', 'suppliers', (int) $id, 'Memperbarui supplier');
        return $this->response->setJSON(['message' => 'Supplier updated']);
    }

    public function deleteSupplier($id)
    {
        $this->db->query("DELETE FROM suppliers WHERE id = ?", [(int) $id]);
        return $this->response->setJSON(['message' => 'Supplier deleted']);
    }

    // ============ STOCK TRANSACTION API ============

    public function listStockTransactions()
    {
        $drugId = $this->request->getGet('drug_id');
        $sql = "SELECT st.*, d.nama_obat AS drug_name, s.name AS supplier_name
                FROM stock_transactions st
                JOIN drugs d ON st.drug_id = d.id
                LEFT JOIN suppliers s ON st.supplier_id = s.id";
        $params = [];
        if ($drugId) {
            $sql .= " WHERE st.drug_id = ?";
            $params[] = (int) $drugId;
        }
        $sql .= " ORDER BY st.created_at DESC LIMIT 100";
        return $this->response->setJSON(['data' => $this->db->query($sql, $params)->getResultArray()]);
    }

    public function createStockTransaction()
    {
        $input = $this->request->getJSON(true);
        $drugId = (int) ($input['drug_id'] ?? 0);
        $type = $input['type'] ?? 'in';
        $qty = (int) ($input['quantity'] ?? 0);
        if (!$drugId || !$qty) return $this->response->setStatusCode(400)->setJSON(['error' => 'drug_id dan quantity wajib']);

        $this->db->transBegin();
        $this->db->query("INSERT INTO stock_transactions (drug_id, type, quantity, supplier_id, batch_number, expiry_date, notes, created_by, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())", [
            $drugId, $type, $qty,
            $input['supplier_id'] ?? null,
            $input['batch_number'] ?? null,
            $input['expiry_date'] ?? null,
            $input['notes'] ?? null,
            session()->get('user_id') ?? 0,
        ]);
        if ($type === 'in') {
            $this->db->query("UPDATE drugs SET stok_obat = stok_obat + ? WHERE id = ?", [$qty, $drugId]);
        } else {
            $this->db->query("UPDATE drugs SET stok_obat = GREATEST(0, stok_obat - ?) WHERE id = ?", [$qty, $drugId]);
        }
        $this->db->transCommit();
        $id = $this->db->insertID();
        $this->logActivity('CREATE', 'stock_transactions', $id, 'Transaksi stok: ' . $type . ' ' . $qty);
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Stock transaction created', 'data' => $id]);
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
