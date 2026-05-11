<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Form Tambah Stok Obat Baru</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li><a href="<?= base_url('apoteker/stok') ?>">Apoteker (Stok)</a></li>
      <li class="active">Tambah Obat</li>
    </ol>
  </nav>
</div>

<section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Informasi Dasar Obat</h5>
      
      <form class="space-y-5">
        <div>
          <label class="form-label">Kode / SKU Obat</label>
          <input type="text" class="form-input bg-slate-50" value="OBT-<?= rand(1000,9999) ?>" readonly>
          <div class="text-xs text-slate-400 mt-1">Kode digenerate secara otomatis</div>
        </div>
        
        <div>
          <label class="form-label">Nama Obat <span class="text-red-500">*</span></label>
          <input type="text" class="form-input" placeholder="Masukkan nama obat, cth: Paracetamol 500mg">
        </div>
        
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="form-label">Kategori / Golongan</label>
            <select class="form-select">
              <option selected>Pilih Golongan</option>
              <option>Obat Bebas</option>
              <option>Obat Bebas Terbatas</option>
              <option>Obat Keras (Resep Dokter)</option>
              <option>Narkotika / Psikotropika</option>
            </select>
          </div>
          <div>
            <label class="form-label">Bentuk Sediaan</label>
            <select class="form-select">
              <option selected>Pilih Sediaan</option>
              <option>Tablet</option>
              <option>Kapsul</option>
              <option>Sirup</option>
              <option>Salep</option>
              <option>Injeksi</option>
            </select>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Harga & Persediaan</h5>
      
      <form class="space-y-5">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="form-label">Harga Beli (Modal)</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">Rp</span>
              <input type="number" class="form-input pl-10" placeholder="0">
            </div>
          </div>
          <div>
            <label class="form-label">Harga Jual (Pasien) <span class="text-red-500">*</span></label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">Rp</span>
              <input type="number" class="form-input pl-10" placeholder="0">
            </div>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="form-label">Stok Awal</label>
            <input type="number" class="form-input" placeholder="Misal: 100">
          </div>
          <div>
            <label class="form-label">Batas Minimum (Alert)</label>
            <input type="number" class="form-input" placeholder="Misal: 10">
          </div>
        </div>

        <div>
          <label class="form-label">Tanggal Kedaluwarsa (Expired Date) <span class="text-red-500">*</span></label>
          <input type="date" class="form-input">
        </div>

        <div class="pt-4 flex justify-end items-center border-t border-slate-100 mt-6 gap-2">
          <button type="button" class="btn btn-outline-secondary">Batal</button>
          <button type="button" class="btn btn-primary px-8 shadow-md">Simpan Data Obat</button>
        </div>
      </form>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
