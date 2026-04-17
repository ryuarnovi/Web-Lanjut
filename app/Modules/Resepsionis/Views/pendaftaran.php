<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle mb-4">
  <h1 class="text-2xl font-bold text-slate-800">Pendaftaran Pasien</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item">Resepsionis</li>
      <li class="breadcrumb-item active">Pendaftaran</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row g-4">
    <!-- Form Pendaftaran -->
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-2xl overflow-hidden">
        <div class="card-header bg-white border-0 py-3">
          <h5 class="card-title m-0 text-indigo-700 font-semibold">Formulir Pendaftaran Baru</h5>
        </div>
        <div class="card-body pt-0">
          <form class="row g-3">
            <div class="col-md-12">
              <label class="form-label font-medium text-slate-600">Nama Lengkap Pasien</label>
              <div class="input-group">
                <span class="input-group-text bg-slate-50 border-slate-200"><i class="bi bi-person text-indigo-500"></i></span>
                <input type="text" class="form-control border-slate-200 focus:ring-2 focus:ring-indigo-200 transition-all py-2.5" placeholder="Masukkan nama lengkap sesuai identitas">
              </div>
            </div>

            <div class="col-md-6 text-slate-600">
              <label class="form-label font-medium">NIK (No. KTP)</label>
              <input type="number" class="form-control border-slate-200 focus:ring-2 focus:ring-indigo-200 py-2.5" placeholder="16 digit nomor NIK">
            </div>

            <div class="col-md-6 text-slate-600">
              <label class="form-label font-medium">Tanggal Lahir</label>
              <input type="date" class="form-control border-slate-200 focus:ring-2 focus:ring-indigo-200 py-2.5">
            </div>

            <div class="col-md-6">
              <label class="form-label font-medium text-slate-600">Jenis Kelamin</label>
              <select class="form-select border-slate-200 focus:ring-2 focus:ring-indigo-200 py-2.5">
                <option selected>Pilih...</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label font-medium text-slate-600">Poli Tujuan</label>
              <select class="form-select border-slate-200 focus:ring-2 focus:ring-indigo-200 py-2.5">
                <option selected>Pilih Poli...</option>
                <option value="Umum">Poli Umum</option>
                <option value="Gigi">Poli Gigi</option>
                <option value="Anak">Poli Anak</option>
              </select>
            </div>

            <div class="col-12">
              <label class="form-label font-medium text-slate-600">Alamat Lengkap</label>
              <textarea class="form-control border-slate-200 focus:ring-2 focus:ring-indigo-200" rows="3" placeholder="Jl. Nama Jalan No. XX ..."></textarea>
            </div>

            <div class="col-12 pt-4">
              <button type="submit" class="btn btn-primary px-4 py-2.5 rounded-xl shadow-lg shadow-indigo-200 transition-transform active:scale-95">
                <i class="bi bi-person-plus me-2"></i>Daftarkan & Ambil Nomor
              </button>
              <button type="reset" class="btn btn-outline-secondary px-4 py-2.5 rounded-xl ms-2">Reset</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Recent Pendaftaran Table -->
      <div class="card border-0 shadow-sm rounded-2xl mt-4 overflow-hidden">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
          <h5 class="card-title m-0 text-slate-800 font-semibold">Pendaftaran Hari Ini</h5>
          <span class="badge bg-indigo-100 text-indigo-700 rounded-full px-3 py-1">Live Update</span>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
              <thead class="bg-slate-50">
                <tr>
                  <th class="px-4 py-3 text-slate-500 font-medium">Nomor</th>
                  <th class="py-3 text-slate-500 font-medium">Pasien</th>
                  <th class="py-3 text-slate-500 font-medium">Poli</th>
                  <th class="py-3 text-slate-500 font-medium">Jam</th>
                  <th class="py-3 text-slate-500 font-medium">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="px-4 font-bold text-indigo-600 text-lg">UM-045</td>
                  <td>
                    <div class="d-flex flex-column text-slate-600">
                      <span class="font-semibold text-slate-800">Ahmad Subandrio</span>
                      <small class="text-xs">NIK: 33010214****</small>
                    </div>
                  </td>
                  <td><span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-semibold">Poli Umum</span></td>
                  <td class="text-slate-500 font-medium">09:12 WIB</td>
                  <td><span class="px-2 py-1 bg-yellow-50 text-yellow-600 rounded-lg text-xs font-semibold">Menunggu</span></td>
                </tr>
                <tr>
                  <td class="px-4 font-bold text-indigo-600 text-lg">AN-012</td>
                  <td>
                    <div class="d-flex flex-column">
                      <span class="font-semibold text-slate-800">Zahra Putri</span>
                      <small class="text-xs">NIK: 33010218****</small>
                    </div>
                  </td>
                  <td><span class="px-2 py-1 bg-purple-50 text-purple-600 rounded-lg text-xs font-semibold">Poli Anak</span></td>
                  <td class="text-slate-500 font-medium">09:05 WIB</td>
                  <td><span class="px-2 py-1 bg-green-50 text-green-600 rounded-lg text-xs font-semibold">Dilayani</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Info Column -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-2xl bg-indigo-600 text-white mb-4">
        <div class="card-body p-4">
            <h6 class="text-sm font-medium opacity-75 uppercase tracking-wider">Antrean Sedang Berjalan</h6>
            <div class="d-flex align-items-center mt-2">
                <i class="bi bi-people-fill text-3xl me-3 opacity-50"></i>
                <h2 class="text-4xl font-bold">45</h2>
            </div>
            <p class="mt-3 text-sm opacity-90"><i class="bi bi-clock me-1"></i> Rata-rata tunggu: 12 Menit</p>
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-2xl overflow-hidden mb-4">
        <div class="card-body p-0">
            <div class="p-4">
                <h5 class="card-title p-0 m-0 mb-3 text-slate-800 font-bold">Status Kuota Poli</h5>
                
                <div class="space-y-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-slate-600">Poli Umum</span>
                        <span class="text-green-500 font-bold"><i class="bi bi-check2-circle me-1"></i>Tersedia</span>
                    </div>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-green-500 h-full w-[65%]"></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-2">
                        <span class="text-slate-600">Poli Gigi</span>
                        <span class="text-amber-500 font-bold"><i class="bi bi-exclamation-triangle me-1"></i>Hampir Penuh</span>
                    </div>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-amber-500 h-full w-[90%]"></div>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 p-4 border-t border-slate-100">
                <a href="#" class="text-indigo-600 font-semibold text-sm hover:underline"><i class="bi bi-calendar-event me-2"></i>Lihat Jadwal Dokter</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
