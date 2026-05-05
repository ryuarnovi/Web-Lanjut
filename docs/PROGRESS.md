# Progress & Roadmap KlinikOS 2.0

## Status Saat Ini
- ✅ **Migrasi UI**: Selesai memigrasikan template lama ke arsitektur desain baru berbasis **TailwindCSS v4**.
- ✅ **Setup Environment**: Terintegrasi penuh dengan Docker (PHP 8.4-Apache) dan kompilasi CSS *real-time* via watcher Tailwind di dalam Docker Compose.
- ✅ **Struktur Direktori**: Berhasil mengadopsi pola Modular/HMVC di dalam folder `app/Modules`.
- ✅ **Routing & Navigasi**: Konfigurasi base routing untuk semua aktor (Resepsionis, Dokter, Apoteker, Kasir, Admin).
- ✅ **Prototyping Views**: Pembuatan antarmuka pengguna (UI) CRUD dan Dashboard sudah responsif, dinamis, dan terstruktur. Sidebar beradaptasi berdasarkan *Role*.
- ✅ **Responsive Fixes**: Telah memperbaiki *bug* UI di mana layout terhimpit di mode mobile dan grid layout telah dipercantik.
- ✅ **NPM & Docker Integration**: Berhasil memindahkan sistem build Tailwind dari standalone CLI ke NPM-based workflow yang berjalan sepenuhnya di dalam Docker (Node.js 20).
- ✅ **Responsive Charts & Layout**: Implementasi responsivitas otomatis pada ApexCharts/ECharts serta sistem **Universal Sidebar Overlay** untuk mencegah tata letak halaman terhimpit di semua ukuran layar (Desktop & Mobile).

## Pekerjaan Selanjutnya (Global Tasks)
1. **Pembuatan Database Schema**: Merancang relasi ERD untuk entitas User, Pasien, Dokter, Obat, Transaksi, dan Rekam Medis.
2. **Koneksi & Konfigurasi Database**: Mengatur `Database.php` untuk terkoneksi ke container database (Misal: MySQL/PostgreSQL).
3. **Integrasi Backend Model**: Menghubungkan views (form UI) dengan Model CI4 untuk implementasi query operasi CRUD ke database sesungguhnya.
4. **Implementasi Autentikasi Sesungguhnya (RBAC)**: Mengatur Filters/Middleware untuk mengamankan route berdasarkan otorisasi role dari sesi database.
5. **Validasi Request Server-side**: Melakukan filter dan sanitasi setiap pengiriman data dari form.

Untuk rincian tugas (Task), Logika (Logic), dan Testing spesifik per modul fitur, silakan merujuk ke dokumentasi berikut:
- [Fitur Resepsionis (Front Desk)](FEATURE_RESEPSIONIS.md)
- [Fitur Dokter (Layanan Medis)](FEATURE_DOKTER.md)
- [Fitur Apoteker (Farmasi & Inventaris)](FEATURE_APOTEKER.md)
- [Fitur Kasir (Pembayaran & Tagihan)](FEATURE_KASIR.md)
- [Fitur Core (Auth, Laporan, Pengaturan)](FEATURE_CORE.md)
