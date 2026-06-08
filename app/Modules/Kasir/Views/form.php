<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Form Tagihan Manual</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li><a href="<?= base_url('kasir/data') ?>">Kasir</a></li>
      <li class="active">Buat Tagihan</li>
    </ol>
  </nav>
</div>

<section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
  <div class="lg:col-span-8">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title border-b border-slate-100 pb-3 mb-4">Informasi Tagihan & Pasien</h5>
        
        <form class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="form-label">Cari Pasien</label>
              <div class="relative" id="patientSearchWrapper">
                <input type="text" class="form-input" id="patientSearchInput" placeholder="Cari berdasarkan nama atau NIK..." autocomplete="off">
                <div id="patientDropdown" class="absolute z-10 w-full bg-white border border-slate-200 rounded-lg shadow-lg mt-1 max-h-48 overflow-y-auto" style="display:none"></div>
              </div>
            </div>
            <div>
              <label class="form-label">Tanggal Terbit</label>
              <input type="date" class="form-input" id="invoiceDate" value="<?= date('Y-m-d') ?>">
            </div>
          </div>

          <div class="bg-slate-50 p-4 rounded-lg border border-slate-200" id="patientInfoCard" style="display:none">
            <h6 class="font-semibold text-slate-700 mb-2">Data Pasien</h6>
            <div class="grid grid-cols-2 gap-2 text-sm">
              <div class="text-slate-500">Nama:</div><div class="font-bold text-slate-800" id="pNama">-</div>
              <div class="text-slate-500">NIK:</div><div class="font-bold text-slate-800" id="pNik">-</div>
              <div class="text-slate-500">Tgl Lahir:</div><div class="font-bold text-slate-800" id="pTgl">-</div>
              <div class="text-slate-500">Alamat:</div><div class="font-bold text-slate-800" id="pAlamat">-</div>
            </div>
          </div>

          <!-- Unpaid bills for selected patient -->
          <div id="unpaidBillsSection" style="display:none">
            <h5 class="card-title border-b border-slate-100 pb-3 mb-4 mt-6">Tagihan Belum Lunas</h5>
            <div class="overflow-x-auto border border-slate-200 rounded-lg">
              <table class="tw-table m-0">
                <thead class="bg-slate-50 text-xs">
                  <tr>
                    <th>No. Invoice</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th class="w-20">Aksi</th>
                  </tr>
                </thead>
                <tbody id="unpaidTbody" class="divide-y divide-slate-100">
                  <tr><td colspan="4" class="text-center py-3 text-slate-400">Tidak ada tagihan belum lunas</td></tr>
                </tbody>
              </table>
            </div>
          </div>

          <h5 class="card-title border-b border-slate-100 pb-3 mb-4 mt-8">Rincian Item Manual</h5>
          
          <div class="space-y-4" id="item-list">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end p-4 border border-slate-200 rounded-lg bg-white relative">
              <button type="button" class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-500 hover:text-white transition" onclick="hapusItem(this)">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
              </button>
              <div class="md:col-span-5">
                <label class="form-label text-xs">Nama Item / Layanan</label>
                <input type="text" class="form-input item-name" placeholder="Misal: Biaya Konsultasi Dokter Umum">
              </div>
              <div class="md:col-span-2">
                <label class="form-label text-xs">Qty</label>
                <input type="number" class="form-input item-qty" value="1" min="1">
              </div>
              <div class="md:col-span-4">
                <label class="form-label text-xs">Harga Satuan (Rp)</label>
                <input type="number" class="form-input item-price" placeholder="0" min="0">
              </div>
            </div>
          </div>

          <button type="button" class="btn btn-outline-secondary w-full border-dashed py-3 flex justify-center items-center gap-2 hover:bg-slate-50 text-slate-600" onclick="tambahItem()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Item Tagihan Lainnya
          </button>

          <div class="pt-4 flex justify-between items-center border-t border-slate-100 mt-6">
            <a href="<?= base_url('kasir/data') ?>" class="btn btn-outline-secondary">Batal</a>
            <button type="button" class="btn btn-primary px-8 shadow-md" id="btnBuatTagihan" disabled>Buat Tagihan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="lg:col-span-4">
    <div class="card bg-klinik-light border-0 shadow-sm">
      <div class="card-body">
        <h5 class="card-title text-klinik-dark">Ringkasan Tagihan</h5>
        <div class="space-y-3 mt-4 text-sm">
          <div class="flex justify-between items-center text-slate-600">
            <span>Subtotal Item Manual:</span>
            <span class="font-semibold text-slate-800" id="ringkasanManual">Rp 0</span>
          </div>
          <div class="flex justify-between items-center text-slate-600">
            <span>Tagihan Lalu (Blm Lunas):</span>
            <span class="font-semibold text-slate-800" id="ringkasanUnpaid">Rp 0</span>
          </div>
          <div class="flex justify-between items-center text-slate-600">
            <span>Diskon:</span>
            <span class="font-semibold text-red-500">- Rp <span id="ringkasanDiskon">0</span></span>
          </div>
          <div class="flex justify-between items-center text-slate-600">
            <span>Diskon (Rp):</span>
            <input type="number" class="form-input text-sm w-28 text-right" id="inputDiskon" value="0" min="0" style="padding:2px 6px">
          </div>
          <div class="h-px bg-slate-200 my-2"></div>
          <div class="flex justify-between items-center text-lg font-bold text-klinik-primary">
            <span>Total:</span>
            <span id="ringkasanTotal">Rp 0</span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="alert alert-info mt-4">
      <div class="flex gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <p class="text-sm m-0">Tagihan manual untuk pasien dengan sisa tagihan akan digabung jadi satu invoice.</p>
      </div>
    </div>
  </div>
