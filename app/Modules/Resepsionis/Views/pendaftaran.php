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

<!-- Import / Export Toolbar -->
<div class="mb-6 flex flex-wrap items-center gap-3">
  <a href="/api/patients/export" class="btn btn-outline-primary flex items-center gap-2" id="btnExportPasien">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
    Export CSV
  </a>
  <a href="/api/patients/template" class="btn btn-outline-secondary flex items-center gap-2" id="btnTemplatePasien">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
    Download Template
  </a>
  <button class="btn btn-success flex items-center gap-2" id="btnOpenImportModal" onclick="document.getElementById('patientImportModal').innerHTML = getPatientImportModalHTML(); document.getElementById('patientImportModal').querySelector('.modal-overlay').classList.remove('hidden')">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
    Import CSV
  </button>
</div>

<!-- Import Modal -->
<div id="patientImportModal"></div>

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
              <input type="text" class="form-input pl-10" id="patientNameInput" placeholder="Ketik nama pasien untuk cari atau isi baru" autocomplete="off">
            </div>
            <div id="patientSearchDropdown" class="relative"></div>
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
            <select class="form-select" id="poliSelect">
              <option selected>Pilih Poli...</option>
            </select>
          </div>

          <div>
            <label class="form-label">Dokter Tujuan</label>
            <select class="form-select" id="doctorSelect">
              <option selected>Pilih Dokter...</option>
            </select>
          </div>

          <div>
            <label class="form-label">Jenis Kunjungan</label>
            <select class="form-select" id="visitTypeSelect">
              <option value="rawat_jalan" selected>Rawat Jalan</option>
              <option value="rawat_inap">Rawat Inap</option>
              <option value="gawat_darurat">Gawat Darurat (IGD)</option>
              <option value="kontrol">Kontrol / Check-up</option>
              <option value="rujukan">Rujukan</option>
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
              <th>Kunjungan</th>
              <th>Jam</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr><td colspan="6" class="text-center py-4 text-slate-400">Memuat data...</td></tr>
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
<script>
let DOCTORS = [];
let selectedPatientId = null;
let patientSearchTimeout = null;

async function searchPatients() {
    const input = document.getElementById('patientNameInput');
    const q = input.value.trim().toLowerCase();
    const dropdown = document.getElementById('patientSearchDropdown');
    if (q.length < 2) { dropdown.innerHTML = ''; return; }
    try {
        const res = await fetch('/api/patients?limit=20');
        const json = await res.json();
        const all = json.data || [];
        const matches = all.filter(p => (p.full_name || '').toLowerCase().includes(q) || (p.nik || '').includes(q));
        if (matches.length) {
            dropdown.innerHTML = '<div class="border border-slate-200 rounded-lg bg-white shadow-lg mt-1 max-h-48 overflow-y-auto">' +
                matches.map(p => `<div class="px-3 py-2 cursor-pointer hover:bg-klinik-light border-b border-slate-100 text-sm flex justify-between" onclick="pilihPasien(${p.id},'${(p.full_name||'').replace(/'/g,"\\'")}','${(p.nik||'').replace(/'/g,"\\'")}')">
                    <span class="font-medium">${p.full_name}</span>
                    <span class="text-slate-400 text-xs">${p.nik} ${p.patient_code ? '('+p.patient_code+')' : ''}</span>
                </div>`).join('') + '</div>';
        } else { dropdown.innerHTML = '<div class="text-xs text-slate-400 mt-1">Pasien tidak ditemukan. Isi form untuk daftarkan baru.</div>'; }
    } catch(e) { dropdown.innerHTML = ''; }
}

function pilihPasien(id, nama, nik) {
    selectedPatientId = id;
    document.getElementById('patientNameInput').value = nama + ' (' + nik + ')';
    document.getElementById('patientSearchDropdown').innerHTML = '<div class="text-xs text-green-600 mt-1 font-semibold">Pasien ditemukan! Akan mendaftarkan pasien yang sudah ada.</div>';
    document.querySelector('input[placeholder*="16 digit"]').value = nik;
}

