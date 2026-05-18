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
              <th>Waktu Daftar</th>
              <th>Waktu Tunggu</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="font-bold text-klinik-primary">B-021</td>
              <td class="font-medium">Budi Santoso</td>
              <td>14:05</td>
              <td>15 Min</td>
              <td><span class="badge badge-info">Siap Dipanggil</span></td>
              <td class="flex gap-2">
                <button class="btn btn-sm btn-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                  Panggil
                </button>
                <a href="<?= base_url('dokter/soap') ?>" class="btn btn-sm btn-success">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                  Periksa
                </a>
              </td>
            </tr>
            <tr>
              <td class="font-bold text-slate-500">B-022</td>
              <td class="font-medium">Siti Aminah</td>
              <td>14:10</td>
              <td>10 Min</td>
              <td><span class="badge badge-warning">Antre</span></td>
              <td class="flex gap-2">
                <button class="btn btn-sm btn-secondary opacity-50 cursor-not-allowed">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                  Panggil
                </button>
                <button class="btn btn-sm btn-success opacity-50 cursor-not-allowed">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                  Periksa
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', async function() {
    const tbody = document.querySelector('.tw-table tbody');
    if (!tbody) return;
    try {
        const res = await fetch('/api/queues');
        const json = await res.json();
        const list = json.data || [];
        tbody.innerHTML = list.length ? list.map(q => {
            const statusMap = { 'waiting': 'warning', 'called': 'info', 'in_progress': 'primary', 'completed': 'success', 'cancelled': 'danger' };
            const badge = statusMap[q.status] || 'secondary';
            const label = q.status === 'waiting' ? 'Menunggu' : q.status === 'called' ? 'Dipanggil' : q.status === 'completed' ? 'Selesai' : q.status;
            const disabled = q.status !== 'waiting' ? 'opacity-50 pointer-events-none' : '';
            return `<tr>
                <td class="font-bold text-klinik-primary">${q.queue_number || '-'}</td>
                <td class="font-medium">${q.patient_name || '-'}</td>
                <td>${q.created_at ? q.created_at.slice(11,16) : '-'}</td>
                <td class="text-sm">${q.loket || '-'}</td>
                <td><span class="badge badge-${badge}">${label}</span></td>
                <td class="flex gap-2">
                    <button class="btn btn-sm btn-primary ${disabled}" onclick="panggilPasien('${q.id}')" ${q.status !== 'waiting' ? 'disabled' : ''}>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                        Panggil
                    </button>
                    <a href="<?= base_url('dokter/soap') ?>?queue_id=${q.id}" class="btn btn-sm btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        Periksa
                    </a>
                </td>
            </tr>`;
        }).join('') : '<tr><td colspan="6" class="text-center py-4 text-slate-400">Tidak ada antrean</td></tr>';
    } catch(e) { tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>'; }
    setInterval(async () => {
        try {
            const res = await fetch('/api/queues');
            const json = await res.json();
            const list = json.data || [];
            const rows = tbody.querySelectorAll('tr');
            list.forEach((q, i) => {
                if (rows[i]) {
                    const statusLabel = q.status === 'waiting' ? 'Menunggu' : q.status === 'called' ? 'Dipanggil' : q.status === 'completed' ? 'Selesai' : q.status;
                    const statusMap2 = { 'waiting': 'warning', 'called': 'info', 'completed': 'success' };
                    const badge2 = statusMap2[q.status] || 'secondary';
                    const tds = rows[i].querySelectorAll('td');
                    if (tds[3]) tds[3].textContent = q.loket || '-';
                    if (tds[4]) tds[4].innerHTML = '<span class="badge badge-' + badge2 + '">' + statusLabel + '</span>';
                }
            });
        } catch(e) {}
    }, 3000);
});
async function panggilPasien(id) {
    try {
        const res = await fetch('/api/queues/' + id, { method:'PUT', headers:{'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'}, body: JSON.stringify({ status:'called', loket: 'Loket Dokter', called_at: new Date().toISOString().slice(0,19).replace('T',' ') }) });
        const json = await res.json();
        if (res.ok) { alert('Pasien dipanggil'); setTimeout(() => location.reload(), 10000); }
        else { alert(json.error || 'Gagal'); }
    } catch(e) { alert('Gagal memanggil pasien'); }
}
</script>
<?= $this->endSection() ?>
