<?php

namespace Modules\Pasien\Controllers;

use App\Controllers\BaseController;

class Pasien extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function submitJanjiTemu()
    {
        $input = $this->request->getJSON(true);
        if (!$input) {
            $input = $this->request->getPost();
        }

        $patientName = $input['patient_name'] ?? '';
        $patientPhone = $input['patient_phone'] ?? null;
        $patientEmail = $input['patient_email'] ?? null;
        $poli = $input['poli'] ?? 'Umum';
        $doctorId = !empty($input['doctor_id']) ? $input['doctor_id'] : null;
        $appointmentDate = $input['appointment_date'] ?? '';
        $appointmentTime = $input['appointment_time'] ?? null;
        $keluhan = $input['keluhan'] ?? null;

        if (empty($patientName) || empty($appointmentDate)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama pasien dan tanggal janji temu wajib diisi']);
        }

        $this->db->query("INSERT INTO appointments (patient_name, patient_phone, patient_email, poli, doctor_id, appointment_date, appointment_time, keluhan, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW())", [
            $patientName, $patientPhone, $patientEmail, $poli, $doctorId, $appointmentDate, $appointmentTime, $keluhan,
        ]);

        $id = $this->db->insertID();
        if (!$id) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Gagal mengirim janji temu']);
        }

        return $this->response->setStatusCode(201)->setJSON(['message' => 'Janji temu berhasil dikirim', 'data' => $id]);
    }

    public function submitPesan()
    {
        $input = $this->request->getJSON(true);
        if (!$input) {
            $input = $this->request->getPost();
        }

        $patientName = $input['patient_name'] ?? '';
        $patientPhone = $input['patient_phone'] ?? null;
        $patientEmail = $input['patient_email'] ?? null;
        $subject = $input['subject'] ?? null;
        $message = $input['message'] ?? '';

        if (empty($patientName) || empty($message)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama dan pesan wajib diisi']);
        }

        $this->db->query("INSERT INTO patient_messages (patient_name, patient_phone, patient_email, subject, message, status, created_at) VALUES (?, ?, ?, ?, ?, 'unread', NOW())", [
            $patientName, $patientPhone, $patientEmail, $subject, $message,
        ]);

        $id = $this->db->insertID();
        if (!$id) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Gagal mengirim pesan']);
        }

        return $this->response->setStatusCode(201)->setJSON(['message' => 'Pesan berhasil dikirim', 'data' => $id]);
    }
}
