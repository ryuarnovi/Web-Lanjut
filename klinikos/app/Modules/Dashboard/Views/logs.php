<div class="space-y-6">
  <div>
    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Log Aktivitas</h2>
    <p class="text-sm text-slate-500 mt-1">200 aktivitas terakhir di sistem.</p>
  </div>

  <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-600">
          <tr>
            <th class="px-4 py-3 text-left">Waktu</th>
            <th class="px-4 py-3 text-left">User</th>
            <th class="px-4 py-3 text-left">Aksi</th>
            <th class="px-4 py-3 text-left">Entitas</th>
            <th class="px-4 py-3 text-left">Deskripsi</th>
            <th class="px-4 py-3 text-left">IP</th>
          </tr>
        </thead>
        <tbody id="logs-tbody" class="divide-y divide-slate-200 dark:divide-slate-800">
          <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">Memuat...</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
(async () => {
  try {
    const { data } = await apiFetch('/api/activity-logs');
    const tbody = document.getElementById('logs-tbody');
    if (!data.length) { tbody.innerHTML = '<tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">Belum ada log</td></tr>'; return; }
    const color = { CREATE:'emerald', UPDATE:'sky', DELETE:'red', LOGIN:'violet', LOGOUT:'slate' };
    tbody.innerHTML = data.map(l => `
      <tr>
        <td class="px-4 py-2.5 text-slate-500 text-xs">${l.created_at}</td>
        <td class="px-4 py-2.5">${l.full_name || l.username || '-'}</td>
        <td class="px-4 py-2.5"><span class="px-2 py-0.5 rounded text-xs bg-${color[l.action]||'slate'}-100 text-${color[l.action]||'slate'}-700">${l.action}</span></td>
        <td class="px-4 py-2.5 text-slate-500">${l.entity||'-'}</td>
        <td class="px-4 py-2.5">${l.description||'-'}</td>
        <td class="px-4 py-2.5 text-slate-400 text-xs">${l.ip_address||'-'}</td>
      </tr>`).join('');
  } catch { showToast('Gagal memuat log','error'); }
})();
</script>
