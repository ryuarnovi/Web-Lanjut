<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Antrean Penebusan Obat</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Apoteker</li>
      <li class="active">Resep</li>
    </ol>
  </nav>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Resep Pending (Penebusan)</h5>
      
      <div class="overflow-x-auto">
        <table class="tw-table">
          <thead>
            <tr>
              <th>Kode Resep</th>
              <th>Nama Pasien</th>
              <th>Dokter Perujuk</th>
              <th>Waktu Order</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr><td colspan="6" class="text-center py-4 text-slate-400">Memuat data...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<div id="detailResepModal"></div>

<script>
async function loadPrescriptionTable() {
    const tbody = document.querySelector('.tw-table tbody');
    if (!tbody) return;
    try {
        const res = await fetch('/api/prescriptions');
        const json = await res.json();
        const list = json.data || [];
        
        window.paginateTable('.tw-table', list, 10, r => {
            const statusMap = { 'pending': 'warning', 'processed': 'info', 'completed': 'success', 'cancelled': 'danger' };
            const statusBadge = statusMap[r.status] || 'secondary';
            const label = r.status === 'pending' ? 'Menunggu' : r.status === 'processed' ? 'Diproses' : r.status === 'completed' ? 'Selesai' : r.status === 'cancelled' ? 'Batal' : r.status;
            return `<tr>
                <td class="font-medium">${r.prescription_code || '-'}</td>
                <td>${r.patient_name || '-'}</td>
                <td>${r.doctor_name || '-'}</td>
                <td>${r.prescription_date ? r.prescription_date.slice(11,16) : (r.created_at ? r.created_at.slice(11,16) : '-')}</td>
                <td><span class="badge badge-${statusBadge}">${label}</span></td>
                <td><button class="btn btn-sm btn-primary" onclick="detailResep(${r.id})">Lihat Resep</button></td>
            </tr>`;
        });
    } catch(e) { tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-red-500">Gagal memuat data</td></tr>'; }
}

async function detailResep(id) {
    try {
        const res = await fetch('/api/prescriptions');
        const json = await res.json();
        const list = json.data || [];
        const r = list.find(p => parseInt(p.id) === parseInt(id));
        if (!r) return alert('Data tidak ditemukan');
        const items = r.items || [];
        const container = document.getElementById('detailResepModal');
        container.innerHTML = `
            <div class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center animate-fade-in" onclick="if(event.target===this)document.getElementById('detailResepModal').innerHTML=''">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 modal-content" onclick="event.stopPropagation()">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="text-lg font-bold">Detail Resep: ${r.prescription_code || '-'}</h5>
                            <button class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('detailResepModal').innerHTML=''">Tutup</button>
                        </div>
                        <div class="space-y-2 text-sm mb-4">
                            <p><span class="font-semibold text-slate-500">Pasien:</span> ${r.patient_name || '-'}</p>
                            <p><span class="font-semibold text-slate-500">Dokter:</span> ${r.doctor_name || '-'}</p>
                            <p><span class="font-semibold text-slate-500">Status:</span> ${r.status || '-'}</p>
                            ${r.notes ? `<p><span class="font-semibold text-slate-500">Catatan:</span> ${r.notes}</p>` : ''}
                        </div>
                        <h6 class="font-bold text-slate-800 mb-2">Items Obat</h6>
                        <div class="overflow-x-auto border border-slate-200 rounded-lg">
                            <table class="tw-table m-0">
                                <thead class="bg-slate-50">
                                    <tr><th>Obat</th><th>Jumlah</th><th>Dosis</th></tr>
                                </thead>
                                <tbody>
                                    ${items.length ? items.map(item => `<tr>
                                        <td>${item.drug_name || '-'}</td>
                                        <td>${item.qty || 0} ${item.unit || ''}</td>
                                        <td>${item.dosage || '-'}</td>
                                    </tr>`).join('') : '<tr><td colspan="3" class="text-center py-2 text-slate-400">Tidak ada item</td></tr>'}
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 flex justify-end gap-2">
                            ${r.status === 'pending' ? `<button class="btn btn-primary" onclick="prosesResep(${r.id})">Proses Resep</button>` : ''}
                            ${r.status === 'processed' ? `<button class="btn btn-success" onclick="serahkanResep(${r.id})">Serahkan Obat</button>` : ''}
                        </div>
                    </div>
                </div>
            </div>`;
    } catch(e) { alert('Gagal memuat detail resep'); }
}

async function prosesResep(id) {
    try {
        const res = await fetch('/api/prescriptions/' + id, { method:'PUT', headers:{'Content-Type':'application/json'}, body: JSON.stringify({ status: 'processed', processed_at: new Date().toISOString().slice(0,19).replace('T',' '), processed_by: <?= session()->get('user_id') ?? 'null' ?> }) });
        const json = await res.json();
        if (res.ok) { window.showToast('Resep diproses', 'success'); document.getElementById('detailResepModal').innerHTML = ''; loadPrescriptionTable(); }
        else { window.showToast(json.error || 'Gagal memproses resep', 'error'); }
    } catch(e) { window.showToast('Network error', 'error'); }
}

function serahkanResep(id) {
    window.confirmDialog('Apakah Anda yakin ingin menyerahkan obat dan menyelesaikan resep ini?', async () => {
        try {
            const res = await fetch('/api/prescriptions/' + id, { 
                method: 'PUT', 
                headers: { 'Content-Type': 'application/json' }, 
                body: JSON.stringify({ status: 'completed' }) 
            });
            const json = await res.json();
            if (res.ok) { 
                window.showToast('Obat berhasil diserahkan dan resep selesai', 'success'); 
                document.getElementById('detailResepModal').innerHTML = ''; 
                loadPrescriptionTable(); 
            } else { 
                window.showToast(json.error || 'Gagal menyerahkan obat', 'error'); 
            }
        } catch(e) { 
            window.showToast('Network error', 'error'); 
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    loadPrescriptionTable();
    setInterval(loadPrescriptionTable, 10000);
});
</script>
<?= $this->endSection() ?>
