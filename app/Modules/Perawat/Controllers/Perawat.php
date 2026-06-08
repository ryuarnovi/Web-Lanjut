<?php

namespace Modules\Perawat\Controllers;

use App\Controllers\BaseController;

class Perawat extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['form', 'url']);
    }

    // ============ VIEW METHODS ============

    public function antrean()
    {
        return view('Modules\Perawat\Views\antrean', ['title' => 'Antrean Pasien - Perawat - KlinikOS 2.0']);
    }

    public function periksa()
    {
        return view('Modules\Perawat\Views\periksa', ['title' => 'Pemeriksaan Awal - Perawat - KlinikOS 2.0']);
    }

    // ============ API: QUEUES ============

    public function listQueues()
    {
        $status = $this->request->getGet('status');
        $userID = session()->get('user_id');
        $role = strtolower(session()->get('role') ?? '');
        $sql = "SELECT q.*, p.full_name AS patient_name, p.nik, p.gender, p.date_of_birth,
                       (SELECT u.full_name FROM users u WHERE u.id = q.doctor_id) AS doctor_name
                FROM queues q
                JOIN patients p ON q.patient_id = p.id
                WHERE q.queue_date = CURDATE()";
        $params = [];
        if ($status) {
            $sql .= " AND q.status = ?";
            $params[] = $status;
        }
        if ($role === 'perawat') {
            $sql .= " AND q.nurse_id = ?";
            $params[] = $userID;
        }
        $sql .= " ORDER BY q.created_at ASC";
        $query = $this->db->query($sql, $params);
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function getQueue($id)
    {
        $query = $this->db->query("SELECT q.*, p.full_name AS patient_name, p.nik, p.gender, p.date_of_birth, p.blood_type, p.allergies,
                                          (SELECT u.full_name FROM users u WHERE u.id = q.doctor_id) AS doctor_name
                                   FROM queues q JOIN patients p ON q.patient_id = p.id WHERE q.id = ?", [(int) $id]);
        $queue = $query->getRowArray();
        if (!$queue) return $this->response->setStatusCode(404)->setJSON(['error' => 'Queue not found']);
        return $this->response->setJSON(['data' => $queue]);
    }

    public function updateQueue($id)
    {
        $input = $this->request->getJSON(true);
        $set = [];
        $params = [];
        if (isset($input['status'])) {
            $set[] = "status = ?"; $params[] = $input['status'];
            if ($input['status'] === 'called') { $set[] = "called_at = NOW()"; }
            if ($input['status'] === 'completed') { $set[] = "completed_at = NOW()"; }
        }
        if (isset($input['loket'])) { $set[] = "loket = ?"; $params[] = $input['loket']; }
        if (isset($input['nurse_id'])) { $set[] = "nurse_id = ?"; $params[] = (int) $input['nurse_id']; }
        if (empty($set)) return $this->response->setStatusCode(400)->setJSON(['error' => 'No data to update']);
        $params[] = (int) $id;
        $this->db->query("UPDATE queues SET " . implode(', ', $set) . " WHERE id = ?", $params);
        $this->logActivity('UPDATE', 'queues', $id, 'Memperbarui antrean #' . $id);
        return $this->response->setJSON(['message' => 'Queue updated']);
    }

    // ============ API: MEDICAL RECORDS (Vital Signs) ============

    public function listMedicalRecords()
    {
        $query = $this->db->query(
            "SELECT mr.*, p.full_name AS patient_name, u.full_name AS doctor_name
             FROM medical_records mr
             JOIN patients p ON mr.patient_id = p.id
             JOIN users u ON mr.doctor_id = u.id
             ORDER BY mr.created_at DESC
             LIMIT 50"
        );
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function createMedicalRecord()
    {
        $input = $this->request->getJSON(true);
        $this->db->query("INSERT INTO medical_records (patient_id, queue_id, doctor_id, visit_date, subjective, objective, assessment, plan, vital_signs, icd_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
            $input['patient_id'],
            $input['queue_id'] ?? null,
            $input['doctor_id'] ?? session()->get('user_id'),
            $input['visit_date'] ?? date('Y-m-d H:i:s'),
            $input['subjective'] ?? null,
            $input['objective'] ?? null,
            $input['assessment'] ?? null,
            $input['plan'] ?? null,
            $input['vital_signs'] ?? null,
            $input['icd_code'] ?? null,
        ]);
        $id = $this->db->insertID();
        $this->logActivity('CREATE', 'medical_records', $id, 'Mencatat pemeriksaan awal perawat');
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Medical record created', 'data' => $id]);
    }

    public function getMedicalRecord($id)
    {
        $query = $this->db->query(
            "SELECT mr.*, p.full_name AS patient_name, u.full_name AS doctor_name
             FROM medical_records mr
             JOIN patients p ON mr.patient_id = p.id
             JOIN users u ON mr.doctor_id = u.id
             WHERE mr.id = ?", [(int) $id]
        );
        $record = $query->getRowArray();
        if (!$record) return $this->response->setStatusCode(404)->setJSON(['error' => 'Record not found']);
        return $this->response->setJSON(['data' => $record]);
    }

    public function updateMedicalRecord($id)
    {
        $input = $this->request->getJSON(true);
        $set = [];
        $params = [];
        if (isset($input['vital_signs'])) { $set[] = "vital_signs = ?"; $params[] = $input['vital_signs']; }
        if (isset($input['subjective'])) { $set[] = "subjective = ?"; $params[] = $input['subjective']; }
        if (isset($input['objective'])) { $set[] = "objective = ?"; $params[] = $input['objective']; }
        if (isset($input['assessment'])) { $set[] = "assessment = ?"; $params[] = $input['assessment']; }
        if (isset($input['plan'])) { $set[] = "plan = ?"; $params[] = $input['plan']; }
        if (empty($set)) return $this->response->setStatusCode(400)->setJSON(['error' => 'No data']);
        $params[] = (int) $id;
        $this->db->query("UPDATE medical_records SET " . implode(', ', $set) . ", updated_at = NOW() WHERE id = ?", $params);
        $this->logActivity('UPDATE', 'medical_records', $id, 'Memperbarui rekam medis');
        return $this->response->setJSON(['message' => 'Record updated']);
    }

    // ============ API: LOKETS ============

    public function listLokets()
    {
        $query = $this->db->query("SELECT * FROM lokets ORDER BY id ASC");
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    // ============ HELPER ============

    private function logActivity($action, $entity, $entityID, $description)
    {
        $userID = session()->get('user_id') ?? 0;
        $ip = $this->request->getIPAddress();
        $this->db->query("INSERT INTO activity_logs (user_id, action, entity, entity_id, description, ip_address, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())", [
            $userID, $action, $entity, $entityID, $description, $ip,
        ]);
    }
}
