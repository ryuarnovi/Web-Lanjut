<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
  <h1>Antrean Penebusan Obat</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item">Apoteker</li>
      <li class="breadcrumb-item active">Resep</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Resep Pending (Penebusan)</h5>
          
          <table class="table table-hover datatable">
            <thead>
              <tr>
                <th>No. Invoice</th>
                <th>Nama Pasien</th>
                <th>Dokter Perujuk</th>
                <th>Waktu Order</th>
                <th>Status Resep</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>INV-0422001</td>
                <td>Budi Santoso</td>
                <td>Dr. Andi</td>
                <td>14:20</td>
                <td><span class="badge bg-warning text-dark">Sedang Disiapkan</span></td>
                <td><button class="btn btn-sm btn-primary">Lihat Resep & Kemas</button></td>
              </tr>
              <tr>
                <td>INV-0422002</td>
                <td>Andi Wijaya</td>
                <td>Drg. Sarah</td>
                <td>14:25</td>
                <td><span class="badge bg-info">Menunggu Input</span></td>
                <td><button class="btn btn-sm btn-primary">Lihat Resep & Kemas</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
