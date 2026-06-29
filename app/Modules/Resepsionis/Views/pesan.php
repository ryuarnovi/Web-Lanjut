<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Pesan Masuk dari Pasien</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Resepsionis</li>
      <li class="active">Pesan Masuk</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-klinik-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
        Inbox Pesan
        <span id="unreadBadge" class="ml-auto px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700"></span>
      </h5>

      <div class="overflow-x-auto border border-slate-200 rounded-lg">
        <table class="tw-table m-0">
          <thead class="bg-slate-50">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Subjek</th>
              <th>Pesan</th>
              <th>Tanggal</th>
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

<!-- Modal Detail Pesan -->
<div id="detailModal" class="fixed inset-0 z-50 hidden bg-black/40 flex items-center justify-center" onclick="if(event.target===this)closeDetail()">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 p-6" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between mb-4">
      <h5 class="text-lg font-bold">Detail Pesan</h5>
      <button class="text-slate-400 hover:text-slate-600" onclick="closeDetail()">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
      </button>
    </div>
    <div id="detailBody" class="space-y-3 text-sm"></div>
    <div class="flex gap-2 mt-6 pt-4 border-t">
      <button class="btn btn-sm btn-outline-danger" onclick="hapusPesan()">Hapus</button>
      <button class="btn btn-sm btn-outline-secondary ml-auto" onclick="closeDetail()">Tutup</button>
    </div>
  </div>
</div>

<script>
let allMessages = [];
let selectedId = null;

async function loadData() {
  try {
    const res = await fetch('/api/messages');
    const json = await res.json();
    allMessages = json.data || [];
    renderTable();
  } catch(e) {
    document.querySelector('.tw-table tbody').innerHTML = '<tr><td colspan="7" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>';
  }
}

function renderTable() {
  const tbody = document.querySelector('.tw-table tbody');
  const unread = allMessages.filter(m => m.status === 'unread').length;
  const badge = document.getElementById('unreadBadge');
  badge.textContent = unread ? unread + ' belum dibaca' : '';
  badge.style.display = unread ? '' : 'none';

  tbody.innerHTML = allMessages.length ? allMessages.map((m, i) => {
    const isUnread = m.status === 'unread';
    return `<tr class="${isUnread ? 'font-bold bg-blue-50/50' : ''}">
      <td>${i + 1}</td>
      <td class="text-slate-700">${m.patient_name || '-'}</td>
      <td>${m.subject || '-'}</td>
      <td class="max-w-[200px] truncate">${m.message || '-'}</td>
      <td class="text-sm">${m.created_at ? m.created_at.slice(0, 16) : '-'}</td>
      <td>${isUnread ? '<span class="badge badge-warning">Belum Dibaca</span>' : '<span class="badge badge-success">Sudah Dibaca</span>'}</td>
      <td>
        <button class="btn btn-sm btn-outline-secondary p-1.5" onclick="showDetail(${m.id})" title="Baca">
          <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
        </button>
      </td>
    </tr>`;
  }).join('') : '<tr><td colspan="7" class="text-center py-4 text-slate-400">Tidak ada pesan</td></tr>';
}

async function showDetail(id) {
  selectedId = id;
  try {
    const res = await fetch('/api/messages/' + id);
    const json = await res.json();
    const m = json.data;
    if (!m) return alert('Data tidak ditemukan');

    document.getElementById('detailBody').innerHTML = `
      <div class="grid grid-cols-2 gap-3">
        <div><label class="block text-xs text-slate-400">Nama</label><span class="font-semibold">${m.patient_name || '-'}</span></div>
        <div><label class="block text-xs text-slate-400">Telepon</label><span class="font-semibold">${m.patient_phone || '-'}</span></div>
        <div class="col-span-2"><label class="block text-xs text-slate-400">Email</label><span class="font-semibold">${m.patient_email || '-'}</span></div>
        <div class="col-span-2"><label class="block text-xs text-slate-400">Subjek</label><span class="font-semibold">${m.subject || '-'}</span></div>
      </div>
      <div class="mt-3 pt-3 border-t">
        <label class="block text-xs text-slate-400 mb-1">Isi Pesan</label>
        <div class="bg-slate-50 rounded-lg p-4 text-slate-700 whitespace-pre-wrap text-sm">${m.message || '-'}</div>
      </div>
      <div class="text-xs text-slate-400">Diterima: ${m.created_at || '-'}</div>
    `;

    document.getElementById('detailModal').classList.remove('hidden');
  } catch(e) {
    alert('Gagal memuat detail');
  }
}

function closeDetail() {
  document.getElementById('detailModal').classList.add('hidden');
  selectedId = null;
}

async function hapusPesan() {
  if (!selectedId) return;
  if (!confirm('Hapus pesan ini?')) return;
  try {
    const res = await fetch('/api/messages/' + selectedId, { method: 'DELETE', headers: { 'X-Requested-With': 'XMLHttpRequest' } });
    if (res.ok) {
      alert('Pesan berhasil dihapus');
      closeDetail();
      loadData();
    }
  } catch(e) {
    alert('Gagal menghapus');
  }
}

document.addEventListener('DOMContentLoaded', function() {
  loadData();
  setInterval(loadData, 10000);
});
</script>
<?= $this->endSection() ?>
