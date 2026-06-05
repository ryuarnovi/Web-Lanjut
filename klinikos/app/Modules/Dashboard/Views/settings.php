<div class="max-w-3xl space-y-6">
  <div>
    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Pengaturan Klinik</h2>
    <p class="text-sm text-slate-500 mt-1">Informasi yang ditampilkan di struk, antrean, dan landing page.</p>
  </div>

  <form id="settings-form" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-6 space-y-4">
    <?php
    $fields = [
      ['nama_klinik','Nama Klinik','text'],
      ['alamat','Alamat','textarea'],
      ['telepon','Telepon','text'],
      ['email','Email','email'],
      ['jam_operasional','Jam Operasional','text'],
      ['admin_fee','Biaya Admin/Pendaftaran (Rp)','number'],
      ['pajak_persen','Pajak (%)','number'],
    ];
    foreach ($fields as [$k,$lbl,$t]): ?>
      <div>
        <label class="block text-sm font-medium mb-1"><?= $lbl ?></label>
        <?php if ($t === 'textarea'): ?>
          <textarea data-key="<?= $k ?>" rows="3" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent text-sm"></textarea>
        <?php else: ?>
          <input data-key="<?= $k ?>" type="<?= $t ?>" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent text-sm">
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
    <button type="submit" class="px-5 py-2.5 bg-sky-600 text-white rounded-lg hover:bg-sky-700 text-sm font-medium">Simpan Perubahan</button>
  </form>
</div>

<script>
(async () => {
  try {
    const { data } = await apiFetch('/api/settings');
    document.querySelectorAll('[data-key]').forEach(el => { el.value = data[el.dataset.key] || ''; });
  } catch { showToast('Gagal memuat pengaturan','error'); }
})();
document.getElementById('settings-form').addEventListener('submit', async e => {
  e.preventDefault();
  const payload = {};
  document.querySelectorAll('[data-key]').forEach(el => payload[el.dataset.key] = el.value);
  try { await apiFetch('/api/settings', { method:'PUT', body: JSON.stringify(payload) }); showToast('Pengaturan disimpan','success'); }
  catch { showToast('Gagal menyimpan','error'); }
});
</script>
