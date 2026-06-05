<div class="space-y-6">
  <div class="flex items-center justify-between flex-wrap gap-3">
    <div>
      <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Manajemen User</h2>
      <p class="text-sm text-slate-500 mt-1">Kelola semua akun staf klinik</p>
    </div>
    <button onclick="openUserModal()" class="px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-700 text-sm font-medium">+ Tambah User</button>
  </div>

  <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
    <div class="p-4 border-b border-slate-200 dark:border-slate-800 flex items-center gap-3">
      <input id="user-search" placeholder="Cari nama / username..." class="flex-1 px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent text-sm">
      <select id="user-role-filter" class="px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent text-sm">
        <option value="">Semua Role</option>
        <option>admin</option><option>resepsionis</option><option>dokter</option>
        <option>perawat</option><option>apoteker</option><option>kasir</option>
      </select>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-600 dark:text-slate-400 text-xs uppercase">
          <tr>
            <th class="px-4 py-3 text-left">Nama</th>
            <th class="px-4 py-3 text-left">Username</th>
            <th class="px-4 py-3 text-left">Role</th>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left">Status</th>
            <th class="px-4 py-3 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody id="users-tbody" class="divide-y divide-slate-200 dark:divide-slate-800">
          <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">Memuat...</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Form -->
<div id="user-modal" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">
  <div class="bg-white dark:bg-slate-900 rounded-xl shadow-2xl max-w-lg w-full">
    <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
      <h3 id="user-modal-title" class="text-lg font-semibold">Tambah User</h3>
      <button onclick="closeUserModal()" class="text-slate-400 hover:text-slate-700">&times;</button>
    </div>
    <form id="user-form" class="p-6 space-y-4">
      <input type="hidden" id="user-id">
      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-medium mb-1">Nama Lengkap *</label>
          <input id="f-full_name" required class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent text-sm">
        </div>
        <div>
          <label class="block text-xs font-medium mb-1">Username *</label>
          <input id="f-username" required class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent text-sm">
        </div>
        <div>
          <label class="block text-xs font-medium mb-1">Password <span class="text-slate-400">(kosongkan jika edit)</span></label>
          <input id="f-password" type="password" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent text-sm">
        </div>
        <div>
          <label class="block text-xs font-medium mb-1">Role *</label>
          <select id="f-role" required class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent text-sm">
            <option value="">- Pilih -</option>
            <option>admin</option><option>resepsionis</option><option>dokter</option>
            <option>perawat</option><option>apoteker</option><option>kasir</option>
          </select>
        </div>
        <div>
          <label class="block text-xs font-medium mb-1">Email</label>
          <input id="f-email" type="email" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent text-sm">
        </div>
        <div>
          <label class="block text-xs font-medium mb-1">No. HP</label>
          <input id="f-phone" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent text-sm">
        </div>
        <div class="col-span-2">
          <label class="block text-xs font-medium mb-1">Spesialisasi (jika dokter)</label>
          <input id="f-specialization" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent text-sm">
        </div>
      </div>
      <div class="flex justify-end gap-2 pt-2">
        <button type="button" onclick="closeUserModal()" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600">Batal</button>
        <button type="submit" class="px-4 py-2 rounded-lg bg-sky-600 text-white">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
let USERS = [];

async function loadUsers() {
  try {
    const { data } = await apiFetch('/api/users');
    USERS = data;
    renderUsers();
  } catch { showToast('Gagal memuat user', 'error'); }
}

function renderUsers() {
  const q = document.getElementById('user-search').value.toLowerCase();
  const r = document.getElementById('user-role-filter').value;
  const tbody = document.getElementById('users-tbody');
  const filtered = USERS.filter(u =>
    (!q || (u.full_name||'').toLowerCase().includes(q) || (u.username||'').toLowerCase().includes(q)) &&
    (!r || u.role === r)
  );
  if (!filtered.length) { tbody.innerHTML = '<tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">Tidak ada data</td></tr>'; return; }
  const roleBadge = { admin:'bg-red-100 text-red-700', dokter:'bg-emerald-100 text-emerald-700', perawat:'bg-amber-100 text-amber-700', apoteker:'bg-violet-100 text-violet-700', kasir:'bg-cyan-100 text-cyan-700', resepsionis:'bg-sky-100 text-sky-700' };
  tbody.innerHTML = filtered.map(u => `
    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
      <td class="px-4 py-3 font-medium">${u.full_name||'-'}</td>
      <td class="px-4 py-3 text-slate-500">${u.username}</td>
      <td class="px-4 py-3"><span class="px-2 py-0.5 rounded text-xs ${roleBadge[u.role]||'bg-slate-100 text-slate-700'}">${u.role}</span></td>
      <td class="px-4 py-3 text-slate-500">${u.email||'-'}</td>
      <td class="px-4 py-3">${u.is_active==1 ? '<span class="text-emerald-600 text-xs">● Aktif</span>' : '<span class="text-slate-400 text-xs">● Nonaktif</span>'}</td>
      <td class="px-4 py-3 text-right space-x-1">
        <button onclick='editUser(${JSON.stringify(u)})' class="px-2 py-1 text-xs rounded bg-sky-100 text-sky-700 hover:bg-sky-200">Edit</button>
        <button onclick="deleteUser(${u.id},'${u.username}')" class="px-2 py-1 text-xs rounded bg-red-100 text-red-700 hover:bg-red-200">Hapus</button>
      </td>
    </tr>`).join('');
}

document.getElementById('user-search').addEventListener('input', renderUsers);
document.getElementById('user-role-filter').addEventListener('change', renderUsers);

function openUserModal() {
  document.getElementById('user-modal-title').textContent = 'Tambah User';
  document.getElementById('user-form').reset();
  document.getElementById('user-id').value = '';
  document.getElementById('user-modal').classList.remove('hidden');
}
function closeUserModal() { document.getElementById('user-modal').classList.add('hidden'); }
function editUser(u) {
  document.getElementById('user-modal-title').textContent = 'Edit User';
  document.getElementById('user-id').value = u.id;
  ['full_name','username','email','phone','role','specialization'].forEach(k => { document.getElementById('f-'+k).value = u[k] || ''; });
  document.getElementById('f-password').value = '';
  document.getElementById('user-modal').classList.remove('hidden');
}
function deleteUser(id, uname) {
  confirmDialog({ title:'Hapus user?', message:`User "${uname}" akan dihapus permanen.`, onConfirm: async () => {
    try { await apiFetch('/api/users/'+id, { method:'DELETE' }); showToast('User dihapus','success'); loadUsers(); }
    catch { showToast('Gagal hapus','error'); }
  }});
}

document.getElementById('user-form').addEventListener('submit', async (e) => {
  e.preventDefault();
  const id = document.getElementById('user-id').value;
  const payload = {};
  ['full_name','username','password','role','email','phone','specialization'].forEach(k => {
    const v = document.getElementById('f-'+k).value.trim();
    if (v) payload[k] = v;
  });
  try {
    if (id) await apiFetch('/api/users/'+id, { method:'PUT', body: JSON.stringify(payload) });
    else    await apiFetch('/api/users',     { method:'POST', body: JSON.stringify(payload) });
    showToast('Tersimpan','success'); closeUserModal(); loadUsers();
  } catch { showToast('Gagal menyimpan','error'); }
});

loadUsers();
</script>
