# Progress & Roadmap KlinikOS 2.0

## ✅ Selesai

### Infrastruktur
- ✅ **Migrasi UI** ke TailwindCSS v4
- ✅ **Setup Environment** — Docker (PHP 8.4-Apache, MySQL, Node.js 20) + watcher Tailwind real-time
- ✅ **Struktur Modular/HMVC** di `app/Modules/`
- ✅ **Routing & Navigasi** — Base routing untuk Resepsionis, Dokter, Perawat, Apoteker, Kasir, Admin
- ✅ **Prototyping Views** — UI CRUD dan Dashboard responsif dengan sidebar adaptif per Role
- ✅ **Responsive Fixes** — Mobile layout, grid, universal sidebar overlay, charts

### Database & Seeder
- ✅ **Schema DDL lengkap** di `app/Database/init.sql` — users, patients, drugs, queues, medical_records, prescriptions, prescription_items, payments, referrals, activity_logs, doctor_schedules, staff_shifts, icd10, icd9, settings, suppliers, stock_transactions, lokets
- ✅ **KlinikSeeder** idempotent — 8 users (3 dokter: Umum/Gigi/Anak), 8 pasien, 20 obat, 5 antrean (dengan `doctor_id` & `poli`), 2 rekam medis, 2 resep + 4 item, 3 loket, 3 supplier, 10 ICD-10, 10 ICD-9CM, 18 pengaturan, jadwal dokter, shift staf, log aktivitas
- ✅ **Poli Queue Reset** — Reset antrean harian otomatis per-poli
- ✅ **Validasi UNIQUE** — NIK dan email unik dengan error handling ramah pengguna

### Dashboard
- ✅ **Pengaturan** — Form load/save via `/api/settings`
- ✅ **Profile** — Company name, email, phone dari settings API
- ✅ **Home** — Statistik dashboard dari `/api/dashboard/stats`, antrean & log dari API
- ✅ **Header** — Notifikasi & jumlah antrean real-time
- ✅ **Footer** — Alamat, telepon, jam operasional dari settings API

### Login & Auth
- ✅ **Session-based auth** — Login, logout, RBAC filter per role
- ✅ **API auth** — Semua endpoint `/api/*` dilindungi filter session
- ✅ **User CRUD API** — `/api/users` dengan role management

### Resepsionis
- ✅ **Pendaftaran** — Form create pasien + queue, poli & dokter dari API, filter dokter by poli
- ✅ **Search pasien existing** — Ketik nama cari existing patient, cegah duplikat
- ✅ **Antrean** — Tabel live update, panggil pasien ke loket
- ✅ **Patient API** — CRUD lengkap dengan search
- ✅ **Queue API** — CRUD dengan filter per role
- ✅ **Generator nomor RM** — Auto-generate nomor RM dengan format `RM-YYMM-XXXX`

### Dokter
- ✅ **Antrean** — Menampilkan antrean per dokter (filter `doctor_id`), polling 3 detik
- ✅ **Panggil pasien** — Modal pilih loket, update status `called`
- ✅ **SOAP (Pemeriksaan)** — Form lengkap: Subjective, Objective, Assessment, Plan, ICD-10 (searchable)
- ✅ **Tanda Vital** — TD, Suhu, Nadi, Nafas, BB, TB (disimpan sebagai JSON di `vital_signs`)
- ✅ **Detail Pasien** — NIK, usia, gender, gol darah, alergi (di-fetch dari `/api/patients/{id}`)
- ✅ **Resep Obat** & **Edit Resep** — Searchable drug dropdown, tambah/hapus item, reload/edit resep terkirim
- ✅ **Simpan & Selesai** — Simpan rekam medis + update queue `completed` + buat resep di `prescriptions`
- ✅ **Riwayat Pemeriksaan** — Menampilkan rekam medis sebelumnya per pasien, modal detail
- ✅ **ICD-10 & ICD-9 API** — Search dan autocomplete untuk diagnosa dan tindakan
- ✅ **Pencatatan Tindakan Medis** — Memasukkan tindakan ICD-9 beserta biaya tindakan (`tindakan_fee`) dan tarif konsultasi dokter (`doctor_fee`)

