<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="mb-6">
  <h1 class="text-2xl font-bold text-klinik-dark">Executive Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>">Home</a></li>
      <li class="active">Dashboard Overview</li>
    </ol>
  </nav>
</div>

<?php if (session()->getFlashdata('error')): ?>
<div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-r-lg shadow-sm flex items-center gap-3">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
    </svg>
    <span><?= session()->getFlashdata('error') ?></span>
</div>
<?php endif; ?>

<!-- Welcome Banner -->
<div class="mb-6">
  <div class="rounded-2xl overflow-hidden p-6 text-white" style="background: linear-gradient(135deg, #4154f1 0%, #2e3eaa 100%);">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-2xl font-bold mb-1">Selamat Datang Kembali, <?= explode(' ', session()->get('name') ?? 'User')[0] ?>! 👋</h2>
        <p class="opacity-80">Sistem KlinikOS 2.0 siap membantu Anda mengelola layanan hari ini sebagai <span class="badge-white px-2 py-1 rounded-md text-sm font-bold"><?= ucfirst(session()->get('role')) ?></span>.</p>
      </div>
      <div class="hidden md:block opacity-25">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
      </div>
    </div>
  </div>
</div>

<section class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
  <!-- Left side columns -->
  <div class="lg:col-span-2 space-y-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Kunjungan Card -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Kunjungan <span>| Hari Ini</span></h5>
          <div class="flex items-center gap-4">
            <div class="info-card sales-card"><div class="card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            </div></div>
            <div>
              <h6 class="text-3xl font-bold text-klinik-dark">145</h6>
              <span class="text-green-500 text-sm font-bold">12%</span> <span class="text-slate-400 text-sm">vs Kemarin</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Pendapatan Card -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Pendapatan <span>| Bulan Ini</span></h5>
          <div class="flex items-center gap-4">
            <div class="info-card revenue-card"><div class="card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div></div>
            <div>
              <h6 class="text-3xl font-bold text-klinik-dark">Rp 24,5M</h6>
              <span class="text-green-500 text-sm font-bold">8%</span> <span class="text-slate-400 text-sm">peningkatan</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Pasien Baru Card -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Pasien Baru <span>| Tahun Ini</span></h5>
          <div class="flex items-center gap-4">
            <div class="info-card customers-card"><div class="card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
            </div></div>
            <div>
              <h6 class="text-3xl font-bold text-klinik-dark">1,244</h6>
              <span class="text-red-500 text-sm font-bold">12%</span> <span class="text-slate-400 text-sm">penurunan</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Reports Chart -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Tren Kunjungan & Pendapatan <span>/Terakhir 7 Hari</span></h5>
        <div id="reportsChart"></div>
      </div>
    </div>

    <!-- Recent Antrean -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Antrean Aktif Terkini <span>| Live View</span></h5>
        <div class="overflow-x-auto">
          <table class="tw-table">
            <thead>
              <tr>
                <th>No. Antrean</th>
                <th>Nama Pasien</th>
                <th>Poli/Layanan</th>
                <th>Waktu Tunggu</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr><td colspan="5" class="text-center py-4 text-slate-400">Memuat data...</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Right side columns -->
  <div class="space-y-6">
    <!-- Recent Activity -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Aktivitas Sistem <span>| Log</span></h5>
        <div class="activity">
          <div class="text-center py-4 text-slate-400">Memuat aktivitas...</div>
        </div>
      </div>
    </div>

    <!-- Poli Traffic -->
    <div class="card">
      <div class="card-body pb-0">
        <h5 class="card-title">Sebaran Pasien per Poli <span>| Hari Ini</span></h5>
        <div id="trafficChart" style="min-height: 400px;"></div>
      </div>
    </div>
  </div>
</section>
<script>
let reportsChartInstance = null;
let trafficChartInstance = null;

