<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Stok Obat & Inventory</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Apoteker</li>
      <li class="active">Inventory</li>
    </ol>
  </nav>
</div>

<!-- Tabs Navigation -->
<div class="tw-tabs border-b border-slate-200 mb-6 flex gap-4" data-tabs>
  <button class="tw-tab active py-2 px-4 border-b-2 border-transparent font-semibold text-slate-500 hover:text-slate-800 transition" data-tab="stok-obat">
    Daftar Stok Obat
  </button>
  <button class="tw-tab py-2 px-4 border-b-2 border-transparent font-semibold text-slate-500 hover:text-slate-800 transition" data-tab="log-stok">
    Log Transaksi Stok
  </button>
</div>

<!-- Tab Content: Stok Obat -->
<div class="tw-tab-content active" data-tab-content="stok-obat">
  <div class="card">
    <div class="card-body">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-6 mt-2">
          <h5 class="card-title p-0 m-0">Stok Obat Apotek</h5>
          <div class="flex flex-wrap gap-2">
            <a href="<?= base_url('apoteker/form') ?>" class="btn btn-primary flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              Tambah Item Baru
            </a>
            <button class="btn btn-success flex items-center gap-2" onclick="document.getElementById('importModal').innerHTML = getImportModalHTML(); document.getElementById('importModal').querySelector('.modal-overlay').classList.remove('hidden')">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
              Import
            </button>
            <a href="<?= base_url('api/drugs/export') ?>" class="btn btn-info flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
              Export
            </a>
            <a href="<?= base_url('api/drugs/template') ?>" class="btn btn-outline-secondary flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
              Template
            </a>
          </div>
        </div>
      
      <div class="overflow-x-auto">
        <table class="tw-table border border-slate-200" id="stockTable">
          <thead class="bg-slate-50">
            <tr>
              <th>SKU / Kode</th>
              <th>Nama Obat</th>
              <th>Satuan</th>
              <th>Stok Sisa</th>
              <th>Min. Stock</th>
              <th>Harga Jual (HET)</th>
              <th>Tgl Kadaluarsa</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            <tr><td colspan="9" class="text-center py-4 text-slate-400">Memuat data obat...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Tab Content: Log Transaksi -->
<div class="tw-tab-content" data-tab-content="log-stok">
  <div class="card">
    <div class="card-body">
      <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-6 mt-2">
        <h5 class="card-title p-0 m-0">Riwayat Pergerakan Stok</h5>
      </div>
      
      <div class="overflow-x-auto">
        <table class="tw-table border border-slate-200" id="logTable">
          <thead class="bg-slate-50">
            <tr>
              <th>Waktu</th>
              <th>Obat</th>
              <th>Tipe</th>
              <th>Jumlah</th>
              <th>Supplier</th>
              <th>No. Batch</th>
              <th>Kadaluarsa</th>
              <th>Catatan</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            <tr><td colspan="8" class="text-center py-4 text-slate-400">Memuat riwayat transaksi...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Detail Drug Modal -->
<div id="drugDetailModal"></div>

<!-- Import Modal -->
<div id="importModal"></div>