</section>

<script>
let daftarPasien = [];
let selectedPatientId = null;
let patientSearchTimeout = null;
let selectedUnpaidPayments = [];
let unpaidPayments = [];

async function setupPatientSearch() {
    const input = document.getElementById('patientSearchInput');
    const dropdown = document.getElementById('patientDropdown');
    if (!input) return;

    async function tampilkanSemua() {
        try {
            const res = await fetch('/api/patients?all=1');
            daftarPasien = (await res.json()).data || [];
        } catch(e) { daftarPasien = []; }
        dropdown.innerHTML = daftarPasien.length
            ? daftarPasien.map(p => `<div class="px-3 py-2 cursor-pointer hover:bg-klinik-light border-b border-slate-100 text-sm" data-patient-id="${p.id}">${p.full_name} (${p.nik || '-'})</div>`).join('')
            : '<div class="px-3 py-2 text-slate-400 text-sm">Tidak ada pasien</div>';
        dropdown.style.display = 'block';
    }

    input.addEventListener('focus', tampilkanSemua);

    input.addEventListener('input', function() {
        const q = this.value.trim().toLowerCase();
        const filtered = daftarPasien.filter(p => (p.full_name || '').toLowerCase().includes(q) || (p.nik || '').includes(q));
        dropdown.innerHTML = filtered.length
            ? filtered.map(p => `<div class="px-3 py-2 cursor-pointer hover:bg-klinik-light border-b border-slate-100 text-sm" data-patient-id="${p.id}">${p.full_name} (${p.nik || '-'})</div>`).join('')
            : '<div class="px-3 py-2 text-slate-400 text-sm">Tidak ditemukan</div>';
        dropdown.style.display = 'block';
    });

    dropdown.addEventListener('click', function(e) {
        const item = e.target.closest('[data-patient-id]');
        if (!item) return;
        const pt = daftarPasien.find(p => p.id == item.dataset.patientId);
        if (!pt) return;
        pilihPasien(pt);
    });

    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('patientSearchWrapper');
        if (wrapper && !wrapper.contains(e.target)) dropdown.style.display = 'none';
    });
}

function pilihPasien(pt) {
    selectedPatientId = pt.id;
    document.getElementById('patientSearchInput').value = pt.full_name + ' (' + (pt.nik || '') + ')';
    document.getElementById('patientDropdown').style.display = 'none';
    document.getElementById('patientInfoCard').style.display = 'block';
    document.getElementById('pNama').textContent = pt.full_name;
    document.getElementById('pNik').textContent = pt.nik || '-';
    document.getElementById('pTgl').textContent = pt.date_of_birth || '-';
    document.getElementById('pAlamat').textContent = pt.address || '-';
    document.getElementById('btnBuatTagihan').disabled = false;
    loadUnpaidBills(pt.id);
}

async function loadUnpaidBills(patientId) {
    try {
        const res = await fetch('/api/payments');
        const all = (await res.json()).data || [];
        unpaidPayments = all.filter(p => parseInt(p.patient_id) === patientId && p.status === 'unpaid');
    } catch(e) { unpaidPayments = []; }

    const section = document.getElementById('unpaidBillsSection');
    const tbody = document.getElementById('unpaidTbody');
    if (unpaidPayments.length === 0) {
        section.style.display = 'none';
        return;
    }
    section.style.display = 'block';
    selectedUnpaidPayments = [];
    tbody.innerHTML = unpaidPayments.map(p => {
        const total = parseInt(p.total || p.total_amount || 0);
        return `<tr>
            <td class="font-medium">${p.invoice_number || p.payment_code || '-'}</td>
            <td class="text-sm">${p.payment_date ? p.payment_date.slice(0,10) : '-'}</td>
            <td class="font-bold text-rose-600">Rp ${total.toLocaleString()}</td>
            <td><input type="checkbox" class="form-checkbox unpaid-checkbox" data-id="${p.id}" data-total="${total}" checked onchange="hitungTotal()"></td>
        </tr>`;
    }).join('');
    hitungTotal();
}

