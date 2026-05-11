<?= $this->extend('Modules\Shared\Views\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Profil Pengguna</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li class="active">Profile</li>
    </ol>
  </nav>
</div>

<section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
  <!-- Profile Sidebar -->
  <div class="lg:col-span-4">
    <div class="card">
      <div class="card-body text-center pt-8">
        <div class="relative inline-block mb-4">
          <img src="<?= base_url() ?>NiceAdmin/assets/img/profile-img.jpg" alt="Profile" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md mx-auto">
          <button class="absolute bottom-0 right-0 bg-klinik-primary text-white p-2 rounded-full hover:bg-klinik-dark transition shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10V4h6l12 12-6 6L3 10zM17 5l2 2" /></svg>
          </button>
        </div>
        <h2 class="text-xl font-bold text-klinik-dark mb-1"><?= session()->get('name') ?? 'Admin Klinik' ?></h2>
        <h3 class="text-sm font-medium text-slate-500 mb-4"><?= ucfirst(session()->get('role') ?? 'Administrator') ?></h3>
      </div>
    </div>
  </div>

  <!-- Profile Detail Tabs -->
  <div class="lg:col-span-8">
    <div class="card">
      <div class="card-body">
        
        <div class="tw-tabs border-b border-slate-200">
          <button class="tw-tab active flex items-center gap-2" data-tab="#overview">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            Overview
          </button>
          <button class="tw-tab flex items-center gap-2" data-tab="#edit-profile">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
            Edit Profile
          </button>
          <button class="tw-tab flex items-center gap-2" data-tab="#change-password">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
            Ubah Password
          </button>
        </div>

        <div class="pt-6">
          
          <!-- Tab Overview -->
          <div id="overview" class="tw-tab-content active space-y-6">
            <div>
              <h5 class="text-lg font-bold text-slate-800 mb-3">Tentang Saya</h5>
              <p class="text-slate-600 text-sm leading-relaxed">Berkomitmen penuh dalam mengelola sistem administrasi KlinikOS 2.0 untuk memberikan pelayanan medis terbaik dan efisien kepada pasien.</p>
            </div>

            <h5 class="text-lg font-bold text-slate-800 mb-3">Detail Profil</h5>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-2">
              <div class="text-slate-500 text-sm font-semibold">Nama Lengkap</div>
              <div class="md:col-span-2 text-slate-800 text-sm"><?= session()->get('name') ?? 'Admin Klinik' ?></div>

              <div class="text-slate-500 text-sm font-semibold">Perusahaan</div>
              <div class="md:col-span-2 text-slate-800 text-sm">KlinikOS 2.0 Medical Center</div>

              <div class="text-slate-500 text-sm font-semibold">Peran/Jabatan</div>
              <div class="md:col-span-2 text-slate-800 text-sm"><?= ucfirst(session()->get('role') ?? 'Administrator') ?></div>

              <div class="text-slate-500 text-sm font-semibold">Nomor Telepon</div>
              <div class="md:col-span-2 text-slate-800 text-sm">(+62) 812 3456 7890</div>

              <div class="text-slate-500 text-sm font-semibold">Email Utama</div>
              <div class="md:col-span-2 text-slate-800 text-sm">admin@klinikos.com</div>
            </div>
          </div>

          <!-- Tab Edit Profile -->
          <div id="edit-profile" class="tw-tab-content">
            <form class="space-y-5">
              <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                <label class="md:col-span-3 form-label m-0">Nama Lengkap</label>
                <div class="md:col-span-9">
                  <input type="text" class="form-input" value="<?= session()->get('name') ?? 'Admin Klinik' ?>">
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                <label class="md:col-span-3 form-label m-0">Tentang</label>
                <div class="md:col-span-9">
                  <textarea class="form-textarea h-24">Berkomitmen penuh dalam mengelola sistem administrasi KlinikOS 2.0 untuk memberikan pelayanan medis terbaik dan efisien kepada pasien.</textarea>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                <label class="md:col-span-3 form-label m-0">Perusahaan</label>
                <div class="md:col-span-9">
                  <input type="text" class="form-input" value="KlinikOS 2.0 Medical Center">
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                <label class="md:col-span-3 form-label m-0">Nomor Telepon</label>
                <div class="md:col-span-9">
                  <input type="text" class="form-input" value="(+62) 812 3456 7890">
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                <label class="md:col-span-3 form-label m-0">Email Utama</label>
                <div class="md:col-span-9">
                  <input type="email" class="form-input" value="admin@klinikos.com">
                </div>
              </div>

              <div class="pt-4 flex justify-end">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>
            </form>
          </div>

          <!-- Tab Change Password -->
          <div id="change-password" class="tw-tab-content">
            <form class="space-y-5">
              <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                <label class="md:col-span-4 form-label m-0">Password Saat Ini</label>
                <div class="md:col-span-8">
                  <input type="password" class="form-input" placeholder="Masukkan password lama">
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                <label class="md:col-span-4 form-label m-0">Password Baru</label>
                <div class="md:col-span-8">
                  <input type="password" class="form-input" placeholder="Minimal 8 karakter">
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                <label class="md:col-span-4 form-label m-0">Ulangi Password Baru</label>
                <div class="md:col-span-8">
                  <input type="password" class="form-input" placeholder="Ketik ulang password baru">
                </div>
              </div>

              <div class="pt-4 flex justify-end">
                <button type="submit" class="btn btn-primary">Ubah Password</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
