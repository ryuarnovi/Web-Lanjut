<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Daftar Tunggu Pasien (Queuing)</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Dokter</li>
      <li class="active">Daftar Tunggu</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Antrean Poli Anda <span class="badge badge-primary ml-2">Poli Umum</span></h5>
      
      <div class="overflow-x-auto">
        <table class="tw-table">
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
              <td class="font-bold text-klinik-primary">B-021</td>
              <td class="font-medium">Budi Santoso</td>
              <td>14:05</td>
              <td>15 Min</td>
              <td><span class="badge badge-info">Siap Dipanggil</span></td>
              <td class="flex gap-2">
                <button class="btn btn-sm btn-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                  Panggil
                </button>
                <a href="<?= base_url('dokter/soap') ?>" class="btn btn-sm btn-success">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                  Periksa
                </a>
              </td>
            </tr>
            <tr>
              <td class="font-bold text-slate-500">B-022</td>
              <td class="font-medium">Siti Aminah</td>
              <td>14:10</td>
              <td>10 Min</td>
              <td><span class="badge badge-warning">Antre</span></td>
              <td class="flex gap-2">
                <button class="btn btn-sm btn-secondary opacity-50 cursor-not-allowed">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                  Panggil
                </button>
                <button class="btn btn-sm btn-success opacity-50 cursor-not-allowed">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                  Periksa
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
