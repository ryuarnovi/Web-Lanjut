<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login — KlinikOS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-sky-500 via-cyan-600 to-teal-600 flex items-center justify-center p-4">
<div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden">
  <div class="p-8">
    <div class="flex items-center gap-3 mb-8">
      <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-sky-500 to-sky-700 flex items-center justify-center text-white font-bold text-xl">K</div>
      <div>
        <h1 class="text-2xl font-bold text-slate-900">KlinikOS 2.0</h1>
        <p class="text-sm text-slate-500">Sistem Manajemen Klinik</p>
      </div>
    </div>

    <?php if ($err = session()->getFlashdata('error')): ?>
      <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 text-sm border border-red-200"><?= esc($err) ?></div>
    <?php endif; ?>

    <form method="post" action="/login" class="space-y-4">
      <?= csrf_field() ?>
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
        <input name="username" required autofocus value="<?= esc(old('username')) ?>"
               class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent">
      </div>
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent">
      </div>
      <button type="submit" class="w-full py-2.5 bg-sky-600 text-white rounded-lg font-medium hover:bg-sky-700 transition">
        Masuk
      </button>
    </form>

    <div class="mt-6 pt-6 border-t border-slate-200 text-center text-xs text-slate-500">
      Default: <code class="bg-slate-100 px-1 rounded">admin / root210605</code>
    </div>
  </div>
</div>
</body>
</html>