async function loadDoctors() {
    try {
        const res = await fetch('/api/doctors');
        const json = await res.json();
        DOCTORS = json.data || [];
        const poliSet = new Set();
        DOCTORS.forEach(d => { if (d.specialization) poliSet.add(d.specialization); });
        const poliSelect = document.getElementById('poliSelect');
        poliSelect.innerHTML = '<option selected>Pilih Poli...</option><option value="Semua Poli">Semua Poli</option>';
        poliSet.forEach(p => { poliSelect.innerHTML += `<option value="${p}">${p}</option>`; });
    } catch(e) { DOCTORS = []; }
}

async function loadPatientTable() {
    try {
        const res = await fetch('/api/queues');
        const json = await res.json();
        const list = json.data || [];
        
        // Filter only today's queues
        const todayStr = new Date().toISOString().slice(0, 10);
        const todayList = list.filter(q => q.queue_date === todayStr || (q.created_at && q.created_at.slice(0, 10) === todayStr));
        
        paginateTable('.tw-table', todayList, 5, q => {
            const poliLabel = q.poli || 'Umum';
            const statusMap = { 'waiting': 'warning', 'called': 'info', 'in_progress': 'primary', 'completed': 'success', 'cancelled': 'danger' };
            const badgeClass = statusMap[q.status] || 'secondary';
            const statusLabels = { 'waiting': 'Menunggu', 'called': 'Dipanggil', 'in_progress': 'Diperiksa', 'completed': 'Selesai', 'cancelled': 'Batal' };
            const label = statusLabels[q.status] || q.status;
            const visitLabels = { 'rawat_jalan': 'Rawat Jalan', 'rawat_inap': 'Rawat Inap', 'gawat_darurat': 'IGD', 'kontrol': 'Kontrol', 'rujukan': 'Rujukan' };
            const visitLabel = visitLabels[q.visit_type] || q.visit_type || 'Rawat Jalan';
            
            return `<tr>
                <td class="font-bold text-klinik-primary text-lg">${q.queue_number || q.id || '-'}</td>
                <td><div class="flex flex-col"><span class="font-bold text-slate-800">${q.patient_name || '-'}</span></div></td>
                <td><span class="badge bg-blue-50 text-blue-600">${poliLabel}</span></td>
                <td><span class="badge bg-purple-50 text-purple-600 border border-purple-200">${visitLabel}</span></td>
                <td class="text-slate-500 text-sm font-medium">${q.created_at ? q.created_at.slice(11, 16) : '-'} WIB</td>
                <td><span class="badge badge-${badgeClass}">${label}</span></td>
            </tr>`;
        });
    } catch(e) {
        const tbody = document.querySelector('.tw-table tbody');
        if (tbody) tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>';
    }
}

function filterDoctorsByPoli(poli) {
    const sel = document.getElementById('doctorSelect');
    sel.innerHTML = '<option value="">Pilih Dokter...</option>';
    if (!poli || poli === 'Pilih Poli...' || poli === 'Semua Poli') {
        DOCTORS.forEach(d => {
            sel.innerHTML += `<option value="${d.id}">${d.full_name}${d.specialization ? ' ('+d.specialization+')' : ''}</option>`;
        });
        return;
    }
    const filtered = DOCTORS.filter(d => (d.specialization || '').toLowerCase() === poli.toLowerCase());
    if (!filtered.length) {
        sel.innerHTML += '<option disabled>Tidak ada dokter untuk poli ini</option>';
        return;
    }
    filtered.forEach(d => {
        sel.innerHTML += `<option value="${d.id}">${d.full_name}</option>`;
    });
}

