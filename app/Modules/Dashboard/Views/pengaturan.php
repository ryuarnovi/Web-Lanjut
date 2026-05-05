<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Pengaturan Sistem & Operasional</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li class="active">Konfigurasi</li>
    </ol>
  </nav>
</div>

<section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

  <!-- Sidebar Nav for Settings -->
  <div class="lg:col-span-3">
    <div class="card overflow-hidden">
      <div class="p-2 tw-tabs flex-col border-b-0 space-y-1">
        <button class="tw-tab w-full text-left justify-start active rounded-lg" data-tab="#umum">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
          Informasi Klinik
        </button>
        <button class="tw-tab w-full text-left justify-start rounded-lg" data-tab="#operasional">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          Jam Operasional
        </button>
        <button class="tw-tab w-full text-left justify-start rounded-lg" data-tab="#notifikasi">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
          Notifikasi Pasien
        </button>
        <button class="tw-tab w-full text-left justify-start rounded-lg" data-tab="#pembayaran">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
          Integrasi Pembayaran
        </button>
      </div>
    </div>
  </div>

  <!-- Content for Settings -->
  <div class="lg:col-span-9">
    <div class="card">
      <div class="card-body p-6">
        
        <!-- Tab: Informasi Klinik -->
        <div id="umum" class="tw-tab-content active">
          <h5 class="text-xl font-bold text-klinik-dark mb-4 border-b border-slate-100 pb-2">Informasi Umum Klinik</h5>
          <form class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div>
                <label class="form-label">Nama Klinik</label>
                <input type="text" class="form-input" value="KlinikOS Medical Center">
              </div>
              <div>
                <label class="form-label">Kode Fasilitas Kesehatan (Faskes)</label>
                <input type="text" class="form-input" value="FKS-009123">
              </div>
            </div>

            <div>
              <label class="form-label">Alamat Lengkap</label>
              <textarea class="form-textarea h-24">Jl. Jend. Sudirman No. 123, Kompleks Kesehatan Terpadu, Jakarta Selatan, 12190</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div>
                <label class="form-label">Nomor Telepon Darurat (IGD)</label>
                <input type="text" class="form-input" value="(021) 555-1234">
              </div>
              <div>
                <label class="form-label">Email Operasional</label>
                <input type="email" class="form-input" value="info@klinikos.co.id">
              </div>
            </div>

            <div class="pt-4 flex justify-end">
              <button type="button" class="btn btn-primary shadow-sm">Simpan Informasi</button>
            </div>
          </form>
        </div>

        <!-- Tab: Jam Operasional -->
        <div id="operasional" class="tw-tab-content">
          <h5 class="text-xl font-bold text-klinik-dark mb-4 border-b border-slate-100 pb-2">Pengaturan Jam Operasional</h5>
          <p class="text-sm text-slate-500 mb-6">Tentukan jam buka klinik agar pendaftaran online otomatis ditutup di luar jam operasional.</p>
          
          <div class="space-y-4">
            <!-- Sen - Jum -->
            <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg bg-slate-50">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div>
                  <h6 class="font-bold text-slate-800 m-0">Senin - Jumat</h6>
                  <p class="text-xs text-slate-500 m-0">Hari kerja normal</p>
                </div>
              </div>
              <div class="flex items-center gap-2">
                <input type="time" class="form-input py-1.5 w-auto" value="08:00">
                <span class="text-slate-400">-</span>
                <input type="time" class="form-input py-1.5 w-auto" value="21:00">
              </div>
            </div>
            
            <!-- Sabtu -->
            <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg bg-slate-50">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div>
                  <h6 class="font-bold text-slate-800 m-0">Sabtu</h6>
                  <p class="text-xs text-slate-500 m-0">Akhir pekan</p>
                </div>
              </div>
              <div class="flex items-center gap-2">
                <input type="time" class="form-input py-1.5 w-auto" value="09:00">
                <span class="text-slate-400">-</span>
                <input type="time" class="form-input py-1.5 w-auto" value="15:00">
              </div>
            </div>

            <!-- Minggu -->
            <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg bg-slate-50">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div>
                  <h6 class="font-bold text-slate-800 m-0">Minggu & Hari Libur Nasional</h6>
                  <p class="text-xs text-slate-500 m-0">Kecuali IGD 24 Jam</p>
                </div>
              </div>
              <div class="flex items-center gap-2">
                 <span class="badge badge-danger">Tutup / Hanya IGD</span>
              </div>
            </div>
          </div>
          
          <div class="pt-6 flex justify-end">
            <button type="button" class="btn btn-primary shadow-sm">Simpan Jadwal</button>
          </div>
        </div>

        <!-- Tab: Notifikasi -->
        <div id="notifikasi" class="tw-tab-content">
          <h5 class="text-xl font-bold text-klinik-dark mb-4 border-b border-slate-100 pb-2">Integrasi Notifikasi Pasien</h5>
          
          <div class="space-y-4">
            <div class="p-4 border border-slate-200 rounded-lg flex items-center justify-between">
              <div>
                <h6 class="font-bold text-slate-800 flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                  WhatsApp Notifikasi (Fonnte API)
                </h6>
                <p class="text-sm text-slate-500 m-0">Kirim notifikasi panggil antrean & e-resep via WhatsApp.</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" value="" class="sr-only peer" checked>
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
              </label>
            </div>
            
            <div class="p-4 border border-slate-200 rounded-lg flex items-center justify-between">
              <div>
                <h6 class="font-bold text-slate-800 flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                  Email Invoice & Medical Record
                </h6>
                <p class="text-sm text-slate-500 m-0">Kirim salinan tagihan ke email pasien yang terdaftar.</p>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" value="" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-klinik-primary"></div>
              </label>
            </div>
          </div>
        </div>

        <!-- Tab: Pembayaran -->
        <div id="pembayaran" class="tw-tab-content">
          <h5 class="text-xl font-bold text-klinik-dark mb-4 border-b border-slate-100 pb-2">Integrasi Sistem Pembayaran</h5>
          <p class="text-sm text-slate-500 mb-6">Konfigurasi API Key untuk gateway pembayaran elektronik.</p>

          <form class="space-y-6">
            <div class="bg-slate-50 p-5 rounded-lg border border-slate-200">
              <h6 class="font-bold text-slate-800 mb-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                Midtrans Payment Gateway
              </h6>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="form-label text-xs">Client Key</label>
                  <input type="text" class="form-input text-sm font-mono" value="SB-Mid-client-A1B2C3D4E5F6G7H8">
                </div>
                <div>
                  <label class="form-label text-xs">Server Key</label>
                  <input type="password" class="form-input text-sm font-mono" value="SB-Mid-server-Z9Y8X7W6V5U4T3S2">
                </div>
                <div class="md:col-span-2">
                  <label class="form-label text-xs">Environment</label>
                  <select class="form-select text-sm">
                    <option value="sandbox" selected>Sandbox (Testing)</option>
                    <option value="production">Production (Live)</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="bg-slate-50 p-5 rounded-lg border border-slate-200 opacity-75">
              <h6 class="font-bold text-slate-800 mb-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                Web3 Crypto Wallet (Eksperimental)
              </h6>
              <div class="grid grid-cols-1 gap-4">
                <div>
                  <label class="form-label text-xs">Network</label>
                  <select class="form-select text-sm" disabled>
                    <option value="devnet" selected>Solana Devnet</option>
                  </select>
                </div>
                <div>
                  <label class="form-label text-xs">Wallet Address Pembayaran (USDC/SOL)</label>
                  <input type="text" class="form-input text-sm font-mono" value="7x...9q2" disabled>
                </div>
              </div>
            </div>

            <div class="pt-2 flex justify-end">
              <button type="button" class="btn btn-primary shadow-sm">Simpan API Key</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

</section>
<?= $this->endSection() ?>
