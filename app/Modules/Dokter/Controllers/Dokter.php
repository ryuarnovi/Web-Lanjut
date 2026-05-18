<?php

namespace Modules\Dokter\Controllers;

use App\Controllers\BaseController;

class Dokter extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ============ VIEW METHODS ============

    public function antrean()
    {
        return view('Modules\Dokter\Views\antrean', ['title' => 'Daftar Tunggu Pasien - KlinikOS 2.0']);
    }

    public function soap()
    {
        return view('Modules\Dokter\Views\soap', ['title' => 'Rekam Medis (SOAP) - KlinikOS 2.0']);
    }

    // ============ SCHEDULES API (HRIS) ============

    public function listSchedules()
    {
        $doctorID = $this->request->getGet('doctor_id');
        $userID = session()->get('user_id');
        $role = strtolower(session()->get('role') ?? '');

        $sql = "SELECT s.id, s.doctor_id, u.full_name as doctor_name, s.day_of_week, s.start_time, s.end_time, s.quota, s.is_active FROM doctor_schedules s JOIN users u ON s.doctor_id = u.id WHERE 1=1";
        $params = [];

        if ($role === 'dokter') {
            $sql .= " AND s.doctor_id = ?";
            $params[] = $userID;
        } elseif (!empty($doctorID)) {
            $sql .= " AND s.doctor_id = ?";
            $params[] = $doctorID;
        }

        $query = $this->db->query($sql, $params);
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function createSchedule()
    {
        $input = $this->request->getJSON(true);

        $this->db->query("INSERT INTO doctor_schedules (doctor_id, day_of_week, start_time, end_time, quota, is_active) VALUES (?, ?, ?, ?, ?, true)", [
            $input['doctor_id'], $input['day_of_week'], $input['start_time'], $input['end_time'], $input['quota'],
        ]);

        $id = $this->db->insertID();
        $this->logActivity('CREATE', 'doctor_schedules', $id, 'Membuat jadwal dokter');
        return $this->response->setStatusCode(201)->setJSON(['data' => $id]);
    }

    public function updateSchedule($id)
    {
        $input = $this->request->getJSON(true);
        $this->db->query("UPDATE doctor_schedules SET doctor_id = ?, day_of_week = ?, start_time = ?, end_time = ?, quota = ? WHERE id = ?", [
            $input['doctor_id'], $input['day_of_week'], $input['start_time'], $input['end_time'], $input['quota'], (int) $id,
        ]);
        return $this->response->setJSON(['message' => 'Schedule updated']);
    }

    public function deleteSchedule($id)
    {
        $this->db->query("DELETE FROM doctor_schedules WHERE id = ?", [(int) $id]);
        return $this->response->setJSON(['message' => 'Schedule deleted']);
    }

    // ============ SHIFTS API ============

    public function listShifts()
    {
        $date = $this->request->getGet('date');
        $userID = session()->get('user_id');
        $role = strtolower(session()->get('role') ?? '');

        $sql = "SELECT s.id, s.staff_id, u.full_name as staff_name, s.shift_date, s.shift_type, s.start_time, s.end_time, s.notes FROM staff_shifts s JOIN users u ON s.staff_id = u.id WHERE 1=1";
        $params = [];

        if (!in_array($role, ['admin', 'pasien', 'dokter'])) {
            $sql .= " AND s.staff_id = ?";
            $params[] = $userID;
        } elseif (!empty($date)) {
            $sql .= " AND s.shift_date = ?";
            $params[] = $date;
        }

        $query = $this->db->query($sql, $params);
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function createShift()
    {
        $input = $this->request->getJSON(true);
        $this->db->query("INSERT INTO staff_shifts (staff_id, shift_date, shift_type, start_time, end_time, notes) VALUES (?, ?, ?, ?, ?, ?)", [
            $input['staff_id'], $input['shift_date'], $input['shift_type'], $input['start_time'] ?? null, $input['end_time'] ?? null, $input['notes'] ?? null,
        ]);

        $id = $this->db->insertID();
        return $this->response->setStatusCode(201)->setJSON(['data' => $id]);
    }

    public function updateShift($id)
    {
        $input = $this->request->getJSON(true);
        $this->db->query("UPDATE staff_shifts SET staff_id = ?, shift_date = ?, shift_type = ?, start_time = ?, end_time = ?, notes = ? WHERE id = ?", [
            $input['staff_id'], $input['shift_date'], $input['shift_type'], $input['start_time'] ?? null, $input['end_time'] ?? null, $input['notes'] ?? null, (int) $id,
        ]);
        return $this->response->setJSON(['message' => 'Shift updated']);
    }

    public function deleteShift($id)
    {
        $this->db->query("DELETE FROM staff_shifts WHERE id = ?", [(int) $id]);
        return $this->response->setJSON(['message' => 'Shift deleted']);
    }

    // ============ ICD-10 / ICD-9 API ============

    public function searchICD10()
    {
        $q = $this->request->getGet('q');
        if (empty($q)) {
            return $this->response->setJSON(['data' => []]);
        }

        $query = $this->db->query("SELECT id, code, description_en, description_id, is_active FROM icd10 WHERE code LIKE ? OR description_id LIKE ? OR description_en LIKE ? LIMIT 20", [
            "%$q%", "%$q%", "%$q%",
        ]);
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function searchICD9()
    {
        $q = $this->request->getGet('q');
        if (empty($q)) {
            return $this->response->setJSON(['data' => []]);
        }

        $query = $this->db->query("SELECT id, code, description_en, description_id, is_active FROM icd9cm WHERE code LIKE ? OR description_id LIKE ? OR description_en LIKE ? LIMIT 20", [
            "%$q%", "%$q%", "%$q%",
        ]);
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    // ============ MEDICAL RECORDS API ============

    public function createMedicalRecord()
    {
        $input = $this->request->getJSON(true);

        $visitDate = !empty($input['visit_date']) ? $input['visit_date'] : date('Y-m-d H:i:s');
        $queueID = !empty($input['queue_id']) ? (int) $input['queue_id'] : null;

        $this->db->query("INSERT INTO medical_records (patient_id, queue_id, doctor_id, visit_date, subjective, objective, assessment, plan, vital_signs, icd_code, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())", [
            $input['patient_id'], $queueID, $input['doctor_id'], $visitDate,
            $input['subjective'] ?? null, $input['objective'] ?? null, $input['assessment'] ?? null,
            $input['plan'] ?? null, $input['vital_signs'] ?? null, $input['icd_code'] ?? null,
        ]);

        $id = $this->db->insertID();
        $this->logActivity('CREATE', 'medical_records', $id, 'Membuat rekam medis baru untuk pasien ID ' . $input['patient_id']);
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Medical record created', 'data' => $id]);
    }

    public function updateMedicalRecord($id)
    {
        $input = $this->request->getJSON(true);

        $fields = [];
        if (isset($input['subjective'])) $fields['subjective'] = $input['subjective'];
        if (isset($input['objective'])) $fields['objective'] = $input['objective'];
        if (isset($input['assessment'])) $fields['assessment'] = $input['assessment'];
        if (isset($input['plan'])) $fields['plan'] = $input['plan'];
        if (isset($input['vital_signs'])) $fields['vital_signs'] = $input['vital_signs'];
        if (isset($input['icd_code'])) $fields['icd_code'] = $input['icd_code'];

        if (empty($fields)) {
            return $this->response->setJSON(['message' => 'Medical record updated']);
        }

        $set = [];
        $params = [];
        foreach ($fields as $col => $val) {
            $set[] = "$col = ?";
            $params[] = $val;
        }
        $params[] = (int) $id;

        $this->db->query("UPDATE medical_records SET " . implode(', ', $set) . ", updated_at = NOW() WHERE id = ?", $params);
        $this->logActivity('UPDATE', 'medical_records', (int) $id, 'Memperbarui rekam medis ID ' . $id);
        return $this->response->setJSON(['message' => 'Medical record updated']);
    }

    public function listMedicalRecords()
    {
        $userID = session()->get('user_id');
        $role = strtolower(session()->get('role') ?? '');

        $sql = "SELECT mr.id, mr.patient_id, mr.queue_id, mr.doctor_id, mr.visit_date, mr.subjective, mr.objective, mr.assessment, mr.plan, mr.vital_signs, mr.icd_code, mr.created_at, mr.updated_at, p.full_name as patient_name, q.queue_number, q.queue_date, q.status as queue_status, u.full_name as doctor_name FROM medical_records mr LEFT JOIN patients p ON mr.patient_id = p.id LEFT JOIN queues q ON mr.queue_id = q.id LEFT JOIN users u ON mr.doctor_id = u.id WHERE 1=1";
        $params = [];

        if ($role === 'dokter') {
            $sql .= " AND mr.doctor_id = ?";
            $params[] = $userID;
        } elseif ($role === 'perawat') {
            $sql .= " AND q.nurse_id = ?";
            $params[] = $userID;
        }

        $sql .= " ORDER BY mr.visit_date DESC";
        $query = $this->db->query($sql, $params);
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function getMedicalRecord($id)
    {
        $query = $this->db->query("SELECT mr.id, mr.patient_id, mr.queue_id, mr.doctor_id, mr.visit_date, mr.subjective, mr.objective, mr.assessment, mr.plan, mr.vital_signs, mr.icd_code, mr.created_at, mr.updated_at, p.full_name as patient_name, q.queue_number, q.queue_date, q.status as queue_status, u.full_name as doctor_name FROM medical_records mr LEFT JOIN patients p ON mr.patient_id = p.id LEFT JOIN queues q ON mr.queue_id = q.id LEFT JOIN users u ON mr.doctor_id = u.id WHERE mr.id = ?", [(int) $id]);

        $record = $query->getRowArray();
        if (!$record) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Medical record not found']);
        }
        return $this->response->setJSON(['data' => $record]);
    }

    public function deleteMedicalRecord($id)
    {
        $this->db->query("DELETE FROM medical_records WHERE id = ?", [(int) $id]);
        $this->logActivity('DELETE', 'medical_records', (int) $id, 'Menghapus rekam medis ID ' . $id);
        return $this->response->setJSON(['message' => 'Medical record deleted']);
    }

    // ============ REFERRALS API ============

    public function createReferral()
    {
        $input = $this->request->getJSON(true);

        $referralDate = !empty($input['referral_date']) ? $input['referral_date'] : date('Y-m-d');

        $this->db->query("INSERT INTO referrals (patient_id, medical_record_id, doctor_id, referral_to, referral_date, diagnosis, notes, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, 'active', NOW(), NOW())", [
            $input['patient_id'], $input['medical_record_id'] ?? null, $input['doctor_id'],
            $input['referral_to'], $referralDate, $input['diagnosis'] ?? null, $input['notes'] ?? null,
        ]);

        $id = $this->db->insertID();
        $this->logActivity('CREATE', 'referrals', $id, 'Membuat rujukan baru ke ' . $input['referral_to']);
        return $this->response->setStatusCode(201)->setJSON(['message' => 'Referral created', 'data' => $id]);
    }

    public function listReferrals()
    {
        $query = $this->db->query("SELECT r.id, r.patient_id, r.medical_record_id, r.doctor_id, r.referral_to, r.referral_date, r.diagnosis, r.notes, r.status, r.created_at, r.updated_at, p.full_name as patient_name, u.full_name as doctor_name FROM referrals r JOIN patients p ON r.patient_id = p.id JOIN users u ON r.doctor_id = u.id ORDER BY r.created_at DESC");
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function updateReferral($id)
    {
        $input = $this->request->getJSON(true);

        $fields = [];
        if (isset($input['referral_to'])) $fields['referral_to'] = $input['referral_to'];
        if (isset($input['referral_date'])) $fields['referral_date'] = $input['referral_date'];
        if (isset($input['diagnosis'])) $fields['diagnosis'] = $input['diagnosis'];
        if (isset($input['notes'])) $fields['notes'] = $input['notes'];
        if (isset($input['status'])) $fields['status'] = $input['status'];

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

        $this->db->query("UPDATE referrals SET " . implode(', ', $set) . ", updated_at = NOW() WHERE id = ?", $params);
        return $this->response->setJSON(['message' => 'Referral updated']);
    }

    public function deleteReferral($id)
    {
        $this->db->query("DELETE FROM referrals WHERE id = ?", [(int) $id]);
        return $this->response->setJSON(['message' => 'Referral deleted']);
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
