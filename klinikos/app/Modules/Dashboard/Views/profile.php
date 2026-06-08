<div class="max-w-2xl space-y-6">
  <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Profil Saya</h2>
  <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-6">
    <div id="profile-body" class="space-y-3 text-sm">Memuat...</div>
  </div>
</div>
<script>
(async () => {
  try {
    const { data } = await apiFetch('/api/users/me');
    document.getElementById('profile-body').innerHTML = Object.entries(data).map(([k,v]) =>
      `<div class="flex justify-between border-b border-slate-100 dark:border-slate-800 py-2"><span class="text-slate-500 capitalize">${k.replace(/_/g,' ')}</span><span class="font-medium">${v||'-'}</span></div>`).join('');
  } catch { showToast('Gagal memuat profil','error'); }
})();
</script>
