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
      
      <div id="serviceMonitor" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 mt-2">
      </div>

      <div class="overflow-x-auto border border-slate-200 rounded-lg">
        <table class="tw-table m-0">
          <thead class="bg-slate-50">
            <tr>
              <th>No. Antrean</th>
              <th>Nama Pasien</th>
              <th>Jenis Kunjungan</th>
              <th>Waktu Daftar</th>
              <th>Loket</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
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
<div id="loketPicker"></div>

<script>
let LOKETS = [];

async function loadLokets() {
    try {
        const res = await fetch('/api/lokets');
        const json = await res.json();
        const list = json.data || [];
        if (list.length) {
            LOKETS = list.map(l => ({ id: l.id, name: l.name, status: 'available', queueId: null, queueNumber: null, patientName: null, timer: null, remaining: 0 }));
        }
    } catch(e) {}
}

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

function renderServiceMonitor(list) {
    const container = document.getElementById('serviceMonitor');
    const called = list.filter(q => q.status === 'called' && q.loket);
    const waiting = list.filter(q => q.status === 'waiting');

    const services = [
        { id:'pendaftaran', label:'Pendaftaran', bg:'bg-klinik-primary',
          icon:'<svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>',
          filter: q => true },
        { id:'umum', label:'Poli Umum', bg:'bg-green-500',
          icon:'<svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>',
          filter: q => q.poli && q.poli.toLowerCase() === 'umum' },
        { id:'gigi', label:'Poli Gigi', bg:'bg-cyan-500',
          icon:'<svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
          filter: q => q.poli && q.poli.toLowerCase() === 'gigi' }
    ];

    container.innerHTML = services.map(svc => {
        const qCalled = called.find(svc.filter);
        const qWaiting = waiting.find(svc.filter);
        const queue = qCalled || qWaiting;

        if (!queue) {
            return `<div class="p-6 rounded-2xl ${svc.bg} text-white shadow-lg text-center relative overflow-hidden opacity-60">
                <div class="absolute top-0 right-0 p-4 opacity-20">${svc.icon}</div>
                <h3 class="font-semibold text-white/80 uppercase tracking-wider text-sm mb-2 relative z-10">${svc.label}</h3>
                <h1 class="text-4xl font-bold mb-2 relative z-10">-</h1>
                <p class="m-0 text-white/70 text-sm relative z-10">Tidak ada antrean</p>
            </div>`;
        }

        const pasien = queue.patient_name || '';
        const loketMsg = qCalled ? ('Silahkan menuju ' + qCalled.loket) : (queue.loket ? 'Silahkan menuju ' + queue.loket : 'Menunggu dipanggil');

        return `<div class="p-6 rounded-2xl ${svc.bg} text-white shadow-lg text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-20">${svc.icon}</div>
            <h3 class="font-semibold text-white/80 uppercase tracking-wider text-sm mb-2 relative z-10">${svc.label}</h3>
            <h1 class="text-6xl font-bold mb-2 relative z-10">${queue.queue_number || '-'}</h1>
            <p class="m-0 text-white truncate text-sm font-medium relative z-10">${pasien}</p>
            <p class="m-0 text-white/70 text-sm relative z-10">${loketMsg}</p>
        </div>`;
    }).join('');
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

        // Update service monitor cards by poli type
        renderServiceMonitor(list);

        renderLoketPanel();

        tbody.innerHTML = list.length ? list.map(q => {
            const statusMap = { 'waiting': 'warning', 'called': 'info', 'in_progress': 'primary', 'completed': 'success', 'cancelled': 'danger' };
            const badge = statusMap[q.status] || 'secondary';
            const label = q.status === 'waiting' ? 'Menunggu' : q.status === 'called' ? 'Dipanggil' : q.status === 'completed' ? 'Selesai' : q.status;
            const disabled = q.status === 'completed' || q.status === 'called' ? 'opacity-50 pointer-events-none' : '';
            const visitLabels = { 'rawat_jalan': 'Rawat Jalan', 'rawat_inap': 'Rawat Inap', 'gawat_darurat': 'IGD', 'kontrol': 'Kontrol', 'rujukan': 'Rujukan' };
            const visitLabel = visitLabels[q.visit_type] || q.visit_type || 'Rawat Jalan';
            return `<tr>
                <td class="font-bold ${q.status === 'waiting' ? 'text-klinik-primary' : 'text-slate-400'} text-lg">${q.queue_number || '-'}</td>
                <td class="font-medium text-slate-700">${q.patient_name || '-'}</td>
                <td><span class="badge bg-purple-50 text-purple-600 border border-purple-200">${visitLabel}</span></td>
                <td>${q.created_at ? q.created_at.slice(11,16) : '-'}</td>
                <td class="text-sm">${q.loket || '-'}</td>
                <td><span class="badge badge-${badge}">${label}</span></td>
                <td>
                    <button class="btn btn-sm btn-primary p-2 ${disabled}" onclick="panggil('${q.id}','${q.queue_number || ''}','${(q.patient_name || '').replace(/'/g,"\\'")}')" ${q.status !== 'waiting' ? 'disabled' : ''}>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                    </button>
                </td>
            </tr>`;
        }).join('') : '<tr><td colspan="7" class="text-center py-4 text-slate-400">Tidak ada antrean</td></tr>';
    } catch(e) { tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>'; }
}

