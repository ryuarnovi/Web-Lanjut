<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KlinikSeeder extends Seeder
{
    public function run(): void
    {
        $this->truncateAll();
        $this->seedUsers();
        $this->seedPatients();
        $this->seedDrugs();
        $this->seedLokets();
        $this->seedSuppliers();
        $this->seedQueues();
        $this->seedMedicalRecords();
        $this->seedPrescriptions();
        $this->seedPrescriptionItems();
        $this->seedPayments();
        $this->seedReferrals();
        $this->seedActivityLogs();
        $this->seedDoctorSchedules();
        $this->seedStaffShifts();
        $this->seedIcd10();
        $this->seedIcd9cm();
        $this->seedSettings();
    }

    private function truncateAll(): void
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        $tables = [
            'stock_transactions', 'suppliers', 'lokets',
            'prescription_items', 'payments', 'referrals',
            'prescriptions', 'medical_records', 'queues',
            'doctor_schedules', 'staff_shifts',
            'activity_logs', 'drugs', 'patients', 'users',
            'icd10', 'icd9cm', 'settings',
        ];
        foreach ($tables as $table) {
            try {
                $this->db->table($table)->truncate();
            } catch (\Exception $e) {
                // skip if table doesn't exist
            }
        }
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    private function seedUsers(): void
    {
        $password = password_hash('root210605', PASSWORD_BCRYPT);
        $users = [
            ['username' => 'admin', 'password_hash' => $password, 'full_name' => 'Administrator', 'email' => 'admin@klinikos.com', 'role' => 'admin', 'is_active' => 1, 'specialization' => null],
            ['username' => 'dokter', 'password_hash' => $password, 'full_name' => 'dr. Budi Santoso', 'email' => 'budi@klinikos.com', 'role' => 'dokter', 'is_active' => 1, 'specialization' => 'Umum'],
            ['username' => 'dokter_gigi', 'password_hash' => $password, 'full_name' => 'drg. Sari Dewi', 'email' => 'sari@klinikos.com', 'role' => 'dokter', 'is_active' => 1, 'specialization' => 'Gigi'],
            ['username' => 'dokter_anak', 'password_hash' => $password, 'full_name' => 'dr. Fitriani', 'email' => 'fitri@klinikos.com', 'role' => 'dokter', 'is_active' => 1, 'specialization' => 'Anak'],
            ['username' => 'apoteker', 'password_hash' => $password, 'full_name' => 'Ibu Siti Aminah', 'email' => 'siti@klinikos.com', 'role' => 'apoteker', 'is_active' => 1, 'specialization' => null],
            ['username' => 'kasir', 'password_hash' => $password, 'full_name' => 'Andi Kasir', 'email' => 'andi@klinikos.com', 'role' => 'kasir', 'is_active' => 1, 'specialization' => null],
            ['username' => 'resepsionis', 'password_hash' => $password, 'full_name' => 'Rina Resep', 'email' => 'rina@klinikos.com', 'role' => 'resepsionis', 'is_active' => 1, 'specialization' => null],
            ['username' => 'perawat', 'password_hash' => $password, 'full_name' => 'Suster Siti', 'email' => 'perawat@klinikos.com', 'role' => 'perawat', 'is_active' => 1, 'specialization' => null],
        ];
        $this->db->table('users')->insertBatch($users);
    }

    private function seedPatients(): void
    {
        $patients = [
            ['patient_code' => 'P001', 'nik' => '1234567890123456', 'full_name' => 'John Doe', 'date_of_birth' => '1990-01-01', 'gender' => 'L', 'address' => 'Jl. Merdeka No. 1', 'phone' => '08123456789', 'status' => 'active'],
            ['patient_code' => 'P002', 'nik' => '3214567890123457', 'full_name' => 'Siti Nurbaya', 'date_of_birth' => '1985-05-15', 'gender' => 'P', 'address' => 'Jl. Jendral Sudirman No. 12', 'phone' => '08129876543', 'status' => 'active'],
            ['patient_code' => 'P003', 'nik' => '6543217890123458', 'full_name' => 'Budi Santoso', 'date_of_birth' => '1978-08-20', 'gender' => 'L', 'address' => 'Jl. Ahmad Yani No. 45', 'phone' => '08134567890', 'status' => 'active'],
            ['patient_code' => 'P004', 'nik' => '9876543210123459', 'full_name' => 'Dewi Lestari', 'date_of_birth' => '1992-11-10', 'gender' => 'P', 'address' => 'Jl. Gatot Subroto No. 8', 'phone' => '08567890123', 'status' => 'active'],
            ['patient_code' => 'P005', 'nik' => '1239874560123460', 'full_name' => 'Andi Firmansyah', 'date_of_birth' => '1980-03-25', 'gender' => 'L', 'address' => 'Jl. Diponegoro No. 22', 'phone' => '08781234567', 'status' => 'active'],
            ['patient_code' => 'P006', 'nik' => '4561237890123461', 'full_name' => 'Rina Kusuma', 'date_of_birth' => '1995-07-30', 'gender' => 'P', 'address' => 'Jl. Pahlawan No. 5', 'phone' => '08963456789', 'status' => 'active'],
            ['patient_code' => 'P007', 'nik' => '7894561230123462', 'full_name' => 'Surya Darma', 'date_of_birth' => '1975-12-05', 'gender' => 'L', 'address' => 'Jl. Veteran No. 18', 'phone' => '08215678901', 'status' => 'active'],
            ['patient_code' => 'P008', 'nik' => '3217894560123463', 'full_name' => 'Maya Indah', 'date_of_birth' => '1988-02-14', 'gender' => 'P', 'address' => 'Jl. Imam Bonjol No. 3', 'phone' => '08529012345', 'status' => 'active'],
        ];
        $this->db->table('patients')->insertBatch($patients);
    }

    private function seedDrugs(): void
    {
        $drugs = [
            ['kode_obat' => 'D001', 'nama_obat' => 'Paracetamol 500mg', 'kategori_obat' => 'Analgesic', 'unit' => 'Tablet', 'stok_obat' => 100, 'min_stock' => 10, 'harga_jual_eceran' => 500.00, 'harga_jual_grosir' => 400.00],
            ['kode_obat' => 'D002', 'nama_obat' => 'Amoxicillin 250mg', 'kategori_obat' => 'Antibiotic', 'unit' => 'Capsule', 'stok_obat' => 50, 'min_stock' => 5, 'harga_jual_eceran' => 1200.00, 'harga_jual_grosir' => 1000.00],
            ['kode_obat' => 'D003', 'nama_obat' => 'Vitamin C 1000mg', 'kategori_obat' => 'Supplement', 'unit' => 'Tablet', 'stok_obat' => 200, 'min_stock' => 20, 'harga_jual_eceran' => 1500.00, 'harga_jual_grosir' => 1200.00],
            ['kode_obat' => 'D004', 'nama_obat' => 'Omeprazole 20mg', 'kategori_obat' => 'Antacid', 'unit' => 'Capsule', 'stok_obat' => 80, 'min_stock' => 15, 'harga_jual_eceran' => 2000.00, 'harga_jual_grosir' => 1800.00],
            ['kode_obat' => 'D005', 'nama_obat' => 'Cetirizine 10mg', 'kategori_obat' => 'Antihistamine', 'unit' => 'Tablet', 'stok_obat' => 150, 'min_stock' => 20, 'harga_jual_eceran' => 1000.00, 'harga_jual_grosir' => 800.00],
            ['kode_obat' => 'D006', 'nama_obat' => 'Ibuprofen 400mg', 'kategori_obat' => 'NSAID', 'unit' => 'Tablet', 'stok_obat' => 120, 'min_stock' => 15, 'harga_jual_eceran' => 800.00, 'harga_jual_grosir' => 600.00],
            ['kode_obat' => 'D007', 'nama_obat' => 'Metformin 500mg', 'kategori_obat' => 'Antidiabetic', 'unit' => 'Tablet', 'stok_obat' => 300, 'min_stock' => 50, 'harga_jual_eceran' => 700.00, 'harga_jual_grosir' => 500.00],
            ['kode_obat' => 'D008', 'nama_obat' => 'Amlodipine 5mg', 'kategori_obat' => 'Antihypertensive', 'unit' => 'Tablet', 'stok_obat' => 250, 'min_stock' => 30, 'harga_jual_eceran' => 900.00, 'harga_jual_grosir' => 700.00],
            ['kode_obat' => 'D009', 'nama_obat' => 'Salbutamol 2mg', 'kategori_obat' => 'Bronchodilator', 'unit' => 'Tablet', 'stok_obat' => 100, 'min_stock' => 15, 'harga_jual_eceran' => 600.00, 'harga_jual_grosir' => 400.00],
            ['kode_obat' => 'D010', 'nama_obat' => 'Cefadroxil 500mg', 'kategori_obat' => 'Antibiotic', 'unit' => 'Capsule', 'stok_obat' => 60, 'min_stock' => 10, 'harga_jual_eceran' => 2500.00, 'harga_jual_grosir' => 2000.00],
            ['kode_obat' => 'D011', 'nama_obat' => 'Loratadine 10mg', 'kategori_obat' => 'Antihistamine', 'unit' => 'Tablet', 'stok_obat' => 150, 'min_stock' => 20, 'harga_jual_eceran' => 1200.00, 'harga_jual_grosir' => 900.00],
            ['kode_obat' => 'D012', 'nama_obat' => 'Domperidone 10mg', 'kategori_obat' => 'Antiemetic', 'unit' => 'Tablet', 'stok_obat' => 200, 'min_stock' => 30, 'harga_jual_eceran' => 800.00, 'harga_jual_grosir' => 600.00],
            ['kode_obat' => 'D013', 'nama_obat' => 'Loperamide 2mg', 'kategori_obat' => 'Antidiarrheal', 'unit' => 'Tablet', 'stok_obat' => 100, 'min_stock' => 15, 'harga_jual_eceran' => 1500.00, 'harga_jual_grosir' => 1200.00],
            ['kode_obat' => 'D014', 'nama_obat' => 'Simvastatin 10mg', 'kategori_obat' => 'Anticholesterol', 'unit' => 'Tablet', 'stok_obat' => 180, 'min_stock' => 25, 'harga_jual_eceran' => 1000.00, 'harga_jual_grosir' => 750.00],
            ['kode_obat' => 'D015', 'nama_obat' => 'Glimepiride 2mg', 'kategori_obat' => 'Antidiabetic', 'unit' => 'Tablet', 'stok_obat' => 150, 'min_stock' => 20, 'harga_jual_eceran' => 1800.00, 'harga_jual_grosir' => 1400.00],
            ['kode_obat' => 'D016', 'nama_obat' => 'Ranitidine 150mg', 'kategori_obat' => 'Antacid', 'unit' => 'Tablet', 'stok_obat' => 90, 'min_stock' => 10, 'harga_jual_eceran' => 800.00, 'harga_jual_grosir' => 600.00],
            ['kode_obat' => 'D017', 'nama_obat' => 'Diclofenac 50mg', 'kategori_obat' => 'NSAID', 'unit' => 'Tablet', 'stok_obat' => 250, 'min_stock' => 40, 'harga_jual_eceran' => 700.00, 'harga_jual_grosir' => 500.00],
            ['kode_obat' => 'D018', 'nama_obat' => 'Neurobion Forte', 'kategori_obat' => 'Vitamin B', 'unit' => 'Tablet', 'stok_obat' => 300, 'min_stock' => 50, 'harga_jual_eceran' => 2000.00, 'harga_jual_grosir' => 1700.00],
            ['kode_obat' => 'D019', 'nama_obat' => 'Captopril 25mg', 'kategori_obat' => 'Antihypertensive', 'unit' => 'Tablet', 'stok_obat' => 120, 'min_stock' => 20, 'harga_jual_eceran' => 500.00, 'harga_jual_grosir' => 300.00],
            ['kode_obat' => 'D020', 'nama_obat' => 'Prednisone 5mg', 'kategori_obat' => 'Corticosteroid', 'unit' => 'Tablet', 'stok_obat' => 200, 'min_stock' => 30, 'harga_jual_eceran' => 600.00, 'harga_jual_grosir' => 400.00],
        ];
        $this->db->table('drugs')->insertBatch($drugs);
    }

    private function seedLokets(): void
    {
        $lokets = [
            ['name' => 'Loket 1', 'description' => 'Pendaftaran & Administrasi'],
            ['name' => 'Loket 2', 'description' => 'Poli Umum'],
            ['name' => 'Loket 3', 'description' => 'Poli Gigi'],
        ];
        $this->db->table('lokets')->insertBatch($lokets);
    }

    private function seedSuppliers(): void
    {
        $suppliers = [
            ['name' => 'PT Kimia Farma', 'contact_person' => 'Bpk. Agus', 'phone' => '021-1234567', 'email' => 'agus@kimiafarma.co.id', 'address' => 'Jl. Industri No. 10, Jakarta'],
            ['name' => 'PT Kalbe Farma', 'contact_person' => 'Ibu Dewi', 'phone' => '021-7654321', 'email' => 'dewi@kalbe.co.id', 'address' => 'Jl. Kesehatan No. 25, Jakarta'],
            ['name' => 'PT Sanbe Farma', 'contact_person' => 'Bpk. Hendra', 'phone' => '022-9876543', 'email' => 'hendra@sanbe.co.id', 'address' => 'Jl. Obat No. 5, Bandung'],
        ];
        $this->db->table('suppliers')->insertBatch($suppliers);
    }

    private function seedQueues(): void
    {
        $queues = [
            ['patient_id' => 1, 'queue_number' => 'Q001', 'poli' => 'Umum', 'doctor_id' => 2, 'status' => 'completed', 'created_by' => 7],
            ['patient_id' => 2, 'queue_number' => 'Q002', 'poli' => 'Umum', 'doctor_id' => 2, 'status' => 'waiting', 'created_by' => 7],
            ['patient_id' => 3, 'queue_number' => 'Q003', 'poli' => 'Umum', 'doctor_id' => 2, 'status' => 'called', 'created_by' => 7],
            ['patient_id' => 4, 'queue_number' => 'Q004', 'poli' => 'Gigi', 'doctor_id' => 3, 'status' => 'waiting', 'created_by' => 7],
            ['patient_id' => 5, 'queue_number' => 'Q005', 'poli' => 'Anak', 'doctor_id' => 4, 'status' => 'waiting', 'created_by' => 7],
        ];
        $this->db->table('queues')->insertBatch($queues);
    }

    private function seedMedicalRecords(): void
    {
        $records = [
            [
                'patient_id' => 1, 'queue_id' => 1, 'doctor_id' => 2,
                'subjective' => 'Pasien mengeluh demam tinggi sejak 3 hari yang lalu, disertai mual dan pusing.',
                'objective' => 'Suhu tubuh 39°C, Tekanan Darah 110/70 mmHg, Nadi 90x/menit. Tampak lemas.',
                'assessment' => 'Observasi Febris H-3, Suspek Demam Dengue / Tifoid.',
                'plan' => 'Cek lab darah lengkap perifer. Berikan antipiretik, istirahat cukup, dan banyak minum air putih.',
                'vital_signs' => '{"TD": "110/70", "Suhu": "39", "Nadi": "90", "Nafas": "20", "BB": "65", "TB": "170"}',
                'icd_code' => 'R50.9',
            ],
            [
                'patient_id' => 2, 'queue_id' => 2, 'doctor_id' => 2,
                'subjective' => 'Batuk berdahak sudah 1 minggu, kadang sesak ringan.',
                'objective' => 'Suara paru kasar, BP 120/80',
                'assessment' => 'Bronkitis Akut',
                'plan' => 'Ekspektoran dan Antibiotik 5 hari',
                'vital_signs' => '{"TD": "120/80", "Suhu": "37", "Nadi": "85", "BB": "55"}',
                'icd_code' => 'J20.9',
            ],
        ];
        $this->db->table('medical_records')->insertBatch($records);
    }

    private function seedPrescriptions(): void
    {
        $prescriptions = [
            ['prescription_code' => 'RX-1681234567', 'medical_record_id' => 1, 'patient_id' => 1, 'doctor_id' => 2, 'status' => 'pending', 'notes' => 'Diminum sesudah makan. Habiskan antibiotik jika ada.'],
            ['prescription_code' => 'RX-1681234568', 'medical_record_id' => 2, 'patient_id' => 2, 'doctor_id' => 2, 'status' => 'processed', 'notes' => 'Tebus segera'],
        ];
        $this->db->table('prescriptions')->insertBatch($prescriptions);
    }

    private function seedPrescriptionItems(): void
    {
        $items = [
            ['prescription_id' => 1, 'drug_id' => 1, 'quantity' => 10, 'dosage_instruction' => '3 x 1 Tablet, jika demam'],
            ['prescription_id' => 1, 'drug_id' => 3, 'quantity' => 10, 'dosage_instruction' => '1 x 1 Tablet, sesudah sarapan'],
            ['prescription_id' => 2, 'drug_id' => 2, 'quantity' => 10, 'dosage_instruction' => '3 x 1 Kapsul, habiskan'],
            ['prescription_id' => 2, 'drug_id' => 5, 'quantity' => 5, 'dosage_instruction' => '1 x 1 Tablet malam hari'],
        ];
        $this->db->table('prescription_items')->insertBatch($items);
    }

    private function seedPayments(): void
    {
        $payments = [
            ['payment_code' => 'INV-1681234567', 'patient_id' => 1, 'medical_record_id' => 1, 'prescription_id' => 1, 'total_amount' => 105000.00, 'payment_method' => 'cash', 'status' => 'unpaid', 'notes' => 'Biaya konsultasi dr. Budi Santoso dan resep rawat jalan.', 'doctor_fee' => 80000.00, 'medicine_cost' => 20000.00, 'admin_fee' => 5000.00],
            ['payment_code' => 'INV-1681234568', 'patient_id' => 2, 'medical_record_id' => 2, 'prescription_id' => 2, 'total_amount' => 120000.00, 'payment_method' => 'qris', 'status' => 'paid', 'notes' => 'Konsultasi + Obat racikan', 'doctor_fee' => 80000.00, 'medicine_cost' => 35000.00, 'admin_fee' => 5000.00],
        ];
        $this->db->table('payments')->insertBatch($payments);
    }

    private function seedReferrals(): void
    {
        $referrals = [
            ['patient_id' => 1, 'medical_record_id' => 1, 'doctor_id' => 2, 'referral_to' => 'RSUD Provinsi', 'diagnosis' => 'Suspek Demam Dengue (DBD) dengan warning signs', 'notes' => 'Mohon penanganan lebih lanjut dan cek lab berkala.', 'status' => 'active'],
            ['patient_id' => 2, 'medical_record_id' => 2, 'doctor_id' => 2, 'referral_to' => 'Klinik Spesialis Paru Sehat', 'diagnosis' => 'Suspek TB/Pneumonia', 'notes' => 'Mohon foto Rontgen Thorax', 'status' => 'active'],
        ];
        $this->db->table('referrals')->insertBatch($referrals);
    }

    private function seedActivityLogs(): void
    {
        $logs = [
            ['user_id' => 1, 'action' => 'LOGIN', 'entity' => 'user', 'entity_id' => 1, 'description' => 'Administrator berhasil login ke sistem.'],
            ['user_id' => 2, 'action' => 'CREATE_MEDICAL_RECORD', 'entity' => 'medical_record', 'entity_id' => 1, 'description' => 'dr. Budi Santoso telah menambahkan rekam medis baru untuk pasien John Doe.'],
        ];
        $this->db->table('activity_logs')->insertBatch($logs);
    }

    private function seedDoctorSchedules(): void
    {
        $schedules = [
            // dr. Budi Santoso (ID 2) - Poli Umum
            ['doctor_id' => 2, 'day_of_week' => 1, 'start_time' => '08:00:00', 'end_time' => '12:00:00', 'quota' => 15, 'is_active' => 1],
            ['doctor_id' => 2, 'day_of_week' => 2, 'start_time' => '08:00:00', 'end_time' => '12:00:00', 'quota' => 15, 'is_active' => 1],
            ['doctor_id' => 2, 'day_of_week' => 3, 'start_time' => '13:00:00', 'end_time' => '17:00:00', 'quota' => 10, 'is_active' => 1],
            ['doctor_id' => 2, 'day_of_week' => 4, 'start_time' => '08:00:00', 'end_time' => '12:00:00', 'quota' => 15, 'is_active' => 1],
            ['doctor_id' => 2, 'day_of_week' => 5, 'start_time' => '08:00:00', 'end_time' => '14:00:00', 'quota' => 20, 'is_active' => 1],
            // drg. Sari Dewi (ID 3) - Poli Gigi
            ['doctor_id' => 3, 'day_of_week' => 1, 'start_time' => '08:00:00', 'end_time' => '12:00:00', 'quota' => 10, 'is_active' => 1],
            ['doctor_id' => 3, 'day_of_week' => 2, 'start_time' => '08:00:00', 'end_time' => '12:00:00', 'quota' => 10, 'is_active' => 1],
            ['doctor_id' => 3, 'day_of_week' => 4, 'start_time' => '13:00:00', 'end_time' => '17:00:00', 'quota' => 8, 'is_active' => 1],
            ['doctor_id' => 3, 'day_of_week' => 5, 'start_time' => '08:00:00', 'end_time' => '12:00:00', 'quota' => 10, 'is_active' => 1],
            // dr. Fitriani (ID 4) - Poli Anak
            ['doctor_id' => 4, 'day_of_week' => 1, 'start_time' => '13:00:00', 'end_time' => '17:00:00', 'quota' => 12, 'is_active' => 1],
            ['doctor_id' => 4, 'day_of_week' => 3, 'start_time' => '08:00:00', 'end_time' => '12:00:00', 'quota' => 15, 'is_active' => 1],
            ['doctor_id' => 4, 'day_of_week' => 5, 'start_time' => '08:00:00', 'end_time' => '14:00:00', 'quota' => 15, 'is_active' => 1],
        ];
        $this->db->table('doctor_schedules')->insertBatch($schedules);
    }

    private function seedStaffShifts(): void
    {
        $shifts = [
            ['staff_id' => 7, 'shift_date' => date('Y-m-d'), 'shift_type' => 'morning', 'start_time' => '07:00:00', 'end_time' => '14:00:00', 'notes' => 'Shift pagi resepsionis'],
            ['staff_id' => 8, 'shift_date' => date('Y-m-d'), 'shift_type' => 'morning', 'start_time' => '07:00:00', 'end_time' => '14:00:00', 'notes' => 'Shift pagi perawat'],
            ['staff_id' => 5, 'shift_date' => date('Y-m-d'), 'shift_type' => 'morning', 'start_time' => '08:00:00', 'end_time' => '16:00:00', 'notes' => 'Shift pagi apoteker'],
        ];
        $this->db->table('staff_shifts')->insertBatch($shifts);
    }

    private function seedIcd10(): void
    {
        $icd10 = [
            ['code' => 'A00.0', 'description_en' => 'Cholera due to Vibrio cholerae 01, biovar cholerae', 'description_id' => 'Kolera akibat Vibrio cholerae 01, biovar cholerae', 'is_active' => 1],
            ['code' => 'A09.0', 'description_en' => 'Infectious gastroenteritis and colitis', 'description_id' => 'Gastroenteritis dan kolitis infeksius', 'is_active' => 1],
            ['code' => 'A15.0', 'description_en' => 'Tuberculosis of lung', 'description_id' => 'Tuberkulosis paru', 'is_active' => 1],
            ['code' => 'E11.9', 'description_en' => 'Type 2 diabetes mellitus without complications', 'description_id' => 'Diabetes melitus tipe 2 tanpa komplikasi', 'is_active' => 1],
            ['code' => 'I10', 'description_en' => 'Essential (primary) hypertension', 'description_id' => 'Hipertensi esensial (primer)', 'is_active' => 1],
            ['code' => 'J00', 'description_en' => 'Acute nasopharyngitis [common cold]', 'description_id' => 'Nasofaringitis akut (pilek biasa)', 'is_active' => 1],
            ['code' => 'J02.9', 'description_en' => 'Acute pharyngitis, unspecified', 'description_id' => 'Faringitis akut, tidak spesifik', 'is_active' => 1],
            ['code' => 'J06.9', 'description_en' => 'Acute upper respiratory infection, unspecified', 'description_id' => 'Infeksi saluran pernapasan atas akut, tidak spesifik', 'is_active' => 1],
            ['code' => 'J20.9', 'description_en' => 'Acute bronchitis, unspecified', 'description_id' => 'Bronkitis akut, tidak spesifik', 'is_active' => 1],
            ['code' => 'K29.7', 'description_en' => 'Gastritis, unspecified', 'description_id' => 'Gastritis, tidak spesifik', 'is_active' => 1],
            ['code' => 'K30', 'description_en' => 'Functional dyspepsia', 'description_id' => 'Dispepsia fungsional', 'is_active' => 1],
            ['code' => 'L20.8', 'description_en' => 'Other atopic dermatitis', 'description_id' => 'Dermatitis atopik lainnya', 'is_active' => 1],
            ['code' => 'M54.5', 'description_en' => 'Low back pain', 'description_id' => 'Nyeri punggung bawah', 'is_active' => 1],
            ['code' => 'N39.0', 'description_en' => 'Urinary tract infection, site not specified', 'description_id' => 'Infeksi saluran kemih, lokasi tidak spesifik', 'is_active' => 1],
            ['code' => 'R50.9', 'description_en' => 'Fever, unspecified', 'description_id' => 'Demam, tidak spesifik', 'is_active' => 1],
            ['code' => 'R51', 'description_en' => 'Headache', 'description_id' => 'Sakit kepala', 'is_active' => 1],
            ['code' => 'R10.4', 'description_en' => 'Other and unspecified abdominal pain', 'description_id' => 'Nyeri perut lainnya dan tidak spesifik', 'is_active' => 1],
            ['code' => 'Z23', 'description_en' => 'Need for immunization against single viral diseases', 'description_id' => 'Kebutuhan imunisasi terhadap penyakit virus tunggal', 'is_active' => 1],
        ];
        $this->db->table('icd10')->insertBatch($icd10);
    }

    private function seedSettings(): void
    {
        $settings = [
            ['key' => 'nama_klinik', 'value' => 'KlinikOS Medical Center'],
            ['key' => 'kode_faskes', 'value' => 'FKS-009123'],
            ['key' => 'alamat', 'value' => 'Jl. Jend. Sudirman No. 123, Kompleks Kesehatan Terpadu, Jakarta Selatan, 12190'],
            ['key' => 'telepon', 'value' => '(021) 555-1234'],
            ['key' => 'email', 'value' => 'info@klinikos.co.id'],
            ['key' => 'jam_buka_senin_jumat', 'value' => '08:00 - 21:00'],
            ['key' => 'jam_buka_sabtu', 'value' => '09:00 - 15:00'],
            ['key' => 'jam_buka_minggu', 'value' => 'Tutup / Hanya IGD'],
            ['key' => 'midtrans_client_key', 'value' => 'SB-Mid-client-A1B2C3D4E5F6G7H8'],
            ['key' => 'midtrans_server_key', 'value' => 'SB-Mid-server-Z9Y8X7W6V5U4T3S2'],
        ];
        $this->db->table('settings')->insertBatch($settings);
    }

    private function seedIcd9cm(): void
    {
        $icd9cm = [
            ['code' => '01.09', 'description_en' => 'Other cranial puncture', 'description_id' => 'Tusukan kranial lainnya', 'is_active' => 1],
            ['code' => '03.31', 'description_en' => 'Spinal tap', 'description_id' => 'Pungsi lumbal', 'is_active' => 1],
            ['code' => '87.03', 'description_en' => 'CT scan of head', 'description_id' => 'CT scan kepala', 'is_active' => 1],
            ['code' => '87.41', 'description_en' => 'Chest x-ray', 'description_id' => 'Foto rontgen dada', 'is_active' => 1],
            ['code' => '88.56', 'description_en' => 'Coronary arteriography', 'description_id' => 'Arteriografi koroner', 'is_active' => 1],
            ['code' => '89.51', 'description_en' => 'Electrocardiogram', 'description_id' => 'Elektrokardiogram', 'is_active' => 1],
            ['code' => '89.7', 'description_en' => 'General physical examination', 'description_id' => 'Pemeriksaan fisik umum', 'is_active' => 1],
            ['code' => '90.59', 'description_en' => 'Microscopic examination of blood', 'description_id' => 'Pemeriksaan mikroskopik darah', 'is_active' => 1],
            ['code' => '93.38', 'description_en' => 'Physical therapy', 'description_id' => 'Terapi fisik', 'is_active' => 1],
            ['code' => '99.04', 'description_en' => 'Parenteral infusion', 'description_id' => 'Infus parenteral', 'is_active' => 1],
        ];
        $this->db->table('icd9cm')->insertBatch($icd9cm);
    }
}
