<?= $this->extend('Modules\\Shared\\Views\\layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
  <h1>Executive Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

        <!-- Kunjungan Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Kunjungan <span>| Hari Ini</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6>145</h6>
                  <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">vs Kemarin</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Kunjungan Card -->

        <!-- Pendapatan Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Pendapatan <span>| Bulan Ini</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                  <h6>Rp 24,5M</h6>
                  <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">peningkatan</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Pendapatan Card -->

        <!-- Pasien Baru Card -->
        <div class="col-xxl-4 col-xl-12">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Pasien Baru <span>| Tahun Ini</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-plus"></i>
                </div>
                <div class="ps-3">
                  <h6>1,244</h6>
                  <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">penurunan</span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Pasien Baru Card -->

        <!-- Reports -->
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tren Kunjungan & Pendapatan <span>/Terakhir 7 Hari</span></h5>

              <!-- Line Chart -->
              <div id="reportsChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#reportsChart"), {
                    series: [{
                      name: 'Kunjungan',
                      data: [31, 40, 28, 51, 42, 82, 56],
                    }, {
                      name: 'Pendapatan (Juta)',
                      data: [11, 32, 45, 32, 34, 52, 41]
                    }],
                    chart: {
                      height: 350,
                      type: 'area',
                      toolbar: { show: false },
                    },
                    markers: { size: 4 },
                    colors: ['#4154f1', '#2eca6a'],
                    fill: {
                      type: "gradient",
                      gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                      }
                    },
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 2 },
                    xaxis: {
                      type: 'datetime',
                      categories: ["2024-04-10T00:00:00.000Z", "2024-04-11T00:00:00.000Z", "2024-04-12T00:00:00.000Z", "2024-04-13T00:00:00.000Z", "2024-04-14T00:00:00.000Z", "2024-04-15T00:00:00.000Z", "2024-04-16T00:00:00.000Z"]
                    },
                    tooltip: { x: { format: 'dd/MM/yy' }, }
                  }).render();
                });
              </script>
              <!-- End Line Chart -->

            </div>

          </div>
        </div><!-- End Reports -->

        <!-- Recent Antrean -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <h5 class="card-title">Antrean Aktif Terkini <span>| Live View</span></h5>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">No. Antrean</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Poli/Layanan</th>
                    <th scope="col">Waktu Tunggu</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><a href="#">A-001</a></th>
                    <td>Budi Santoso</td>
                    <td>Poli Umum</td>
                    <td>15 Menit</td>
                    <td><span class="badge bg-warning text-dark">Dalam Pemeriksaan</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">B-024</a></th>
                    <td>Siti Aminah</td>
                    <td>Poli Gigi</td>
                    <td>45 Menit</td>
                    <td><span class="badge bg-info">Menunggu</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">A-002</a></th>
                    <td>Andi Wijaya</td>
                    <td>Poli Umum</td>
                    <td>5 Menit</td>
                    <td><span class="badge bg-success">Selesai</span></td>
                  </tr>
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Antrean -->

      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">

      <!-- Recent Activity -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Aktivitas Sistem <span>| Log</span></h5>
          <div class="activity">
            <div class="activity-item d-flex">
              <div class="activite-label">2 min</div>
              <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
              <div class="activity-content">
                Resepsionis mendaftarkan <a href="#" class="fw-bold text-dark">Pasien Baru</a> #P00234
              </div>
            </div><!-- End activity item-->
            <div class="activity-item d-flex">
              <div class="activite-label">12 min</div>
              <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
              <div class="activity-content">
                Dokter <a href="#" class="fw-bold text-dark">Andi</a> memanggil antrean A-001
              </div>
            </div><!-- End activity item-->
          </div>
        </div>
      </div><!-- End Recent Activity -->

      <!-- Poli Traffic -->
      <div class="card">
        <div class="card-body pb-0">
          <h5 class="card-title">Sebaran Pasien per Poli <span>| Hari Ini</span></h5>
          <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
          <script>
            document.addEventListener("DOMContentLoaded", () => {
              echarts.init(document.querySelector("#trafficChart")).setOption({
                tooltip: { trigger: 'item' },
                legend: { top: '5%', left: 'center' },
                series: [{
                  name: 'Kunjungan Poli',
                  type: 'pie',
                  radius: ['40%', '70%'],
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
                }]
              });
            });
          </script>
        </div>
      </div><!-- End Poli Traffic -->

    </div><!-- End Right side columns -->

  </div>
</section>
<?= $this->endSection() ?>
