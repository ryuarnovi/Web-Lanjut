<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
  <h1>Daftar Tunggu Pasien (Queuing)</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item">Dokter</li>
      <li class="breadcrumb-item active">Daftar Tunggu</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Antrean Poli Anda <span class="badge bg-primary ms-1">Poli Umum</span></h5>
          
          <table class="table table-hover datatable">
            <thead>
              <tr>
                <th>No. Antrean</th>
                <th>Nama Pasien</th>
                <th>Waktu Daftar</th>
                <th>Waktu Tunggu</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>B-021</td>
                <td>Budi Santoso</td>
                <td>14:05</td>
                <td>15 Min</td>
                <td><span class="badge bg-info">Siap Dipanggil</span></td>
                <td>
                  <button class="btn btn-sm btn-primary"><i class="bi bi-megaphone me-1"></i>Panggil</button>
                  <a href="<?= base_url('dokter/soap') ?>" class="btn btn-sm btn-success"><i class="bi bi-pencil-square me-1"></i>Periksa</a>
                </td>
              </tr>
              <tr>
                <td>B-022</td>
                <td>Siti Aminah</td>
                <td>14:10</td>
                <td>10 Min</td>
                <td><span class="badge bg-warning text-dark">Antre</span></td>
                <td>
                  <button class="btn btn-sm btn-secondary disabled"><i class="bi bi-megaphone me-1"></i>Panggil</button>
                  <button class="btn btn-sm btn-success disabled"><i class="bi bi-pencil-square me-1"></i>Periksa</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