let pendingCallId = null;
let pendingCallNumber = null;
let pendingPatientName = null;

function showLoketPicker(id, queueNumber, patientName) {
    pendingCallId = id;
    pendingCallNumber = queueNumber;
    pendingPatientName = patientName;
    const avail = LOKETS.filter(l => l.status === 'available');
    if (!avail.length) return alert('Semua loket sedang sibuk. Harap tunggu hingga ada yang tersedia.');
    if (avail.length === 1) {
        panggilKeLoket(id, avail[0].name);
        return;
    }
    const container = document.getElementById('loketPicker');
    container.innerHTML = `
        <div class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center" onclick="if(event.target===this)document.getElementById('loketPicker').innerHTML=''">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6" onclick="event.stopPropagation()">
                <h5 class="text-lg font-bold mb-4">Pilih Loket untuk ${patientName} (${queueNumber})</h5>
                <div class="space-y-2">
                    ${avail.map(l => `<button class="btn btn-outline-primary w-full justify-start text-left py-3" onclick="panggilKeLoket('${id}','${l.name}')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        ${l.name} — Tersedia
                    </button>`).join('')}
                </div>
                <button class="btn btn-outline-secondary w-full mt-4" onclick="document.getElementById('loketPicker').innerHTML=''">Batal</button>
            </div>
        </div>`;
}

async function panggilKeLoket(id, loketName) {
    const loket = LOKETS.find(l => l.name === loketName);
    if (!loket || loket.status !== 'available') return alert('Loket tidak tersedia');
    try {
        const res = await fetch('/api/queues/' + id, { method:'PUT', headers:{'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'}, body: JSON.stringify({ status:'called', loket: loketName, called_at: new Date().toISOString().slice(0,19).replace('T',' ') }) });
        const json = await res.json();
        if (res.ok) {
            startLoketTimer(loket, id, pendingCallNumber, pendingPatientName);
            loadQueueTable();
        } else {
            alert(json.error || 'Gagal memanggil');
        }
    } catch(e) { alert('Gagal memanggil pasien'); }
    document.getElementById('loketPicker').innerHTML = '';
}

function panggil(id, queueNumber, patientName) {
    pendingCallId = id;
    pendingCallNumber = queueNumber;
    pendingPatientName = patientName;
    showLoketPicker(id, queueNumber, patientName);
}

document.addEventListener('DOMContentLoaded', async function() {
    await loadLokets();
    if (!LOKETS.length) {
        LOKETS = [
            { id:1, name:'Loket 1', status:'available', queueId:null, queueNumber:null, patientName:null, timer:null, remaining:0 },
            { id:2, name:'Loket 2', status:'available', queueId:null, queueNumber:null, patientName:null, timer:null, remaining:0 },
            { id:3, name:'Loket 3', status:'available', queueId:null, queueNumber:null, patientName:null, timer:null, remaining:0 }
        ];
    }
    loadQueueTable();
    setInterval(loadQueueTable, 3000);
    setInterval(loadLokets, 30000);
});
</script>
<?= $this->endSection() ?>
