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

      <div class="mb-4" id="patientSearchSection">
        <div class="relative" id="patientSearchWrapper">
          <input type="text" class="form-input" id="patientSearchInput" placeholder="Cari pasien berdasarkan nama atau NIK..." autocomplete="off">
          <div id="patientDropdown" class="absolute z-10 w-full bg-white border border-slate-200 rounded-lg shadow-lg mt-1 max-h-48 overflow-y-auto" style="display:none"></div>
        </div>
      </div>

      <div class="alert alert-secondary flex items-start gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-slate-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <div>
          <h6 class="font-bold text-slate-800 mb-1">Memuat data pasien...</h6>
          <p class="text-sm m-0">Memuat...</p>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4" id="patientDetailCard" style="display:none">
        <div class="text-sm text-slate-600"><span class="font-semibold text-slate-800">NIK:</span> <span id="pNik">-</span></div>
        <div class="text-sm text-slate-600"><span class="font-semibold text-slate-800">Tgl Lahir:</span> <span id="pTglLahir">-</span></div>
        <div class="text-sm text-slate-600"><span class="font-semibold text-slate-800">Usia:</span> <span id="pUsia">-</span></div>
        <div class="text-sm text-slate-600"><span class="font-semibold text-slate-800">Jenis Kelamin:</span> <span id="pGender">-</span></div>
        <div class="text-sm text-slate-600"><span class="font-semibold text-slate-800">Gol. Darah:</span> <span id="pBlood">-</span></div>
        <div class="text-sm text-slate-600"><span class="font-semibold text-slate-800">Alergi:</span> <span id="pAllergies" class="text-red-500 font-semibold">-</span></div>
      </div>

      <div class="border border-slate-200 rounded-lg p-4 mb-4 bg-slate-50" id="vitalSignsSection" style="display:none">
        <h6 class="font-bold text-slate-800 mb-3">Tanda Vital</h6>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-3">
          <div>
            <label class="text-xs font-semibold text-slate-600">TD (mmHg)</label>
            <input type="text" id="vitalTd" class="form-input" placeholder="120/80">
          </div>
          <div>
            <label class="text-xs font-semibold text-slate-600">Suhu (°C)</label>
            <input type="text" id="vitalSuhu" class="form-input" placeholder="36.5">
          </div>
          <div>
            <label class="text-xs font-semibold text-slate-600">Nadi (/menit)</label>
            <input type="text" id="vitalNadi" class="form-input" placeholder="80">
          </div>
          <div>
            <label class="text-xs font-semibold text-slate-600">Nafas (/menit)</label>
            <input type="text" id="vitalNafas" class="form-input" placeholder="20">
          </div>
          <div>
            <label class="text-xs font-semibold text-slate-600">BB (kg)</label>
            <input type="text" id="vitalBb" class="form-input" placeholder="65">
          </div>
          <div>
            <label class="text-xs font-semibold text-slate-600">TB (cm)</label>
            <input type="text" id="vitalTb" class="form-input" placeholder="170">
          </div>
        </div>
      </div>

      <div class="tw-tabs mt-4">
        <button class="tw-tab active flex items-center gap-2" data-tab="#tab-soap">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
          SOAP & Diagnosis
        </button>
        <button class="tw-tab flex items-center gap-2" data-tab="#tab-resep">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
          Resep Obat
        </button>
        <button class="tw-tab flex items-center gap-2" data-tab="#tab-riwayat">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          Riwayat Pemeriksaan
        </button>
      </div>

      <div class="pt-4">
        <div id="tab-soap" class="tw-tab-content active">
          <form class="space-y-5" id="soapForm">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
              <label class="md:col-span-3 form-label pt-2">Subjective (S)</label>
              <div class="md:col-span-9">
                <textarea class="form-textarea h-24" placeholder="Keluhan utama pasien..." id="soapSubjective"></textarea>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
              <label class="md:col-span-3 form-label pt-2">Objective (O)</label>
              <div class="md:col-span-9">
                <textarea class="form-textarea h-24" placeholder="Hasil pemeriksaan fisik..." id="soapObjective"></textarea>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
              <label class="md:col-span-3 form-label pt-2">Assessment (A)</label>
              <div class="md:col-span-9 space-y-3">
                <div class="relative" id="icd10SearchWrapper">
                  <input type="text" class="form-input" id="icd10SearchInput" placeholder="Cari diagnosis ICD-10... (min 2 huruf)" autocomplete="off">
                  <div id="icd10Dropdown" class="absolute z-10 w-full bg-white border border-slate-200 rounded-lg shadow-lg mt-1 max-h-48 overflow-y-auto" style="display:none"></div>
                </div>
                <input type="hidden" id="icd10Code" value="">
                <input type="text" class="form-input" id="icd10SelectedDisplay" placeholder="Pilih diagnosis di atas" readonly>
                <textarea class="form-textarea h-20" placeholder="Keterangan diagnosis tambahan..." id="soapAssessment"></textarea>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
              <label class="md:col-span-3 form-label pt-2">Tindakan / Prosedur (ICD-9CM)</label>
              <div class="md:col-span-9 space-y-3">
                <div class="relative" id="icd9SearchWrapper">
                  <input type="text" class="form-input" id="icd9SearchInput" placeholder="Cari prosedur ICD-9CM... (min 2 huruf)" autocomplete="off">
                  <div id="icd9Dropdown" class="absolute z-10 w-full bg-white border border-slate-200 rounded-lg shadow-lg mt-1 max-h-48 overflow-y-auto" style="display:none"></div>
                </div>
                <input type="hidden" id="icd9Code" value="">
                <input type="text" class="form-input" id="icd9SelectedDisplay" placeholder="Pilih tindakan di atas" readonly>
                
                <div class="flex gap-4">
                  <div class="w-1/2">
                    <label class="text-xs font-semibold text-slate-500">Biaya Tindakan (Rp)</label>
                    <input type="number" class="form-input" id="tindakanFee" placeholder="0" min="0" value="0">
                  </div>
                  <div class="w-1/2">
                    <label class="text-xs font-semibold text-slate-500">Biaya Konsultasi Dokter (Rp)</label>
                    <input type="number" class="form-input" id="doctorFee" placeholder="50000" min="0" value="50000">
                  </div>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
              <label class="md:col-span-3 form-label pt-2">Plan (P)</label>
              <div class="md:col-span-9">
                <textarea class="form-textarea h-24" placeholder="Tindakan medis, edukasi, rujukan..." id="soapPlan"></textarea>
              </div>
            </div>
          </form>
        </div>

        <div id="tab-resep" class="tw-tab-content">
          <div class="flex items-center gap-3 mb-4">
            <div class="flex-1 relative" id="obatSearchWrapper">
              <input type="text" class="form-input" id="obatSearchInput" placeholder="Cari obat... (min 2 huruf)" autocomplete="off">
              <div id="obatDropdown" class="absolute z-10 w-full bg-white border border-slate-200 rounded-lg shadow-lg mt-1 max-h-48 overflow-y-auto" style="display:none"></div>
            </div>
            <div class="w-20">
              <input type="number" id="resepJumlah" class="form-input" placeholder="Jml" min="1" value="1">
            </div>
            <div class="flex-1">
              <input type="text" id="resepAturan" class="form-input" placeholder="Aturan pakai (3x1)">
            </div>
            <button type="button" class="btn btn-sm btn-primary" onclick="tambahResep()">Tambah</button>
          </div>
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
              <tbody id="resepTbody" class="divide-y divide-slate-200">
                <tr><td colspan="4" class="text-center py-4 text-slate-400">Belum ada obat</td></tr>
              </tbody>
            </table>
          </div>
        </div>

        <div id="tab-riwayat" class="tw-tab-content">
          <ul id="riwayatList" class="space-y-3">
            <li class="text-center py-4 text-slate-400">Memuat riwayat...</li>
          </ul>
        </div>
      </div>

      <div class="mt-8 pt-4 border-t border-slate-100 flex justify-end gap-3">
        <a href="<?= base_url('dokter/antrean') ?>" class="btn btn-outline-secondary">Kembali</a>
        <button type="button" class="btn btn-success" id="btnSimpan">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
          Simpan & Selesai
        </button>
      </div>
    </div>
  </div>
