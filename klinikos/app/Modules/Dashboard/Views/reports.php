<div class="space-y-6">
  <div>
    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Laporan & Analytics</h2>
    <p class="text-sm text-slate-500 mt-1">Grafik & ekspor data operasional klinik.</p>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <button onclick="exportCSV('visits')" class="p-5 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 text-left hover:border-sky-500 transition">
      <div class="text-sm font-medium">Ekspor Kunjungan (CSV)</div>
      <div class="text-xs text-slate-500 mt-1">Data antrean & rekam medis</div>
    </button>
    <button onclick="exportCSV('finance')" class="p-5 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 text-left hover:border-emerald-500 transition">
      <div class="text-sm font-medium">Ekspor Keuangan (CSV)</div>
      <div class="text-xs text-slate-500 mt-1">Semua pembayaran lunas</div>
    </button>
    <button onclick="exportCSV('drugs')" class="p-5 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 text-left hover:border-violet-500 transition">
      <div class="text-sm font-medium">Ekspor Stok Obat (CSV)</div>
      <div class="text-xs text-slate-500 mt-1">Inventaris saat ini</div>
    </button>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-slate-200 dark:border-slate-800">
      <h3 class="font-semibold mb-4">Tren Kunjungan</h3>
      <div id="chart-r1" style="min-height:300px"></div>
    </div>
    <div class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-slate-200 dark:border-slate-800">
      <h3 class="font-semibold mb-4">Tren Pendapatan</h3>
      <div id="chart-r2" style="min-height:300px"></div>
    </div>
  </div>
</div>

<script>
function exportCSV(type) {
  // Stub: arahkan ke endpoint export
  window.location.href = '/api/export/' + type;
}
(async () => {
  try {
    const { data } = await apiFetch('/api/dashboard/stats');
    const cats = data.trend.map(t => t.date.slice(5));
    new ApexCharts(document.querySelector('#chart-r1'), { chart:{type:'line',height:300,toolbar:{show:false}}, series:[{name:'Kunjungan',data:data.trend.map(t=>t.visits)}], xaxis:{categories:cats}, colors:['#0ea5e9'], stroke:{curve:'smooth',width:3} }).render();
    new ApexCharts(document.querySelector('#chart-r2'), { chart:{type:'bar',height:300,toolbar:{show:false}}, series:[{name:'Pendapatan',data:data.trend.map(t=>t.revenue)}], xaxis:{categories:cats}, colors:['#10b981'], plotOptions:{bar:{borderRadius:6}} }).render();
  } catch {}
})();
</script>