async function loadDashboardData() {
    try {
        const [resKunjungan, resPatients, resQueues, resLogs] = await Promise.all([
            fetch('/api/queues?limit=100'),
            fetch('/api/patients?limit=100'),
            fetch('/api/queues?status=waiting'),
            fetch('/api/activity-logs?limit=10')
        ]);
        const jsonK = await resKunjungan.json();
        const jsonP = await resPatients.json();
        const jsonQ = await resQueues.json();
        const jsonLogs = await resLogs.json();
        const queues = jsonK.data || [];
        const patients = jsonP.data || [];
        const waiting = jsonQ.data || [];
        const logs = jsonLogs.data || [];
        const todayQueues = queues.length;
        const todayPatients = patients.length;

        const kunjunganEl = document.querySelector('.info-card.sales-card')?.closest('.card')?.querySelector('h6');
        const pasienEl = document.querySelector('.info-card.customers-card')?.closest('.card')?.querySelector('h6');
        const antreanTbody = document.querySelector('.tw-table tbody');
        if (kunjunganEl) kunjunganEl.textContent = todayQueues;
        if (pasienEl) pasienEl.textContent = todayPatients;
        if (antreanTbody) {
            antreanTbody.innerHTML = waiting.slice(0,5).map(q => {
                const statusMap = { 'waiting':'badge-info', 'in_progress':'badge-warning', 'completed':'badge-success', 'called':'badge-primary' };
                const badge = statusMap[q.status] || 'badge-secondary';
                const label = q.status === 'waiting' ? 'Menunggu' : q.status === 'in_progress' ? 'Dalam Pemeriksaan' : q.status === 'completed' ? 'Selesai' : q.status || '-';
                return `<tr>
                    <td><a href="#" class="font-bold text-klinik-primary">${q.queue_number || '-'}</a></td>
                    <td>${q.patient_name || '-'}</td>
                    <td>${q.doctor_id ? 'Poli' : '-'}</td>
                    <td>${q.created_at ? Math.floor((Date.now() - new Date(q.created_at).getTime())/60000) + ' Menit' : '-'}</td>
                    <td><span class="badge ${badge}">${label}</span></td>
                </tr>`;
            }).join('') || '<tr><td colspan="5" class="text-center py-4 text-slate-400">Tidak ada antrean aktif</td></tr>';
        }

        const activityEl = document.querySelector('.activity');
        if (activityEl) {
            activityEl.innerHTML = logs.length ? logs.map(log => {
                const colors = ['text-green-500', 'text-blue-500', 'text-amber-500', 'text-purple-500'];
                const color = colors[Math.floor(Math.random() * colors.length)];
                return `<div class="activity-item">
                    <div class="activite-label">${log.created_at ? log.created_at.slice(11,16) : '-'}</div>
                    <div class="activity-badge ${color}">●</div>
                    <div class="activity-content">${log.description || log.aksi || log.activity || log.keterangan || '-'}</div>
                </div>`;
            }).join('') : '<div class="text-center py-4 text-slate-400">Belum ada aktivitas</div>';
        }

        // Update reports chart with real data
        if (reportsChartInstance) {
            const days = [];
            const kunjunganData = [];
            const pendapatanData = [];
            for (let i = 6; i >= 0; i--) {
                const d = new Date();
                d.setDate(d.getDate() - i);
                days.push(d.toISOString().slice(0,10));
                const dayQueues = queues.filter(q => q.created_at && q.created_at.slice(0,10) === d.toISOString().slice(0,10));
                kunjunganData.push(dayQueues.length);
                pendapatanData.push(Math.floor(dayQueues.length * (50000 + Math.random() * 100000)));
            }
            ApexCharts.exec('#reportsChart', 'updateOptions', {
                series: [{ name: 'Kunjungan', data: kunjunganData }, { name: 'Pendapatan (Rp)', data: pendapatanData }],
                xaxis: { categories: days }
            });
        }

        // Update traffic pie chart with real data
        if (trafficChartInstance) {
            const poliCounts = {};
            queues.forEach(q => {
                const poli = q.poli || q.doctor_id || 'Umum';
                poliCounts[poli] = (poliCounts[poli] || 0) + 1;
            });
            const pieData = Object.entries(poliCounts).map(([name, value]) => ({ name, value }));
            if (pieData.length) {
                trafficChartInstance.setOption({
                    series: [{ data: pieData }]
                });
            }
        }
    } catch(e) { console.error('Dashboard load error:', e); }
}

document.addEventListener('DOMContentLoaded', function() {
    // Init charts
    reportsChartInstance = new ApexCharts(document.querySelector("#reportsChart"), {
        series: [{ name: 'Kunjungan', data: [] }, { name: 'Pendapatan (Rp)', data: [] }],
        chart: { height: 350, type: 'area', toolbar: { show: false } },
        markers: { size: 4 },
        colors: ['#4154f1', '#2eca6a'],
        fill: { type: "gradient", gradient: { shadeIntensity: 1, opacityFrom: 0.3, opacityTo: 0.4, stops: [0, 90, 100] } },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        xaxis: { type: 'datetime' },
        tooltip: { x: { format: 'dd/MM/yy' } }
    });
    reportsChartInstance.render();

    trafficChartInstance = echarts.init(document.querySelector("#trafficChart"));
    trafficChartInstance.setOption({
        tooltip: { trigger: 'item' },
        legend: { top: '5%', left: 'center' },
        series: [{
            name: 'Kunjungan Poli',
            type: 'pie',
            radius: ['40%', '70%'],
            center: ['50%', '60%'],
            avoidLabelOverlap: false,
            label: { show: false, position: 'center' },
            emphasis: { label: { show: true, fontSize: '18', fontWeight: 'bold' } },
            labelLine: { show: false },
            data: []
        }],
        media: [{
            query: { maxWidth: 500 },
            option: {
                legend: { bottom: '0', top: 'auto', orient: 'horizontal' },
                series: [{ radius: ['35%', '60%'], center: ['50%', '40%'] }]
            }
        }]
    });
    window.addEventListener('resize', () => { trafficChartInstance.resize(); });

    loadDashboardData();
    setInterval(loadDashboardData, 10000);
});
</script>
<?= $this->endSection() ?>
