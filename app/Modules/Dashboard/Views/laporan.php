<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Laporan & Business Intelligence</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li class="active">Laporan & BI</li>
    </ol>
  </nav>
</div>

<!-- KPI Metrics Section -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
  <!-- KPI 1 -->
  <div class="card bg-gradient-to-br from-indigo-500 to-indigo-600 text-white shadow-sm border-none transition hover:scale-[1.02] duration-300">
    <div class="card-body p-6 flex items-center justify-between">
      <div>
        <span class="text-xs text-indigo-100 font-semibold block uppercase">Total Kunjungan</span>
        <h3 class="text-3xl font-extrabold m-0 mt-1" id="kpiTotalVisits">0</h3>
      </div>
      <div class="bg-white/20 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.738.189-1.432.518-2.03M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
      </div>
    </div>
  </div>

  <!-- KPI 2 -->
  <div class="card bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-sm border-none transition hover:scale-[1.02] duration-300">
    <div class="card-body p-6 flex items-center justify-between">
      <div>
        <span class="text-xs text-emerald-100 font-semibold block uppercase">Kunjungan Hari Ini</span>
        <h3 class="text-3xl font-extrabold m-0 mt-1" id="kpiTodayVisits">0</h3>
      </div>
      <div class="bg-white/20 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z" /></svg>
      </div>
    </div>
  </div>

  <!-- KPI 3 -->
  <div class="card bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-sm border-none transition hover:scale-[1.02] duration-300">
    <div class="card-body p-6 flex items-center justify-between">
      <div>
        <span class="text-xs text-blue-100 font-semibold block uppercase">Total Pendapatan</span>
        <h3 class="text-xl font-extrabold m-0 mt-2" id="kpiTotalRevenue">Rp 0</h3>
      </div>
      <div class="bg-white/20 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      </div>
    </div>
  </div>

  <!-- KPI 4 -->
  <div class="card bg-gradient-to-br from-amber-500 to-amber-600 text-white shadow-sm border-none transition hover:scale-[1.02] duration-300">
    <div class="card-body p-6 flex items-center justify-between">
      <div>
        <span class="text-xs text-amber-100 font-semibold block uppercase">Kritis Stok Obat</span>
        <h3 class="text-3xl font-extrabold m-0 mt-1" id="kpiLowStock">0</h3>
      </div>
      <div class="bg-white/20 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 9.172V5L8 4z" /></svg>
      </div>
    </div>
  </div>
</div>

<!-- Visual Reports -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
  <!-- Chart 1: Kunjungan -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Tren Kunjungan Pasien (Harian)</h5>
      <div id="visitsChart" style="min-height: 350px;"></div>
    </div>
  </div>

  <!-- Chart 2: Pendapatan -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Tren Pendapatan Lunas (Harian)</h5>
      <div id="revenueChart" style="min-height: 350px;"></div>
    </div>
  </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
  <!-- Chart 3: Poli distribution -->
  <div class="card lg:col-span-1">
    <div class="card-body">
      <h5 class="card-title">Distribusi Poli Tujuan</h5>
      <div id="poliChart" style="min-height: 300px;"></div>
    </div>
  </div>

  <!-- Export Panel -->
  <div class="card lg:col-span-2">
    <div class="card-body flex flex-col justify-between">
      <div>
        <h5 class="card-title">Ekspor & Raw Data Exporter</h5>
        <p class="text-sm text-slate-500 mb-6">Download data klinis langsung dalam format CSV untuk pelaporan manual dinas kesehatan atau audit keuangan eksternal.</p>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <!-- Button 1 -->
          <button class="btn btn-outline-primary flex flex-col justify-center items-center p-6 gap-2 text-center" onclick="exportVisitsCSV()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="font-bold text-xs uppercase block tracking-wider">Ekspor Kunjungan</span>
            <span class="text-[10px] text-slate-400">Data registrasi & poli</span>
          </button>

          <!-- Button 2 -->
          <button class="btn btn-outline-success flex flex-col justify-center items-center p-6 gap-2 text-center" onclick="exportRevenueCSV()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="font-bold text-xs uppercase block tracking-wider">Ekspor Keuangan</span>
            <span class="text-[10px] text-slate-400">Data invoice & lunas</span>
          </button>

          <!-- Button 3 -->
          <button class="btn btn-outline-warning flex flex-col justify-center items-center p-6 gap-2 text-center" onclick="exportStockCSV()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="font-bold text-xs uppercase block tracking-wider">Ekspor Stok Obat</span>
            <span class="text-[10px] text-slate-400">Daftar stok apotek</span>
          </button>
        </div>
      </div>
      <div class="text-[11px] text-slate-400 mt-4 border-t border-slate-100 pt-3 text-right">
        * Penarikan data menggunakan caching internal CLI. Waktu penarikan real-time.
      </div>
    </div>
  </div>
</div>

<script>
let globalQueues = [];
let globalPayments = [];
let globalDrugs = [];

