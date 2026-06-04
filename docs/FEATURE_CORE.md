# Feature: Core (Auth, Laporan, Profile, Pengaturan)

## Deskripsi Logic
Modul sentral atau Global (Core) menangani fitur-fitur administratif seperti autentikasi user (Login/Logout), manajemen sesi, hak akses, visualisasi data statistik harian (Dashboard utama), serta pengaturan operasional *setting* klinik.

## Status Implementasi

### ✅ Sudah Jadi
- **Autentikasi Session** — Login/logout dengan session, password di-hash `PASSWORD_BCRYPT`.
- **RBAC Filter** — CI4 Filter `auth` dengan parameter role (`admin,dokter`, `admin,resepsionis`, dll). Cegah akses tanpa login, cegah akses URL role lain.
- **Sidebar adaptif** — Menu yang tampil sesuai role user.
- **Dashboard Home** — Statistik (total pasien, dokter, obat, antrean hari ini) dari `/api/dashboard/stats`.
- **Grafik Charts** — ApexCharts terhubung ke API (tren kunjungan harian, tren pendapatan harian, distribusi poli).
- **Profile** — Nama klinik, email, telepon dari settings API.
- **Pengaturan (Settings)** — Form key-value, load/save via `/api/settings`.
- **Header & Footer** — Notifikasi real-time (jumlah antrean), info kontak dari settings.
- **User Management API** — CRUD user (`/api/users`), upload foto profile.
- **Activity Logs** — Semua operasi CREATE/UPDATE/DELETE tercatat di `activity_logs`.
- **Pagination** — Pagination tabel dinamis via utility helper `window.paginateTable`.
- **Dark Mode** — Toggler dark mode yang persisten menggunakan local storage.
- **Toast Notification** — Notifikasi toast modern dengan model overlay (`window.showToast`).
- **Confirm Dialog** — Modal konfirmasi modern menggantikan alert native (`window.confirmDialog`).
- **CSRF Protection** — Diaktifkan secara global di Filters.php dengan mitigasi fetch auto-injection, session-based.
- **Laporan Kunjungan** — Grafik tren kunjungan pasien harian menggunakan ApexCharts.
- **Laporan Pendapatan** — Grafik tren pendapatan klinik harian menggunakan ApexCharts.
- **Laporan Distribusi Poli** — Grafik donat distribusi kunjungan per departemen/poli.
- **Ekspor Raw Data (CSV)** — Pengunduhan data Kunjungan, Keuangan, dan Stok Obat dalam file CSV secara client-side.

### ❌ Belum / Kurang
- **Rate Limiting** — API belum ada rate limiter (opsional).
- **Input Sanitasi** — Belum ada validasi server-side untuk XSS (opsional).
- **Unit Test** — Belum ada PHPUnit test.
- **Integration Test** — Belum ada test untuk API endpoints.

## Skenario Testing
- [x] **Bypass URL** — Tanpa login redirect ke halaman login.
- [x] **Hak Akses** — Resepsionis tidak bisa akses `/dokter/soap` (403/dialog).
- [x] **Kalkulasi Dashboard** — Jumlah kunjungan sesuai COUNT() di database.
- [x] **CSRF** — Form submit tanpa token ditolak.
- [x] **Dark Mode** — Toggle dark mode berfungsi dan persisten.
- [x] **Toast & Dialog** — Notifikasi dan konfirmasi modern tampil saat operasi CRUD.
- [x] **Pagination** — Tabel dengan data banyak ter-paginate dengan benar.
- [x] **Ekspor CSV** — File CSV terunduh dengan data yang benar.