<script>
async function loadStockTable() {
    const tbody = document.querySelector('#stockTable tbody');
    if (!tbody) return;
    try {
        const res = await fetch('/api/drugs/detail');
        const json = await res.json();
        const drugs = json.data || [];
        
        window.paginateTable('#stockTable', drugs, 10, d => {
            // Check expiry condition (near expiry is < 30 days)
            const expiryDate = d.expiry_date ? new Date(d.expiry_date) : null;
            const today = new Date();
            let expiryClass = '';
            let expiryWarning = '';
            let statusBadge = '<span class="badge badge-success">Stok Aman</span>';
            
            if (expiryDate) {
                const diffTime = expiryDate - today;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                if (diffDays <= 0) {
                    expiryClass = 'text-red-600 font-bold bg-red-50/50 dark:bg-red-950/20';
                    expiryWarning = '<span class="text-xs font-bold block text-red-600">Kadaluarsa</span>';
                    statusBadge = '<span class="badge badge-danger bg-slate-500">Expired</span>';
                } else if (diffDays <= 30) {
                    expiryClass = 'text-red-500 font-medium';
                    expiryWarning = `<span class="text-xs font-semibold block text-red-500">Expired in ${diffDays}d</span>`;
                    statusBadge = '<span class="badge badge-warning">Near Expiry</span>';
                }
            }

            const isLowStock = parseInt(d.stok_obat) <= parseInt(d.min_stock);
            if (isLowStock && statusBadge.indexOf('Expired') === -1) {
                statusBadge = '<span class="badge badge-danger">Low Stock</span>';
            }

            const stockClass = isLowStock ? 'font-bold text-red-500' : 'font-bold text-slate-700';

            return `<tr>
                <td class="font-medium text-slate-700">${d.kode_obat || '-'}</td>
                <td>${d.nama_obat || '-'}</td>
                <td>${d.unit || '-'}</td>
                <td class="${stockClass}">${d.stok_obat}</td>
                <td>${d.min_stock || 0}</td>
                <td>Rp ${parseInt(d.harga_jual_eceran || 0).toLocaleString()}</td>
                <td class="${expiryClass}">${d.expiry_date ? d.expiry_date.slice(0,10) : '-'} ${expiryWarning}</td>
                <td>${statusBadge}</td>
                <td>
                  <button class="btn btn-sm btn-outline-info p-1.5" onclick="viewDrugDetail('${d.kode_obat}')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                  </button>
                </td>
            </tr>`;
        });
    } catch(e) { 
        tbody.innerHTML = '<tr><td colspan="9" class="text-center py-4 text-red-500">Gagal memuat data obat</td></tr>'; 
    }
}

async function loadTransactionTable() {
    const tbody = document.querySelector('#logTable tbody');
    if (!tbody) return;
    try {
        const res = await fetch('/api/stock-transactions');
        const json = await res.json();
        const transactions = json.data || [];
        
        window.paginateTable('#logTable', transactions, 15, st => {
            const typeBadge = st.type === 'in' 
                ? '<span class="badge badge-success bg-emerald-100 text-emerald-800 border-none">Masuk</span>' 
                : '<span class="badge badge-danger bg-rose-100 text-rose-800 border-none">Keluar</span>';
            const qtyClass = st.type === 'in' ? 'text-emerald-600 font-semibold' : 'text-rose-600 font-semibold';
            return `<tr>
                <td class="text-slate-500 text-xs">${st.created_at || '-'}</td>
                <td class="font-medium">${st.drug_name || '-'}</td>
                <td>${typeBadge}</td>
                <td class="${qtyClass}">${st.type === 'in' ? '+' : '-'}${st.quantity || 0}</td>
                <td>${st.supplier_name || '-'}</td>
                <td>${st.batch_number || '-'}</td>
                <td>${st.expiry_date ? st.expiry_date.slice(0,10) : '-'}</td>
                <td class="text-slate-600 text-xs">${st.notes || '-'}</td>
            </tr>`;
        });
    } catch(e) { 
        tbody.innerHTML = '<tr><td colspan="8" class="text-center py-4 text-red-500">Gagal memuat data transaksi</td></tr>'; 
    }
}