// Dynamic CSV Downloader Helper
function downloadCSV(data, filename, headers) {
    let csv = headers.join(',') + '\n';
    data.forEach(row => {
        let line = headers.map(h => {
            let val = row[h] !== undefined && row[h] !== null ? row[h] : '';
            // Escape double quotes
            val = typeof val === 'string' ? val.replace(/"/g, '""') : val;
            if (typeof val === 'string' && (val.includes(',') || val.includes('\n') || val.includes('"'))) {
                val = `"${val}"`;
            }
            return val;
        }).join(',');
        csv += line + '\n';
    });
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement("a");
    if (link.download !== undefined) {
        const url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", filename);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}

function exportVisitsCSV() {
    if (!globalQueues.length) return window.showToast('Data kosong', 'warning');
    const headers = ['id', 'queue_number', 'queue_date', 'patient_name', 'patient_code', 'poli', 'status', 'created_at'];
    downloadCSV(globalQueues, `Laporan_Kunjungan_${new Date().toISOString().slice(0,10)}.csv`, headers);
    window.showToast('Laporan Kunjungan diekspor!', 'success');
}

function exportRevenueCSV() {
    if (!globalPayments.length) return window.showToast('Data kosong', 'warning');
    const headers = ['id', 'invoice_number', 'payment_date', 'patient_name', 'payment_method', 'total', 'status'];
    downloadCSV(globalPayments, `Laporan_Pendapatan_${new Date().toISOString().slice(0,10)}.csv`, headers);
    window.showToast('Laporan Keuangan diekspor!', 'success');
}

function exportStockCSV() {
    if (!globalDrugs.length) return window.showToast('Data kosong', 'warning');
    const headers = ['id', 'kode_obat', 'nama_obat', 'unit', 'stok_obat', 'min_stock', 'harga_jual_eceran', 'expiry_date'];
    downloadCSV(globalDrugs, `Laporan_Stok_Obat_${new Date().toISOString().slice(0,10)}.csv`, headers);
    window.showToast('Laporan Stok Obat diekspor!', 'success');
}

async function initDashboard() {
    try {
        // Fetch Queues
        const qRes = await fetch('/api/queues');
        const qJson = await qRes.json();
        globalQueues = qJson.data || [];

        // Fetch Payments
        const pRes = await fetch('/api/payments');
        const pJson = await pRes.json();
        globalPayments = pJson.data || [];

        // Fetch Drugs
        const dRes = await fetch('/api/drugs/detail');
        const dJson = await dRes.json();
        globalDrugs = dJson.data || [];

        // Update KPIs
        document.getElementById('kpiTotalVisits').textContent = globalQueues.length;
        
        const todayStr = new Date().toISOString().slice(0, 10);
        const todayVisits = globalQueues.filter(q => q.queue_date && q.queue_date.slice(0, 10) === todayStr).length;
        document.getElementById('kpiTodayVisits').textContent = todayVisits;

        const totalRevenue = globalPayments
            .filter(p => p.status === 'paid')
            .reduce((sum, p) => sum + parseInt(p.total || p.total_amount || 0), 0);
        document.getElementById('kpiTotalRevenue').textContent = 'Rp ' + totalRevenue.toLocaleString();

        const lowStockCount = globalDrugs.filter(d => parseInt(d.stok_obat) <= parseInt(d.min_stock)).length;
        document.getElementById('kpiLowStock').textContent = lowStockCount;

        renderVisitsChart();
        renderRevenueChart();
        renderPoliChart();
    } catch (e) {
        window.showToast('Gagal memuat data laporan', 'error');
    }
}

function renderVisitsChart() {
    // Group queues by date
    const groups = {};
    globalQueues.forEach(q => {
        if (!q.queue_date) return;
        const date = q.queue_date.slice(0, 10);
        groups[date] = (groups[date] || 0) + 1;
    });

    const sortedDates = Object.keys(groups).sort();
    const counts = sortedDates.map(d => groups[d]);

    const options = {
        chart: { type: 'area', height: 350, toolbar: { show: false } },
        series: [{ name: 'Kunjungan Pasien', data: counts }],
        xaxis: { categories: sortedDates },
        colors: ['#4f46e5'],
        fill: {
            type: 'gradient',
            gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.1 }
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 3 }
    };

    const chart = new ApexCharts(document.querySelector("#visitsChart"), options);
    chart.render();
}

function renderRevenueChart() {
    // Group payments by date
    const groups = {};
    globalPayments.filter(p => p.status === 'paid').forEach(p => {
        if (!p.payment_date) return;
        const date = p.payment_date.slice(0, 10);
        const amount = parseInt(p.total || p.total_amount || 0);
        groups[date] = (groups[date] || 0) + amount;
    });

    const sortedDates = Object.keys(groups).sort();
    const amounts = sortedDates.map(d => groups[d]);

    const options = {
        chart: { type: 'bar', height: 350, toolbar: { show: false } },
        series: [{ name: 'Pendapatan Lunas', data: amounts }],
        xaxis: { categories: sortedDates },
        colors: ['#10b981'],
        dataLabels: { enabled: false },
        plotOptions: {
            bar: { borderRadius: 6, columnWidth: '45%' }
        },
        yaxis: {
            labels: {
                formatter: function(val) {
                    return 'Rp ' + parseInt(val).toLocaleString();
                }
            }
        }
    };

    const chart = new ApexCharts(document.querySelector("#revenueChart"), options);
    chart.render();
}

function renderPoliChart() {
    // Group queues by poli
    const groups = {};
    globalQueues.forEach(q => {
        const poli = q.poli || 'Umum';
        groups[poli] = (groups[poli] || 0) + 1;
    });

    const labels = Object.keys(groups);
    const series = labels.map(l => groups[l]);

    const options = {
        chart: { type: 'donut', height: 300 },
        series: series,
        labels: labels,
        colors: ['#4f46e5', '#10b981', '#3b82f6', '#f59e0b', '#ec4899', '#64748b'],
        legend: { position: 'bottom' },
        plotOptions: {
            pie: { donut: { size: '65%' } }
        }
    };

    const chart = new ApexCharts(document.querySelector("#poliChart"), options);
    chart.render();
}

document.addEventListener('DOMContentLoaded', initDashboard);
</script>
<?= $this->endSection() ?>