### Perawat
- ✅ **Antrean** — Menampilkan antrean hari ini, polling 5 detik
- ✅ **Pemeriksaan Awal (Triase)** — Form tanda vital lengkap: TD, Suhu, Nadi, Nafas, BB, TB, GDS
- ✅ **Simpan & Update Status** — Vital signs tersimpan ke `medical_records`, status queue → `in_progress`, `nurse_id` tercatat
- ✅ **Perawat API** — Queue, Medical Records, dan Loket API di endpoint `/api/perawat/*`

### Apoteker
- ✅ **CRUD Obat** — Stok obat, kategori, unit, harga, low-stock warning
- ✅ **Supplier API** — CRUD supplier
- ✅ **Stock Transaction API** — Barang masuk/keluar
- ✅ **Resep (Penebusan)** — Tabel dari API `/api/prescriptions`, detail modal, tombol "Proses Resep"
- ✅ **Konfirmasi penyerahan obat** — Tombol "Serahkan Obat" yang mengurangi stok real-time, mencatat riwayat transaksi, dan menyelaraskan tagihan
- ✅ **Manajemen batch & kedaluwarsa** — Indikator warna merah untuk obat kadaluarsa dan mendekati kadaluarsa (< 30 hari)
- ✅ **Riwayat pergerakan stok** — Tab khusus di halaman inventaris yang menampilkan mutasi stok barang masuk/keluar

### Kasir
- ✅ **Billing** — Preview struk tagihan konsolidasi otomatis
- ✅ **Konsolidasi tagihan otomatis** — Menggabungkan biaya admin, konsultasi dokter, tindakan medis, dan biaya resep obat
- ✅ **Cetak struk (Print Layout)** — Cetak langsung dengan layout termal (80mm) yang bersih via `@media print`
- ✅ **Form tagihan manual** — Input diskon, pajak, dan biaya tambahan dengan kalkulasi kembalian real-time
- ✅ **Payment Gateway & Web3** — Integrasi penuh dengan Midtrans Snap SDK dan Web3 Crypto Wallet (mock transfer)

### Laporan & Analytics
- ✅ **Grafik Kunjungan** — Tren kunjungan pasien harian menggunakan ApexCharts
- ✅ **Grafik Pendapatan** — Tren pendapatan klinik harian menggunakan ApexCharts
- ✅ **Laporan Distribusi Poli** — Grafik donat distribusi kunjungan per departemen/poli
- ✅ **Ekspor Raw Data (CSV)** — Pengunduhan data Kunjungan, Keuangan, dan Stok Obat dalam file CSV secara client-side

### UI / UX
- ✅ **Pagination** — Pagination tabel dinamis via utility helper `window.paginateTable`
- ✅ **Confirm dialog** — Modal konfirmasi modern menggantikan alert native (`window.confirmDialog`)
- ✅ **Toast notification** — Notifikasi toast modern dengan model overlay (`window.showToast`)
- ✅ **Dark mode** — Toggler dark mode yang persisten menggunakan local storage

### Keamanan
- ✅ **CSRF protection** — Diaktifkan secara global di Filters.php dengan mitigasi fetch auto-injection

### Landing Page (Publik)
- ✅ **Home Profile** — Landing page utama klinik tanpa login
- ✅ **Layanan** — Halaman informasi layanan klinik
- ✅ **Tentang** — Halaman profil dan informasi klinik
- ✅ **Kontak** — Halaman informasi kontak klinik

---

## ❌ Belum / Kurang

### Keamanan
- ⬜ **Rate limiting** — API belum ada rate limiter (Opsional)
- ⬜ **Input sanitasi** — Belum ada validasi server-side untuk XSS (Opsional)

### Testing
- ⬜ **Unit test** — Belum ada PHPUnit test
- ⬜ **Integration test** — Belum ada test untuk API endpoints
- ⬜ **Seed data testing** — Perlu verifikasi manual bahwa semua seed data berfungsi

Untuk rincian tugas spesifik per modul, lihat:
- [Fitur Resepsionis](FEATURE_RESEPSIONIS.md)
- [Fitur Dokter](FEATURE_DOKTER.md)
- [Fitur Perawat](FEATURE_PERAWAT.md)
- [Fitur Apoteker](FEATURE_APOTEKER.md)
- [Fitur Kasir](FEATURE_KASIR.md)
- [Fitur Core (Auth, Laporan, Pengaturan)](FEATURE_CORE.md)
- [Fitur Landing Page (Publik)](FEATURE_GENERAL.md)
