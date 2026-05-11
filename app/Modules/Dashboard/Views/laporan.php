<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Laporan & Business Intelligence</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li class="active">Laporan</li>
    </ol>
  </nav>
</div>

<section>
  <div class="text-center py-10">
    <div class="card inline-block w-full max-w-4xl p-10 shadow-sm mx-auto">
      <div class="flex justify-center mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-klinik-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
        </svg>
      </div>
      <h2 class="text-3xl font-bold text-klinik-dark mb-4">Halaman Laporan & BI</h2>
      <p class="text-slate-500 mb-8 max-w-2xl mx-auto">Fitur ini memungkinkan visualisasi data real-time untuk kunjungan, pendapatan, dan efisiensi layanan (TAT - Turn Around Time).</p>
      
      <div class="flex flex-wrap justify-center gap-4">
        <button class="btn btn-outline-primary">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
          Ekspor Laporan Bulanan
        </button>
        <button class="btn btn-outline-success">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
          Ekspor Laporan Pendapatan
        </button>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
