<?php
/**
 * @var string $title
 * @var string $content
 * Shared base layout — semua view modul render di sini via $this->extend()
 */
$session = session();
$role     = $session->get('role') ?? 'guest';
$fullName = $session->get('full_name') ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="id" class="<?= ($_COOKIE['theme'] ?? 'light') === 'dark' ? 'dark' : '' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <title><?= esc($title ?? 'KlinikOS 2.0') ?> — KlinikOS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = { darkMode: 'class', theme: { extend: {
        colors: { brand: { 50:'#f0f9ff',500:'#0ea5e9',600:'#0284c7',700:'#0369a1',900:'#0c4a6e' } }
      }}};
      // Apply theme before paint
      if (localStorage.getItem('theme') === 'dark') document.documentElement.classList.add('dark');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
      [x-cloak]{display:none}
      .scrollbar-thin::-webkit-scrollbar{width:6px;height:6px}
      .scrollbar-thin::-webkit-scrollbar-thumb{background:#94a3b8;border-radius:3px}
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen">

<div class="flex min-h-screen">
    <?= view('App\Modules\Shared\Views\components\sidebar', ['role' => $role]) ?>

    <div class="flex-1 flex flex-col min-w-0 lg:ml-64">
        <?= view('App\Modules\Shared\Views\components\header', ['fullName' => $fullName, 'role' => $role]) ?>

        <main class="flex-1 p-4 md:p-6 lg:p-8">
            <?= $content ?? '' ?>
        </main>

        <?= view('App\Modules\Shared\Views\components\footer') ?>
    </div>
</div>

<!-- Toast container -->
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

<!-- Confirm dialog -->
<div id="confirm-dialog" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">
  <div class="bg-white dark:bg-slate-800 rounded-xl shadow-2xl max-w-md w-full p-6">
    <h3 id="confirm-title" class="text-lg font-semibold mb-2"></h3>
    <p id="confirm-message" class="text-sm text-slate-600 dark:text-slate-400 mb-6"></p>
    <div class="flex justify-end gap-2">
      <button id="confirm-cancel" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700">Batal</button>
      <button id="confirm-ok" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">Konfirmasi</button>
    </div>
  </div>
</div>

<script>
// ===== Global helpers =====
window.csrfToken = () => document.querySelector('meta[name=csrf-token]').content;

window.apiFetch = async (url, opts = {}) => {
  const headers = { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest', ...(opts.headers || {}) };
  if (opts.method && opts.method !== 'GET') headers['X-CSRF-TOKEN'] = window.csrfToken();
  const res = await fetch(url, { ...opts, headers, credentials: 'same-origin' });
  if (!res.ok) throw new Error(`HTTP ${res.status}`);
  return res.json();
};

window.showToast = (msg, type = 'info') => {
  const colors = { success:'bg-emerald-600', error:'bg-red-600', info:'bg-sky-600', warning:'bg-amber-600' };
  const el = document.createElement('div');
  el.className = `${colors[type]||colors.info} text-white px-4 py-3 rounded-lg shadow-lg animate-pulse`;
  el.textContent = msg;
  document.getElementById('toast-container').appendChild(el);
  setTimeout(() => el.remove(), 3500);
};

window.confirmDialog = ({ title, message, onConfirm }) => {
  const dlg = document.getElementById('confirm-dialog');
  document.getElementById('confirm-title').textContent = title || 'Konfirmasi';
  document.getElementById('confirm-message').textContent = message || 'Apakah Anda yakin?';
  dlg.classList.remove('hidden');
  const ok = document.getElementById('confirm-ok'), cancel = document.getElementById('confirm-cancel');
  const close = () => dlg.classList.add('hidden');
  ok.onclick = () => { close(); onConfirm?.(); };
  cancel.onclick = close;
};

// Dark mode toggle (used by header)
window.toggleTheme = () => {
  const isDark = document.documentElement.classList.toggle('dark');
  localStorage.setItem('theme', isDark ? 'dark' : 'light');
};

// Sidebar mobile toggle
window.toggleSidebar = () => document.getElementById('sidebar')?.classList.toggle('-translate-x-full');
</script>
</body>
</html>