function hitungTotal() {
    let manualTotal = 0;
    document.querySelectorAll('#item-list .grid').forEach(row => {
        const qty = parseInt(row.querySelector('.item-qty')?.value || 1);
        const price = parseInt(row.querySelector('.item-price')?.value || 0);
        manualTotal += qty * price;
    });
    document.getElementById('ringkasanManual').textContent = 'Rp ' + manualTotal.toLocaleString();

    let unpaidTotal = 0;
    selectedUnpaidPayments = [];
    document.querySelectorAll('.unpaid-checkbox:checked').forEach(cb => {
        unpaidTotal += parseInt(cb.dataset.total);
        selectedUnpaidPayments.push(parseInt(cb.dataset.id));
    });
    document.getElementById('ringkasanUnpaid').textContent = 'Rp ' + unpaidTotal.toLocaleString();

    const diskon = parseInt(document.getElementById('inputDiskon')?.value || 0);
    document.getElementById('ringkasanDiskon').textContent = diskon.toLocaleString();
    const grandTotal = Math.max(0, manualTotal + unpaidTotal - diskon);
    document.getElementById('ringkasanTotal').textContent = 'Rp ' + grandTotal.toLocaleString();
}

document.addEventListener('input', function(e) {
    if (e.target.matches('.item-qty, .item-price, #inputDiskon')) hitungTotal();
});

function tambahItem() {
    const list = document.getElementById('item-list');
    const template = list.querySelector('.grid').cloneNode(true);
    template.querySelectorAll('input').forEach(i => i.value = '');
    template.querySelector('.item-qty').value = 1;
    list.appendChild(template);
}

function hapusItem(btn) {
    const list = document.getElementById('item-list');
    if (list.querySelectorAll('.grid').length > 1) {
        btn.closest('.grid').remove();
        hitungTotal();
    }
}

document.getElementById('btnBuatTagihan')?.addEventListener('click', async function() {
    if (!selectedPatientId) return window.showToast('Pilih pasien terlebih dahulu', 'warning');
    this.disabled = true;
    this.innerHTML = '<span class="loading-spinner"></span> Menyimpan...';

    const items = [];
    document.querySelectorAll('#item-list .grid').forEach(row => {
        const inputs = row.querySelectorAll('input');
        items.push({ nama: inputs[0]?.value || '', qty: parseInt(inputs[1]?.value || 1), harga: parseInt(inputs[2]?.value || 0) });
    });
    const manualTotal = items.reduce((s, i) => s + i.qty * i.harga, 0);
    let unpaidTotal = 0;
    document.querySelectorAll('.unpaid-checkbox:checked').forEach(cb => { unpaidTotal += parseInt(cb.dataset.total); });
    const diskon = parseInt(document.getElementById('inputDiskon')?.value || 0);
    const grandTotal = Math.max(0, manualTotal + unpaidTotal - diskon);

    if (grandTotal <= 0) {
        window.showToast('Total tagihan harus lebih dari 0', 'warning');
        this.disabled = false;
        this.innerHTML = 'Buat Tagihan';
        return;
    }

    try {
        // Mark selected unpaid payments as merged into this new invoice
            for (const pid of selectedUnpaidPayments) {
                await fetch('/api/payments/' + pid, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ notes: 'Digabung ke tagihan baru', processed_by: <?= session()->get('user_id') ?? 'null' ?> })
                });
            }

            // Create new consolidated unpaid payment
            const invoiceCode = 'INV-' + Date.now();
            const res = await fetch('/api/payments', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({
                    invoice_number: invoiceCode,
                    patient_id: selectedPatientId,
                    total: grandTotal,
                    discount: diskon,
                    payment_method: 'cash',
                    notes: 'Tagihan manual: ' + items.map(i => i.nama + ' x' + i.qty).join(', '),
                    processed_by: <?= session()->get('user_id') ?? 'null' ?>
                })
            });
            const json = await res.json();
            if (res.ok) {
                window.showToast('Tagihan berhasil dibuat', 'success');
                setTimeout(() => { window.location.href = '<?= base_url("kasir/billing") ?>?id=' + json.data; }, 500);
            } else {
                window.showToast(json.error || 'Gagal membuat tagihan', 'error');
                this.disabled = false;
                this.innerHTML = 'Buat Tagihan';
            }
    } catch(e) {
        window.showToast('Network error', 'error');
        this.disabled = false;
        this.innerHTML = 'Buat Tagihan';
    }
});

setupPatientSearch();
</script>
<?= $this->endSection() ?>