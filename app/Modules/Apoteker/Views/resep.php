<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Antrean Penebusan Obat</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Apoteker</li>
      <li class="active">Resep</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Resep Pending (Penebusan)</h5>
      
      <div class="overflow-x-auto">
        <table class="tw-table">
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
              <td class="font-medium">INV-0422001</td>
              <td>Budi Santoso</td>
              <td>Dr. Andi</td>
              <td>14:20</td>
              <td><span class="badge badge-warning">Sedang Disiapkan</span></td>
              <td><button class="btn btn-sm btn-primary">Lihat Resep & Kemas</button></td>
            </tr>
            <tr>
              <td class="font-medium">INV-0422002</td>
              <td>Andi Wijaya</td>
              <td>Drg. Sarah</td>
              <td>14:25</td>
              <td><span class="badge badge-info">Menunggu Input</span></td>
              <td><button class="btn btn-sm btn-primary">Lihat Resep & Kemas</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