</section>

<div id="detailModalContainer"></div>

<script>
let resepItems = [];
let daftarObat = [];
let daftarICD10 = [];
let selectedObat = null;
let obatSearchTimeout = null;
let icd10SearchTimeout = null;

let daftarPasien = [];
let patientSearchTimeout = null;
let selectedPatientId = null;

function hitungUsia(tglLahir) {
    if (!tglLahir) return '-';
    const lahir = new Date(tglLahir);
    const now = new Date();
    let usia = now.getFullYear() - lahir.getFullYear();
    const m = now.getMonth() - lahir.getMonth();
    if (m < 0 || (m === 0 && now.getDate() < lahir.getDate())) usia--;
    return usia + ' Thn';
}

function loadPatientById(id) {
    if (!id) return;
    selectedPatientId = id;
    document.getElementById('patientSearchInput').value = '';
    document.getElementById('patientDropdown').style.display = 'none';
    document.getElementById('patientSearchSection').style.display = 'none';
    document.dispatchEvent(new CustomEvent('patientSelected', { detail: id }));
    fetch('/api/patients/' + id).then(r => r.json()).then(json => {
        if (json.data) {
            const pt = json.data;
            document.getElementById('patientDetailCard').style.display = 'grid';
            document.getElementById('vitalSignsSection').style.display = 'block';
            document.querySelector('.alert-secondary h6').innerHTML = pt.full_name + ' <button class="btn btn-xs btn-outline-secondary ml-2" onclick="document.getElementById(\'patientDetailCard\').style.display=\'none\';document.getElementById(\'vitalSignsSection\').style.display=\'none\';document.getElementById(\'patientSearchSection\').style.display=\'block\';document.getElementById(\'patientSearchInput\').value=\'\';selectedPatientId=null">Ganti Pasien</button>';
            document.querySelector('.alert-secondary p').textContent = 'NIK: ' + (pt.nik || '-') + ' | Kode: ' + (pt.patient_code || '-');
            document.getElementById('pNik').textContent = pt.nik || '-';
            document.getElementById('pTglLahir').textContent = formatTgl(pt.date_of_birth);
            document.getElementById('pUsia').textContent = hitungUsia(pt.date_of_birth);
            document.getElementById('pGender').textContent = pt.gender === 'L' ? 'Laki-laki' : pt.gender === 'P' ? 'Perempuan' : pt.gender || '-';
            document.getElementById('pBlood').textContent = pt.blood_type || '-';
            document.getElementById('pAllergies').textContent = pt.allergies || 'Tidak ada';
            document.getElementById('riwayatList').innerHTML = '<li class="text-center py-4 text-slate-400">Memuat riwayat medis...</li>';
            loadRiwayat(id);
            if (typeof showToast === 'function') showToast('Pasien ' + pt.full_name + ' dipilih', 'success');
        }
    }).catch(function() {
        if (typeof showToast === 'function') showToast('Gagal memuat data pasien', 'error');
    });
}

