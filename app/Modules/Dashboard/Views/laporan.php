<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
  <h1>Laporan & Business Intelligence</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item active">Laporan</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12 text-center py-5">
       <div class="card p-5 shadow-sm">
          <i class="bi bi-graph-up-arrow display-1 text-primary mb-3"></i>
          <h2 class="fw-bold">Halaman Laporan & BI</h2>
          <p class="text-muted">Fitur ini memungkinkan visualisasi data real-time untuk kunjungan, pendapatan, dan efisiensi layanan (TAT - Turn Around Time).</p>
          <div class="d-flex justify-content-center gap-2">
            <button class="btn btn-outline-primary"><i class="bi bi-file-earmark-pdf me-1"></i>Ekspor Laporan Bulanan</button>
            <button class="btn btn-outline-success"><i class="bi bi-file-earmark-excel me-1"></i>Ekspor Laporan Pendapatan</button>
          </div>
       </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
