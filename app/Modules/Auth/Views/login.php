<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - KlinikOS 2.0</title>

  <!-- Favicons -->
  <link href="<?= base_url()?>NiceAdmin/assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS (Compiled) -->
  <link href="<?= base_url()?>assets/css/app.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 font-[Nunito] flex items-center justify-center p-4">

  <main class="w-full max-w-md">

    <!-- Logo -->
    <div class="flex justify-center mb-8">
      <a href="<?= base_url() ?>" class="flex items-center gap-3 group">
        <img src="<?= base_url()?>NiceAdmin/assets/img/logo.png" alt="KlinikOS Logo" class="h-10 w-auto transition-transform group-hover:scale-110">
        <span class="text-2xl font-bold text-klinik-dark tracking-tight">KlinikOS <span class="text-klinik-primary">2.0</span></span>
      </a>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100">

      <!-- Header -->
      <div class="bg-gradient-to-r from-klinik-primary to-klinik-secondary px-8 py-10 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
        </div>
        <h1 class="text-2xl font-bold text-white tracking-wide">Selamat Datang</h1>
        <p class="text-blue-100 text-sm mt-2">Silakan login untuk mengakses Sistem KlinikOS</p>
      </div>

      <!-- Form -->
      <div class="px-8 py-8">

        <?php if(session()->getFlashdata('error')): ?>
          <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-red-500" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <span><?= session()->getFlashdata('error') ?></span>
          </div>
        <?php endif; ?>

        <form method="POST" action="<?= base_url('login/auth') ?>" class="space-y-5" id="loginForm">

          <!-- Username -->
          <div>
            <label for="username" class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <input
                type="text"
                name="username"
                id="username"
                required
                placeholder="Masukkan username"
                class="w-full pl-12 pr-4 py-3 border border-slate-200 rounded-xl text-slate-700 placeholder-slate-400
                       focus:outline-none focus:ring-2 focus:ring-klinik-primary/30 focus:border-klinik-primary
                       transition-all duration-200"
              >
            </div>
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
              </div>
              <input
                type="password"
                name="password"
                id="password"
                required
                placeholder="Masukkan password"
                class="w-full pl-12 pr-4 py-3 border border-slate-200 rounded-xl text-slate-700 placeholder-slate-400
                       focus:outline-none focus:ring-2 focus:ring-klinik-primary/30 focus:border-klinik-primary
                       transition-all duration-200"
              >
            </div>
          </div>

          <!-- Remember Me -->
          <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="checkbox" name="remember" value="true" id="rememberMe"
                     class="w-4 h-4 text-klinik-primary border-slate-300 rounded focus:ring-klinik-primary/50">
              <span class="text-sm text-slate-600">Ingat saya</span>
            </label>
          </div>

          <!-- Submit -->
          <button
            type="submit"
            id="loginButton"
            class="w-full py-3.5 bg-gradient-to-r from-klinik-primary to-klinik-secondary text-white font-bold rounded-xl
                   hover:shadow-lg hover:shadow-klinik-primary/30 hover:-translate-y-0.5
                   active:translate-y-0 active:shadow-md
                   transition-all duration-200 cursor-pointer text-base"
          >
            Login
          </button>

        </form>

        <!-- Footer text -->
        <p class="text-center text-sm text-slate-400 mt-6">Hanya untuk staf medis terdaftar</p>
      </div>
    </div>

    <!-- Credits -->
    <p class="text-center text-xs text-slate-400 mt-6">
      Designed by <a href="#" class="text-klinik-primary hover:underline">KlinikOS Team</a>
    </p>

  </main>

</body>
</html>
