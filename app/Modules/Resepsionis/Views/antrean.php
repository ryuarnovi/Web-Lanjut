<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Antrean Pendaftaran & Layanan</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Resepsionis</li>
      <li class="active">Antrean</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title flex items-center gap-2">
        Monitor Antrean Real-Time 
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-klinik-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      </h5>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 mt-2">
         <div class="p-6 rounded-2xl bg-klinik-primary text-white shadow-lg text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-20">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
            </div>
            <h3 class="font-semibold text-white/80 uppercase tracking-wider text-sm mb-2 relative z-10">Pendaftaran</h3>
            <h1 class="text-6xl font-bold mb-2 relative z-10">A-042</h1>
            <p class="m-0 text-white/70 text-sm relative z-10">Silahkan menuju Loket 1</p>
         </div>
         <div class="p-6 rounded-2xl bg-green-500 text-white shadow-lg text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-20">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
            </div>
            <h3 class="font-semibold text-white/80 uppercase tracking-wider text-sm mb-2 relative z-10">Poli Umum</h3>
            <h1 class="text-6xl font-bold mb-2 relative z-10">B-021</h1>
            <p class="m-0 text-white/70 text-sm relative z-10">Silahkan menuju Ruang 1</p>
         </div>
         <div class="p-6 rounded-2xl bg-cyan-500 text-white shadow-lg text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-20">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <h3 class="font-semibold text-white/80 uppercase tracking-wider text-sm mb-2 relative z-10">Poli Gigi</h3>
            <h1 class="text-6xl font-bold mb-2 relative z-10">C-005</h1>
            <p class="m-0 text-white/70 text-sm relative z-10">Silahkan menuju Ruang 2</p>
         </div>
      </div>

      <div class="overflow-x-auto border border-slate-200 rounded-lg">
        <table class="tw-table m-0">
          <thead class="bg-slate-50">
            <tr>
              <th>No. Antrean</th>
              <th>Jenis</th>
              <th>Waktu Daftar</th>
              <th>Estimasi Panggil</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            <tr>
              <td class="font-bold text-klinik-primary text-lg">A-043</td>
              <td class="font-medium text-slate-700">Pendaftaran</td>
              <td>14:10</td>
              <td class="text-amber-600 font-medium">~5 Menit</td>
              <td><span class="badge badge-warning">Menunggu</span></td>
              <td>
                <button class="btn btn-sm btn-primary p-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                </button>
              </td>
            </tr>
            <tr>
              <td class="font-bold text-slate-400 text-lg">A-042</td>
              <td class="font-medium text-slate-700">Pendaftaran</td>
              <td>14:05</td>
              <td class="text-green-600 font-medium">Panggil Sekarang</td>
              <td><span class="badge badge-info">Dipanggil</span></td>
              <td>
                <button class="btn btn-sm btn-primary p-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<style>