function setupPatientSearch() {
    const input = document.getElementById('patientSearchInput');
    const dropdown = document.getElementById('patientDropdown');
    if (!input) return;

    async function loadAllPatients() {
        try {
            const res = await fetch('/api/patients?all=1');
            const json = await res.json();
            daftarPasien = json.data || [];
        } catch(e) { daftarPasien = []; }
    }
    loadAllPatients();

    input.addEventListener('input', function() {
        clearTimeout(patientSearchTimeout);
        const q = this.value.trim().toLowerCase();
        if (q.length < 2) { dropdown.style.display = 'none'; return; }
        patientSearchTimeout = setTimeout(() => {
            const filtered = daftarPasien.filter(p => (p.full_name || '').toLowerCase().includes(q) || (p.nik || '').includes(q));
            if (filtered.length) {
                dropdown.innerHTML = filtered.map(p => `<div class="px-3 py-2 cursor-pointer hover:bg-klinik-light border-b border-slate-100 text-sm" data-patient-id="${p.id}">${p.full_name} (${p.nik || '-'})</div>`).join('');
                dropdown.style.display = 'block';
            } else { dropdown.style.display = 'none'; }
        }, 300);
    });

    dropdown.addEventListener('click', function(e) {
        const item = e.target.closest('[data-patient-id]');
        if (!item) return;
        const id = parseInt(item.dataset.patientId);
        const pt = daftarPasien.find(p => p.id == id);
        if (!pt) return;
        input.value = pt.full_name + ' (' + (pt.nik || '-') + ')';
        dropdown.style.display = 'none';
        loadPatientById(id);
    });

    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('patientSearchWrapper');
        if (wrapper && !wrapper.contains(e.target)) dropdown.style.display = 'none';
    });
}

