<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Daftar Janji Temu (Appointment)</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Resepsionis</li>
      <li class="active">Janji Temu</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-klinik-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
        Permintaan Janji Temu dari Pasien
        <span id="badgeCount" class="ml-auto px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700"></span>
      </h5>

      <div class="flex gap-2 mb-4 flex-wrap">
        <button class="btn btn-sm btn-outline-primary filter-btn active" data-filter="all">Semua</button>
        <button class="btn btn-sm btn-outline-warning filter-btn" data-filter="pending">Menunggu</button>
        <button class="btn btn-sm btn-outline-info filter-btn" data-filter="confirmed">Dikonfirmasi</button>
        <button class="btn btn-sm btn-outline-success filter-btn" data-filter="completed">Selesai</button>
        <button class="btn btn-sm btn-outline-danger filter-btn" data-filter="cancelled">Dibatalkan</button>
      </div>

      <div class="overflow-x-auto border border-slate-200 rounded-lg">
        <table class="tw-table m-0">
          <thead class="bg-slate-50">
            <tr>
              <th>No</th>
              <th>Nama Pasien</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Poli</th>
              <th>Dokter</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200"></tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 z-50 hidden bg-black/40 flex items-center justify-center" onclick="if(event.target===this)closeDetail()">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 p-6 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between mb-4">
      <h5 class="text-lg font-bold">Detail Janji Temu</h5>
      <button class="text-slate-400 hover:text-slate-600" onclick="closeDetail()">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
      </button>
    </div>
    <div id="detailBody" class="space-y-3 text-sm"></div>
    <div class="flex gap-2 mt-6 pt-4 border-t" id="detailActions"></div>
  </div>
</div>

<script>
let allData = [];

async function loadData() {
  try {
    const res = await fetch('/api/appointments');
    const json = await res.json();
    allData = json.data || [];
    renderTable('all');
  } catch(e) {
    document.querySelector('.tw-table tbody').innerHTML = '<tr><td colspan="8" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>';
  }
}

function renderTable(filter) {
  const tbody = document.querySelector('.tw-table tbody');
  const filtered = filter === 'all' ? allData : allData.filter(a => a.status === filter);

  const badge = document.getElementById('badgeCount');
  const pending = allData.filter(a => a.status === 'pending').length;
  badge.textContent = pending ? pending + ' menunggu' : '';
  badge.style.display = pending ? '' : 'none';

  const statusLabels = { pending: 'Menunggu', confirmed: 'Dikonfirmasi', cancelled: 'Dibatalkan', completed: 'Selesai' };
  const statusColors = { pending: 'warning', confirmed: 'info', cancelled: 'danger', completed: 'success' };

  tbody.innerHTML = filtered.length ? filtered.map((a, i) => {
    const dateStr = a.appointment_date ? a.appointment_date.slice(0, 10) : '-';
    return `<tr data-status="${a.status}">
      <td>${i + 1}</td>
      <td class="font-medium text-slate-700">${a.patient_name || '-'}</td>
      <td>${dateStr}</td>
      <td>${a.appointment_time ? a.appointment_time.slice(0, 5) : '-'}</td>
      <td><span class="badge bg-purple-50 text-purple-600 border border-purple-200">${a.poli || '-'}</span></td>
      <td>${a.doctor_name || '-'}</td>
      <td><span class="badge badge-${statusColors[a.status] || 'secondary'}">${statusLabels[a.status] || a.status}</span></td>
      <td>
        <button class="btn btn-sm btn-outline-secondary p-1.5" onclick="showDetail(${a.id})" title="Detail">
          <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
        </button>
      </td>
    </tr>`;
  }).join('') : '<tr><td colspan="8" class="text-center py-4 text-slate-400">Tidak ada data</td></tr>';
}

async function showDetail(id) {
  try {
    const res = await fetch('/api/appointments/' + id);
    const json = await res.json();
    const a = json.data;
    if (!a) return alert('Data tidak ditemukan');

    const statusLabels = { pending: 'Menunggu', confirmed: 'Dikonfirmasi', cancelled: 'Dibatalkan', completed: 'Selesai' };

    document.getElementById('detailBody').innerHTML = `
      <div class="grid grid-cols-2 gap-3">
        <div><label class="block text-xs text-slate-400">Nama</label><span class="font-semibold">${a.patient_name || '-'}</span></div>
        <div><label class="block text-xs text-slate-400">Telepon</label><span class="font-semibold">${a.patient_phone || '-'}</span></div>
        <div><label class="block text-xs text-slate-400">Email</label><span class="font-semibold">${a.patient_email || '-'}</span></div>
        <div><label class="block text-xs text-slate-400">Poli</label><span class="font-semibold">${a.poli || '-'}</span></div>
        <div><label class="block text-xs text-slate-400">Tanggal</label><span class="font-semibold">${a.appointment_date ? a.appointment_date.slice(0,10) : '-'}</span></div>
        <div><label class="block text-xs text-slate-400">Jam</label><span class="font-semibold">${a.appointment_time ? a.appointment_time.slice(0,5) : '-'}</span></div>
        <div><label class="block text-xs text-slate-400">Dokter</label><span class="font-semibold">${a.doctor_name || '-'}</span></div>
        <div><label class="block text-xs text-slate-400">Status</label><span class="font-semibold">${statusLabels[a.status] || a.status}</span></div>
      </div>
      ${a.keluhan ? `<div class="mt-3 pt-3 border-t"><label class="block text-xs text-slate-400 mb-1">Keluhan</label><p class="text-sm text-slate-600">${a.keluhan}</p></div>` : ''}
      ${a.created_at ? `<div class="mt-2 text-xs text-slate-400">Dibuat: ${a.created_at}</div>` : ''}
    `;

    let actionsHtml = '';
    if (a.status === 'pending') {
      actionsHtml = `
        <button class="btn btn-sm btn-success" onclick="updateStatus(${a.id},'confirmed')">Konfirmasi</button>
        <button class="btn btn-sm btn-danger" onclick="updateStatus(${a.id},'cancelled')">Tolak</button>
      `;
    } else if (a.status === 'confirmed') {
      actionsHtml = `
        <button class="btn btn-sm btn-success" onclick="updateStatus(${a.id},'completed')">Selesai</button>
        <button class="btn btn-sm btn-danger" onclick="updateStatus(${a.id},'cancelled')">Batalkan</button>
      `;
    }
    actionsHtml += `<button class="btn btn-sm btn-outline-secondary" onclick="closeDetail()">Tutup</button>`;
    document.getElementById('detailActions').innerHTML = actionsHtml;

    document.getElementById('detailModal').classList.remove('hidden');
  } catch(e) {
    alert('Gagal memuat detail');
  }
}

function closeDetail() {
  document.getElementById('detailModal').classList.add('hidden');
}

async function updateStatus(id, status) {
  try {
    const res = await fetch('/api/appointments/' + id, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      body: JSON.stringify({ status }),
    });
    const json = await res.json();
    if (res.ok) {
      alert('Status berhasil diperbarui');
      closeDetail();
      loadData();
    } else {
      alert(json.error || 'Gagal memperbarui');
    }
  } catch(e) {
    alert('Gagal memperbarui status');
  }
}

document.addEventListener('DOMContentLoaded', function() {
  loadData();

  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      renderTable(this.dataset.filter);
    });
  });

  setInterval(loadData, 10000);
});
</script>
<?= $this->endSection() ?>
