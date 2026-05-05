# Feature: Apoteker (Farmasi & Inventaris)

## Deskripsi Logic
Apoteker bertugas mengelola keseluruhan rantai suplai (inventory) persediaan obat di dalam fasilitas klinik. Selain itu, Apoteker memproses dan menebus obat berdasarkan *E-Prescription* (resep elektronik) yang diterbitkan secara real-time oleh Dokter.

## Kekurangan / Yang Perlu Ditambahkan
- **CRUD Data Stok Obat**: Pembuatan fungsionalitas CRUD secara utuh ke database (Tabel `stok_obat`) meliputi Harga Beli, Harga Jual, Jenis/Kategori, dan Satuan (Tablet/Botol).
- **Manajemen Batch & Kedaluwarsa (Expired)**: Tambahkan sistem notifikasi otomatis untuk stok obat yang akan kedaluwarsa atau sudah mencapai limit stok minimum.
- **Konfirmasi Penebusan Resep**: UI/Logic untuk Apoteker dalam memverifikasi e-Resep yang di-submit Dokter, memeriksa ketersediaan riil stok fisik, mengkalkulasi harga obat total, dan memotong database stok jika obat diserahkan ke pasien.
- **Riwayat Pengeluaran Obat**: Laporan log pergerakan inventaris (barang masuk dari supplier vs barang keluar ke pasien).

## Skenario Testing Per Fitur
- [ ] **Proses Stok Baru**: Memastikan data obat baru atau pembaruan jumlah stok berhasil disinkronkan ke seluruh sistem dan langsung tersedia di menu dropdown resep Dokter.
- [ ] **Notifikasi Stok Menipis**: Menguji pemicu peringatan warna merah saat suatu item obat mencapai ambang batas sisa stok (misal < 10 strip).
- [ ] **Kalkulasi & Kirim Tagihan ke Kasir**: Setelah resep di-*approve* (diberikan kepada pasien), pastikan total harga dari setiap butir resep secara utuh dihitung sistem dan ditambahkan ke *Invoice* akhir di Kasir.