document.addEventListener('DOMContentLoaded', async function() {
    await loadDoctors();
    document.getElementById('poliSelect').value = 'Semua Poli';
    filterDoctorsByPoli('Semua Poli');
    loadPatientTable();
    setInterval(loadPatientTable, 10000);
    document.getElementById('patientNameInput').addEventListener('keyup', function() {
        clearTimeout(patientSearchTimeout);
        selectedPatientId = null;
        patientSearchTimeout = setTimeout(searchPatients, 300);
    });
    document.getElementById('poliSelect').addEventListener('change', function() {
        filterDoctorsByPoli(this.value);
    });
    document.querySelector('button[type="submit"]')?.addEventListener('click', async function(e) {
        e.preventDefault();
        const nama = document.getElementById('patientNameInput')?.value?.split(' (')[0] || '';
        const nik = document.querySelector('input[placeholder*="16 digit"]')?.value || '';
        const tglLahir = document.querySelector('input[type="date"]')?.value || '';
        const jk = document.querySelectorAll('select')[0]?.value || '';
        const poli = document.getElementById('poliSelect').value || '';
        const doctorId = document.getElementById('doctorSelect').value || '';
        const alamat = document.querySelector('textarea')?.value || '';
        
        if (!nama || !nik || !doctorId) {
            return showToast('Harap isi nama, NIK, dan dokter tujuan', 'warning');
        }
        if (!poli || poli === 'Semua Poli' || poli === 'Pilih Poli...') {
            return showToast('Harap pilih poli tujuan', 'warning');
        }
        try {
            let patientId = selectedPatientId;
            if (!patientId) {
                const res = await fetch('/api/patients', { 
                    method: 'POST', 
                    headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, 
                    body: JSON.stringify({ full_name: nama, nik, date_of_birth: tglLahir || null, gender: jk, address: alamat, poli_tujuan: poli }) 
                });
                const json = await res.json();
                if (!res.ok) { 
                    showToast(json.error || 'Gagal membuat pasien', 'error'); 
                    return; 
                }
                patientId = json.data;
            }
            const visitType = document.getElementById('visitTypeSelect').value || 'rawat_jalan';
            const qRes = await fetch('/api/queues', { 
                method: 'POST', 
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, 
                body: JSON.stringify({ patient_id: patientId, poli: poli, doctor_id: parseInt(doctorId), status: 'waiting', visit_type: visitType }) 
            });
            const qJson = await qRes.json();
            if (!qRes.ok) {
                showToast(qJson.error || 'Gagal membuat antrean', 'error');
                return;
            }
            showToast('Pasien berhasil didaftarkan ke antrean!', 'success');
            loadPatientTable();
            document.querySelector('form').reset();
            selectedPatientId = null;
            document.getElementById('patientSearchDropdown').innerHTML = '';
        } catch(e) { 
            showToast('Terjadi kesalahan jaringan', 'error'); 
        }
    });

    // Patient Import: file preview
    document.addEventListener('change', function(e) {
        if (e.target && e.target.id === 'patientImportFileInput') {
            previewPatientCSV(e.target);
        }
    });

    // Patient Import: form submit
    document.addEventListener('submit', function(e) {
        if (e.target && e.target.id === 'patientImportForm') {
            e.preventDefault();
            submitPatientImport();
        }
    });
});

// ============ PATIENT IMPORT MODAL ============

function getPatientImportModalHTML() {
    return `<div class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center modal-overlay hidden" onclick="if(event.target===this)closePatientImportModal()">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-emerald-50 to-teal-50">
                <h5 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                    Import Data Pasien dari CSV
                </h5>
                <button class="btn btn-sm btn-outline-secondary rounded-full" onclick="closePatientImportModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <div class="p-6">
                <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-700">
                    <strong>Tips:</strong> Unduh <a href="/api/patients/template" class="underline font-bold">template CSV</a> terlebih dahulu untuk memastikan format kolom yang benar.
                    <br>Kolom wajib: <code class="bg-blue-100 px-1 rounded">nik</code>, <code class="bg-blue-100 px-1 rounded">full_name</code>.
                    <br>Jika NIK sudah ada, data pasien akan di-<em>update</em>. Jika belum, akan ditambahkan sebagai pasien baru.
                </div>
                <form id="patientImportForm" class="space-y-4">
                    <div>
                        <label class="form-label">Pilih File CSV</label>
                        <input type="file" class="form-input" id="patientImportFileInput" accept=".csv,.txt" required>
                    </div>
                    <div id="patientImportPreview" class="hidden">
                        <label class="form-label">Preview Data (5 baris pertama)</label>
                        <div class="overflow-x-auto border border-slate-200 rounded-lg max-h-52 text-xs"></div>
                    </div>
                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="btn btn-success flex items-center gap-2" id="btnPatientImport">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                            Import Data
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="closePatientImportModal()">Batal</button>
                    </div>
                </form>
                <div id="patientImportResult" class="hidden mt-4"></div>
            </div>
        </div>
    </div>`;
}

