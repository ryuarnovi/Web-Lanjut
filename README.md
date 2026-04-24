# 🏥 KlinikOS 2.0 - Clinical Management System

Sistem manajemen klinik modern berbasis **CodeIgniter 4** dengan arsitektur **Modular** dan styling menggunakan **TailwindCSS v4** & **NiceAdmin (Bootstrap 5)**. Proyek ini dirancang untuk skalabilitas tinggi dan kemudahan pemeliharaan.

---

## 📂 Struktur Proyek (Modular)

KlinikOS menggunakan pendekatan modular di mana setiap fitur utama memiliki "ruang" sendiri. Semua logika bisnis berada di dalam folder `app/Modules`.

```text
KlinikOS/
├── app/
│   ├── Modules/              <-- Jantung aplikasi
│   │   ├── Auth/             (Login/Logout/RBAC)
│   │   ├── Dashboard/        (Home, Profile, Reports)
│   │   ├── Resepsionis/      (Pendaftaran & Antrean)
│   │   ├── Dokter/           (SOAP, Diagnosis, EMR)
│   │   ├── Apoteker/         (Farmasi, Inventory)
│   │   ├── Kasir/            (Billing, Payments)
│   │   └── Shared/           (Layout, Sidebar, Header global)
│   └── Config/               (Autoload.php terdaftar untuk Modules)
├── public/
│   └── assets/               (Compiled CSS, Images, Vendor JS)
├── docker-compose.yml        (Konfigurasi Orchestration)
└── Dockerfile                (Build image PHP 8.4-apache)
```

---

## 🛠️ Panduan Instalasi (Docker)

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan lokal Anda:

### 1. Persiapkan Environment
Copy file `env.example` menjadi `.env`:
```bash
cp env.example .env
```

### 2. Jalankan Docker
Gunakan Docker Compose untuk membuild image dan menjalankan container:
```bash
docker compose up --build -d
```
*Gunakan flag `-d` untuk menjalankan di background.*

### 3. Akses Aplikasi
Buka browser dan akses URL berikut:
- **URL**: `http://localhost:9092`
- **Kredensial Default**:
  - Username: `admin`
  - Password: `admin`

---

## 🎨 Pengembangan UI (TailwindCSS v4)

Proyek ini menggunakan **TailwindCSS v4 Standalone CLI** (tanpa Node.js di host). Binary `tailwindcss` sudah tersedia di root proyek.

- **Watch Mode (Mac/Linux)**:
  ```bash
  ./tailwindcss -i public/assets/css/input.css -o public/assets/css/app.css --watch
  ```
- **Build Mode**:
  ```bash
  ./tailwindcss -i public/assets/css/input.css -o public/assets/css/app.css
  ```

---

## ⚠️ Troubleshooting (Penting)

### 1. Error Permission `writable` Folder
Jika Anda melihat error *Permission Denied* pada folder `writable`, jalankan perintah berikut di host (Mac/Linux):
```bash
chmod -R 777 writable
```
Atau masuk ke container dan ubah owner-nya:
```bash
docker exec -it tugas-app-1 chown -R www-data:www-data writable
```

### 2. Port Conflict (9092)
Jika port `9092` sudah digunakan aplikasi lain, ubah angka kiri pada `docker-compose.yml`:
```yaml
ports:
  - "9093:80" # Ubah 9092 menjadi 9093
```

### 3. Tailwind Binary Error
Jika binary `./tailwindcss` tidak bisa dieksekusi, berikan akses execute:
```bash
chmod +x tailwindcss
```

---

## 📝 Catatan Pengembangan
- **Menambah Modul Baru**: Buat folder di `app/Modules/`, tambahkan Controller, View, dan Model. Namespace akan otomatis terdeteksi karena sudah terdaftar di `app/Config/Autoload.php`.
- **Assets**: Selalu gunakan `base_url()` untuk memanggil asset agar link tetap valid di Docker.

---
Dikembangkan dengan ❤️ oleh **Tim KlinikOS**
