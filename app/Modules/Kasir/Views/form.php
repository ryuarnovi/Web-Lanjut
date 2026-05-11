<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Form Tagihan Manual</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li><a href="<?= base_url('kasir/data') ?>">Kasir</a></li>
      <li class="active">Buat Tagihan</li>
    </ol>
  </nav>
</div>

<section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
  <div class="lg:col-span-8">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title border-b border-slate-100 pb-3 mb-4">Informasi Tagihan & Pasien</h5>
        
        <form class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="form-label">No. Rekam Medis / NIK Pasien</label>
              <div class="flex gap-2">
                <input type="text" class="form-input" placeholder="Masukkan RM / NIK...">
                <button type="button" class="btn btn-outline-primary px-4">Cari</button>
              </div>
            </div>
            <div>
              <label class="form-label">Tanggal Terbit</label>
              <input type="date" class="form-input" value="<?= date('Y-m-d') ?>">
            </div>
          </div>

          <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
            <h6 class="font-semibold text-slate-700 mb-2">Data Pasien Ditemukan:</h6>
            <div class="grid grid-cols-2 gap-2 text-sm">
              <div class="text-slate-500">Nama:</div><div class="font-bold text-slate-800">Ahmad Subandrio</div>
              <div class="text-slate-500">Umur:</div><div class="font-bold text-slate-800">32 Tahun</div>
              <div class="text-slate-500">Alamat:</div><div class="font-bold text-slate-800">Jl. Mawar No 12, Jakarta Raya</div>
            </div>
          </div>

          <h5 class="card-title border-b border-slate-100 pb-3 mb-4 mt-8">Rincian Item (Layanan / Obat)</h5>
          
          <div class="space-y-4" id="item-list">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end p-4 border border-slate-200 rounded-lg bg-white relative">
              <button type="button" class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-500 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
              </button>
              <div class="md:col-span-5">
                <label class="form-label text-xs">Nama Item / Layanan</label>
                <input type="text" class="form-input" placeholder="Misal: Biaya Konsultasi Dokter Umum">
              </div>
              <div class="md:col-span-2">
                <label class="form-label text-xs">Qty</label>
                <input type="number" class="form-input" value="1" min="1">
              </div>
              <div class="md:col-span-4">
                <label class="form-label text-xs">Harga Satuan (Rp)</label>
                <input type="number" class="form-input" placeholder="0">
              </div>
            </div>
          </div>

          <button type="button" class="btn btn-outline-secondary w-full border-dashed py-3 flex justify-center items-center gap-2 hover:bg-slate-50 text-slate-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Item Tagihan Lainnya
          </button>

          <div class="pt-4 flex justify-between items-center border-t border-slate-100 mt-6">
            <button type="button" class="btn btn-outline-secondary">Batal</button>
            <button type="button" class="btn btn-primary px-8 shadow-md">Buat Tagihan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="lg:col-span-4">
    <div class="card bg-klinik-light border-0 shadow-sm">
      <div class="card-body">
        <h5 class="card-title text-klinik-dark">Ringkasan Tagihan</h5>
        <div class="space-y-3 mt-4 text-sm">
          <div class="flex justify-between items-center text-slate-600">
            <span>Subtotal:</span>
            <span class="font-semibold text-slate-800">Rp 0</span>
          </div>
          <div class="flex justify-between items-center text-slate-600">
            <span>Pajak (0%):</span>
            <span class="font-semibold text-slate-800">Rp 0</span>
          </div>
          <div class="flex justify-between items-center text-slate-600">
            <span>Diskon:</span>
            <span class="font-semibold text-red-500">- Rp 0</span>
          </div>
          <div class="h-px bg-slate-200 my-2"></div>
          <div class="flex justify-between items-center text-lg font-bold text-klinik-primary">
            <span>Total:</span>
            <span>Rp 0</span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="alert alert-info mt-4">
      <div class="flex gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <p class="text-sm m-0">Tagihan manual biasa digunakan untuk pembelian obat tanpa resep dokter atau biaya layanan ad-hoc (tambahan).</p>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
