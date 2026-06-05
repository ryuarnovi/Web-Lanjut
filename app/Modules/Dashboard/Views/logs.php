<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Log Aktivitas Sistem</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li class="active">Log Aktivitas</li>
    </ol>
  </nav>
</div>

<!-- Filter Bar -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
  <div class="card bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-sm border-none">
    <div class="card-body p-4 flex items-center justify-between">
      <div>
        <span class="text-xs text-emerald-100 font-semibold block uppercase">Create</span>
        <h3 class="text-2xl font-extrabold m-0 mt-1" id="countCreate">0</h3>
      </div>
      <div class="bg-white/20 p-2.5 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
      </div>
    </div>
  </div>
  <div class="card bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-sm border-none">
    <div class="card-body p-4 flex items-center justify-between">
      <div>
        <span class="text-xs text-blue-100 font-semibold block uppercase">Update</span>
        <h3 class="text-2xl font-extrabold m-0 mt-1" id="countUpdate">0</h3>
      </div>
      <div class="bg-white/20 p-2.5 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
      </div>
    </div>
  </div>
  <div class="card bg-gradient-to-br from-red-500 to-red-600 text-white shadow-sm border-none">
    <div class="card-body p-4 flex items-center justify-between">
      <div>
        <span class="text-xs text-red-100 font-semibold block uppercase">Delete</span>
        <h3 class="text-2xl font-extrabold m-0 mt-1" id="countDelete">0</h3>
      </div>
      <div class="bg-white/20 p-2.5 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
      </div>
    </div>
  </div>
  <div class="card bg-gradient-to-br from-violet-500 to-violet-600 text-white shadow-sm border-none">
    <div class="card-body p-4 flex items-center justify-between">
      <div>
        <span class="text-xs text-violet-100 font-semibold block uppercase">Login/Logout</span>
        <h3 class="text-2xl font-extrabold m-0 mt-1" id="countAuth">0</h3>
      </div>
      <div class="bg-white/20 p-2.5 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
      </div>
    </div>
  </div>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-klinik-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
        200 Aktivitas Terakhir
      </h5>

      <div class="flex items-center gap-3 flex-wrap mb-4">
        <input id="log-search" placeholder="Cari deskripsi..." class="form-input w-64 text-sm">
        <select id="log-action-filter" class="form-select w-auto text-sm">
          <option value="">Semua Aksi</option>
          <option>CREATE</option><option>UPDATE</option><option>DELETE</option>
          <option>LOGIN</option><option>LOGOUT</option>
        </select>
      </div>

      <div class="overflow-x-auto border border-slate-200 rounded-lg">
        <table class="tw-table m-0">
          <thead class="bg-slate-50">
            <tr>
              <th>Waktu</th>
              <th>User</th>
              <th>Aksi</th>
              <th>Entitas</th>
              <th>Deskripsi</th>
              <th>IP Address</th>
            </tr>
          </thead>
          <tbody id="logs-tbody">
            <tr><td colspan="6" class="text-center py-4 text-slate-400">Memuat data...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
let ALL_LOGS = [];

async function loadLogs() {
  try {
    const res = await fetch('/api/dashboard/logs');
    const json = await res.json();
    ALL_LOGS = json.data || [];
    updateCounters();
    renderLogs();
  } catch(e) { showToast('Gagal memuat log aktivitas', 'error'); }
}

function updateCounters() {
  const count = (action) => ALL_LOGS.filter(l => (l.action||'').toUpperCase() === action).length;
  document.getElementById('countCreate').textContent = count('CREATE');
  document.getElementById('countUpdate').textContent = count('UPDATE');
  document.getElementById('countDelete').textContent = count('DELETE');
  document.getElementById('countAuth').textContent = count('LOGIN') + count('LOGOUT');
}

function renderLogs() {
  const q = document.getElementById('log-search').value.toLowerCase();
  const a = document.getElementById('log-action-filter').value;
  const tbody = document.getElementById('logs-tbody');

  const filtered = ALL_LOGS.filter(l =>
    (!q || (l.description||'').toLowerCase().includes(q) || (l.user_name||l.username||'').toLowerCase().includes(q)) &&
    (!a || (l.action||'').toUpperCase() === a)
  );

  if (!filtered.length) {
    tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-slate-400">Tidak ada data</td></tr>';
    return;
  }

  const actionBadge = { CREATE:'success', UPDATE:'primary', DELETE:'danger', LOGIN:'info', LOGOUT:'secondary' };

  window.paginateTable('.tw-table', filtered, 20, (l) => {
    const badge = actionBadge[(l.action||'').toUpperCase()] || 'secondary';
    return `<tr>
      <td class="text-xs text-slate-500 whitespace-nowrap">${l.created_at || '-'}</td>
      <td class="font-medium text-slate-700">${l.user_name || l.username || '-'}</td>
      <td><span class="badge badge-${badge}">${l.action || '-'}</span></td>
      <td class="text-slate-500">${l.entity || '-'}</td>
      <td class="text-sm max-w-xs truncate">${l.description || '-'}</td>
      <td class="text-xs text-slate-400 font-mono">${l.ip_address || '-'}</td>
    </tr>`;
  });
}

document.getElementById('log-search').addEventListener('input', renderLogs);
document.getElementById('log-action-filter').addEventListener('change', renderLogs);

document.addEventListener('DOMContentLoaded', loadLogs);
</script>
<?= $this->endSection() ?>
