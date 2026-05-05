# Feature: Dokter (Layanan Medis & Asesmen)

## Deskripsi Logic
Modul tempat dokter spesialis/umum melihat daftar antrean pasien yang diarahkan dari Resepsionis. Dokter melakukan pemeriksaan, mencatat riwayat dalam rekam medis terintegrasi menggunakan format standar SOAP (Subjective, Objective, Assessment, Plan), memberikan diagnosis ICD-10, dan menerbitkan resep elektronik (E-Prescription) kepada Apoteker.

## Kekurangan / Yang Perlu Ditambahkan
- **Sinkronisasi Antrean per Poli**: Logic backend untuk menarik antrean hari ini berdasarkan poli yang dipegang oleh dokter yang sedang *login*.
- **Database Rekam Medis**: Tabel `rekam_medis` yang menyimpan catatan SOAP, berelasi *one-to-many* dengan `pasien` dan *one-to-one* dengan `transaksi_kunjungan`.
- **E-Resep & Master Obat**: Mengintegrasikan sistem pencarian jenis obat dari master tabel `stok_obat` (yang dikelola Apoteker) saat dokter meresepkan, lengkap dengan dosis dan aturan pakai.
- **Pencatatan Tindakan Medis**: UI dan backend untuk mencatat tagihan tindakan medis (contoh: Biaya Konsultasi, Jahit Luka, Cabut Gigi) yang nantinya diteruskan ke sistem Kasir.

## Skenario Testing Per Fitur
- [ ] **Tarik Data Antrean**: Pastikan dokter poli umum hanya melihat antrean poli umum, tidak tercampur dengan antrean poli gigi.
- [ ] **Simpan Rekam Medis (SOAP)**: Seluruh pencatatan rekam medis berhasil disimpan dan tercatat ke histori rekam medis pasien di masa depan.
- [ ] **Integrasi Lempar Resep Otomatis**: Saat formulir SOAP dan resep disimpan, pastikan *event/trigger* dikirimkan sehingga antrean Penebusan Resep otomatis bertambah di dashboard Apoteker tanpa ada kertas fisik.
