# Feature: Apoteker (Farmasi & Inventaris)

## Deskripsi Logic
Apoteker bertugas mengelola keseluruhan rantai suplai (inventory) persediaan obat di dalam fasilitas klinik. Selain itu, Apoteker memproses dan menebus obat berdasarkan *E-Prescription* (resep elektronik) yang diterbitkan secara real-time oleh Dokter.

## Status Implementasi

### ✅ Sudah Jadi
- **CRUD Obat** — `kode_obat`, `nama_obat`, `deskripsi`, `fungsi_obat`, `efek_samping`, `kategori_obat`, `merek_obat`, `dosis_obat`, `unit`, `stok_obat`, `min_stock`, `harga` (eceran & grosir).
- **Drug API** — CRUD lengkap + low-stock warning + detail.
- **Supplier API** — CRUD supplier.
- **Stock Transaction API** — Barang masuk/keluar.
- **Resep (Penebusan)** — Tabel dari API `/api/prescriptions` dengan polling 10 detik.
- **Detail Resep Modal** — Menampilkan items obat, jumlah, dosis.
- **Proses Resep** — Tombol "Proses Resep" update status → `processed`, set `processed_by` & `processed_at`.
- **Prescription API** — CRUD lengkap + items, transaction-safe.
- **Konfirmasi penyerahan obat** — Tombol "Serahkan Obat" yang mengurangi stok real-time (`stok_obat - qty`), mencatat riwayat transaksi, dan menyelaraskan tagihan.
- **Manajemen batch & kedaluwarsa** — Indikator warna merah untuk obat kadaluarsa dan mendekati kadaluarsa (< 30 hari) di halaman inventaris.
- **Riwayat pergerakan stok** — Tab khusus "Log Transaksi Stok" di halaman inventaris yang menampilkan mutasi stok barang masuk/keluar dengan pagination.

### ❌ Belum / Kurang
- **Notifikasi push stok menipis** — Belum ada notifikasi otomatis (email/push) saat stok mendekati `min_stock` (saat ini hanya badge visual di tabel).

## Skenario Testing
- [x] **Stok Baru & Update** — Data obat tersedia di dropdown resep Dokter.
- [x] **Resep Masuk** — Prescription dari Dokter muncul di tabel Apoteker.
- [x] **Proses Resep** — Status berubah `pending` → `processed`.
- [x] **Serahkan Obat** — Stok berkurang, status berubah `processed` → `completed`.
- [x] **Indikator Stok Menipis** — Warna merah saat stok ≤ `min_stock`, badge "Low Stock".
- [x] **Indikator Kadaluarsa** — Warna merah + badge "Expired"/"Near Expiry" untuk obat kedaluwarsa/hampir kedaluwarsa.
- [x] **Log Transaksi Stok** — Tab riwayat pergerakan stok menampilkan data masuk/keluar.
