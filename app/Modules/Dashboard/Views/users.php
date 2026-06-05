<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Manajemen User</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li class="active">Manajemen User</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title flex items-center justify-between flex-wrap gap-3">
        <span>Daftar Akun Staf Klinik</span>
        <button onclick="openUserModal()" class="btn btn-primary text-sm shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
          Tambah User
        </button>
      </h5>

      <div class="flex items-center gap-3 flex-wrap mb-4">
        <input id="user-search" placeholder="Cari nama / username..." class="form-input w-64 text-sm">
        <select id="user-role-filter" class="form-select w-auto text-sm">
          <option value="">Semua Role</option>
          <option>admin</option><option>resepsionis</option><option>dokter</option>
          <option>perawat</option><option>apoteker</option><option>kasir</option>
        </select>
      </div>

      <div class="overflow-x-auto border border-slate-200 rounded-lg">
        <table class="tw-table m-0">
          <thead class="bg-slate-50">
            <tr>
              <th>Nama Lengkap</th>
              <th>Username</th>
              <th>Role</th>
              <th>Email</th>
              <th>Spesialisasi</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="users-tbody">
            <tr><td colspan="7" class="text-center py-4 text-slate-400">Memuat data...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Modal Form -->
<div id="user-modal" class="hidden fixed inset-0 z-[99999] bg-black/40 flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full modal-content">
    <div class="p-5 border-b border-slate-200 flex items-center justify-between">
      <h5 id="user-modal-title" class="text-lg font-bold text-klinik-dark m-0">Tambah User</h5>
      <button onclick="closeUserModal()" class="text-slate-400 hover:text-slate-700 text-2xl leading-none">&times;</button>
    </div>
    <form id="user-form" class="p-5 space-y-4">
      <input type="hidden" id="user-id">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="form-label">Nama Lengkap *</label>
          <input id="f-full_name" required class="form-input">
        </div>
        <div>
          <label class="form-label">Username *</label>
          <input id="f-username" required class="form-input">
        </div>
        <div>
          <label class="form-label">Password <span class="text-slate-400 text-xs">(kosongkan jika edit)</span></label>
          <input id="f-password" type="password" class="form-input">
        </div>
        <div>
          <label class="form-label">Role *</label>
          <select id="f-role" required class="form-select">
            <option value="">- Pilih Role -</option>
            <option>admin</option><option>resepsionis</option><option>dokter</option>
            <option>perawat</option><option>apoteker</option><option>kasir</option>
          </select>
        </div>
        <div>
          <label class="form-label">Email</label>
          <input id="f-email" type="email" class="form-input">
        </div>
        <div>
          <label class="form-label">No. HP</label>
          <input id="f-phone" class="form-input">
        </div>
        <div class="md:col-span-2">
          <label class="form-label">Spesialisasi <span class="text-slate-400 text-xs">(jika dokter)</span></label>
          <input id="f-specialization" class="form-input">
        </div>
      </div>
      <div class="flex justify-end gap-3 pt-2">
        <button type="button" onclick="closeUserModal()" class="btn btn-outline-secondary py-1.5 px-4">Batal</button>
        <button type="submit" class="btn btn-primary py-1.5 px-4 shadow-sm">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
let USERS = [];

async function loadUsers() {
  try {
    const res = await fetch('/api/users');
    const json = await res.json();
    USERS = json.data || [];
    renderUsers();
  } catch(e) { showToast('Gagal memuat user', 'error'); }
}

function renderUsers() {
  const q = document.getElementById('user-search').value.toLowerCase();
  const r = document.getElementById('user-role-filter').value;
  const tbody = document.getElementById('users-tbody');
  const filtered = USERS.filter(u =>
    (!q || (u.full_name||'').toLowerCase().includes(q) || (u.username||'').toLowerCase().includes(q)) &&
    (!r || u.role === r)
  );
  if (!filtered.length) {
    tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-slate-400">Tidak ada data</td></tr>';
    return;
  }
  const roleBadge = {
    admin:'danger', dokter:'success', perawat:'warning',
    apoteker:'info', kasir:'primary', resepsionis:'secondary'
  };
  tbody.innerHTML = filtered.map(u => `
    <tr>
      <td class="font-semibold text-slate-700">${u.full_name||'-'}</td>
      <td class="text-slate-500">${u.username}</td>
      <td><span class="badge badge-${roleBadge[u.role]||'secondary'}">${u.role}</span></td>
      <td class="text-slate-500">${u.email||'-'}</td>
      <td class="text-slate-500">${u.specialization||'-'}</td>
      <td>${u.is_active==1
        ? '<span class="badge badge-success">Aktif</span>'
        : '<span class="badge badge-secondary">Nonaktif</span>'}</td>
      <td>
        <button onclick='editUser(${JSON.stringify(u)})' class="btn btn-sm btn-outline-primary py-0.5 px-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
        </button>
        <button onclick="deleteUser(${u.id},'${(u.username||'').replace(/'/g,"\\'")}')" class="btn btn-sm btn-outline-danger py-0.5 px-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
        </button>
      </td>
    </tr>`).join('');
}

document.getElementById('user-search').addEventListener('input', renderUsers);
document.getElementById('user-role-filter').addEventListener('change', renderUsers);

function openUserModal() {
  document.getElementById('user-modal-title').textContent = 'Tambah User Baru';
  document.getElementById('user-form').reset();
  document.getElementById('user-id').value = '';
  document.getElementById('user-modal').classList.remove('hidden');
}
function closeUserModal() { document.getElementById('user-modal').classList.add('hidden'); }
function editUser(u) {
  document.getElementById('user-modal-title').textContent = 'Edit User';
  document.getElementById('user-id').value = u.id;
  ['full_name','username','email','phone','role','specialization'].forEach(k => {
    document.getElementById('f-'+k).value = u[k] || '';
  });
  document.getElementById('f-password').value = '';
  document.getElementById('user-modal').classList.remove('hidden');
}
function deleteUser(id, uname) {
  confirmDialog('User "' + uname + '" akan dihapus permanen. Lanjutkan?', async () => {
    try {
      await fetch('/api/users/' + id, { method:'DELETE' });
      showToast('User berhasil dihapus', 'success');
      loadUsers();
    } catch(e) { showToast('Gagal menghapus user', 'error'); }
  });
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
    if (id) {
      await fetch('/api/users/' + id, { method:'PUT', headers:{'Content-Type':'application/json'}, body: JSON.stringify(payload) });
    } else {
      await fetch('/api/users', { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify(payload) });
    }
    showToast('User berhasil disimpan', 'success');
    closeUserModal();
    loadUsers();
  } catch(e) { showToast('Gagal menyimpan user', 'error'); }
});

document.addEventListener('DOMContentLoaded', loadUsers);
</script>
<?= $this->endSection() ?>