function formatTgl(t) {
    if (!t) return '-';
    const d = new Date(t);
    return d.toLocaleDateString('id-ID', { year: 'numeric', month: '2-digit', day: '2-digit' });
}

function setupICD10Search() {
    const input = document.getElementById('icd10SearchInput');
    const dropdown = document.getElementById('icd10Dropdown');
    const hidden = document.getElementById('icd10Code');
    const display = document.getElementById('icd10SelectedDisplay');
    if (!input) return;

    input.addEventListener('input', function() {
        clearTimeout(icd10SearchTimeout);
        const q = this.value.trim();
        if (q.length < 2) { dropdown.style.display = 'none'; return; }
        icd10SearchTimeout = setTimeout(async () => {
            try {
                const res = await fetch('/api/icd10/search?q=' + encodeURIComponent(q));
                const json = await res.json();
                daftarICD10 = json.data || [];
                if (daftarICD10.length) {
                    dropdown.innerHTML = daftarICD10.map(d => `<div class="px-3 py-2 cursor-pointer hover:bg-klinik-light border-b border-slate-100 text-sm" onclick="pilihICD10('${d.code.replace(/'/g,"\\'")}', '${(d.description_id || d.description_en || '').replace(/'/g,"\\'")}')">${d.code} - ${d.description_id || d.description_en}</div>`).join('');
                    dropdown.style.display = 'block';
                } else { dropdown.style.display = 'none'; }
            } catch(e) { dropdown.style.display = 'none'; }
        }, 300);
    });

    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('icd10SearchWrapper');
        if (wrapper && !wrapper.contains(e.target)) dropdown.style.display = 'none';
    });
}

function pilihICD10(code, desc) {
    document.getElementById('icd10Code').value = code;
    document.getElementById('icd10SelectedDisplay').value = code + ' - ' + desc;
    document.getElementById('icd10Dropdown').style.display = 'none';
    document.getElementById('icd10SearchInput').value = '';
}

function setupObatSearch() {
    const input = document.getElementById('obatSearchInput');
    const dropdown = document.getElementById('obatDropdown');
    if (!input) return;

    async function loadAllObat() {
        try {
            const res = await fetch('/api/drugs');
            const json = await res.json();
            daftarObat = json.data || [];
        } catch(e) { daftarObat = []; }
    }
    loadAllObat();

    input.addEventListener('input', function() {
        clearTimeout(obatSearchTimeout);
        const q = this.value.trim().toLowerCase();
        if (q.length < 2) { dropdown.style.display = 'none'; return; }
        obatSearchTimeout = setTimeout(() => {
            const filtered = daftarObat.filter(o => (o.nama_obat || '').toLowerCase().includes(q) || (o.kode_obat || '').toLowerCase().includes(q));
            if (filtered.length) {
                dropdown.innerHTML = filtered.map(o => `<div class="px-3 py-2 cursor-pointer hover:bg-klinik-light border-b border-slate-100 text-sm" onclick="pilihObat(${o.id}, '${(o.nama_obat || '').replace(/'/g,"\\'")}')">${o.nama_obat} (${o.kode_obat})</div>`).join('');
                dropdown.style.display = 'block';
            } else { dropdown.style.display = 'none'; }
        }, 300);
    });

    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('obatSearchWrapper');
        if (wrapper && !wrapper.contains(e.target)) dropdown.style.display = 'none';
    });
}

