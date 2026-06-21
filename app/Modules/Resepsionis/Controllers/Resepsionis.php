<?php

namespace Modules\Resepsionis\Controllers;

use App\Controllers\BaseController;

class Resepsionis extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ============ VIEW METHODS ============

    public function pendaftaran()
    {
        return view('Modules\Resepsionis\Views\pendaftaran', ['title' => 'Pendaftaran Pasien - KlinikOS 2.0']);
    }

    public function antrean()
    {
        return view('Modules\Resepsionis\Views\antrean', ['title' => 'Plotting Antrean - KlinikOS 2.0']);
    }

    // ============ PATIENTS API ============

    public function createPatient()
    {
        $input = $this->request->getJSON(true);

        $nik = $input['nik'] ?? '';
        $email = $input['email'] ?? null;

        if (empty($nik)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'NIK wajib diisi']);
        }

        // Validate unique NIK
        $existingNik = $this->db->query("SELECT id FROM patients WHERE nik = ?", [$nik])->getRow();
        if ($existingNik) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Pasien dengan NIK tersebut sudah terdaftar!']);
        }

        // Validate unique Email if provided
        if (!empty($email)) {
            $existingEmail = $this->db->query("SELECT id FROM patients WHERE email = ?", [$email])->getRow();
            if ($existingEmail) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Email sudah digunakan oleh pasien lain!']);
            }
        }

        // Auto-generate patient code (RM number): RM-YYMM-XXXX
        $todayCount = $this->db->query("SELECT COUNT(*) as c FROM patients WHERE YEAR(created_at) = YEAR(NOW()) AND MONTH(created_at) = MONTH(NOW())")->getRow()->c;
        $patientCode = 'RM-' . date('ym') . '-' . sprintf('%04d', $todayCount + 1);
        while ($this->db->query("SELECT id FROM patients WHERE patient_code = ?", [$patientCode])->getRow()) {
            $todayCount++;
            $patientCode = 'RM-' . date('ym') . '-' . sprintf('%04d', $todayCount + 1);
        }

        $status = $input['status'] ?? 'active';

        $this->db->query("INSERT INTO patients (patient_code, nik, full_name, date_of_birth, gender, address, phone, email, blood_type, allergies, emergency_contact, emergency_phone, is_walkin, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())", [
            $patientCode,
            $nik,
            $input['full_name'] ?? '',
            $input['date_of_birth'] ?? null,
            $input['gender'] ?? '',
            $input['address'] ?? null,
            $input['phone'] ?? null,
            $email,
            $input['blood_type'] ?? null,
            $input['allergies'] ?? null,
            $input['emergency_contact'] ?? null,
            $input['emergency_phone'] ?? null,
            !empty($input['is_walkin']) ? 1 : 0,
            $status,
        ]);

        $id = $this->db->insertID();
        if (!$id) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Gagal membuat pasien']);
        }

        $this->logActivity('CREATE', 'patients', $id, 'Mendaftarkan pasien baru ' . $patientCode);
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Patient created', 'data' => $id]);
    }

    public function updatePatient($id)
    {
        $input = $this->request->getJSON(true);
        $id = (int) $id;

        $fields = [
            'full_name'         => $input['full_name'] ?? null,
            'date_of_birth'     => $input['date_of_birth'] ?? null,
            'gender'            => $input['gender'] ?? null,
            'address'           => $input['address'] ?? null,
            'phone'             => $input['phone'] ?? null,
            'email'             => $input['email'] ?? null,
            'blood_type'        => $input['blood_type'] ?? null,
            'allergies'         => $input['allergies'] ?? null,
            'emergency_contact' => $input['emergency_contact'] ?? null,
            'emergency_phone'   => $input['emergency_phone'] ?? null,
            'is_walkin'         => isset($input['is_walkin']) ? ($input['is_walkin'] ? 1 : 0) : null,
            'status'            => $input['status'] ?? null,
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

        $set[] = "updated_at = NOW()";
        $params[] = $id;

        $this->db->query("UPDATE patients SET " . implode(', ', $set) . " WHERE id = ?", $params);
        $this->logActivity('UPDATE', 'patients', $id, 'Memperbarui data pasien');
        return $this->response->setJSON(['message' => 'Patient updated']);
    }

    public function deletePatient($id)
    {
        $this->db->query("DELETE FROM patients WHERE id = ?", [(int) $id]);
        $this->logActivity('DELETE', 'patients', (int) $id, 'Menghapus data pasien');
        return $this->response->setJSON(['message' => 'Patient deleted']);
    }

    public function getPatient($id)
    {
        $patient = $this->db->query("SELECT id, patient_code, nik, full_name, date_of_birth, gender, address, phone, email, blood_type, allergies, emergency_contact, emergency_phone, is_walkin, status, created_at, updated_at FROM patients WHERE id = ?", [(int) $id])->getRowArray();

        if (!$patient) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Patient not found']);
        }
        return $this->response->setJSON(['data' => $patient]);
    }

    public function listPatients()
    {
        $userID = session()->get('user_id');
        $role = strtolower(session()->get('role') ?? '');
        $all = $this->request->getGet('all');

        $sql = "SELECT DISTINCT p.id, p.patient_code, p.nik, p.full_name, p.date_of_birth, p.gender, p.address, p.phone, p.email, p.blood_type, p.allergies, p.emergency_contact, p.emergency_phone, p.is_walkin, p.status, p.created_at, p.updated_at FROM patients p";
        $params = [];

        if ($role === 'dokter' && !$all) {
            $sql .= " LEFT JOIN queues q ON p.id = q.patient_id LEFT JOIN medical_records mr ON p.id = mr.patient_id WHERE q.doctor_id = ? OR mr.doctor_id = ?";
            $params[] = $userID;
            $params[] = $userID;
        } elseif ($role === 'perawat' && !$all) {
            $sql .= " JOIN queues q ON p.id = q.patient_id WHERE q.nurse_id = ?";
            $params[] = $userID;
        }

        $sql .= " ORDER BY p.full_name ASC";
        $query = $this->db->query($sql, $params);
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function listPatientPayments()
    {
        $patientID = $this->request->getGet('patient_id');

        $sql = "SELECT p.id, p.payment_code as invoice_number, p.total_amount as total, p.payment_date as created_at, p.payment_method, p.status, pt.full_name as patient_name, pt.patient_code FROM payments p JOIN patients pt ON p.patient_id = pt.id WHERE 1=1";
        $params = [];

        if (!empty($patientID)) {
            $sql .= " AND p.patient_id = ?";
            $params[] = $patientID;
        }

        $query = $this->db->query($sql, $params);
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    // ============ QUEUES API ============

    public function createQueue()
    {
        $input = $this->request->getJSON(true);

        $poli = $input['poli'] ?? 'Umum';
        $prefix = 'Q';
        if (stripos($poli, 'Umum') !== false) {
            $prefix = 'A';
        } elseif (stripos($poli, 'Gigi') !== false) {
            $prefix = 'B';
        } elseif (stripos($poli, 'Anak') !== false) {
            $prefix = 'C';
        }

        $queueDate = $input['queue_date'] ?? date('Y-m-d');
        
        // Count today's queues for this specific poli to reset daily per-poli
        $todayPoliCount = $this->db->query("SELECT COUNT(*) as c FROM queues WHERE queue_date = ? AND poli = ?", [$queueDate, $poli])->getRow()->c;
        $queueNumber = $input['queue_number'] ?? ($prefix . '-' . sprintf('%03d', $todayPoliCount + 1));

        $visitType = $input['visit_type'] ?? 'rawat_jalan';

        $this->db->TransBegin();
        $this->db->query("INSERT INTO queues (patient_id, queue_number, queue_date, status, created_by, doctor_id, nurse_id, loket, poli, visit_type, created_at) VALUES (?, ?, ?, 'waiting', ?, ?, ?, ?, ?, ?, NOW())", [
            $input['patient_id'], $queueNumber, $queueDate,
            $input['created_by'] ?? session()->get('user_id'),
            $input['doctor_id'] ?? null,
            $input['nurse_id'] ?? null,
            $input['loket'] ?? null,
            $poli,
            $visitType,
        ]);

        $id = $this->db->insertID();
        if (!$id) {
            $this->db->TransRollback();
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Gagal membuat antrean']);
        }
        $this->db->TransCommit();

        $this->logActivity('CREATE', 'queues', $id, 'Menambahkan antrean baru #' . $queueNumber . ' di Poli ' . $poli);
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Queue created', 'data' => $id]);
    }

    public function updateQueue($id)
    {
        $input = $this->request->getJSON(true);

        $set = [];
        $params = [];

        if (isset($input['status'])) {
            $set[] = "status = ?";
            $params[] = $input['status'];
        }
        if (isset($input['called_at'])) {
            $set[] = "called_at = ?";
            $params[] = $input['called_at'];
        }
        if (isset($input['completed_at'])) {
            $set[] = "completed_at = ?";
            $params[] = $input['completed_at'];
        }
        if (isset($input['loket'])) {
            $set[] = "loket = ?";
            $params[] = $input['loket'];
        }

        if (empty($set)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'No data to update']);
        }

        $params[] = (int) $id;
        $this->db->query("UPDATE queues SET " . implode(', ', $set) . " WHERE id = ?", $params);

        $statusInfo = isset($input['status']) ? ' ke status ' . $input['status'] : '';
        $this->logActivity('UPDATE', 'queues', (int) $id, 'Memperbarui antrean ID ' . $id . $statusInfo);
        return $this->response->setJSON(['message' => 'Queue updated']);
    }

    public function deleteQueue($id)
    {
        $this->db->query("DELETE FROM queues WHERE id = ?", [(int) $id]);
        $this->logActivity('DELETE', 'queues', (int) $id, 'Menghapus antrean ID ' . $id);
        return $this->response->setJSON(['message' => 'Queue deleted']);
    }

    public function getQueue($id)
    {
        $query = $this->db->query("SELECT q.id, q.patient_id, q.queue_number, q.queue_date, q.status, q.created_by, q.doctor_id, q.nurse_id, q.loket, q.poli, q.called_at, q.completed_at, q.created_at, p.full_name as patient_name, p.patient_code, u.full_name as created_by_name FROM queues q LEFT JOIN patients p ON q.patient_id = p.id LEFT JOIN users u ON q.created_by = u.id WHERE q.id = ?", [(int) $id]);

        $queue = $query->getRowArray();
        if (!$queue) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Queue not found']);
        }
        return $this->response->setJSON(['data' => $queue]);
    }

    public function listQueues()
    {
        $userID = session()->get('user_id');
        $role = strtolower(session()->get('role') ?? '');

        $sql = "SELECT q.id, q.patient_id, q.queue_number, q.queue_date, q.status, q.created_by, q.doctor_id, q.nurse_id, q.loket, q.poli, q.called_at, q.completed_at, q.created_at, p.full_name as patient_name, p.patient_code, u.full_name as created_by_name FROM queues q LEFT JOIN patients p ON q.patient_id = p.id LEFT JOIN users u ON q.created_by = u.id WHERE 1=1";
        $params = [];

        if ($role === 'dokter') {
            $sql .= " AND q.doctor_id = ?";
            $params[] = $userID;
        } elseif ($role === 'perawat') {
            $sql .= " AND q.nurse_id = ?";
            $params[] = $userID;
        }

        $sql .= " ORDER BY q.id ASC";
        $query = $this->db->query($sql, $params);
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function listDoctors()
    {
        $query = $this->db->query("SELECT id, full_name, specialization FROM users WHERE role = 'dokter' AND is_active = 1 ORDER BY full_name ASC");
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    // ============ ACTIVITY LOGS API ============

    public function listActivityLogs()
    {
        $query = $this->db->query("SELECT al.id, al.user_id, al.action, al.entity, al.entity_id, al.description, al.ip_address, al.created_at, u.full_name as user_name FROM activity_logs al LEFT JOIN users u ON al.user_id = u.id ORDER BY al.created_at DESC");
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function getActivityLog($id)
    {
        $log = $this->db->query("SELECT al.id, al.user_id, al.action, al.entity, al.entity_id, al.description, al.ip_address, al.created_at, u.full_name as user_name FROM activity_logs al LEFT JOIN users u ON al.user_id = u.id WHERE al.id = ?", [(int) $id])->getRowArray();

        if (!$log) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Activity log not found']);
        }
        return $this->response->setJSON(['data' => $log]);
    }

    public function searchActivityLogs()
    {
        $action = $this->request->getGet('action');
        $entity = $this->request->getGet('entity');

        $sql = "SELECT al.id, al.user_id, al.action, al.entity, al.entity_id, al.description, al.ip_address, al.created_at, u.full_name as user_name FROM activity_logs al LEFT JOIN users u ON al.user_id = u.id WHERE 1=1";
        $params = [];

        if (!empty($action)) {
            $sql .= " AND al.action = ?";
            $params[] = $action;
        }
        if (!empty($entity)) {
            $sql .= " AND al.entity = ?";
            $params[] = $entity;
        }

        $sql .= " ORDER BY al.created_at DESC";
        $query = $this->db->query($sql, $params);
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function createActivityLog()
    {
        $input = $this->request->getJSON(true);
        $ip = $this->request->getIPAddress();

        $this->db->query("INSERT INTO activity_logs (user_id, action, entity, entity_id, description, ip_address, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())", [
            $input['user_id'], $input['action'], $input['entity'] ?? null,
            $input['entity_id'] ?? null, $input['description'] ?? null, $ip,
        ]);

        $id = $this->db->insertID();
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Log created', 'data' => $id]);
    }

    // ============ ACTIVITY LOG HELPER ============

    // ============ LOKET API ============

    public function listLokets()
    {
        $query = $this->db->query("SELECT * FROM lokets ORDER BY id ASC");
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function createLoket()
    {
        $input = $this->request->getJSON(true);
        $this->db->query("INSERT INTO lokets (name, description, is_active, created_at) VALUES (?, ?, 1, NOW())", [
            $input['name'],
            $input['description'] ?? null,
        ]);
        $id = $this->db->insertID();
        $this->logActivity('CREATE', 'lokets', $id, 'Menambahkan loket ' . $input['name']);
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Loket created', 'data' => $id]);
    }

    public function updateLoket($id)
    {
        $input = $this->request->getJSON(true);
        $set = []; $params = [];
        if (isset($input['name'])) { $set[] = "name = ?"; $params[] = $input['name']; }
        if (isset($input['description'])) { $set[] = "description = ?"; $params[] = $input['description']; }
        if (isset($input['is_active'])) { $set[] = "is_active = ?"; $params[] = $input['is_active'] ? 1 : 0; }
        if (empty($set)) return $this->response->setStatusCode(400)->setJSON(['error' => 'No data']);
        $params[] = (int) $id;
        $this->db->query("UPDATE lokets SET " . implode(', ', $set) . " WHERE id = ?", $params);
        $this->logActivity('UPDATE', 'lokets', (int) $id, 'Memperbarui loket');
        return $this->response->setJSON(['message' => 'Loket updated']);
    }

    public function deleteLoket($id)
    {
        $this->db->query("DELETE FROM lokets WHERE id = ?", [(int) $id]);
        return $this->response->setJSON(['message' => 'Loket deleted']);
    }

    // ============ IMPORT / EXPORT PATIENTS ============

    public function downloadPatientTemplate()
    {
        $filename = 'template_import_pasien.csv';
        $headers = [
            'nik', 'full_name', 'date_of_birth', 'gender', 'address',
            'phone', 'email', 'blood_type', 'allergies',
            'emergency_contact', 'emergency_phone', 'status'
        ];

        $example1 = [
            '3201234567890001', 'Budi Santoso', '1990-05-15', 'L', 'Jl. Merdeka No. 10 RT 03/RW 05 Kel. Sukamaju Kec. Cilandak Jakarta Selatan',
            '081234567890', 'budi.santoso@email.com', 'O', 'Tidak ada',
            'Siti Aminah', '089876543210', 'active'
        ];
        $example2 = [
            '3201234567890002', 'Ani Rahayu', '1985-11-22', 'P', 'Jl. Sudirman No. 55 RT 01/RW 02 Kel. Menteng Kec. Menteng Jakarta Pusat',
            '082345678901', 'ani.rahayu@email.com', 'A', 'Penisilin, Sulfa',
            'Dedi Rahayu', '081122334455', 'active'
        ];
        $example3 = [
            '3201234567890003', 'Cahyo Wibowo', '2000-03-08', 'L', 'Jl. Gatot Subroto No. 22 Bandung',
            '083456789012', '', 'B', '',
            'Rina Wibowo', '087766554433', 'active'
        ];

        $this->downloadCSV($filename, $headers, [$headers, $example1, $example2, $example3]);
    }

    public function exportPatients()
    {
        $query = $this->db->query("SELECT nik, full_name, date_of_birth, gender, address, phone, email, blood_type, allergies, emergency_contact, emergency_phone, status, patient_code, created_at FROM patients ORDER BY full_name ASC");
        $patients = $query->getResultArray();

        $filename = 'data_pasien_' . date('Y-m-d') . '.csv';
        $headers = [
            'nik', 'full_name', 'date_of_birth', 'gender', 'address',
            'phone', 'email', 'blood_type', 'allergies',
            'emergency_contact', 'emergency_phone', 'status',
            'patient_code', 'created_at'
        ];

        $rows = array_map(function($p) {
            return [
                $p['nik'], $p['full_name'], $p['date_of_birth'], $p['gender'], $p['address'],
                $p['phone'], $p['email'], $p['blood_type'], $p['allergies'],
                $p['emergency_contact'], $p['emergency_phone'], $p['status'],
                $p['patient_code'], $p['created_at']
            ];
        }, $patients);

        $this->downloadCSV($filename, $headers, $rows);
    }

    public function importPatients()
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
            // Remove BOM if present
            $h = preg_replace('/[\x{FEFF}]/u', '', $h);
            return $h;
        }, $header);

        $expected = ['full_name', 'nik'];
        $missing = array_diff($expected, $header);
        if (!empty($missing)) {
            fclose($handle);
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Kolom wajib tidak ditemukan: ' . implode(', ', $missing) . '. Unduh template untuk format yang benar.']);
        }

        // Map CSV columns to DB columns
        $columnMap = [
            'nik'               => 'nik',
            'full_name'         => 'full_name',
            'nama_lengkap'      => 'full_name',
            'nama'              => 'full_name',
            'date_of_birth'     => 'date_of_birth',
            'tanggal_lahir'     => 'date_of_birth',
            'tgl_lahir'         => 'date_of_birth',
            'gender'            => 'gender',
            'jenis_kelamin'     => 'gender',
            'jk'                => 'gender',
            'address'           => 'address',
            'alamat'            => 'address',
            'phone'             => 'phone',
            'telepon'           => 'phone',
            'no_telepon'        => 'phone',
            'no_hp'             => 'phone',
            'email'             => 'email',
            'blood_type'        => 'blood_type',
            'golongan_darah'    => 'blood_type',
            'gol_darah'         => 'blood_type',
            'allergies'         => 'allergies',
            'alergi'            => 'allergies',
            'emergency_contact' => 'emergency_contact',
            'kontak_darurat'    => 'emergency_contact',
            'emergency_phone'   => 'emergency_phone',
            'telepon_darurat'   => 'emergency_phone',
            'no_darurat'        => 'emergency_phone',
            'status'            => 'status',
        ];

        // Build index map
        $indexMap = [];
        foreach ($header as $i => $col) {
            if (isset($columnMap[$col])) {
                $indexMap[$i] = $columnMap[$col];
            }
        }

        $this->db->transBegin();
        $imported = 0;
        $updated = 0;
        $skipped = 0;
        $errors = [];
        $rowNum = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $rowNum++;
            $data = [];
            foreach ($indexMap as $i => $dbCol) {
                $data[$dbCol] = isset($row[$i]) ? trim($row[$i]) : null;
            }

            $nik = $data['nik'] ?? '';
            $fullName = $data['full_name'] ?? '';

            if (empty($nik) || empty($fullName)) {
                $errors[] = "Baris $rowNum: NIK dan Nama Lengkap wajib diisi";
                continue;
            }

            // Validate NIK format (numeric, 16 digits)
            if (!preg_match('/^\d{16}$/', $nik)) {
                $errors[] = "Baris $rowNum: NIK harus 16 digit angka (NIK: $nik)";
                continue;
            }

            // Normalize gender
            $gender = strtoupper($data['gender'] ?? '');
            if (in_array($gender, ['LAKI-LAKI', 'LAKI', 'MALE', 'M'])) {
                $gender = 'L';
            } elseif (in_array($gender, ['PEREMPUAN', 'WANITA', 'FEMALE', 'F'])) {
                $gender = 'P';
            }
            if (!in_array($gender, ['L', 'P'])) {
                $gender = 'L'; // Default
            }

            // Normalize blood type
            $bloodType = strtoupper($data['blood_type'] ?? '');
            $validBloodTypes = ['A', 'B', 'AB', 'O', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
            if (!in_array($bloodType, $validBloodTypes)) {
                $bloodType = null;
            }

            $status = strtolower($data['status'] ?? 'active');
            if (!in_array($status, ['active', 'inactive'])) {
                $status = 'active';
            }

            // Check if patient exists by NIK
            $existing = $this->db->query("SELECT id FROM patients WHERE nik = ?", [$nik])->getRowArray();

            if ($existing) {
                // Update existing patient
                $this->db->query("UPDATE patients SET full_name = ?, date_of_birth = ?, gender = ?, address = ?, phone = ?, email = ?, blood_type = ?, allergies = ?, emergency_contact = ?, emergency_phone = ?, status = ?, updated_at = NOW() WHERE id = ?", [
                    $fullName,
                    !empty($data['date_of_birth']) ? $data['date_of_birth'] : null,
                    $gender,
                    $data['address'] ?? null,
                    $data['phone'] ?? null,
                    $data['email'] ?? null,
                    $bloodType,
                    $data['allergies'] ?? null,
                    $data['emergency_contact'] ?? null,
                    $data['emergency_phone'] ?? null,
                    $status,
                    $existing['id'],
                ]);
                $updated++;
            } else {
                // Generate patient code: RM-YYMM-XXXX
                $todayCount = $this->db->query("SELECT COUNT(*) as c FROM patients WHERE YEAR(created_at) = YEAR(NOW()) AND MONTH(created_at) = MONTH(NOW())")->getRow()->c;
                $patientCode = 'RM-' . date('ym') . '-' . sprintf('%04d', $todayCount + $imported + 1);
                // Ensure uniqueness
                while ($this->db->query("SELECT id FROM patients WHERE patient_code = ?", [$patientCode])->getRow()) {
                    $todayCount++;
                    $patientCode = 'RM-' . date('ym') . '-' . sprintf('%04d', $todayCount + $imported + 1);
                }

                $this->db->query("INSERT INTO patients (patient_code, nik, full_name, date_of_birth, gender, address, phone, email, blood_type, allergies, emergency_contact, emergency_phone, is_walkin, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?, NOW(), NOW())", [
                    $patientCode,
                    $nik,
                    $fullName,
                    !empty($data['date_of_birth']) ? $data['date_of_birth'] : null,
                    $gender,
                    $data['address'] ?? null,
                    $data['phone'] ?? null,
                    $data['email'] ?? null,
                    $bloodType,
                    $data['allergies'] ?? null,
                    $data['emergency_contact'] ?? null,
                    $data['emergency_phone'] ?? null,
                    $status,
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

        $this->logActivity('IMPORT', 'patients', 0, "Import CSV pasien: $imported baru, $updated diperbarui");
        return $this->response->setJSON([
            'message' => "Import berhasil! $imported pasien baru ditambahkan, $updated pasien diperbarui.",
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

    private function logActivity($action, $entity, $entityID, $description)
    {
        $userID = session()->get('user_id') ?? 0;
        $ip = $this->request->getIPAddress();

        $this->db->query("INSERT INTO activity_logs (user_id, action, entity, entity_id, description, ip_address, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())", [
            $userID, $action, $entity, $entityID, $description, $ip,
        ]);
    }
}
