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
        <div class="alert alert-secondary flex items-start gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 text-slate-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          <div>
            <h6 class="font-bold text-slate-800 mb-1" id="patientIdentity">Memuat data pasien...</h6>
            <p class="text-sm m-0" id="patientDetail">Nomor Antrean: -</p>
          </div>
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
          <button class="btn btn-primary w-full justify-center" id="btnSimpanVital">
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
document.addEventListener('DOMContentLoaded', async function() {
    const params = new URLSearchParams(window.location.search);
    const queueId = params.get('queue_id');
    if (!queueId) return;

    let patientId = null;
    try {
        const res = await fetch('/api/perawat/queues/' + queueId);
        const json = await res.json();
        if (json.data) {
            const q = json.data;
            patientId = q.patient_id;
            document.getElementById('patientIdentity').textContent = q.patient_name + ' (' + q.gender + ')';
            const visitLabels = { 'rawat_jalan': 'Rawat Jalan', 'rawat_inap': 'Rawat Inap', 'gawat_darurat': 'IGD', 'kontrol': 'Kontrol', 'rujukan': 'Rujukan' };
            const visitLabel = visitLabels[q.visit_type] || q.visit_type || 'Rawat Jalan';
            document.getElementById('patientDetail').textContent = 'No. Antrean: ' + q.queue_number + ' | ' + visitLabel + ' | NIK: ' + (q.nik ? q.nik.slice(0,8)+'****' : '-');
            if (q.blood_type) document.getElementById('patientDetail').textContent += ' | Gol. Darah: ' + q.blood_type;
        }
    } catch(e) {}

    document.getElementById('btnSimpanVital')?.addEventListener('click', async function() {
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
                    patient_id: patientId,
                    queue_id: queueId,
                    vital_signs: vitalSigns
                })
            });
            const json = await res.json();
            if (res.ok) {
                await fetch('/api/perawat/queues/' + queueId, {
                    method: 'PUT',
                    headers: {'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'},
                    body: JSON.stringify({ status: 'in_progress', nurse_id: <?= session()->get('user_id') ?? 0 ?> })
                });
                alert('Data vital tersimpan. Pasien siap diperiksa dokter.');
                window.location.href = '<?= base_url("perawat/antrean") ?>';
            } else {
                alert(json.error || 'Gagal menyimpan');
            }
        } catch(e) { alert('Network error'); }
    });
});
</script>
<?= $this->endSection() ?>
