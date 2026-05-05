<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Antrean Pendaftaran & Layanan</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Resepsionis</li>
      <li class="active">Antrean</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title flex items-center gap-2">
        Monitor Antrean Real-Time 
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-klinik-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      </h5>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 mt-2">
         <div class="p-6 rounded-2xl bg-klinik-primary text-white shadow-lg text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-20">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
            </div>
            <h3 class="font-semibold text-white/80 uppercase tracking-wider text-sm mb-2 relative z-10">Pendaftaran</h3>
            <h1 class="text-6xl font-bold mb-2 relative z-10">A-042</h1>
            <p class="m-0 text-white/70 text-sm relative z-10">Silahkan menuju Loket 1</p>
         </div>
         <div class="p-6 rounded-2xl bg-green-500 text-white shadow-lg text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-20">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
            </div>
            <h3 class="font-semibold text-white/80 uppercase tracking-wider text-sm mb-2 relative z-10">Poli Umum</h3>
            <h1 class="text-6xl font-bold mb-2 relative z-10">B-021</h1>
            <p class="m-0 text-white/70 text-sm relative z-10">Silahkan menuju Ruang 1</p>
         </div>
         <div class="p-6 rounded-2xl bg-cyan-500 text-white shadow-lg text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-20">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <h3 class="font-semibold text-white/80 uppercase tracking-wider text-sm mb-2 relative z-10">Poli Gigi</h3>
            <h1 class="text-6xl font-bold mb-2 relative z-10">C-005</h1>
            <p class="m-0 text-white/70 text-sm relative z-10">Silahkan menuju Ruang 2</p>
         </div>
      </div>

      <div class="overflow-x-auto border border-slate-200 rounded-lg">
        <table class="tw-table m-0">
          <thead class="bg-slate-50">
            <tr>
              <th>No. Antrean</th>
              <th>Jenis</th>
              <th>Waktu Daftar</th>
              <th>Estimasi Panggil</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            <tr>
              <td class="font-bold text-klinik-primary text-lg">A-043</td>
              <td class="font-medium text-slate-700">Pendaftaran</td>
              <td>14:10</td>
              <td class="text-amber-600 font-medium">~5 Menit</td>
              <td><span class="badge badge-warning">Menunggu</span></td>
              <td>
                <button class="btn btn-sm btn-primary p-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                </button>
              </td>
            </tr>
            <tr>
              <td class="font-bold text-slate-400 text-lg">A-042</td>
              <td class="font-medium text-slate-700">Pendaftaran</td>
              <td>14:05</td>
              <td class="text-green-600 font-medium">Panggil Sekarang</td>
              <td><span class="badge badge-info">Dipanggil</span></td>
              <td>
                <button class="btn btn-sm btn-primary p-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
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
