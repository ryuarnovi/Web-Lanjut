# KlinikOS 2.0 - Clinical Management System

Sistem manajemen klinik modern berbasis **CodeIgniter 4** dengan arsitektur **Modular** dan styling menggunakan **TailwindCSS v4** & **NiceAdmin (Bootstrap 5)**.

## 🚀 Fitur Utama
- **Arsitektur Modular**: Pemisahan fitur per modul (Resepsionis, Dokter, Apoteker, Kasir).
- **Executive Dashboard**: Visualisasi data klinis dengan Chart.
- **Electronic Medical Record (EMR)**: Panel SOAP untuk dokter.
- **Security Middleware**: Proteksi rute medis dengan Auth Filter.
- **Tailwind v4 Integration**: Styling modern dengan Standalone CLI.
- **Dockerized**: Berjalan di PHP 8.4 & Apache.

## 🛠️ Prasyarat
- Docker & Docker Compose
- Node.js (Opsional, sudah ada Standalone CLI)

## 📦 Set Up & Instalasi

### 1. Jalankan dengan Docker
Pastikan Anda berada di root direktori proyek, lalu jalankan:
```bash
docker compose up --build
```
Aplikasi akan tersedia di: `http://localhost:9092`

### 2. Login Default
Gunakan kredensial berikut untuk masuk ke sistem:
- **Username**: `admin`
- **Password**: `admin`

## 🎨 Pengembangan UI (TailwindCSS)
Sistem menggunakan Tailwind Standalone CLI. Untuk melakukan *compile* pada Mac:

**Mode Sekali Build:**
```bash
./tailwindcss -i public/assets/css/input.css -o public/assets/css/app.css
```

**Mode Watch (Auto-compile):**
```bash
./tailwindcss -i public/assets/css/input.css -o public/assets/css/app.css --watch
```
*Catatan: File CSS juga akan otomatis ter-build di dalam Docker saat perintah `docker compose up --build` dijalankan.*

## 📂 Struktur Folder Modular
- `app/Modules/Auth`: Modul Login & Logout.
- `app/Modules/Dashboard`: Modul Berita, Laporan, & Profil.
- `app/Modules/Resepsionis`: Modul Pendaftaran & Antrean.
- `app/Modules/Dokter`: Modul Rekam Medis & Diagnosis.
- `app/Modules/Apoteker`: Modul Farmasi & Stok.
- `app/Modules/Kasir`: Modul Billing & Kasir.
- `app/Modules/Shared`: Layout global, Header, & Sidebar.

---
Dikembangkan oleh **Rizki Ardiansyah (KlinikOS Team)**
