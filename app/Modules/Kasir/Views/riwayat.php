<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Riwayat Transaksi</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li>Kasir</li>
      <li class="active">Riwayat</li>
    </ol>
  </nav>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
  <div class="card bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-sm border-none transition hover:scale-[1.02] duration-300">
    <div class="card-body p-5 flex items-center justify-between">
      <div>
        <span class="text-xs text-emerald-100 font-semibold block uppercase">Total Lunas</span>
        <h3 class="text-2xl font-extrabold m-0 mt-1" id="kpiPaid">0</h3>
      </div>
      <div class="bg-white/20 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      </div>
    </div>
  </div>
  <div class="card bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-sm border-none transition hover:scale-[1.02] duration-300">
    <div class="card-body p-5 flex items-center justify-between">
      <div>
        <span class="text-xs text-blue-100 font-semibold block uppercase">Total Pendapatan</span>
        <h3 class="text-xl font-extrabold m-0 mt-2" id="kpiRevenue">Rp 0</h3>
      </div>
      <div class="bg-white/20 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      </div>
    </div>
  </div>
  <div class="card bg-gradient-to-br from-amber-500 to-amber-600 text-white shadow-sm border-none transition hover:scale-[1.02] duration-300">
    <div class="card-body p-5 flex items-center justify-between">
      <div>
        <span class="text-xs text-amber-100 font-semibold block uppercase">Belum Bayar</span>
        <h3 class="text-2xl font-extrabold m-0 mt-1" id="kpiUnpaid">0</h3>
      </div>
      <div class="bg-white/20 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
      </div>
    </div>
  </div>
</div>

<section>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-klinik-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
        Arsip Pembayaran
      </h5>

      <div class="flex items-center gap-3 flex-wrap mb-4">
        <input id="pay-search" placeholder="Cari invoice / pasien..." class="form-input w-64 text-sm">
        <select id="pay-status-filter" class="form-select w-auto text-sm">
          <option value="">Semua Status</option>
          <option value="paid">Lunas</option>
          <option value="unpaid">Belum Bayar</option>
          <option value="cancelled">Batal</option>
        </select>
      </div>

      <div class="overflow-x-auto border border-slate-200 rounded-lg">
        <table class="tw-table m-0">
          <thead class="bg-slate-50">
            <tr>
              <th>No. Invoice</th>
              <th>Tanggal</th>
              <th>Pasien</th>
              <th>Metode</th>
              <th>Total</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="payments-tbody">
            <tr><td colspan="6" class="text-center py-4 text-slate-400">Memuat data...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
let ALL_PAYMENTS = [];

async function loadPayments() {
  try {
    const res = await fetch('/api/payments');
    const json = await res.json();
    ALL_PAYMENTS = json.data || [];
    updateKPI();
    renderPayments();
  } catch(e) { showToast('Gagal memuat data pembayaran', 'error'); }
}

function updateKPI() {
  const paid = ALL_PAYMENTS.filter(p => p.status === 'paid');
  const unpaid = ALL_PAYMENTS.filter(p => p.status === 'unpaid');
  const totalRevenue = paid.reduce((sum, p) => sum + parseInt(p.total || p.total_amount || 0), 0);
  document.getElementById('kpiPaid').textContent = paid.length;
  document.getElementById('kpiRevenue').textContent = 'Rp ' + totalRevenue.toLocaleString('id-ID');
  document.getElementById('kpiUnpaid').textContent = unpaid.length;
}

function renderPayments() {
  const q = document.getElementById('pay-search').value.toLowerCase();
  const s = document.getElementById('pay-status-filter').value;
  const tbody = document.getElementById('payments-tbody');

  const filtered = ALL_PAYMENTS.filter(p =>
    (!q || (p.invoice_number||p.payment_code||'').toLowerCase().includes(q) || (p.patient_name||'').toLowerCase().includes(q)) &&
    (!s || p.status === s)
  );

  if (!filtered.length) {
    tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-slate-400">Tidak ada data</td></tr>';
    return;
  }

  const statusBadge = { paid:'success', unpaid:'warning', cancelled:'danger' };
  const statusLabel = { paid:'Lunas', unpaid:'Belum Bayar', cancelled:'Batal' };

  window.paginateTable('.tw-table', filtered, 15, (p) => {
    const badge = statusBadge[p.status] || 'secondary';
    const label = statusLabel[p.status] || p.status;
    const total = parseInt(p.total || p.total_amount || 0);
    return `<tr>
      <td class="font-bold text-klinik-primary">${p.invoice_number || p.payment_code || '-'}</td>
      <td class="text-sm text-slate-500">${p.payment_date || p.created_at || '-'}</td>
      <td class="font-medium text-slate-700">${p.patient_name || '-'}</td>
      <td class="text-sm text-slate-500">${p.payment_method || '-'}</td>
      <td class="font-semibold">Rp ${total.toLocaleString('id-ID')}</td>
      <td><span class="badge badge-${badge}">${label}</span></td>
    </tr>`;
  });
}

document.getElementById('pay-search').addEventListener('input', renderPayments);
document.getElementById('pay-status-filter').addEventListener('change', renderPayments);

document.addEventListener('DOMContentLoaded', loadPayments);
</script>
<?= $this->endSection() ?>
