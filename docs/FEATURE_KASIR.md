# Feature: Kasir (Billing & Pembayaran)

## Deskripsi Logic
Titik penyelesaian transaksi secara menyeluruh. Modul ini secara otomatis menggabungkan seluruh komponen biaya (Biaya Pendaftaran, Biaya Konsultasi Dokter, Biaya Tindakan, dan Biaya Penebusan Resep Obat) menjadi satu Invoice terpadu untuk pasien.

## Kekurangan / Yang Perlu Ditambahkan
- **Database Invoice/Billing**: Perlu mendesain tabel `billing` yang berelasi dengan riwayat kunjungan dan memiliki detail baris (*line items*) untuk setiap pembebanan biaya.
- **Konsolidasi Tagihan Otomatis**: Backend logic yang mengumpulkan dan menjumlahkan semua *cost* dari berbagai departemen secara realtime jika statusnya *unpaid*.
- **Integrasi Payment Gateway**: Menerapkan payment gateway lokal (misal Midtrans atau Xendit) untuk men-*generate* kode QRIS dinamis di layar pasien, atau opsi pembayaran tunai tradisional.
- **Cetak Struk (PDF/Thermal)**: Pustaka/Library (seperti dompdf atau interaksi API ESC/POS) untuk mengekspor struk digital yang valid atau mencetaknya secara instan di atas printer kasir (Thermal Printer).
- **Form Tagihan Tambahan/Manual**: Fungsionalitas tambahan agar Kasir dapat meng-_input_ jenis tagihan mendadak di luar sistem (misalnya biaya administrasi ekstra, map cetak, dll).

## Skenario Testing Per Fitur
- [ ] **Konsistensi Biaya Konsolidasi**: Uji silang harga di tabel master vs harga total yang tergenerate di Invoice. Pastikan tidak ada resep atau tindakan yang "terlewat" tertagih.
- [ ] **Konversi Status Pembayaran**: Simulasi pembayaran. Saat tombol "Konfirmasi Pembayaran" ditekan, ubah *flag* DB dari `UNPAID` menjadi `PAID` secara permanen.
- [ ] **Cetak Struk**: Validasi tata letak PDF Struk, pastikan memuat Logo Klinik, ID Transaksi yang benar, rincian *item*, total, dan kembalian.