function closePatientImportModal() {
    const overlay = document.querySelector('#patientImportModal .modal-overlay');
    if (overlay) overlay.classList.add('hidden');
    const result = document.getElementById('patientImportResult');
    if (result) result.classList.add('hidden');
}

function previewPatientCSV(input) {
    const file = input.files[0];
    if (!file) return;
    const preview = document.getElementById('patientImportPreview');
    const reader = new FileReader();
    reader.onload = function(e) {
        const text = e.target.result;
        const lines = text.split('\n').filter(l => l.trim());
        if (lines.length < 2) {
            preview.classList.add('hidden');
            return;
        }
        // Parse CSV (simple)
        const parseCSVLine = (line) => {
            const result = [];
            let current = '';
            let inQuotes = false;
            for (let i = 0; i < line.length; i++) {
                const ch = line[i];
                if (ch === '"') { inQuotes = !inQuotes; }
                else if (ch === ',' && !inQuotes) { result.push(current.trim()); current = ''; }
                else { current += ch; }
            }
            result.push(current.trim());
            return result;
        };
        const headers = parseCSVLine(lines[0]);
        const rows = lines.slice(1, 6).map(l => parseCSVLine(l));
        let html = '<table class="tw-table m-0 text-xs"><thead class="bg-slate-50"><tr>';
        headers.forEach(h => { html += '<th class="px-2 py-1 whitespace-nowrap">' + h.replace(/^\xEF\xBB\xBF/, '') + '</th>'; });
        html += '</tr></thead><tbody>';
        rows.forEach(r => {
            html += '<tr>';
            r.forEach(c => { html += '<td class="px-2 py-1 max-w-[200px] truncate">' + (c || '<span class=\'text-slate-300\'>-</span>') + '</td>'; });
            html += '</tr>';
        });
        html += '</tbody></table>';
        const remaining = lines.length - 6;
        if (remaining > 0) {
            html += '<div class="text-xs text-slate-400 p-2 text-center">...dan ' + remaining + ' baris lainnya</div>';
        }
        preview.querySelector('div').innerHTML = html;
        preview.classList.remove('hidden');
    };
    reader.readAsText(file);
}

async function submitPatientImport() {
    const fileInput = document.getElementById('patientImportFileInput');
    if (!fileInput || !fileInput.files[0]) {
        showToast('Pilih file CSV terlebih dahulu', 'warning');
        return;
    }
    const formData = new FormData();
    formData.append('file', fileInput.files[0]);

    const btn = document.getElementById('btnPatientImport');
    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Importing...';

    try {
        const res = await fetch('/api/patients/import', { method: 'POST', body: formData });
        const json = await res.json();
        const resultDiv = document.getElementById('patientImportResult');
        resultDiv.classList.remove('hidden');
        if (res.ok) {
            resultDiv.innerHTML = '<div class="p-3 rounded-lg bg-green-50 text-green-700 border border-green-200 text-sm">' + (json.message || 'Import berhasil') + '</div>';
            showToast(json.message || 'Import berhasil', 'success');
            // Refresh patient table
            if (typeof loadPatientTable === 'function') loadPatientTable();
        } else {
            const errMsg = json.error || 'Gagal import';
            let details = '';
            if (json.details && json.details.length) {
                details = '<ul class="mt-2 ml-4 list-disc text-xs">' + json.details.map(d => '<li>' + d + '</li>').join('') + '</ul>';
            }
            resultDiv.innerHTML = '<div class="p-3 rounded-lg bg-red-50 text-red-700 border border-red-200 text-sm">' + errMsg + details + '</div>';
            showToast(errMsg, 'error');
        }
    } catch(e) {
        showToast('Terjadi kesalahan jaringan', 'error');
    }

    btn.disabled = false;
    btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg> Import Data';
}
</script>
<?= $this->endSection() ?>
