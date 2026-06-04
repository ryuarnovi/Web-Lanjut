-- MySQL Schema for KlinikOS

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(100) NULL,
    phone VARCHAR(20) NULL,
    nip VARCHAR(20) UNIQUE NULL,
    specialization VARCHAR(100) NULL,
    license_number VARCHAR(100) NULL,
    role VARCHAR(20) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    profile_picture_url VARCHAR(255) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_code VARCHAR(20) UNIQUE NOT NULL,
    nik VARCHAR(20) UNIQUE NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender CHAR(1) NOT NULL,
    address TEXT NULL,
    phone VARCHAR(20) NULL,
    email VARCHAR(100) NULL,
    blood_type VARCHAR(5) NULL,
    allergies TEXT NULL,
    emergency_contact VARCHAR(255) NULL,
    emergency_phone VARCHAR(20) NULL,
    is_walkin TINYINT(1) DEFAULT 0,
    status VARCHAR(20) DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS drugs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_obat VARCHAR(20) UNIQUE NOT NULL,
    nama_obat VARCHAR(255) NOT NULL,
    deskripsi TEXT NULL,
    fungsi_obat TEXT NULL,
    efek_samping TEXT NULL,
    kategori_obat VARCHAR(100) NULL,
    merek_obat VARCHAR(100) NULL,
    dosis_obat VARCHAR(100) NULL,
    golongan_obat VARCHAR(100) NULL,
    bentuk_obat VARCHAR(50) NULL,
    unit VARCHAR(50) NULL,
    stok_obat INT DEFAULT 0,
    min_stock INT DEFAULT 0,
    harga_jual_grosir DECIMAL(15,2) DEFAULT 0,
    harga_jual_eceran DECIMAL(15,2) DEFAULT 0,
    expiry_date DATE NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS queues (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    queue_number VARCHAR(10) NOT NULL,
    queue_date DATE DEFAULT (CURRENT_DATE),
    status VARCHAR(20) DEFAULT 'waiting',
    created_by INT NULL,
    doctor_id INT NULL,
    nurse_id INT NULL,
    loket VARCHAR(20) NULL,
    poli VARCHAR(100) NULL,
    visit_type VARCHAR(50) NULL DEFAULT 'rawat_jalan',
    called_at DATETIME NULL,
    completed_at DATETIME NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (created_by) REFERENCES users(id),
    FOREIGN KEY (doctor_id) REFERENCES users(id),
    FOREIGN KEY (nurse_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS medical_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    queue_id INT NULL,
    doctor_id INT NOT NULL,
    visit_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    subjective TEXT NULL,
    objective TEXT NULL,
    assessment TEXT NULL,
    plan TEXT NULL,
    vital_signs TEXT NULL,
    icd_code VARCHAR(20) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (queue_id) REFERENCES queues(id),
    FOREIGN KEY (doctor_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS prescriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prescription_code VARCHAR(20) UNIQUE NOT NULL,
    medical_record_id INT NULL,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    prescription_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'pending',
    notes TEXT NULL,
    processed_by INT NULL,
    processed_at DATETIME NULL,
    dispensed_at DATETIME NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (doctor_id) REFERENCES users(id),
    FOREIGN KEY (medical_record_id) REFERENCES medical_records(id),
    FOREIGN KEY (processed_by) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS prescription_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prescription_id INT NOT NULL,
    drug_id INT NOT NULL,
    quantity INT NOT NULL,
    dosage_instruction TEXT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (prescription_id) REFERENCES prescriptions(id),
    FOREIGN KEY (drug_id) REFERENCES drugs(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_code VARCHAR(20) UNIQUE NOT NULL,
    patient_id INT NOT NULL,
    medical_record_id INT NULL,
    prescription_id INT NULL,
    payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    doctor_fee DECIMAL(15,2) DEFAULT 0,
    medicine_cost DECIMAL(15,2) DEFAULT 0,
    admin_fee DECIMAL(15,2) DEFAULT 0,
    discount DECIMAL(15,2) DEFAULT 0,
    tax DECIMAL(15,2) DEFAULT 0,
    total_amount DECIMAL(15,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    paid_amount DECIMAL(15,2) DEFAULT 0,
    change_amount DECIMAL(15,2) DEFAULT 0,
    status VARCHAR(20) DEFAULT 'unpaid',
    processed_by INT NULL,
    notes TEXT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (medical_record_id) REFERENCES medical_records(id),
    FOREIGN KEY (prescription_id) REFERENCES prescriptions(id),
    FOREIGN KEY (processed_by) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS referrals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    medical_record_id INT NULL,
    doctor_id INT NOT NULL,
    referral_to VARCHAR(255) NOT NULL,
    referral_date DATE DEFAULT (CURRENT_DATE),
    diagnosis TEXT NULL,
    notes TEXT NULL,
    status VARCHAR(20) DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (medical_record_id) REFERENCES medical_records(id),
    FOREIGN KEY (doctor_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    action VARCHAR(100) NOT NULL,
    entity VARCHAR(50) NULL,
    entity_id INT NULL,
    description TEXT NULL,
    ip_address VARCHAR(45) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS doctor_schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT NOT NULL,
    day_of_week TINYINT(1) NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    quota INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (doctor_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS staff_shifts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT NOT NULL,
    shift_date DATE NOT NULL,
    shift_type VARCHAR(20) NOT NULL,
    start_time TIME NULL,
    end_time TIME NULL,
    notes TEXT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (staff_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS icd10 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL,
    description_en TEXT NULL,
    description_id TEXT NULL,
    is_active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS icd9cm (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL,
    description_en TEXT NULL,
    description_id TEXT NULL,
    is_active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(100) UNIQUE NOT NULL,
    `value` TEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


