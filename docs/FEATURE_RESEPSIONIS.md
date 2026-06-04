# Feature: Resepsionis (Front Desk)

## Deskripsi Logic
Modul ini adalah pintu masuk pertama bagi operasional klinik. Resepsionis bertugas menerima pendaftaran pasien baru (pengumpulan data diri/rekam medis awal), mencari pasien lama, dan mendaftarkan mereka ke sistem antrean berdasarkan poli yang dituju.

## Status Implementasi

### ✅ Sudah Jadi
- **Form Pendaftaran** — Input nama, NIK, tanggal lahir, gender, poli, dokter, alamat.
- **Search Pasien Existing** — Input nama pasien dengan autocomplete dari `/api/patients`, pilih pasien lama untuk didaftarkan ulang (cegah duplikat).
- **Poli & Dokter dari API** — Poli dari spesialisasi dokter, filter dokter by poli.
- **Create Pasien + Queue** — POST `/api/patients` + POST `/api/queues` dalam satu klik.
- **Antrean Hari Ini** — Tabel live update dengan polling 5 detik.
- **Panggil Pasien** — Modal pilih loket, update status `called`.
- **Patient API** — CRUD lengkap dengan search dan filter role.
- **Queue API** — CRUD dengan filter per role, termasuk `patient_code` di response.
- **Generator Nomor RM** — Auto-generate nomor rekam medis per pasien baru dengan format `RM-YYMM-XXXX`.
- **Reset Antrean Harian** — Reset nomor antrean ke 1 setiap hari (per-poli).
- **Validasi UNIQUE** — NIK dan email unik dengan error handling ramah pengguna.

### ❌ Belum / Kurang
- **Validasi BPJS/Asuransi** — Integrasi API BPJS VClaim (opsional).

## Skenario Testing
- [x] **Pendaftaran Pasien Baru** — Data submit tersimpan ke `patients` + `queues`.
- [x] **Pencarian Pasien Lama** — Input nama me-retrieve data existing via AJAX.
- [x] **Plotting Antrean Poli** — Queue langsung muncul di dokter tujuan.
- [x] **Nomor RM Otomatis** — Format nomor RM sesuai standar `RM-YYMM-XXXX`, auto-increment.
- [x] **Reset Antrean** — Nomor kembali ke 1 setiap hari baru per-poli.
