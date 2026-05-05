<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Stok Obat & Inventory</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Apoteker</li>
      <li class="active">Inventory</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-6 mt-2">
        <h5 class="card-title p-0 m-0">Daftar Stok Obat Apotek</h5>
        <a href="<?= base_url('apoteker/form') ?>" class="btn btn-primary flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          Tambah Item Baru
        </a>
      </div>
      
      <div class="overflow-x-auto">
        <table class="tw-table border border-slate-200">
          <thead class="bg-slate-50">
            <tr>
              <th>No. Batch</th>
              <th>Nama Obat</th>
              <th>Satuan</th>
              <th>Stok Sisa</th>
              <th>HET (Harga Eceran)</th>
              <th>Tgl Kadaluarsa</th>
              <th>Status Stok</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            <tr>
              <td class="font-medium text-slate-700">B123-001</td>
              <td>Paracetamol 500mg</td>
              <td>Tablet</td>
              <td class="font-bold">1,245</td>
              <td>Rp 500</td>
              <td>12-12-2025</td>
              <td><span class="badge badge-success">Stok Aman</span></td>
              <td>
                <button class="btn btn-sm btn-outline-info p-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </button>
              </td>
            </tr>
            <tr>
              <td class="font-medium text-slate-700">B123-002</td>
              <td>Amoxicillin 250mg</td>
              <td>Vial</td>
              <td class="font-bold text-red-500">15</td>
              <td>Rp 12,500</td>
              <td>01-05-2024</td>
              <td><span class="badge badge-danger">Low Stock</span></td>
              <td>
                <button class="btn btn-sm btn-outline-info p-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </button>
              </td>
            </tr>
            <tr>
              <td class="font-medium text-slate-700">B123-003</td>
              <td>Dexamethasone</td>
              <td>Ampul</td>
              <td class="font-bold">240</td>
              <td>Rp 3,500</td>
              <td class="text-red-500 font-medium">01-01-2024</td>
              <td><span class="badge badge-secondary">Expired</span></td>
              <td>
                <button class="btn btn-sm btn-outline-info p-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
