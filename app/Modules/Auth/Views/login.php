<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KlinikOS 2.0</title>

    <link href="<?= base_url() ?>NiceAdmin/assets/img/favicon.png" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary:       '#2136d9',
                        'primary-con': '#4154f1',
                        'on-primary':  '#ffffff',
                        secondary:     '#5b5f64',
                        surface:       '#f9f9ff',
                        'surface-low': '#f0f3ff',
                        'on-bg':       '#021b3b',
                        'on-sv':       '#454655',
                        outline:       '#c5c5d8',
                        tertiary:      '#304d94',
                    },
                    fontFamily: {
                        display: ['Manrope', 'sans-serif'],
                        body:    ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-12px); }
        }
        .float-slow { animation: float 6s ease-in-out infinite; }
        .float-mid  { animation: float 4s ease-in-out infinite; }
        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(65, 84, 241, 0.15);
            border-color: #4154f1;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-surface via-surface-low to-[#dfe0ff] flex items-center justify-center p-4 relative overflow-hidden">

    <div class="float-slow absolute top-[-80px] left-[-80px] w-72 h-72 rounded-full bg-primary-con/8 blur-3xl pointer-events-none"></div>
    <div class="float-mid  absolute bottom-[-60px] right-[-60px] w-64 h-64 rounded-full bg-tertiary/8 blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 right-[-120px] w-80 h-80 rounded-full bg-primary/5 blur-3xl pointer-events-none"></div>

    <main class="w-full max-w-sm relative z-10">

        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <a href="<?= base_url('general') ?>" class="flex items-center gap-2 group">
                <img src="<?= base_url() ?>NiceAdmin/assets/img/logo.png"
                     alt="KlinikOS Logo"
                     class="h-8 w-auto transition-transform duration-300 group-hover:scale-110">
                <div class="flex flex-col leading-tight">
                    <span class="text-xl font-extrabold text-primary tracking-tight font-display">KlinikOS 2.0</span>
                    <span class="text-[11px] text-on-sv font-medium">Sistem Klinik Modern</span>
                </div>
            </a>
        </div>

        <!-- Card login -->
        <div class="bg-white rounded-2xl overflow-hidden border border-outline/30"
             style="box-shadow: 0 20px 60px rgba(33,54,217,.12), 0 4px 20px rgba(0,0,0,.06)">

            <!-- Header card -->
            <div class="bg-gradient-to-r from-primary to-primary-con px-6 py-6 text-center relative overflow-hidden">
                <div class="absolute top-[-30px] right-[-30px] w-28 h-28 rounded-full bg-white/10 pointer-events-none"></div>
                <div class="absolute bottom-[-20px] left-[-20px] w-20 h-20 rounded-full bg-white/8 pointer-events-none"></div>
                <div class="relative z-10 flex items-center justify-center gap-3">
                    <div class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-white/20 backdrop-blur-sm flex-shrink-0">
                        <span class="material-symbols-outlined text-white text-[22px]">medical_services</span>
                    </div>
                    <div class="text-left">
                        <h1 class="text-lg font-extrabold text-white tracking-wide font-display">Selamat Datang</h1>
                        <p class="text-blue-100 text-xs">Login untuk mengakses KlinikOS</p>
                    </div>
                </div>
            </div>

            <!-- Form body -->
            <div class="px-6 py-5">

                <?php if(session()->getFlashdata('error')): ?>
                <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 px-3 py-2.5 rounded-lg mb-4 text-xs" role="alert">
                    <span class="material-symbols-outlined text-red-500 text-[18px] flex-shrink-0">error</span>
                    <span><?= session()->getFlashdata('error') ?></span>
                </div>
                <?php endif; ?>

                <form method="POST" action="<?= base_url('login/auth') ?>" class="space-y-4" id="loginForm">
                    <?= csrf_field() ?>

                    <!-- Username -->
                    <div class="space-y-1">
                        <label for="username" class="block text-xs font-semibold text-on-bg">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline text-[18px]">person</span>
                            </div>
                            <input type="text" name="username" id="username" required autocomplete="username"
                                placeholder="Masukkan username"
                                class="w-full pl-10 pr-4 py-2.5 border border-outline/60 rounded-lg text-on-bg placeholder-outline bg-surface transition-all duration-200 text-sm">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="space-y-1">
                        <label for="password" class="block text-xs font-semibold text-on-bg">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline text-[18px]">lock</span>
                            </div>
                            <input type="password" name="password" id="password" required autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="w-full pl-10 pr-10 py-2.5 border border-outline/60 rounded-lg text-on-bg placeholder-outline bg-surface transition-all duration-200 text-sm">
                            <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-outline hover:text-primary-con transition-colors">
                                <span class="material-symbols-outlined text-[18px]" id="eyeIcon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <!-- Remember me -->
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" value="true" id="rememberMe"
                               class="w-3.5 h-3.5 text-primary-con border-outline rounded focus:ring-primary-con/30 cursor-pointer">
                        <label for="rememberMe" class="text-xs text-on-sv cursor-pointer select-none">Ingat saya</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" id="loginButton"
                        class="w-full py-2.5 bg-gradient-to-r from-primary to-primary-con text-white font-bold rounded-lg text-sm
                               hover:shadow-lg hover:shadow-primary-con/30 hover:-translate-y-0.5
                               active:translate-y-0 active:shadow-md transition-all duration-200 cursor-pointer
                               flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">login</span>
                        Login ke Sistem
                    </button>

                </form>

                <!-- Info + kembali -->
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-outline/20">
                    <p class="text-[11px] text-on-sv leading-relaxed">
                        Hanya untuk <strong class="text-on-bg">staf &amp; admin</strong> terdaftar.
                    </p>
                    <a href="<?= base_url('general') ?>"
                       class="inline-flex items-center gap-1 text-[11px] text-on-sv hover:text-primary-con transition-colors whitespace-nowrap ml-3">
                        <span class="material-symbols-outlined text-[14px]">arrow_back</span>
                        Kembali
                    </a>
                </div>

            </div>
        </div>

        <p class="text-center text-[11px] text-on-sv/60 mt-4">
            &copy; <?= date('Y') ?> KlinikOS 2.0 &mdash; Sistem Manajemen Klinik Modern
        </p>

    </main>

    <script>
    (function(){
        const toggleBtn = document.getElementById('togglePassword');
        const pwInput   = document.getElementById('password');
        const eyeIcon   = document.getElementById('eyeIcon');
        if(!toggleBtn) return;
        toggleBtn.addEventListener('click', function(){
            const isHidden = pwInput.type === 'password';
            pwInput.type   = isHidden ? 'text' : 'password';
            eyeIcon.textContent = isHidden ? 'visibility_off' : 'visibility';
        });
    })();

    (function(){
        const form = document.getElementById('loginForm');
        const btn  = document.getElementById('loginButton');
        if(!form || !btn) return;
        form.addEventListener('submit', function(){
            btn.disabled = true;
            btn.innerHTML = `
                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                Memproses...
            `;
        });
    })();
    </script>

</body>
</html>