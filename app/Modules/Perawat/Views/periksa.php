<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Pemeriksaan Awal Pasien</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li><a href="<?= base_url('perawat/antrean') ?>">Perawat</a></li>
      <li class="active">Pemeriksaan Awal</li>
    </ol>
  </nav>
</div>

<section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
  <div class="lg:col-span-2 space-y-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Data Pasien</h5>

        <div class="mb-4" id="patientSearchSection">
          <div class="relative" id="patientSearchWrapper">
            <input type="text" class="form-input" id="patientSearchInput" placeholder="Cari pasien berdasarkan nama atau NIK..." autocomplete="off">
            <div id="patientDropdown" class="absolute z-10 w-full bg-white border border-slate-200 rounded-lg shadow-lg mt-1 max-h-48 overflow-y-auto" style="display:none"></div>
          </div>
        </div>

        <div class="alert alert-secondary flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-slate-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          <div>
            <h6 class="font-bold text-slate-800 mb-1" id="patientIdentity">Pilih pasien terlebih dahulu</h6>
            <p class="text-sm m-0" id="patientDetail">Gunakan pencarian di atas atau pilih dari antrean</p>
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

        <h5 class="card-title mt-6">Tanda Vital (Vital Signs)</h5>
        <form class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <div>
            <label class="form-label">Tekanan Darah (mmHg)</label>
            <input type="text" class="form-input" id="td" placeholder="120/80">
          </div>
          <div>
            <label class="form-label">Suhu (°C)</label>
            <input type="text" class="form-input" id="suhu" placeholder="36.5">
          </div>
          <div>
            <label class="form-label">Nadi (x/menit)</label>
            <input type="number" class="form-input" id="nadi" placeholder="80">
          </div>
          <div>
            <label class="form-label">Pernapasan (x/menit)</label>
            <input type="number" class="form-input" id="nafas" placeholder="20">
          </div>
          <div>
            <label class="form-label">Berat Badan (kg)</label>
            <input type="text" class="form-input" id="bb" placeholder="65">
          </div>
          <div>
            <label class="form-label">Tinggi Badan (cm)</label>
            <input type="text" class="form-input" id="tb" placeholder="170">
          </div>
          <div>
            <label class="form-label">Gula Darah (mg/dL)</label>
            <input type="text" class="form-input" id="gds" placeholder="100">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="space-y-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Aksi</h5>
        <div class="space-y-3">
          <button class="btn btn-primary w-full justify-center" id="btnSimpanVital" disabled>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
            Simpan & Lanjutkan
          </button>
          <a href="<?= base_url('perawat/antrean') ?>" class="btn btn-outline-secondary w-full justify-center">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
let daftarPasien = [];
let selectedPatientId = null;
let patientSearchTimeout = null;
let currentQueueId = null;

function hitungUsia(tglLahir) {
    if (!tglLahir) return '-';
    const lahir = new Date(tglLahir);
    const now = new Date();
    let usia = now.getFullYear() - lahir.getFullYear();
    const m = now.getMonth() - lahir.getMonth();
    if (m < 0 || (m === 0 && now.getDate() < lahir.getDate())) usia--;
    return usia + ' Thn';
}

function formatTgl(t) {
    if (!t) return '-';
    const d = new Date(t);
    return d.toLocaleDateString('id-ID', { year: 'numeric', month: '2-digit', day: '2-digit' });
}

function loadPatientById(id) {
    if (!id) return;
    selectedPatientId = id;
    document.getElementById('patientSearchInput').value = '';
    document.getElementById('patientDropdown').style.display = 'none';
    document.getElementById('patientSearchSection').style.display = 'none';
    document.getElementById('patientDetailCard').style.display = 'grid';
    document.getElementById('btnSimpanVital').disabled = false;
    fetch('/api/patients/' + id).then(r => r.json()).then(json => {
        if (json.data) {
            const pt = json.data;
            document.getElementById('patientIdentity').innerHTML = pt.full_name + ' <button class="btn btn-xs btn-outline-secondary ml-2" onclick="gantiPasien()">Ganti Pasien</button>';
            document.getElementById('patientDetail').textContent = 'NIK: ' + (pt.nik || '-') + ' | Kode: ' + (pt.patient_code || '-');
            document.getElementById('pNik').textContent = pt.nik || '-';
            document.getElementById('pTglLahir').textContent = formatTgl(pt.date_of_birth);
            document.getElementById('pUsia').textContent = hitungUsia(pt.date_of_birth);
            document.getElementById('pGender').textContent = pt.gender === 'L' ? 'Laki-laki' : pt.gender === 'P' ? 'Perempuan' : pt.gender || '-';
            document.getElementById('pBlood').textContent = pt.blood_type || '-';
            document.getElementById('pAllergies').textContent = pt.allergies || 'Tidak ada';
        }
    }).catch(function() {});
}

