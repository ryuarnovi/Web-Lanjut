<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Pemeriksaan Medis (SOAP)</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Dokter</li>
      <li class="active">SOAP Electronic Medical Record</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Panel Pemeriksaan Pasien</h5>
      
      <div class="alert alert-secondary flex items-start gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-slate-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <div>
          <h6 class="font-bold text-slate-800 mb-1">Identitas Pasien: #P00123 - Budi Santoso</h6>
          <p class="text-sm m-0">Usia: 45 Thn | Jenis Kelamin: Laki-laki | Alergi: <span class="text-red-500 font-semibold">Amoxicillin</span></p>
        </div>
      </div>
      
      <!-- Custom Tabs using layout.js -->
      <div class="tw-tabs mt-6">
        <button class="tw-tab active flex items-center gap-2" data-tab="#tab-soap">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
          SOAP & Diagnosis
        </button>
        <button class="tw-tab flex items-center gap-2" data-tab="#tab-resep">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
          Resep Obat (E-Prescribe)
        </button>
        <button class="tw-tab flex items-center gap-2" data-tab="#tab-riwayat">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          Riwayat Pemeriksaan
        </button>
      </div>

      <div class="pt-4">
        <!-- Tab 1: SOAP -->
        <div id="tab-soap" class="tw-tab-content active">
          <form class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
              <label class="md:col-span-3 form-label pt-2">Subjective (S)</label>
              <div class="md:col-span-9">
                <textarea class="form-textarea h-24" placeholder="Keluhan utama pasien..."></textarea>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
              <label class="md:col-span-3 form-label pt-2">Objective (O)</label>
              <div class="md:col-span-9">
                <textarea class="form-textarea h-24" placeholder="Hasil pemeriksaan fisik, tanda vital..."></textarea>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
              <label class="md:col-span-3 form-label pt-2">Assessment (A)</label>
              <div class="md:col-span-9 space-y-3">
                <select class="form-select">
                  <option selected>Pilih Diagnosis ICD-10</option>
                  <option value="A00">A00 - Cholera</option>
                  <option value="B01">B01 - Varicella [chickenpox]</option>
                  <option value="C00">C00 - Malignant neoplasm of lip</option>
                  <option value="J00">J00 - Acute Nasopharyngitis (Common Cold)</option>
                </select>
                <textarea class="form-textarea h-20" placeholder="Keterangan diagnosis tambahan..."></textarea>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
              <label class="md:col-span-3 form-label pt-2">Plan (P)</label>
              <div class="md:col-span-9">
                <textarea class="form-textarea h-24" placeholder="Tindakan medis, edukasi, rujukan..."></textarea>
              </div>
            </div>
          </form>
        </div>
        
        <!-- Tab 2: Resep -->
        <div id="tab-resep" class="tw-tab-content">
          <h6 class="font-bold text-slate-800 mb-4">Daftar Obat</h6>
          <div class="overflow-x-auto mb-4 border border-slate-200 rounded-lg">
            <table class="tw-table m-0">
              <thead class="bg-slate-50">
                <tr>
                  <th>Nama Obat</th>
                  <th>Jumlah</th>
                  <th>Aturan Pakai</th>
                  <th class="w-20">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-200">
                <tr>
                  <td class="font-medium">Paracetamol 500mg</td>
                  <td>10</td>
                  <td>3x sehari sesudah makan</td>
                  <td>
                    <button class="btn btn-sm btn-danger p-1.5">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <button class="btn btn-outline-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            Tambah Obat
          </button>
        </div>

        <!-- Tab 3: Riwayat -->
        <div id="tab-riwayat" class="tw-tab-content">
           <ul class="space-y-3">
            <li class="p-4 border border-slate-200 rounded-lg flex flex-col sm:flex-row justify-between sm:items-center gap-3 hover:bg-slate-50 transition">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-klinik-light text-klinik-primary flex items-center justify-center font-bold">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <div>
                  <p class="font-bold text-slate-800 m-0">12 Jan 2024</p>
                  <p class="text-sm text-slate-500 m-0">Poli Umum (Dr. Andi)</p>
                </div>
              </div>
              <button class="badge badge-primary hover:bg-klinik-primary hover:text-white transition cursor-pointer border-0">Lihat Rekam</button>
            </li>
            <li class="p-4 border border-slate-200 rounded-lg flex flex-col sm:flex-row justify-between sm:items-center gap-3 hover:bg-slate-50 transition">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-klinik-light text-klinik-primary flex items-center justify-center font-bold">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <div>
                  <p class="font-bold text-slate-800 m-0">05 Des 2023</p>
                  <p class="text-sm text-slate-500 m-0">Poli Gigi (Drg. Sarah)</p>
                </div>
              </div>
              <button class="badge badge-primary hover:bg-klinik-primary hover:text-white transition cursor-pointer border-0">Lihat Rekam</button>
            </li>
          </ul>
        </div>
      </div>

      <div class="mt-8 pt-4 border-t border-slate-100 flex justify-end gap-3">
        <button type="button" class="btn btn-outline-secondary">Tunda Pemeriksaan</button>
        <button type="button" class="btn btn-success">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
          Simpan & Selesai
        </button>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
