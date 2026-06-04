<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
  <div>
    <h1 class="text-2xl font-bold text-klinik-dark">Manajemen Supplier</h1>
    <nav><ol class="breadcrumb"><li><a href="<?= base_url() ?>">Home</a></li><li>Apoteker</li><li class="active">Supplier</li></ol></nav>
  </div>
  <button class="btn btn-primary flex items-center gap-2 shadow-md" onclick="showModal()">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
    Tambah Supplier
  </button>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <div class="overflow-x-auto border border-slate-200 rounded-lg">
        <table class="tw-table m-0">
          <thead class="bg-slate-50">
            <tr><th>Nama Supplier</th><th>Kontak Person</th><th>Telepon</th><th>Email</th><th>Aksi</th></tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            <tr><td colspan="5" class="text-center py-4 text-slate-400">Memuat data...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<div id="supplierModal" class="fixed inset-0 z-50 hidden bg-black/40 flex items-center justify-center" onclick="if(event.target===this)hideModal()">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 overflow-hidden" onclick="event.stopPropagation()">
    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
      <h5 class="text-lg font-bold m-0" id="modalTitle">Tambah Supplier</h5>
      <button class="text-slate-400 hover:text-slate-600" onclick="hideModal()">&times;</button>
    </div>
    <div class="p-6 space-y-4">
      <input type="hidden" id="editId">
      <div><label class="form-label">Nama Supplier <span class="text-red-500">*</span></label><input type="text" class="form-input" id="sName"></div>
      <div><label class="form-label">Kontak Person</label><input type="text" class="form-input" id="sContact"></div>
      <div class="grid grid-cols-2 gap-4">
        <div><label class="form-label">Telepon</label><input type="text" class="form-input" id="sPhone"></div>
        <div><label class="form-label">Email</label><input type="email" class="form-input" id="sEmail"></div>
      </div>
      <div><label class="form-label">Alamat</label><textarea class="form-textarea" id="sAddress" rows="2"></textarea></div>
      <div><label class="form-label">Catatan</label><textarea class="form-textarea" id="sNotes" rows="2"></textarea></div>
    </div>
    <div class="px-6 py-4 border-t border-slate-100 flex justify-end gap-2">
      <button class="btn btn-outline-secondary" onclick="hideModal()">Batal</button>
      <button class="btn btn-primary" onclick="saveSupplier()">Simpan</button>
    </div>
  </div>
</div>

<script>
let editId = null;

function showModal(data) {
    editId = data?.id || null;
    document.getElementById('modalTitle').textContent = editId ? 'Edit Supplier' : 'Tambah Supplier';
    document.getElementById('editId').value = editId || '';
    document.getElementById('sName').value = data?.name || '';
    document.getElementById('sContact').value = data?.contact_person || '';
    document.getElementById('sPhone').value = data?.phone || '';
    document.getElementById('sEmail').value = data?.email || '';
    document.getElementById('sAddress').value = data?.address || '';
    document.getElementById('sNotes').value = data?.notes || '';
    document.getElementById('supplierModal').classList.remove('hidden');
}

function hideModal() {
    document.getElementById('supplierModal').classList.add('hidden');
}

async function loadSuppliers() {
    const tbody = document.querySelector('.tw-table tbody');
    if (!tbody) return;
    try {
        const res = await fetch('/api/suppliers');
        const json = await res.json();
        const list = json.data || [];
        tbody.innerHTML = list.length ? list.map(s => `<tr class="hover:bg-slate-50 transition">
            <td class="font-semibold">${s.name}</td>
            <td>${s.contact_person || '-'}</td>
            <td>${s.phone || '-'}</td>
            <td>${s.email || '-'}</td>
            <td><div class="flex gap-2">
                <button class="btn btn-sm btn-outline-primary p-1.5" onclick='showModal(${JSON.stringify(s).replace(/'/g,"\\'")})' title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </button>
                <button class="btn btn-sm btn-outline-danger p-1.5" onclick="deleteSupplier(${s.id})" title="Hapus">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div></td>
        </tr>`).join('') : '<tr><td colspan="5" class="text-center py-4 text-slate-400">Tidak ada supplier</td></tr>';
    } catch(e) { tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>'; }
}

async function saveSupplier() {
    const data = {
        name: document.getElementById('sName').value,
        contact_person: document.getElementById('sContact').value,
        phone: document.getElementById('sPhone').value,
        email: document.getElementById('sEmail').value,
        address: document.getElementById('sAddress').value,
        notes: document.getElementById('sNotes').value,
    };
    if (!data.name) return alert('Nama supplier wajib diisi');
    const editId = document.getElementById('editId').value;
    try {
        const url = editId ? '/api/suppliers/' + editId : '/api/suppliers';
        const method = editId ? 'PUT' : 'POST';
        const res = await fetch(url, { method, headers:{'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'}, body: JSON.stringify(data) });
        const json = await res.json();
        alert(json.message || 'Berhasil');
        hideModal();
        loadSuppliers();
    } catch(e) { alert('Network error'); }
}

async function deleteSupplier(id) {
    if (!confirm('Hapus supplier ini?')) return;
    try {
        const res = await fetch('/api/suppliers/' + id, { method:'DELETE', headers:{'X-Requested-With':'XMLHttpRequest'} });
        const json = await res.json();
        alert(json.message || 'Dihapus');
        loadSuppliers();
    } catch(e) { alert('Gagal'); }
}

document.addEventListener('DOMContentLoaded', function() {
    loadSuppliers();
    setInterval(loadSuppliers, 10000);
});
</script>
<?= $this->endSection() ?>