async function viewDrugDetail(sku) {
    try {
        const res = await fetch('/api/drugs/' + sku);
        const json = await res.json();
        const d = json.data;
        if (!d) return alert('Obat tidak ditemukan');
        
        const container = document.getElementById('drugDetailModal');
        container.innerHTML = `
            <div class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center animate-fade-in" onclick="if(event.target===this)document.getElementById('drugDetailModal').innerHTML=''">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl mx-4 modal-content" onclick="event.stopPropagation()">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4 border-b border-slate-100 pb-3">
                            <h5 class="text-lg font-bold">Detail Obat: ${d.nama_obat}</h5>
                            <button class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('drugDetailModal').innerHTML=''">Tutup</button>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                            <div>
                                <p><span class="font-semibold text-slate-500">SKU / Kode:</span> ${d.kode_obat || '-'}</p>
                                <p><span class="font-semibold text-slate-500">Golongan:</span> ${d.golongan_obat || '-'}</p>
                                <p><span class="font-semibold text-slate-500">Kategori:</span> ${d.kategori_obat || '-'}</p>
                                <p><span class="font-semibold text-slate-500">Bentuk:</span> ${d.bentuk_obat || '-'}</p>
                                <p><span class="font-semibold text-slate-500">Dosis:</span> ${d.dosis_obat || '-'}</p>
                            </div>
                            <div>
                                <p><span class="font-semibold text-slate-500">Stok Sisa:</span> ${d.stok_obat} ${d.unit || ''}</p>
                                <p><span class="font-semibold text-slate-500">Min. Stock:</span> ${d.min_stock} ${d.unit || ''}</p>
                                <p><span class="font-semibold text-slate-500">Harga Eceran:</span> Rp ${parseInt(d.harga_jual_eceran || 0).toLocaleString()}</p>
                                <p><span class="font-semibold text-slate-500">Harga Grosir/Beli:</span> Rp ${parseInt(d.harga_jual_grosir || 0).toLocaleString()}</p>
                                <p><span class="font-semibold text-slate-500">Tgl Kadaluarsa:</span> ${d.expiry_date ? d.expiry_date.slice(0,10) : '-'}</p>
                            </div>
                        </div>
                        ${d.deskripsi ? `<div class="mb-3 text-sm"><span class="font-semibold text-slate-500 block">Deskripsi:</span><p class="text-slate-600">${d.deskripsi}</p></div>` : ''}
                        ${d.fungsi_obat ? `<div class="mb-3 text-sm"><span class="font-semibold text-slate-500 block">Indikasi/Fungsi:</span><p class="text-slate-600">${d.fungsi_obat}</p></div>` : ''}
                        ${d.efek_samping ? `<div class="mb-3 text-sm"><span class="font-semibold text-slate-500 block">Efek Samping:</span><p class="text-slate-600">${d.efek_samping}</p></div>` : ''}
                    </div>
                </div>
            </div>`;
    } catch(e) { 
        alert('Gagal memuat detail obat'); 
    }
}

function getImportModalHTML() {
    return `<div class="fixed inset-0 z-50 bg-black/40 flex items-center justify-center modal-overlay hidden" onclick="if(event.target===this)closeImportModal()">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl mx-4 p-6 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-4 border-b border-slate-100 pb-3">
                <h5 class="text-lg font-bold">Import Stok Obat dari CSV</h5>
                <button class="btn btn-sm btn-outline-secondary" onclick="closeImportModal()">Tutup</button>
            </div>
            <div class="text-sm text-slate-600 mb-4 space-y-2">
                <p class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>Download template terlebih dahulu untuk format kolom yang benar.</p>
                <p class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>Jika kode_obat sudah ada, data akan diperbarui (update).</p>
                <p class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>Kolom wajib: <strong>nama_obat</strong>. Sisanya opsional.</p>
            </div>
            <form id="importForm" class="space-y-4">
                <div>
                    <label class="form-label">Pilih File CSV</label>
                    <input type="file" class="form-input" id="importFileInput" accept=".csv,.txt" required>
                    <p class="text-xs text-slate-400 mt-1">Maksimal 2MB. File harus berformat CSV dengan delimiter koma.</p>
                </div>
                <div id="importPreview" class="hidden">
                    <label class="form-label">Pratinjau</label>
                    <div class="border border-slate-200 rounded-lg overflow-x-auto max-h-40">
                        <table class="tw-table m-0 text-xs" id="previewTable">
                            <thead><tr id="previewHeader"></tr></thead>
                            <tbody id="previewBody"></tbody>
                        </table>
                    </div>
                    <p class="text-xs text-slate-400 mt-1" id="previewCount"></p>
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="submit" class="btn btn-success flex items-center gap-2" id="btnImport">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                        Import Data
                    </button>
                    <button type="button" class="btn btn-outline-secondary" onclick="closeImportModal()">Batal</button>
                </div>
            </form>
            <div id="importResult" class="hidden mt-4"></div>
        </div>
    </div>`;
}

