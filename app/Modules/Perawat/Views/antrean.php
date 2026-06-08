<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Antrean Pasien — Perawat</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Perawat</li>
      <li class="active">Antrean</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title flex items-center gap-2">
        Daftar Antrean Hari Ini
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-klinik-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      </h5>

      <div class="overflow-x-auto border border-slate-200 rounded-lg">
        <table class="tw-table m-0">
          <thead class="bg-slate-50">
            <tr>
              <th>No. Antrean</th>
              <th>Nama Pasien</th>
              <th>Jenis Kunjungan</th>
              <th>Dokter</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            <tr><td colspan="6" class="text-center py-4 text-slate-400">Memuat data...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
async function loadQueueTable() {
    const tbody = document.querySelector('.tw-table tbody');
    if (!tbody) return;
    try {
        const res = await fetch('/api/perawat/queues');
        const json = await res.json();
        const list = json.data || [];
        tbody.innerHTML = list.length ? list.map(q => {
            const statusMap = { 'waiting': 'warning', 'called': 'info', 'in_progress': 'primary', 'nurse_call': 'danger', 'completed': 'success', 'cancelled': 'danger' };
            const badge = statusMap[q.status] || 'secondary';
            const label = q.status === 'waiting' ? 'Menunggu' : q.status === 'called' ? 'Dipanggil' : q.status === 'nurse_call' ? 'Butuh Perawat' : q.status === 'completed' ? 'Selesai' : q.status;
            const disabled = !['waiting', 'in_progress', 'nurse_call'].includes(q.status) ? 'opacity-50 pointer-events-none' : '';
            const visitLabels = { 'rawat_jalan': 'Rawat Jalan', 'rawat_inap': 'Rawat Inap', 'gawat_darurat': 'IGD', 'kontrol': 'Kontrol', 'rujukan': 'Rujukan' };
            const visitLabel = visitLabels[q.visit_type] || q.visit_type || 'Rawat Jalan';
            return `<tr>
                <td class="font-bold text-klinik-primary">${q.queue_number || '-'}</td>
                <td class="font-medium">${q.patient_name || '-'}</td>
                <td><span class="badge bg-purple-50 text-purple-600 border border-purple-200">${visitLabel}</span></td>
                <td>${q.doctor_name || '-'}</td>
                <td><span class="badge badge-${badge}">${label}</span></td>
                <td class="flex gap-2">
                    <a href="<?= base_url('perawat/periksa') ?>?queue_id=${q.id}" class="btn btn-sm btn-primary ${q.status === 'completed' ? 'opacity-50 pointer-events-none' : ''}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                        Periksa
                    </a>
                </td>
            </tr>`;
        }).join('') : '<tr><td colspan="6" class="text-center py-4 text-slate-400">Tidak ada antrean hari ini</td></tr>';
    } catch(e) { tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>'; }
}
document.addEventListener('DOMContentLoaded', function() {
    loadQueueTable();
    setInterval(loadQueueTable, 5000);
});
</script>
<?= $this->endSection() ?>