function pilihObat(id, nama) {
    selectedObat = { id, nama_obat: nama };
    document.getElementById('obatSearchInput').value = nama;
    document.getElementById('obatDropdown').style.display = 'none';
}

function tambahResep() {
    if (!selectedObat) return alert('Pilih obat terlebih dahulu');
    const jumlah = document.getElementById('resepJumlah');
    const aturan = document.getElementById('resepAturan');
    const qty = parseInt(jumlah.value) || 1;
    resepItems.push({ drug_id: selectedObat.id, nama_obat: selectedObat.nama_obat, qty: qty, dosage: aturan.value || '-' });
    renderResep();
    selectedObat = null;
    document.getElementById('obatSearchInput').value = '';
    jumlah.value = '1';
    aturan.value = '';
}

function renderResep() {
    const tbody = document.getElementById('resepTbody');
    if (!tbody) return;
    if (!resepItems.length) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-slate-400">Belum ada obat</td></tr>';
        return;
    }
    tbody.innerHTML = resepItems.map((item, i) => `<tr>
        <td class="font-medium">${item.nama_obat}</td>
        <td>${item.qty}</td>
        <td>${item.dosage}</td>
        <td><button class="btn btn-sm btn-outline-danger" onclick="hapusResep(${i})">Hapus</button></td>
    </tr>`).join('');
}

function hapusResep(idx) {
    resepItems.splice(idx, 1);
    renderResep();
}

async function loadRiwayat(patientId) {
    const list = document.getElementById('riwayatList');
    if (!list) return;
    try {
        const res = await fetch('/api/medical-records');
        const json = await res.json();
        const records = (json.data || []).filter(r => r.patient_id == patientId);
        list.innerHTML = records.length ? records.map(r => `
            <li class="p-4 border border-slate-200 rounded-lg flex flex-col sm:flex-row justify-between sm:items-center gap-3 hover:bg-slate-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-klinik-light text-klinik-primary flex items-center justify-center font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <div>
                        <p class="font-bold text-slate-800 m-0">${r.visit_date ? r.visit_date.slice(0,10) : '-'}</p>
                        <p class="text-sm text-slate-500 m-0">${r.assessment || r.icd_code || '-'}</p>
                    </div>
                </div>
                <button class="badge badge-primary hover:bg-klinik-primary hover:text-white transition cursor-pointer border-0" onclick="lihatDetailRekam(${r.id})">Lihat Rekam</button>
            </li>
        `).join('') : '<li class="text-center py-4 text-slate-400">Belum ada riwayat pemeriksaan</li>';
    } catch(e) { list.innerHTML = '<li class="text-center py-4 text-red-500">Gagal memuat riwayat</li>'; }
}

