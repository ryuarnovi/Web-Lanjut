# Feature: Dokter (Layanan Medis & Asesmen)

## Deskripsi Logic
Modul tempat dokter spesialis/umum melihat daftar antrean pasien yang diarahkan dari Resepsionis. Dokter melakukan pemeriksaan, mencatat riwayat dalam rekam medis terintegrasi menggunakan format standar SOAP (Subjective, Objective, Assessment, Plan), memberikan diagnosis ICD-10, dan menerbitkan resep elektronik (E-Prescription) kepada Apoteker.

## Status Implementasi

### ✅ Sudah Jadi
- **Antrean per dokter** — Filter `doctor_id` di `/api/queues` untuk role dokter, hanya menampilkan antrean poli sesuai dokter login. Polling 3 detik.
- **Panggil pasien** — Modal pilih loket → update status `called`.
- **SOAP (Subjective, Objective, Assessment, Plan)** — Form lengkap dengan textarea per komponen.
- **Diagnosis ICD-10** — Searchable dropdown dengan autocomplete dari `/api/icd10/search`.
- **Tanda Vital** — Input TD, Suhu, Nadi, Nafas, BB, TB (disimpan sebagai JSON di kolom `vital_signs`).
- **Detail Pasien** — NIK, usia (dari DOB), gender, gol. darah, alergi di-fetch dari `/api/patients/{id}`.
- **Resep Obat (E-Prescribe)** — Searchable drug dropdown, tambah/hapus item, tersimpan ke `prescriptions` + `prescription_items` saat simpan.
- **Simpan & Selesai** — Simpan rekam medis (POST `/api/medical-records`), update queue status `completed`, simpan resep (POST `/api/prescriptions`).
- **Riwayat Pemeriksaan** — Tampilkan rekam medis sebelumnya per pasien, modal detail lengkap (SOAP + tanda vital).
- **Rekam Medis API** — CRUD dengan filter role, JOIN pasien & antrean.
- **Edit Resep** — Dokter bisa mengubah/reload resep yang sudah tersimpan.
- **Pencatatan Tindakan Medis** — UI untuk mencatat tindakan ICD-9 beserta biaya tindakan (`tindakan_fee`) dan tarif konsultasi dokter (`doctor_fee`).
- **ICD-10 & ICD-9 API** — Search dan autocomplete untuk diagnosa dan tindakan.

### ❌ Belum / Kurang
- **Rujukan internal** — API `/api/referrals` sudah ada, view form rujukan belum lengkap.
- **Jadwal dokter** — API `/api/schedules` & `/api/shifts` sudah ada, UI untuk melihat/mengatur jadwal belum.

## Skenario Testing
- [x] **Tarik Data Antrean** — Dokter poli Umum hanya melihat antrean poli Umum (filter doctor_id).
- [x] **Simpan Rekam Medis (SOAP)** — Catatan SOAP + tanda vital + ICD-10 tersimpan ke `medical_records`.
- [x] **Resep Tersimpan** — Obat yang diresepkan tersimpan ke `prescriptions` + `prescription_items`.
- [x] **Antrean Selesai** — Queue status berubah jadi `completed` setelah simpan.
- [x] **Riwayat Muncul** — Pasien yang sudah pernah diperiksa melihat histori rekam medis.
- [x] **Edit Resep** — Dokter berhasil mengubah resep yang sudah dikirim.
- [x] **Tindakan Medis** — Biaya tindakan ICD-9 tercatat dan `tindakan_fee` diteruskan ke payment.
- [ ] **Rujukan** — Rujukan ke dokter lain tercatat di sistem.