function gantiPasien() {
    selectedPatientId = null;
    document.getElementById('patientDetailCard').style.display = 'none';
    document.getElementById('patientSearchSection').style.display = 'block';
    document.getElementById('patientSearchInput').value = '';
    document.getElementById('patientIdentity').textContent = 'Pilih pasien terlebih dahulu';
    document.getElementById('patientDetail').textContent = 'Gunakan pencarian di atas atau pilih dari antrean';
    document.getElementById('btnSimpanVital').disabled = true;
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

document.addEventListener('DOMContentLoaded', async function() {
    setupPatientSearch();
    const params = new URLSearchParams(window.location.search);
    const queueId = params.get('queue_id');

    if (queueId) {
        currentQueueId = queueId;
        try {
            const res = await fetch('/api/perawat/queues/' + queueId);
            const json = await res.json();
            if (json.data) {
                const q = json.data;
                selectedPatientId = q.patient_id;
                loadPatientById(selectedPatientId);
                document.getElementById('patientSearchSection').style.display = 'none';
                const visitLabels = { 'rawat_jalan': 'Rawat Jalan', 'rawat_inap': 'Rawat Inap', 'gawat_darurat': 'IGD', 'kontrol': 'Kontrol', 'rujukan': 'Rujukan' };
                const visitLabel = visitLabels[q.visit_type] || q.visit_type || 'Rawat Jalan';
                document.getElementById('patientDetail').textContent = 'No. Antrean: ' + q.queue_number + ' | ' + visitLabel + ' | NIK: ' + (q.nik ? q.nik.slice(0,8)+'****' : '-');
                if (q.blood_type) document.getElementById('patientDetail').textContent += ' | Gol. Darah: ' + q.blood_type;
            }
        } catch(e) {}
    }

    document.getElementById('btnSimpanVital')?.addEventListener('click', async function() {
        if (!selectedPatientId) return alert('Pilih pasien terlebih dahulu');
        this.disabled = true;
        this.innerHTML = '<span class="loading-spinner"></span> Menyimpan...';
        const vitalSigns = JSON.stringify({
            TD: document.getElementById('td')?.value || '',
            Suhu: document.getElementById('suhu')?.value || '',
            Nadi: document.getElementById('nadi')?.value || '',
            Nafas: document.getElementById('nafas')?.value || '',
            BB: document.getElementById('bb')?.value || '',
            TB: document.getElementById('tb')?.value || '',
            GDS: document.getElementById('gds')?.value || ''
        });
        try {
            const res = await fetch('/api/perawat/medical-records', {
                method: 'POST',
                headers: {'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'},
                body: JSON.stringify({
                    patient_id: selectedPatientId,
                    queue_id: currentQueueId || null,
                    vital_signs: vitalSigns
                })
            });
            const json = await res.json();
            if (res.ok) {
                if (currentQueueId) {
                    await fetch('/api/perawat/queues/' + currentQueueId, {
                        method: 'PUT',
                        headers: {'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'},
                        body: JSON.stringify({ status: 'in_progress', nurse_id: <?= session()->get('user_id') ?? 0 ?> })
                    });
                }
                alert('Data vital tersimpan. Pasien siap diperiksa dokter.');
                window.location.href = '<?= base_url("perawat/antrean") ?>';
            } else {
                alert(json.error || 'Gagal menyimpan');
                this.disabled = false;
                this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg> Simpan & Lanjutkan';
            }
        } catch(e) { alert('Network error'); this.disabled = false; this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg> Simpan & Lanjutkan'; }
    });
});
</script>
<?= $this->endSection() ?>