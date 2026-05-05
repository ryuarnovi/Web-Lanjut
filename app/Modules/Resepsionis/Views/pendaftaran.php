<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-slate-800">Pendaftaran Pasien</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Resepsionis</li>
      <li class="active">Pendaftaran</li>
    </ol>
  </nav>
</div>

<section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
  <!-- Form Pendaftaran -->
  <div class="lg:col-span-2 space-y-6">
    <div class="card overflow-hidden">
      <div class="bg-white px-6 py-4 border-b border-slate-100">
        <h5 class="text-lg m-0 text-klinik-primary font-bold">Formulir Pendaftaran Baru</h5>
      </div>
      <div class="card-body">
        <form class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="md:col-span-2">
            <label class="form-label">Nama Lengkap Pasien</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
              </span>
              <input type="text" class="form-input pl-10" placeholder="Masukkan nama lengkap sesuai identitas">
            </div>
          </div>

          <div>
            <label class="form-label">NIK (No. KTP)</label>
            <input type="number" class="form-input" placeholder="16 digit nomor NIK">
          </div>

          <div>
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-input">
          </div>

          <div>
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select">
              <option selected>Pilih...</option>
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>

          <div>
            <label class="form-label">Poli Tujuan</label>
            <select class="form-select">
              <option selected>Pilih Poli...</option>
              <option value="Umum">Poli Umum</option>
              <option value="Gigi">Poli Gigi</option>
              <option value="Anak">Poli Anak</option>
            </select>
          </div>

          <div class="md:col-span-2">
            <label class="form-label">Alamat Lengkap</label>
            <textarea class="form-textarea h-24" placeholder="Jl. Nama Jalan No. XX ..."></textarea>
          </div>

          <div class="md:col-span-2 pt-2 flex gap-3">
            <button type="submit" class="btn btn-primary shadow-md shadow-indigo-200 py-2.5">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
              Daftarkan & Ambil Nomor
            </button>
            <button type="reset" class="btn btn-outline-secondary py-2.5">Reset</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Recent Pendaftaran Table -->
    <div class="card overflow-hidden">
      <div class="bg-white px-6 py-4 flex justify-between items-center border-b border-slate-100">
        <h5 class="text-lg m-0 text-slate-800 font-bold">Pendaftaran Hari Ini</h5>
        <span class="badge bg-indigo-50 text-klinik-primary px-3 py-1 rounded-full border border-indigo-100">Live Update</span>
      </div>
      <div class="overflow-x-auto">
        <table class="tw-table m-0">
          <thead class="bg-slate-50 text-sm">
            <tr>
              <th>Nomor</th>
              <th>Pasien</th>
              <th>Poli</th>
              <th>Jam</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr>
              <td class="font-bold text-klinik-primary text-lg">UM-045</td>
              <td>
                <div class="flex flex-col">
                  <span class="font-bold text-slate-800">Ahmad Subandrio</span>
                  <span class="text-xs text-slate-500">NIK: 33010214****</span>
                </div>
              </td>
              <td><span class="badge bg-blue-50 text-blue-600">Poli Umum</span></td>
              <td class="text-slate-500 text-sm font-medium">09:12 WIB</td>
              <td><span class="badge badge-warning">Menunggu</span></td>
            </tr>
            <tr>
              <td class="font-bold text-klinik-primary text-lg">AN-012</td>
              <td>
                <div class="flex flex-col">
                  <span class="font-bold text-slate-800">Zahra Putri</span>
                  <span class="text-xs text-slate-500">NIK: 33010218****</span>
                </div>
              </td>
              <td><span class="badge bg-purple-50 text-purple-600">Poli Anak</span></td>
              <td class="text-slate-500 text-sm font-medium">09:05 WIB</td>
              <td><span class="badge badge-success">Dilayani</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Info Column -->
  <div class="space-y-6">
    <div class="rounded-2xl bg-klinik-primary text-white shadow-md p-6 relative overflow-hidden">
      <div class="absolute -right-4 -top-4 opacity-10">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
      </div>
      <h6 class="text-sm font-medium opacity-80 uppercase tracking-wider mb-2 relative z-10">Antrean Sedang Berjalan</h6>
      <div class="flex items-center gap-4 relative z-10">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
          <h2 class="text-5xl font-bold m-0">45</h2>
      </div>
      <p class="mt-4 text-sm opacity-90 m-0 flex items-center gap-1 relative z-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        Rata-rata tunggu: 12 Menit
      </p>
    </div>

    <div class="card overflow-hidden">
      <div class="card-body !pb-6">
          <h5 class="card-title p-0 m-0 mb-4 text-slate-800 font-bold">Status Kuota Poli</h5>
          
          <div class="space-y-5">
              <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-slate-600 font-medium text-sm">Poli Umum</span>
                    <span class="text-green-500 font-bold text-sm flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                      Tersedia
                    </span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-green-500 h-full w-[65%] rounded-full"></div>
                </div>
              </div>

              <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-slate-600 font-medium text-sm">Poli Gigi</span>
                    <span class="text-amber-500 font-bold text-sm flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                      Hampir Penuh
                    </span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-amber-500 h-full w-[90%] rounded-full"></div>
                </div>
              </div>
          </div>
      </div>
      <div class="bg-slate-50 p-4 border-t border-slate-100">
          <a href="#" class="text-klinik-primary font-semibold text-sm hover:underline flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            Lihat Jadwal Dokter
          </a>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
