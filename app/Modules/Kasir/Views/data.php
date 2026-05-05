<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
  <div>
    <h1 class="text-2xl font-bold text-klinik-dark">Data Tagihan & Pembayaran</h1>
    <nav>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>">Home</a></li>
        <li>Kasir</li>
        <li class="active">Daftar Tagihan</li>
      </ol>
    </nav>
  </div>
  
  <div>
    <a href="<?= base_url('kasir/form') ?>" class="btn btn-primary flex items-center gap-2 shadow-md">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
      Buat Tagihan Manual
    </a>
  </div>
</div>

<section>
  <div class="card">
    <div class="card-body">
      
      <!-- Filter / Search Tools -->
      <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        <div class="flex gap-2 w-full md:w-auto">
          <select class="form-select w-32">
            <option value="all">Semua Status</option>
            <option value="pending">Belum Lunas</option>
            <option value="paid">Lunas</option>
          </select>
          <input type="date" class="form-input w-40">
        </div>
        
        <div class="relative w-full md:w-64">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
          </span>
          <input type="text" class="form-input pl-9" placeholder="Cari no invoice / nama...">
        </div>
      </div>

      <!-- Tagihan Table -->
      <div class="overflow-x-auto border border-slate-200 rounded-lg">
        <table class="tw-table m-0">
          <thead class="bg-slate-50 text-slate-600">
            <tr>
              <th>No. Invoice</th>
              <th>Tanggal</th>
              <th>Nama Pasien</th>
              <th>Poli / Layanan</th>
              <th>Total Tagihan</th>
              <th>Status</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            
            <!-- Row 1 (Belum Lunas) -->
            <tr class="hover:bg-slate-50 transition">
              <td class="font-bold text-klinik-primary">INV-0422001</td>
              <td class="text-sm text-slate-500">05 Mei 2026<br><span class="text-xs">09:15 WIB</span></td>
              <td>
                <div class="font-semibold text-slate-800">Ahmad Subandrio</div>
                <div class="text-xs text-slate-500">RM-001234</div>
              </td>
              <td>Poli Umum</td>
              <td class="font-bold text-slate-700">Rp 80.000</td>
              <td><span class="badge badge-warning">Belum Lunas</span></td>
              <td>
                <div class="flex justify-center items-center gap-2">
                  <!-- Bayar / Proses -->
                  <a href="<?= base_url('kasir/billing') ?>" class="btn btn-sm btn-success p-1.5" title="Proses Pembayaran">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                  </a>
                  <!-- Edit Data -->
                  <button class="btn btn-sm btn-outline-primary p-1.5" title="Edit Tagihan">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                  </button>
                  <!-- Hapus -->
                  <button class="btn btn-sm btn-outline-danger p-1.5" title="Hapus Tagihan">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                  </button>
                </div>
              </td>
            </tr>

            <!-- Row 2 (Lunas) -->
            <tr class="hover:bg-slate-50 transition">
              <td class="font-bold text-klinik-primary">INV-0422002</td>
              <td class="text-sm text-slate-500">05 Mei 2026<br><span class="text-xs">08:30 WIB</span></td>
              <td>
                <div class="font-semibold text-slate-800">Siti Aminah</div>
                <div class="text-xs text-slate-500">RM-001200</div>
              </td>
              <td>Poli Gigi + Farmasi</td>
              <td class="font-bold text-slate-700">Rp 350.000</td>
              <td><span class="badge badge-success">Lunas</span></td>
              <td>
                <div class="flex justify-center items-center gap-2">
                  <!-- Cetak Struk -->
                  <button class="btn btn-sm btn-info text-white p-1.5" title="Cetak Struk">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                  </button>
                  <button class="btn btn-sm btn-outline-primary p-1.5" title="Edit Tagihan">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                  </button>
                </div>
              </td>
            </tr>

            <!-- Row 3 (Lunas) -->
            <tr class="hover:bg-slate-50 transition">
              <td class="font-bold text-klinik-primary">INV-0422003</td>
              <td class="text-sm text-slate-500">04 Mei 2026<br><span class="text-xs">19:45 WIB</span></td>
              <td>
                <div class="font-semibold text-slate-800">Budi Santoso</div>
                <div class="text-xs text-slate-500">RM-000854</div>
              </td>
              <td>IGD + Farmasi</td>
              <td class="font-bold text-slate-700">Rp 1.250.000</td>
              <td><span class="badge badge-success">Lunas</span></td>
              <td>
                <div class="flex justify-center items-center gap-2">
                  <button class="btn btn-sm btn-info text-white p-1.5" title="Cetak Struk">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                  </button>
                </div>
              </td>
            </tr>

          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-slate-500">
          Menampilkan 1 hingga 3 dari 45 tagihan
        </div>
        <div class="flex gap-1">
          <button class="btn btn-outline-secondary px-3 py-1 bg-slate-100 text-slate-400 cursor-not-allowed" disabled>Prev</button>
          <button class="btn btn-primary px-3 py-1">1</button>
          <button class="btn btn-outline-secondary px-3 py-1">2</button>
          <button class="btn btn-outline-secondary px-3 py-1">3</button>
          <button class="btn btn-outline-secondary px-3 py-1">Next</button>
        </div>
      </div>

    </div>
  </div>
</section>
<?= $this->endSection() ?>
