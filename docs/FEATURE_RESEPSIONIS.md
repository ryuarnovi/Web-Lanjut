# Feature: Resepsionis (Front Desk)

## Deskripsi Logic
Modul ini adalah pintu masuk pertama bagi operasional klinik. Resepsionis bertugas menerima pendaftaran pasien baru (pengumpulan data diri/rekam medis awal), mencari pasien lama, dan mendaftarkan mereka ke sistem antrean berdasarkan poli yang dituju.

## Kekurangan / Yang Perlu Ditambahkan
- **Tabel Database Pasien**: Diperlukan skema database tabel `pasien` untuk menyimpan data rekam medis dasar (Nama, NIK, Tanggal Lahir, dsb).
- **Generator Nomor Rekam Medis (RM)**: Logic otomatis untuk *auto-generate* Nomor RM yang unik bagi pasien baru.
- **Sistem Antrean Harian**: Logic untuk mendistribusikan pasien ke poli yang sesuai (Poli Umum, Poli Gigi, dsb) dan menghasilkan nomor antrean yang berurutan per hari, lalu me-reset antrean ke angka 1 setiap harinya.
- **Validasi BPJS/Asuransi (Opsional)**: Integrasi dengan API BPJS VClaim jika klinik mendukung skema asuransi.

## Skenario Testing Per Fitur
- [ ] **Pendaftaran Pasien Baru**: Pastikan data *submit* tersimpan aman ke database dan Nomor RM baru berhasil terbuat secara otomatis.
- [ ] **Pencarian Pasien Lama**: Form input harus dapat me-*retrieve* data existing saat NIK atau Nomor RM diketik (bisa dengan AJAX Call).
- [ ] **Plotting Antrean Poli**: Pasien yang telah dikonfirmasi antreannya harus langsung terdistribusi (muncul) secara *real-time* di Dashboard Antrean Poli milik dokter yang dituju.
