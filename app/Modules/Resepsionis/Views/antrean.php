<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
  <h1>Antrean Pendaftaran & Layanan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item">Resepsionis</li>
      <li class="breadcrumb-item active">Antrean</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Monitor Antrean Real-Time <i class="bi bi-clock-fill ms-1 text-primary"></i></h5>
          
          <div class="row text-center mb-4 mt-3">
             <div class="col-md-4 mb-3">
                <div class="p-3 border rounded bg-primary text-white shadow-sm">
                   <h3>Pendaftaran</h3>
                   <h1 class="display-1 fw-bold">A-042</h1>
                   <p class="m-0 text-white-50">Silahkan menuju Loket 1</p>
                </div>
             </div>
             <div class="col-md-4 mb-3">
                <div class="p-3 border rounded bg-success text-white shadow-sm">
                   <h3>Poli Umum</h3>
                   <h1 class="display-1 fw-bold">B-021</h1>
                   <p class="m-0 text-white-50">Silahkan menuju Ruang 1</p>
                </div>
             </div>
             <div class="col-md-4 mb-3">
                <div class="p-3 border rounded bg-info text-white shadow-sm">
                   <h3>Poli Gigi</h3>
                   <h1 class="display-1 fw-bold">C-005</h1>
                   <p class="m-0 text-white-50">Silahkan menuju Ruang 2</p>
                </div>
             </div>
          </div>

          <table class="table table-hover datatable">
            <thead>
              <tr>
                <th>No. Antrean</th>
                <th>Jenis</th>
                <th>Waktu Daftar</th>
                <th>Estimasi Panggil</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>A-043</td>
                <td>Pendaftaran</td>
                <td>14:10</td>
                <td>~5 Menit</td>
                <td><span class="badge bg-warning">Menunggu</span></td>
                <td><button class="btn btn-sm btn-primary"><i class="bi bi-megaphone"></i></button></td>
              </tr>
              <tr>
                <td>A-042</td>
                <td>Pendaftaran</td>
                <td>14:05</td>
                <td>Panggil Sekarang</td>
                <td><span class="badge bg-info">Dipanggil</span></td>
                <td><button class="btn btn-sm btn-primary"><i class="bi bi-megaphone"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
