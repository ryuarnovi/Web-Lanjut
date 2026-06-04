# Feature: Perawat (Asesmen Awal & Tanda Vital)

## Deskripsi Logic
Modul Perawat berfungsi sebagai tahap triase dan pemeriksaan awal sebelum pasien bertemu Dokter. Perawat melihat daftar antrean pasien hari ini, memilih pasien untuk diperiksa, lalu menginput tanda vital (vital signs) ke dalam rekam medis. Setelah data vital tersimpan, status antrean pasien diperbarui menjadi `in_progress` sehingga Dokter mengetahui pasien sudah siap diperiksa.

## Alur Kerja (Workflow)
1. Perawat melihat **Antrean Hari Ini** (`/perawat/antrean`) — tabel polling 5 detik.
2. Perawat klik **Periksa** pada pasien → diarahkan ke halaman **Pemeriksaan Awal** (`/perawat/periksa?queue_id=X`).
3. Data pasien (nama, gender, NIK, golongan darah) di-fetch otomatis dari API (`/api/perawat/queues/{id}`).
4. Perawat mengisi **Tanda Vital**: Tekanan Darah, Suhu, Nadi, Pernapasan, Berat Badan, Tinggi Badan, Gula Darah Sewaktu.
5. Klik **Simpan & Lanjutkan** → POST ke `/api/perawat/medical-records` (menyimpan `vital_signs` sebagai JSON).
6. Status antrean di-update ke `in_progress` via PUT `/api/perawat/queues/{id}` dengan `nurse_id` perawat yang bertugas.
7. Perawat diarahkan kembali ke daftar antrean.

## Status Implementasi

### ✅ Sudah Jadi
- **Halaman Antrean** — Tabel daftar antrean hari ini dengan polling 5 detik dari `/api/perawat/queues`.
- **Data Pasien** — Fetch otomatis nama, NIK (masked), gender, golongan darah dari API saat halaman pemeriksaan dibuka.
- **Form Tanda Vital** — Input: Tekanan Darah (mmHg), Suhu (°C), Nadi (x/menit), Pernapasan (x/menit), Berat Badan (kg), Tinggi Badan (cm), Gula Darah Sewaktu (mg/dL).
- **Simpan Rekam Medis** — POST vital signs ke `/api/perawat/medical-records`, data tersimpan di `medical_records.vital_signs` sebagai JSON.
- **Update Status Antrean** — Setelah simpan, status queue berubah menjadi `in_progress` dan `nurse_id` terisi.
- **Queue API (Perawat)** — List, Get, Update antrean di endpoint `/api/perawat/queues`.
- **Medical Records API (Perawat)** — List, Create, Get, Update rekam medis di endpoint `/api/perawat/medical-records`.
- **Loket API** — List loket dari `/api/perawat/lokets`.
- **Activity Log** — Semua operasi CREATE/UPDATE tercatat di `activity_logs`.

### ❌ Belum / Kurang
- **Panggil Pasien (Loket)** — Perawat belum bisa memanggil pasien ke loket seperti Resepsionis/Dokter.
- **Riwayat Pemeriksaan** — Belum ada tab/halaman untuk melihat rekam medis sebelumnya dari sisi perawat.
- **Catatan Keperawatan** — Belum ada form catatan khusus keperawatan (nursing notes) terpisah dari SOAP Dokter.
- **Dashboard Statistik Perawat** — Belum ada ringkasan jumlah pasien yang sudah/belum diperiksa hari ini.

## Endpoint API

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/api/perawat/queues` | List antrean hari ini (filter opsional `?status=`) |
| GET | `/api/perawat/queues/{id}` | Detail antrean + data pasien |
| PUT | `/api/perawat/queues/{id}` | Update status/loket/nurse_id |
| GET | `/api/perawat/medical-records` | List 50 rekam medis terbaru |
| POST | `/api/perawat/medical-records` | Buat rekam medis baru (vital signs) |
| GET | `/api/perawat/medical-records/{id}` | Detail rekam medis |
| PUT | `/api/perawat/medical-records/{id}` | Update rekam medis |
| GET | `/api/perawat/lokets` | List loket |

## Skenario Testing
- [x] **Tampil Antrean** — Perawat melihat semua antrean hari ini dengan polling otomatis.
- [x] **Fetch Data Pasien** — Data pasien ter-load otomatis saat buka halaman pemeriksaan.
- [x] **Simpan Vital Signs** — Data tanda vital tersimpan ke `medical_records` sebagai JSON.
- [x] **Status Queue Update** — Status berubah `waiting` → `in_progress` setelah simpan vital signs.
- [x] **Nurse ID Tercatat** — `nurse_id` perawat yang bertugas tersimpan di tabel `queues`.
- [ ] **Panggil ke Loket** — Perawat bisa memanggil pasien ke loket tertentu.
- [ ] **Riwayat Pasien** — Perawat melihat histori pemeriksaan sebelumnya.
