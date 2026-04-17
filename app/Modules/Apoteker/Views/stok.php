<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
  <h1>Stok Obat & Inventory</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item">Apoteker</li>
      <li class="breadcrumb-item active">Inventory</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
            <h5 class="card-title p-0 m-0">Daftar Stok Obat Apotek</h5>
            <button class="btn btn-sm btn-primary"><i class="bi bi-plus-circle me-1"></i>Tambah Item Baru</button>
          </div>
          
          <table class="table table-hover table-bordered datatable">
            <thead class="bg-light">
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
            <tbody>
              <tr>
                <td>B123-001</td>
                <td>Paracetamol 500mg</td>
                <td>Tablet</td>
                <td>1,245</td>
                <td>Rp 500</td>
                <td>12-12-2025</td>
                <td><span class="badge bg-success">Stok Aman</span></td>
                <td><button class="btn btn-xs btn-outline-info"><i class="bi bi-eye"></i></button></td>
              </tr>
              <tr>
                <td>B123-002</td>
                <td>Amoxicillin 250mg</td>
                <td>Vial</td>
                <td>15</td>
                <td>Rp 12,500</td>
                <td>01-05-2024</td>
                <td><span class="badge bg-danger">Low Stock</span></td>
                <td><button class="btn btn-xs btn-outline-info"><i class="bi bi-eye"></i></button></td>
              </tr>
              <tr>
                <td>B123-003</td>
                <td>Dexamethasone</td>
                <td>Ampul</td>
                <td>240</td>
                <td>Rp 3,500</td>
                <td>01-01-2024</td>
                <td><span class="badge bg-secondary">Expired</span></td>
                <td><button class="btn btn-xs btn-outline-info"><i class="bi bi-eye"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
