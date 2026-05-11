# Feature: Core (Auth, Laporan, Profile, Pengaturan)

## Deskripsi Logic
Modul sentral atau Global (Core) menangani fitur-fitur administratif seperti autentikasi user (Login/Logout), manajemen sesi, hak akses, visualisasi data statistik harian (Dashboard utama), serta pengaturan operasional *setting* klinik.

## Kekurangan / Yang Perlu Ditambahkan
- **Autentikasi & Database Users**: Perlu tabel `users` dengan enkripsi *password* menggunakan `password_hash()` bawaan PHP/CI4.
- **Implementasi Middleware (Filters) di CI4**: Saat ini sistem belum mengamankan jalur *URL*. Fitur Filter CI4 harus mencegah `guest` mengakses halaman dalam, serta membatasi `Kasir` untuk tidak bisa masuk (Bypass URL) ke `/dokter/soap`.
- **Dinamisasi Grafik Laporan (Charts)**: Widget grafik E-Charts & ApexCharts di Dashboard perlu dihubungkan dengan *query* Ajax atau Data Binding dari database untuk memunculkan tren pasien atau pendapatan yang sesungguhnya.
- **Penyimpanan Profil & Pengaturan**: Form "Informasi Klinik" dan "Jam Operasional" harus disinkronisasikan ke tabel konfigurasi global (biasanya tabel `settings` model _key-value_).
- **Manajemen Role**: UI *User Management* untuk admin level atas menambahkan akun pekerja baru (Dokter/Kasir).

## Skenario Testing Per Fitur
- [ ] **Uji Coba Bypass URL (Security Test)**: Dalam keadaan tidak *login* (sudah logout), pengguna mencoba mengakses `http://localhost:9092/dokter/soap`. Filter harus memaksa pengalihan paksa (Redirect) ke halaman login.
- [ ] **Autentikasi Hak Akses**: Pengguna login dengan NIP/Email 'Resepsionis', pastikan menu Sidebar di luar otoritasnya benar-benar tidak tampil, dan URL lain menolak *request* (Error 403 Forbidden).
- [ ] **Kalkulasi Rekap Dashboard**: Memeriksa apakah jumlah Kunjungan (Pasien Baru/Lama) yang tertulis di widget sesuai persis dengan perhitungan `COUNT()` jumlah `transaksi_kunjungan` hari itu di database.
