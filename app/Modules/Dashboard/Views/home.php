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
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            const reportsChart = new ApexCharts(document.querySelector("#reportsChart"), {
              series: [{
                name: 'Kunjungan',
                data: [31, 40, 28, 51, 42, 82, 56],
              }, {
                name: 'Pendapatan (Juta)',
                data: [11, 32, 45, 32, 34, 52, 41]
              }],
              chart: { height: 350, type: 'area', toolbar: { show: false }, redrawOnWindowResize: true },
              markers: { size: 4 },
              colors: ['#4154f1', '#2eca6a'],
              fill: { type: "gradient", gradient: { shadeIntensity: 1, opacityFrom: 0.3, opacityTo: 0.4, stops: [0, 90, 100] } },
              dataLabels: { enabled: false },
              stroke: { curve: 'smooth', width: 2 },
              xaxis: { type: 'datetime', categories: ["2024-04-10", "2024-04-11", "2024-04-12", "2024-04-13", "2024-04-14", "2024-04-15", "2024-04-16"] },
              tooltip: { x: { format: 'dd/MM/yy' } }
            });
            reportsChart.render();
          });
        </script>
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
              <tr>
                <td><a href="#" class="font-bold text-klinik-primary">A-001</a></td>
                <td>Budi Santoso</td>
                <td>Poli Umum</td>
                <td>15 Menit</td>
                <td><span class="badge badge-warning">Dalam Pemeriksaan</span></td>
              </tr>
              <tr>
                <td><a href="#" class="font-bold text-klinik-primary">B-024</a></td>
                <td>Siti Aminah</td>
                <td>Poli Gigi</td>
                <td>45 Menit</td>
                <td><span class="badge badge-info">Menunggu</span></td>
              </tr>
              <tr>
                <td><a href="#" class="font-bold text-klinik-primary">A-002</a></td>
                <td>Andi Wijaya</td>
                <td>Poli Umum</td>
                <td>5 Menit</td>
                <td><span class="badge badge-success">Selesai</span></td>
              </tr>
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
          <div class="activity-item">
            <div class="activite-label">2 min</div>
            <div class="activity-badge text-green-500">●</div>
            <div class="activity-content">Resepsionis mendaftarkan <a href="#" class="font-bold text-klinik-dark">Pasien Baru</a> #P00234</div>
          </div>
          <div class="activity-item">
            <div class="activite-label">12 min</div>
            <div class="activity-badge text-blue-500">●</div>
            <div class="activity-content">Dokter <a href="#" class="font-bold text-klinik-dark">Andi</a> memanggil antrean A-001</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Poli Traffic -->
    <div class="card">
      <div class="card-body pb-0">
        <h5 class="card-title">Sebaran Pasien per Poli <span>| Hari Ini</span></h5>
        <div id="trafficChart" style="min-height: 400px;"></div>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            const trafficChart = echarts.init(document.querySelector("#trafficChart"));
            trafficChart.setOption({
              tooltip: { trigger: 'item' },
              legend: { top: '5%', left: 'center' },
              series: [{
                name: 'Kunjungan Poli',
                type: 'pie',
                radius: ['40%', '70%'],
                center: ['50%', '60%'], // Better centering
                avoidLabelOverlap: false,
                label: { show: false, position: 'center' },
                emphasis: { label: { show: true, fontSize: '18', fontWeight: 'bold' } },
                labelLine: { show: false },
                data: [
                  { value: 1048, name: 'Poli Umum' },
                  { value: 735, name: 'Poli Gigi' },
                  { value: 580, name: 'Poli Anak' },
                  { value: 484, name: 'Poli Mata' },
                  { value: 300, name: 'Radiologi' }
                ]
              }],
              // Built-in responsiveness
              media: [
                {
                  query: { maxWidth: 500 },
                  option: {
                    legend: { bottom: '0', top: 'auto', orient: 'horizontal' },
                    series: [{ 
                      radius: ['35%', '60%'],
                      center: ['50%', '40%'] 
                    }]
                  }
                }
              ]
            });
            
            // Handle ECharts responsiveness
            window.addEventListener('resize', () => {
              trafficChart.resize();
            });
          });
        </script>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