async function lihatDetailRekam(recordId) {
    try {
        const res = await fetch('/api/medical-records/' + recordId);
        const json = await res.json();
        if (!json.data) return showToast('Data tidak ditemukan', 'error');
        const r = json.data;
        const container = document.getElementById('detailModalContainer');
        container.innerHTML = `
            <div class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center" onclick="if(event.target===this)document.getElementById('detailModalContainer').innerHTML=''">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="text-lg font-bold">Detail Rekam Medis</h5>
                            <button class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('detailModalContainer').innerHTML=''">Tutup</button>
                        </div>
                        <div class="space-y-3 text-sm text-slate-700">
                            <p><span class="font-bold text-slate-800">Tanggal:</span> ${r.visit_date ? r.visit_date.slice(0,16) : '-'}</p>
                            <p><span class="font-bold text-slate-800">Subjective:</span><br>${r.subjective || '-'}</p>
                            <p><span class="font-bold text-slate-800">Objective:</span><br>${r.objective || '-'}</p>
                            <p><span class="font-bold text-slate-800">Assessment:</span><br>${r.assessment || '-'}</p>
                            <p><span class="font-bold text-slate-800">ICD-10:</span> ${r.icd_code || '-'}</p>
                            <p><span class="font-bold text-slate-800">Tindakan (ICD-9CM):</span> ${r.icd9_code || '-'}</p>
                            <p><span class="font-bold text-slate-800">Biaya Tindakan:</span> Rp ${(parseFloat(r.tindakan_fee) || 0).toLocaleString('id-ID')}</p>
                            <p><span class="font-bold text-slate-800">Biaya Konsultasi:</span> Rp ${(parseFloat(r.doctor_fee) || 50000).toLocaleString('id-ID')}</p>
                            <p><span class="font-bold text-slate-800">Plan:</span><br>${r.plan || '-'}</p>
                            ${r.vital_signs ? `<p><span class="font-bold text-slate-800">Tanda Vital:</span><br>${(() => {
                                try {
                                    const v = typeof r.vital_signs === 'string' ? JSON.parse(r.vital_signs) : r.vital_signs;
                                    return Object.entries(v).map(([k, val]) => {
                                        if (!val) return null;
                                        const label = {td:'TD', suhu:'Suhu', nadi:'Nadi', nafas:'Nafas', bb:'BB', tb:'TB'}[k] || k;
                                        return label + ': ' + val;
                                    }).filter(Boolean).join(' | ');
                                } catch(e) { return r.vital_signs; }
                            })()}</p>` : ''}
                        </div>
                    </div>
                </div>
            </div>`;
    } catch(e) { showToast('Gagal memuat detail', 'error'); }
}

let daftarICD9 = [];
let icd9SearchTimeout = null;

function setupICD9Search() {
    const input = document.getElementById('icd9SearchInput');
    const dropdown = document.getElementById('icd9Dropdown');
    if (!input) return;

    input.addEventListener('input', function() {
        clearTimeout(icd9SearchTimeout);
        const q = this.value.trim();
        if (q.length < 2) { dropdown.style.display = 'none'; return; }
        icd9SearchTimeout = setTimeout(async () => {
            try {
                const res = await fetch('/api/icd9/search?q=' + encodeURIComponent(q));
                const json = await res.json();
                daftarICD9 = json.data || [];
                if (daftarICD9.length) {
                    dropdown.innerHTML = daftarICD9.map(d => `<div class="px-3 py-2 cursor-pointer hover:bg-klinik-light border-b border-slate-100 text-sm" onclick="pilihICD9('${d.code.replace(/'/g,"\\'")}', '${(d.description_id || d.description_en || '').replace(/'/g,"\\'")}')">${d.code} - ${d.description_id || d.description_en}</div>`).join('');
                    dropdown.style.display = 'block';
                } else { dropdown.style.display = 'none'; }
            } catch(e) { dropdown.style.display = 'none'; }
        }, 300);
    });

    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('icd9SearchWrapper');
        if (wrapper && !wrapper.contains(e.target)) dropdown.style.display = 'none';
    });
}

