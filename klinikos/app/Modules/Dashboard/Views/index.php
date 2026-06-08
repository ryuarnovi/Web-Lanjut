<?php /** Admin Executive Dashboard */ ?>
<div class="space-y-6">

  <div class="flex items-center justify-between flex-wrap gap-3">
    <div>
      <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Selamat datang, <?= esc(session()->get('full_name')) ?> 👋</h2>
      <p class="text-sm text-slate-500 mt-1">Ringkasan operasional klinik hari ini · <?= date('d M Y') ?></p>
    </div>
  </div>

  <!-- Stat cards -->
  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
    <?php
    $cards = [
      ['key'=>'total_patients',  'label'=>'Total Pasien',    'color'=>'sky',     'icon'=>'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5.13a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 11-8 0 4 4 0 018 0z'],
      ['key'=>'total_doctors',   'label'=>'Dokter Aktif',    'color'=>'emerald', 'icon'=>'M4.354 5.119A7.001 7.001 0 0119 8a7 7 0 11-14.646-2.881'],
      ['key'=>'total_drugs',     'label'=>'Jenis Obat',      'color'=>'violet',  'icon'=>'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2'],
      ['key'=>'queue_today',     'label'=>'Antrean Hari Ini','color'=>'amber',   'icon'=>'M4 6h16M4 12h16M4 18h7'],
      ['key'=>'low_stock_drugs', 'label'=>'Stok Menipis',    'color'=>'red',     'icon'=>'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
      ['key'=>'revenue_today',   'label'=>'Pendapatan Hari Ini','color'=>'cyan','icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1'],
    ];
    foreach ($cards as $c): ?>
      <div class="bg-white dark:bg-slate-900 rounded-xl p-4 border border-slate-200 dark:border-slate-800">
        <div class="flex items-start justify-between mb-3">
          <div class="w-10 h-10 rounded-lg bg-<?= $c['color'] ?>-100 dark:bg-<?= $c['color'] ?>-900/30 text-<?= $c['color'] ?>-600 dark:text-<?= $c['color'] ?>-400 flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $c['icon'] ?>"/></svg>
          </div>
        </div>
        <div class="text-xs text-slate-500"><?= $c['label'] ?></div>
        <div class="text-2xl font-bold text-slate-900 dark:text-white mt-1" data-stat="<?= $c['key'] ?>">—</div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Charts -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-slate-200 dark:border-slate-800">
      <h3 class="font-semibold text-slate-900 dark:text-white mb-4">Tren Kunjungan (7 Hari)</h3>
      <div id="chart-visits" style="min-height:280px"></div>
    </div>
    <div class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-slate-200 dark:border-slate-800">
      <h3 class="font-semibold text-slate-900 dark:text-white mb-4">Tren Pendapatan (7 Hari)</h3>
      <div id="chart-revenue" style="min-height:280px"></div>
    </div>
  </div>

  <!-- Quick links -->
  <div class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-slate-200 dark:border-slate-800">
    <h3 class="font-semibold text-slate-900 dark:text-white mb-4">Akses Cepat</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
      <?php foreach ([
        ['User','/dashboard/users','sky'],
        ['Pendaftaran','/resepsionis/pendaftaran','emerald'],
        ['Antrean','/resepsionis/antrean','amber'],
        ['Stok Obat','/apoteker/stok','violet'],
        ['Billing','/kasir/billing','cyan'],
        ['Laporan','/dashboard/reports','rose'],
      ] as $q): ?>
        <a href="<?= $q[1] ?>" class="p-3 rounded-lg bg-<?= $q[2] ?>-50 dark:bg-<?= $q[2] ?>-900/20 text-<?= $q[2] ?>-700 dark:text-<?= $q[2] ?>-300 text-sm font-medium text-center hover:scale-105 transition">
          <?= $q[0] ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<script>
(async () => {
  const fmt = n => new Intl.NumberFormat('id-ID').format(n);
  const rp  = n => 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(n));
  try {
    const { data } = await apiFetch('/api/dashboard/stats');
    document.querySelector('[data-stat=total_patients]').textContent  = fmt(data.total_patients);
    document.querySelector('[data-stat=total_doctors]').textContent   = fmt(data.total_doctors);
    document.querySelector('[data-stat=total_drugs]').textContent     = fmt(data.total_drugs);
    document.querySelector('[data-stat=queue_today]').textContent     = fmt(data.queue_today);
    document.querySelector('[data-stat=low_stock_drugs]').textContent = fmt(data.low_stock_drugs);
    document.querySelector('[data-stat=revenue_today]').textContent   = rp(data.revenue_today);

    const dates = data.trend.map(t => t.date.slice(5));
    new ApexCharts(document.querySelector('#chart-visits'), {
      chart: { type:'area', height:280, toolbar:{show:false} },
      series: [{ name:'Kunjungan', data: data.trend.map(t => t.visits) }],
      xaxis: { categories: dates },
      colors: ['#0ea5e9'], stroke:{curve:'smooth',width:3}, dataLabels:{enabled:false},
      fill:{type:'gradient',gradient:{shadeIntensity:1,opacityFrom:0.4,opacityTo:0}},
    }).render();

    new ApexCharts(document.querySelector('#chart-revenue'), {
      chart: { type:'bar', height:280, toolbar:{show:false} },
      series: [{ name:'Pendapatan', data: data.trend.map(t => t.revenue) }],
      xaxis: { categories: dates },
      colors: ['#06b6d4'], plotOptions:{bar:{borderRadius:6,columnWidth:'50%'}}, dataLabels:{enabled:false},
      yaxis:{labels:{formatter: v => 'Rp '+fmt(Math.round(v/1000))+'K'}},
    }).render();
  } catch (e) {
    showToast('Gagal memuat data statistik', 'error');
  }
})();
</script>
