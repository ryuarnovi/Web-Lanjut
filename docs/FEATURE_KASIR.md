# Feature: Kasir (Billing & Pembayaran)

## Deskripsi Logic
Titik penyelesaian transaksi secara menyeluruh. Modul ini secara otomatis menggabungkan seluruh komponen biaya (Biaya Pendaftaran, Biaya Konsultasi Dokter, Biaya Tindakan, dan Biaya Penebusan Resep Obat) menjadi satu Invoice terpadu untuk pasien.

## Status Implementasi

### ✅ Sudah Jadi
- **Billing View** — Preview struk tagihan konsolidasi otomatis dari `/api/payments`.
- **Konsolidasi tagihan otomatis** — Menggabungkan biaya admin, konsultasi dokter (`doctor_fee`), tindakan medis (`tindakan_fee`), dan biaya resep obat (`medicine_cost`) menjadi satu invoice.
- **Payment API** — CRUD lengkap.
- **Cetak Struk (Print Layout)** — Cetak langsung dengan layout termal (80mm) yang bersih via `@media print`, termasuk header klinik, detail item, total, dan footer ucapan terima kasih.
- **Form tagihan manual** — Input diskon, pajak/biaya tambahan, metode pembayaran, nominal diterima, catatan. Kalkulasi subtotal, total akhir, dan kembalian real-time.
- **QRIS Dinamis** — QR code dinamis yang berubah sesuai nominal tagihan.
- **Midtrans Snap SDK** — Integrasi pembayaran via Midtrans Snap (sandbox) dengan endpoint `/api/midtrans/snap`.
- **Web3 Crypto Wallet** — Mock transfer crypto dengan kalkulasi konversi ETH.
- **Simpan Rincian** — Tombol "Simpan Saja" untuk menyimpan adjustment (diskon, pajak, catatan) tanpa checkout.
- **Bayar & Cetak** — Tombol konfirmasi pembayaran + auto-print struk + redirect ke data kasir.

### ❌ Belum / Kurang
- **Riwayat Pembayaran** — Belum ada halaman arsip/riwayat semua transaksi yang sudah dibayar.
- **Midtrans Production** — Masih menggunakan sandbox, belum konfigurasi production key.

## Skenario Testing
- [x] **Konsistensi Biaya** — Harga total sesuai penjumlahan admin + dokter + tindakan + obat.
- [x] **Konversi Status** — `UNPAID` → `PAID` saat tombol konfirmasi ditekan.
- [x] **Cetak Struk** — Print layout 80mm valid dengan header klinik, rincian, total, ucapan.
- [x] **Diskon & Pajak** — Kalkulasi subtotal - diskon + pajak = total akhir real-time.
- [x] **Kembalian** — Kembalian terhitung otomatis dari nominal diterima - total.
- [x] **QRIS Update** — QR code berubah sesuai total tagihan.
- [x] **Midtrans Snap** — Popup Midtrans terbuka saat klik "Snap Midtrans".