function pilihICD9(code, desc) {
    document.getElementById('icd9Code').value = code;
    document.getElementById('icd9SelectedDisplay').value = code + ' - ' + desc;
    document.getElementById('icd9Dropdown').style.display = 'none';
    document.getElementById('icd9SearchInput').value = '';
}
document.addEventListener('DOMContentLoaded', async function() {
    setupICD10Search();
    setupICD9Search();
    setupObatSearch();
    setupPatientSearch();
    const params = new URLSearchParams(window.location.search);
    const queueId = params.get('queue_id');
    let patientId = null;
    let doctorId = <?= session()->get('user_id') ?? 'null' ?>;

    if (queueId) {
        try {
            const res = await fetch('/api/queues/' + queueId);
            const json = await res.json();
            if (json.data) {
                const p = json.data;
                patientId = p.patient_id;
                doctorId = p.doctor_id || doctorId;
                document.querySelector('.alert-secondary h6').textContent = 'Identitas Pasien: #' + (p.patient_code || '-') + ' - ' + (p.patient_name || '-');
                document.querySelector('.alert-secondary p').innerHTML = 'No. Antrean: ' + (p.queue_number || '-') + ' | Poli: ' + (p.poli || '-');
                document.getElementById('patientSearchSection').style.display = 'none';
                
                // Enforce read-only for already completed or cancelled queues
                if (['completed', 'cancelled'].includes(p.status)) {
                    showToast('Pemeriksaan ini sudah selesai/batal dan tidak dapat diubah.', 'warning');
                    document.getElementById('btnSimpan').disabled = true;
                    document.getElementById('btnSimpan').classList.add('opacity-50', 'pointer-events-none');
                    // Disable all form inputs and buttons in SOAP and Resep tabs
                    document.querySelectorAll('#soapForm input, #soapForm textarea, #soapForm select, #tab-resep input, #tab-resep button').forEach(el => {
                        el.disabled = true;
                        el.classList.add('bg-slate-100', 'cursor-not-allowed');
                    });
                } else if (['waiting', 'called'].includes(p.status)) {
                    // Automatically transition queue status to 'in_progress' if currently waiting or called
                    await fetch('/api/queues/' + queueId, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ status: 'in_progress' })
                    });
                }
            }
        } catch(e) {}

        if (patientId) {
            try {
                const res = await fetch('/api/patients/' + patientId);
                const json = await res.json();
                if (json.data) {
                    const pt = json.data;
                    document.getElementById('patientDetailCard').style.display = 'grid';
                    document.getElementById('vitalSignsSection').style.display = 'block';
                    document.getElementById('pNik').textContent = pt.nik || '-';
                    document.getElementById('pTglLahir').textContent = formatTgl(pt.date_of_birth);
                    document.getElementById('pUsia').textContent = hitungUsia(pt.date_of_birth);
                    document.getElementById('pGender').textContent = pt.gender === 'L' ? 'Laki-laki' : pt.gender === 'P' ? 'Perempuan' : pt.gender || '-';
                    document.getElementById('pBlood').textContent = pt.blood_type || '-';
                    document.getElementById('pAllergies').textContent = pt.allergies || 'Tidak ada';
                    
                    document.getElementById('riwayatList').innerHTML = '<li class="text-center py-4 text-slate-400">Memuat riwayat medis...</li>';
                    loadRiwayat(patientId);
                }
                
                // Load existing pending prescription if any for edit resep support
                const rxRes = await fetch('/api/prescriptions');
                const rxJson = await rxRes.json();
                const rxList = rxJson.data || [];
                const existingRx = rxList.find(r => r.medical_record_id === null && r.patient_id == patientId && r.status === 'pending');
                if (existingRx) {
                    resepItems = (existingRx.items || []).map(item => ({
                        drug_id: item.drug_id,
                        nama_obat: item.drug_name,
                        qty: item.qty,
                        dosage: item.dosage || '-'
                    }));
                    renderResep();
                    window.existingPrescriptionId = existingRx.id;
                    showToast('Memuat resep tersimpan (status pending) untuk diedit.', 'info');
                }
            } catch(e) {}
        } else {
            document.querySelector('.alert-secondary h6').textContent = 'Data pasien tidak ditemukan';
        }
    } else {
        document.querySelector('.alert-secondary h6').textContent = 'Silakan pilih pasien terlebih dahulu';
        document.querySelector('.alert-secondary p').textContent = 'Gunakan pencarian di atas untuk memilih pasien';
    }

    document.addEventListener('patientSelected', function(e) {
        patientId = e.detail;
    });

    document.getElementById('btnSimpan').addEventListener('click', async function() {
        const activePatientId = patientId || selectedPatientId;
        if (!activePatientId) return showToast('Silakan pilih pasien terlebih dahulu', 'error');
        
        // Form fields validation
        const subjective = document.getElementById('soapSubjective').value.trim();
        const assessment = document.getElementById('soapAssessment').value.trim();
        
        if (!subjective) {
            return showToast('Keluhan Pasien (Subjective) wajib diisi!', 'warning');
        }
        if (!assessment) {
            return showToast('Diagnosa / Penilaian (Assessment) wajib diisi!', 'warning');
        }

        this.disabled = true;
        this.innerHTML = '<span class="loading-spinner"></span> Menyimpan...';
        const vitalSigns = {
            td: document.getElementById('vitalTd').value || '',
            suhu: document.getElementById('vitalSuhu').value || '',
            nadi: document.getElementById('vitalNadi').value || '',
            nafas: document.getElementById('vitalNafas').value || '',
            bb: document.getElementById('vitalBb').value || '',
            tb: document.getElementById('vitalTb').value || ''
        };
        const hasVitals = Object.values(vitalSigns).some(v => v !== '');
        const icdCode = document.getElementById('icd10Code').value || '';
        const icd9Code = document.getElementById('icd9Code').value || '';
        const tindakanFee = parseFloat(document.getElementById('tindakanFee').value) || 0;
        const doctorFee = parseFloat(document.getElementById('doctorFee').value) || 50000;

        const formData = {
            patient_id: activePatientId,
            doctor_id: doctorId,
            queue_id: queueId || '',
            subjective: subjective,
            objective: document.getElementById('soapObjective').value || '',
            assessment: assessment,
            icd_code: icdCode,
            icd9_code: icd9Code,
            tindakan_fee: tindakanFee,
            doctor_fee: doctorFee,
            plan: document.getElementById('soapPlan').value || '',
            vital_signs: hasVitals ? JSON.stringify(vitalSigns) : null
        };
        try {
            const res = await fetch('/api/medical-records', { method:'POST', headers:{'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'}, body: JSON.stringify(formData) });
            const json = await res.json();
            if (!res.ok) { showToast(json.error || 'Gagal menyimpan rekam medis', 'error'); this.disabled = false; this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg> Simpan & Selesai'; return; }
            const medRecId = json.data;
            if (resepItems.length > 0 && medRecId) {
                let prescRes;
                if (window.existingPrescriptionId) {
                    prescRes = await fetch('/api/prescriptions/' + window.existingPrescriptionId, { 
                        method: 'PUT', 
                        headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, 
                        body: JSON.stringify({ patient_id: activePatientId, doctor_id: doctorId, medical_record_id: medRecId, items: resepItems }) 
                    });
                } else {
                    prescRes = await fetch('/api/prescriptions', { 
                        method: 'POST', 
                        headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, 
                        body: JSON.stringify({ patient_id: activePatientId, doctor_id: doctorId, medical_record_id: medRecId, items: resepItems }) 
                    });
                }
                const prescJson = await prescRes.json();
                if (!prescRes.ok) { 
                    showToast('Rekam medis tersimpan, tapi resep gagal: ' + (prescJson.error || ''), 'warning'); 
                } else { 
                    showToast('Rekam medis dan resep tersimpan', 'success'); 
                }
            } else { 
                showToast('Rekam medis tersimpan', 'success'); 
            }
            setTimeout(() => {
                window.location.href = '<?= base_url("dokter/antrean") ?>';
            }, 1000);
        } catch(e) { showToast('Network error', 'error'); this.disabled = false; this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg> Simpan & Selesai'; }
    });
});
</script>
<?= $this->endSection() ?>