function closeImportModal() {
    const overlay = document.querySelector('#importModal .modal-overlay');
    if (overlay) overlay.classList.add('hidden');
    document.getElementById('importResult')?.classList.add('hidden');
}

function previewCSV(file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        const text = e.target.result;
        const lines = text.split('\n').filter(l => l.trim());
        if (lines.length < 1) return;

        const preview = document.getElementById('importPreview');
        preview.classList.remove('hidden');

        const headers = parseCSVLine(lines[0]);
        const headerRow = document.getElementById('previewHeader');
        headerRow.innerHTML = headers.map(h => `<th class="text-xs">${h.trim()}</th>`).join('');

        const body = document.getElementById('previewBody');
        const maxPreview = Math.min(lines.length - 1, 5);
        body.innerHTML = '';
        for (let i = 1; i <= maxPreview; i++) {
            const cells = parseCSVLine(lines[i]);
            body.innerHTML += `<tr>${cells.map(c => `<td class="text-xs">${c.trim()}</td>`).join('')}</tr>`;
        }

        document.getElementById('previewCount').textContent = `Menampilkan ${maxPreview} dari ${lines.length - 1} baris data`;
    };
    reader.readAsText(file);
}

function parseCSVLine(line) {
    const result = [];
    let current = '';
    let inQuotes = false;
    for (let i = 0; i < line.length; i++) {
        const ch = line[i];
        if (ch === '"') {
            inQuotes = !inQuotes;
        } else if (ch === ',' && !inQuotes) {
            result.push(current);
            current = '';
        } else {
            current += ch;
        }
    }
    result.push(current);
    return result;
}

document.addEventListener('DOMContentLoaded', function() {
    // Import file preview
    document.addEventListener('change', function(e) {
        if (e.target && e.target.id === 'importFileInput') {
            const file = e.target.files[0];
            if (file) previewCSV(file);
        }
    });

    // Import form submit
    document.addEventListener('submit', async function(e) {
        if (e.target && e.target.id === 'importForm') {
            e.preventDefault();
            const fileInput = document.getElementById('importFileInput');
            const file = fileInput?.files[0];
            if (!file) return showToast('Pilih file CSV terlebih dahulu', 'warning');

            const formData = new FormData();
            formData.append('file', file);

            const btn = document.getElementById('btnImport');
            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Importing...';

            try {
                const res = await fetch('/api/drugs/import', { method: 'POST', body: formData });
                const json = await res.json();
                const resultDiv = document.getElementById('importResult');
                resultDiv.classList.remove('hidden');
                if (res.ok) {
                    resultDiv.innerHTML = '<div class="p-3 rounded-lg bg-green-50 text-green-700 border border-green-200 text-sm">' + (json.message || 'Import berhasil') + '</div>';
                    showToast(json.message || 'Import berhasil', 'success');
                    loadStockTable();
                } else {
                    const errMsg = json.error || 'Gagal import';
                    const details = json.details ? '<ul class="mt-1 list-disc pl-4">' + json.details.map(d => '<li>' + d + '</li>').join('') + '</ul>' : '';
                    resultDiv.innerHTML = '<div class="p-3 rounded-lg bg-red-50 text-red-700 border border-red-200 text-sm">' + errMsg + details + '</div>';
                    showToast(errMsg, 'error');
                }
            } catch(e) {
                showToast('Gagal mengunggah file', 'error');
            }
            btn.disabled = false;
            btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg> Import Data';
        }
    });

    loadStockTable();
    
    // Add event listener to the tabs
    document.querySelectorAll('.tw-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.getAttribute('data-tab');
            if (target === 'stok-obat') {
                loadStockTable();
            } else if (target === 'log-stok') {
                loadTransactionTable();
            }
        });
    });

    // Auto refresh stock table only
    setInterval(() => {
        const activeTab = document.querySelector('.tw-tab.active');
        if (activeTab && activeTab.getAttribute('data-tab') === 'stok-obat') {
            loadStockTable();
        }
    }, 10000);
});
</script>
<?= $this->endSection() ?>
