<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Daftar Tunggu Pasien (Queuing)</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Dokter</li>
      <li class="active">Daftar Tunggu</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Antrean Poli Anda <span class="badge badge-primary ml-2">Poli Umum</span></h5>
      
      <div class="overflow-x-auto">
        <table class="tw-table">
          <thead>
            <tr>
              <th>No. Antrean</th>
              <th>Nama Pasien</th>
              <th>Poli</th>
              <th>Kunjungan</th>
              <th>Waktu Daftar</th>
              <th>Loket</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr><td colspan="8" class="text-center py-4 text-slate-400">Memuat data...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<div id="loketPicker"></div>
<script>
let LOKETS_DOKTER = [];

async function loadDokterLokets() {
    try {
        const res = await fetch('/api/perawat/lokets');
        const json = await res.json();
        LOKETS_DOKTER = (json.data || []).filter(l => l.is_active != 0);
    } catch(e) { LOKETS_DOKTER = []; }
}

async function loadQueueTable() {
    const tbody = document.querySelector('.tw-table tbody');
    if (!tbody) return;
    try {
        const res = await fetch('/api/queues');
        const json = await res.json();
        const list = json.data || [];
        
        window.paginateTable('.tw-table', list, 10, q => {
            const statusMap = { 'waiting': 'warning', 'called': 'info', 'in_progress': 'primary', 'completed': 'success', 'cancelled': 'danger' };
            const badge = statusMap[q.status] || 'secondary';
            const label = q.status === 'waiting' ? 'Menunggu' : q.status === 'called' ? 'Dipanggil' : q.status === 'completed' ? 'Selesai' : q.status === 'in_progress' ? 'Diperiksa' : q.status === 'cancelled' ? 'Batal' : q.status;
            const disabled = q.status !== 'waiting' ? 'opacity-50 pointer-events-none' : '';
            const disabledPeriksa = ['waiting', 'completed', 'cancelled'].includes(q.status) ? 'opacity-50 pointer-events-none' : '';
            const visitLabels = { 'rawat_jalan': 'Rawat Jalan', 'rawat_inap': 'Rawat Inap', 'gawat_darurat': 'IGD', 'kontrol': 'Kontrol', 'rujukan': 'Rujukan' };
            const visitLabel = visitLabels[q.visit_type] || q.visit_type || 'Rawat Jalan';
            return `<tr>
                <td class="font-bold text-klinik-primary">${q.queue_number || '-'}</td>
                <td class="font-medium">${q.patient_name || '-'}</td>
                <td class="text-sm">${q.poli || '-'}</td>
                <td><span class="badge bg-purple-50 text-purple-600 border border-purple-200 text-xs">${visitLabel}</span></td>
                <td>${q.created_at ? q.created_at.slice(11,16) : '-'}</td>
                <td class="text-sm">${q.loket || '-'}</td>
                <td><span class="badge badge-${badge}">${label}</span></td>
                <td class="flex gap-2">
                    <button class="btn btn-sm btn-primary ${disabled}" onclick="showLoketPicker('${q.id}','${(q.patient_name || '').replace(/'/g,"\\'")}')" ${q.status !== 'waiting' ? 'disabled' : ''}>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                        Panggil
                    </button>
                    <a href="<?= base_url('dokter/soap') ?>?queue_id=${q.id}" class="btn btn-sm btn-success ${disabledPeriksa}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        Periksa
                    </a>
                </td>
            </tr>`;
        });
    } catch(e) { tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>'; }
}

function showLoketPicker(id, patientName) {
    if (!LOKETS_DOKTER.length) return window.showToast('Tidak ada loket tersedia', 'warning');
    const container = document.getElementById('loketPicker');
    container.innerHTML = `
        <div class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center animate-fade-in" onclick="if(event.target===this)document.getElementById('loketPicker').innerHTML=''">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6 modal-content" onclick="event.stopPropagation()">
                <h5 class="text-lg font-bold mb-4">Panggil ${patientName} ke Loket</h5>
                <div class="space-y-2">
                    ${LOKETS_DOKTER.map(l => `<button class="btn btn-outline-primary w-full justify-start text-left py-3" onclick="panggilPasien('${id}','${l.name}')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        ${l.name}
                    </button>`).join('')}
                </div>
                <button class="btn btn-outline-secondary w-full mt-4" onclick="document.getElementById('loketPicker').innerHTML=''">Batal</button>
            </div>
        </div>`;
}

async function panggilPasien(id, loketName) {
    try {
        const res = await fetch('/api/queues/' + id, { method:'PUT', headers:{'Content-Type':'application/json'}, body: JSON.stringify({ status:'called', loket: loketName || 'Loket Dokter', called_at: new Date().toISOString().slice(0,19).replace('T',' ') }) });
        const json = await res.json();
        if (res.ok) { window.showToast('Pasien dipanggil ke ' + loketName, 'success'); loadQueueTable(); }
        else { window.showToast(json.error || 'Gagal memanggil pasien', 'error'); }
    } catch(e) { window.showToast('Gagal memanggil pasien', 'error'); }
    document.getElementById('loketPicker').innerHTML = '';
}

document.addEventListener('DOMContentLoaded', async function() {
    await loadDokterLokets();
    loadQueueTable();
    setInterval(loadQueueTable, 5000);
    setInterval(loadDokterLokets, 30000);
});
</script>
<?= $this->endSection() ?>