.loket-panel { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:24px }
.loket-card { border-radius:16px; padding:20px; text-align:center; transition:all .3s; border:2px solid transparent }
.loket-card.available { background:#f0fdf4; border-color:#86efac; color:#166534 }
.loket-card.busy { background:#fef2f2; border-color:#fca5a5; color:#991b1b; animation:pulse 1.5s infinite }
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.7} }
.loket-nomor { font-size:2.5rem; font-weight:800; margin:4px 0 }
.loket-pasien { font-size:1.1rem; font-weight:600 }
.loket-timer { font-size:2rem; font-weight:700; font-variant-numeric:tabular-nums }
.loket-status { display:inline-block; padding:4px 12px; border-radius:999px; font-size:.75rem; font-weight:600; text-transform:uppercase }
.loket-card.available .loket-status { background:#bbf7d0; color:#166534 }
.loket-card.busy .loket-status { background:#fecaca; color:#991b1b }
</style>

<section id="loketMonitor" class="mb-8"></section>

<script>
const LOKETS = [
    { id:1, name:'Loket 1', status:'available', queueId:null, queueNumber:null, patientName:null, timer:null, remaining:0 },
    { id:2, name:'Loket 2', status:'available', queueId:null, queueNumber:null, patientName:null, timer:null, remaining:0 },
    { id:3, name:'Loket 3', status:'available', queueId:null, queueNumber:null, patientName:null, timer:null, remaining:0 }
];

function renderLoketPanel() {
    const container = document.getElementById('loketMonitor');
    container.innerHTML = `<h5 class="card-title mb-4 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-klinik-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
        Monitor Loket Real-Time
    </h5>
    <div class="loket-panel">` + LOKETS.map(l => {
        const isAvail = l.status === 'available';
        return `<div class="loket-card ${isAvail ? 'available' : 'busy'}">
            <div class="loket-status">${isAvail ? 'Tersedia' : 'Sibuk'}</div>
            <div class="loket-nomor">${l.name}</div>
            ${isAvail
                ? `<p style="margin:12px 0 0;opacity:.7">Menunggu antrean</p>`
                : `<div class="loket-pasien">${l.patientName || '-'}</div>
                   <div style="font-size:.85rem;margin:4px 0">${l.queueNumber || ''}</div>
                   <div class="loket-timer" id="timer-${l.id}">${l.remaining}s</div>
                   <div style="width:100%;height:4px;background:#e5e7eb;border-radius:2px;margin-top:8px;overflow:hidden">
                       <div id="progress-${l.id}" style="height:100%;background:#ef4444;border-radius:2px;transition:width 1s linear;width:${(l.remaining/10)*100}%"></div>
                   </div>`
            }
        </div>`;
    }).join('') + `</div>`;
}

function getAvailableLoket() {
    return LOKETS.find(l => l.status === 'available');
}

function startLoketTimer(loket, queueId, queueNumber, patientName, remaining) {
    loket.status = 'busy';
    loket.queueId = queueId;
    loket.queueNumber = queueNumber;
    loket.patientName = patientName;
    loket.remaining = remaining != null ? remaining : 10;
    renderLoketPanel();

    if (loket.timer) clearInterval(loket.timer);
    const maxDur = 10;
    loket.timer = setInterval(async () => {
        loket.remaining--;
        const timerEl = document.getElementById('timer-' + loket.id);
        const progEl = document.getElementById('progress-' + loket.id);
        if (timerEl) timerEl.textContent = loket.remaining + 's';
        if (progEl) progEl.style.width = (loket.remaining / maxDur * 100) + '%';

        if (loket.remaining <= 0) {
            clearInterval(loket.timer);
            loket.timer = null;
            try {
                await fetch('/api/queues/' + queueId, { method:'PUT', headers:{'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'}, body: JSON.stringify({ status:'completed' }) });
            } catch(e) {}
            loket.status = 'available';
            loket.queueId = null;
            loket.queueNumber = null;
            loket.patientName = null;
            renderLoketPanel();
            loadQueueTable();
        }
    }, 1000);
}

async function loadQueueTable() {
    const tbody = document.querySelector('.tw-table tbody');
    if (!tbody) return;
    try {
        const res = await fetch('/api/queues');
        const json = await res.json();
        const list = json.data || [];
        const now = Date.now();

        // Reset all lokets first, then re-assign from DB
        LOKETS.forEach(l => {
            if (l.timer) clearInterval(l.timer);
            l.timer = null;
            l.status = 'available';
            l.queueId = null;
            l.queueNumber = null;
            l.patientName = null;
            l.remaining = 0;
        });

        // Assign called queues to their lokets
        list.forEach(q => {
            if (q.loket && q.status === 'called') {
                const loket = LOKETS.find(l => l.name === q.loket);
                if (loket) {
                    loket.status = 'busy';
                    loket.queueId = q.id;
                    loket.queueNumber = q.queue_number;
                    loket.patientName = q.patient_name;
                    const calledAt = q.called_at ? new Date(q.called_at).getTime() : now;
                    const elapsed = Math.floor((now - calledAt) / 1000);
                    loket.remaining = Math.max(0, 10 - elapsed);
                    startLoketTimer(loket, q.id, q.queue_number, q.patient_name, loket.remaining);
                }
            }
        });

        // Update counter cards — only if called/waiting queues exist, keep hardcoded fallback
        const cardTitles = document.querySelectorAll('h1.text-6xl.font-bold.mb-2');
        if (cardTitles.length >= 3) {
            const waiting = list.filter(q => q.status === 'waiting');
            const called = list.filter(q => q.status === 'called' && q.loket);
            const lokets = ['Loket 1', 'Loket 2', 'Loket 3'];
            for (let i = 0; i < 3; i++) {
                const qCalled = called.find(q => q.loket === lokets[i]);
                const qWaiting = waiting[i];
                const next = qCalled || qWaiting;
                if (next) cardTitles[i].textContent = next.queue_number;
            }
        }

        renderLoketPanel();

        tbody.innerHTML = list.length ? list.map(q => {
            const statusMap = { 'waiting': 'warning', 'called': 'info', 'in_progress': 'primary', 'completed': 'success', 'cancelled': 'danger' };
            const badge = statusMap[q.status] || 'secondary';
            const label = q.status === 'waiting' ? 'Menunggu' : q.status === 'called' ? 'Dipanggil' : q.status === 'completed' ? 'Selesai' : q.status;
            const disabled = q.status === 'completed' || q.status === 'called' ? 'opacity-50 pointer-events-none' : '';
            return `<tr>
                <td class="font-bold ${q.status === 'waiting' ? 'text-klinik-primary' : 'text-slate-400'} text-lg">${q.queue_number || '-'}</td>
                <td class="font-medium text-slate-700">${q.patient_name || '-'}</td>
                <td>${q.created_at ? q.created_at.slice(11,16) : '-'}</td>
                <td class="text-sm">${q.loket || '-'}</td>
                <td><span class="badge badge-${badge}">${label}</span></td>
                <td>
                    <button class="btn btn-sm btn-primary p-2 ${disabled}" onclick="panggil('${q.id}','${q.queue_number || ''}','${(q.patient_name || '').replace(/'/g,"\\'")}')" ${q.status !== 'waiting' ? 'disabled' : ''}>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                    </button>
                </td>
            </tr>`;
        }).join('') : '<tr><td colspan="6" class="text-center py-4 text-slate-400">Tidak ada antrean</td></tr>';
    } catch(e) { tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>'; }
}

async function panggil(id, queueNumber, patientName) {
    const loket = getAvailableLoket();
    if (!loket) return alert('Semua loket sedang sibuk. Harap tunggu hingga ada yang tersedia.');
    try {
        const res = await fetch('/api/queues/' + id, { method:'PUT', headers:{'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'}, body: JSON.stringify({ status:'called', loket: loket.name, called_at: new Date().toISOString().slice(0,19).replace('T',' ') }) });
        const json = await res.json();
        if (res.ok) {
            startLoketTimer(loket, id, queueNumber, patientName);
            loadQueueTable();
        } else {
            alert(json.error || 'Gagal memanggil');
        }
    } catch(e) { alert('Gagal memanggil pasien'); }
}

document.addEventListener('DOMContentLoaded', function() {
    loadQueueTable();
    setInterval(loadQueueTable, 3000);
});
</script>
<?= $this->endSection() ?>
