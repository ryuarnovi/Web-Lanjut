<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Kontak - KlinikOS 2.0') ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('NiceAdmin/assets/img/favicon.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('NiceAdmin/assets/img/apple-touch-icon.png') ?>">

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
                        primary: '#2136d9',
                        'primary-con': '#4154f1',
                        'on-primary': '#ffffff',
                        secondary: '#5b5f64',
                        surface: '#f9f9ff',
                        'surface-low': '#f0f3ff',
                        'surface-high': '#dee8ff',
                        'surface-card': '#ffffff',
                        'on-bg': '#021b3b',
                        'on-sv': '#454655',
                        outline: '#c5c5d8',
                        tertiary: '#304d94',
                    },
                    fontFamily: {
                        display: ['Manrope', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24;
            vertical-align: middle;
        }

        .nav-blur {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .clinic-shadow {
            box-shadow: 0 10px 30px rgba(65,84,241,.08);
        }

        .card-lift {
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .card-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 40px rgba(1,41,112,.12);
        }

        section {
            scroll-margin-top: 80px;
        }
    </style>
</head>

<body class="bg-surface text-on-bg">

<!-- ═══════════════════════════════
     NAVBAR
═══════════════════════════════ -->

<!-- Overlay backdrop -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-40 hidden"></div>

<!-- Sidebar mobile -->
<div id="mobile-sidebar" class="fixed top-0 right-0 h-full w-72 bg-white z-50 shadow-2xl flex flex-col" style="transform: translateX(100%); transition: transform 0.3s ease;">
    <!-- Sidebar header -->
    <div class="flex items-center justify-between px-5 py-4 border-b border-outline/30">
        <a href="<?= base_url('/') ?>" class="flex items-center gap-2">
            <img src="<?= base_url('NiceAdmin/assets/img/logo.png') ?>" alt="KlinikOS Logo" class="w-8 h-8 object-contain">
            <span class="text-lg font-extrabold text-[#1029d0] tracking-tight">KlinikOS 2.0</span>
        </a>
        <button id="sidebar-close" class="p-1.5 rounded-lg hover:bg-surface-high">
            <span class="material-symbols-outlined text-on-sv">close</span>
        </button>
    </div>

    <!-- Sidebar nav links -->
    <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">
    <a href="<?= base_url('general') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-secondary hover:text-primary hover:bg-surface-low transition text-[15px]">
        <span class="material-symbols-outlined text-[20px]">home</span>
        Home
    </a>
    <a href="<?= base_url('about') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-secondary hover:text-primary hover:bg-surface-low transition text-[15px]">
        <span class="material-symbols-outlined text-[20px]">info</span>
        Tentang Kami
    </a>
    <a href="<?= base_url('service') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-secondary hover:text-primary hover:bg-surface-low transition text-[15px]">
        <span class="material-symbols-outlined text-[20px]">medical_services</span>
        Layanan
    </a>
    <a href="<?= base_url('contact') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-primary font-bold bg-surface-low text-[15px]">
        <span class="material-symbols-outlined text-[20px]">call</span>
        Kontak
    </a>
    </nav>

    <!-- Sidebar footer CTA -->
    <div class="px-4 py-5 border-t border-outline/30">
        <a href="<?= base_url('login') ?>"
           class="flex items-center justify-center gap-2 bg-primary-con text-white text-[14px] font-semibold px-5 py-3 rounded-xl hover:brightness-110 transition-all w-full">
            <span class="material-symbols-outlined text-[17px]">lock</span>
            Akses Internal
        </a>
    </div>

</div>

<nav class="fixed top-0 w-full z-50 nav-blur bg-surface/80 border-b border-outline/40 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- Logo -->
        <a href="<?= base_url('/') ?>" class="flex items-center gap-3">
            <img src="<?= base_url('NiceAdmin/assets/img/logo.png') ?>" alt="KlinikOS Logo" class="w-10 h-10 object-contain">
            <div class="flex flex-col leading-tight">
                <span class="text-2xl font-extrabold text-[#1029d0] tracking-tight">KlinikOS 2.0</span>
                <span class="text-xs text-slate-500 font-medium hidden md:block">Sistem Klinik Modern</span>
            </div>
        </a>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex items-center gap-7 text-[15px]">
            <li><a href="<?= base_url('general') ?>" class="text-secondary hover:text-primary transition" style="padding-bottom:4px">Home</a></li>
            <li><a href="<?= base_url('about') ?>"   class="text-secondary hover:text-primary transition" style="padding-bottom:4px">Tentang Kami</a></li>
            <li><a href="<?= base_url('service') ?>" class="text-secondary hover:text-primary transition" style="padding-bottom:4px">Layanan</a></li>
            <li><a href="<?= base_url('contact') ?>" class="text-primary font-bold" style="padding-bottom:4px; border-bottom:2px solid #2136d9">Kontak</a></li>
        </ul>

        <!-- CTA Desktop -->
        <a href="<?= base_url('login') ?>"
           class="hidden md:flex items-center gap-2 bg-primary-con text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-primary-con/20 hover:brightness-110 transition-all">
            <span class="material-symbols-outlined text-[18px]">lock</span>
            Akses Internal
        </a>

        <!-- Mobile hamburger -->
        <button id="sidebar-open" class="md:hidden p-2 rounded-lg hover:bg-surface-high">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</nav>
<!-- END NAVBAR -->


<!-- HERO -->
<section class="pt-32 pb-20 px-6 overflow-hidden">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">

        <div class="relative z-10">
            <span class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full text-[13px] font-semibold mb-5">
                <span class="material-symbols-outlined text-[18px]">support_agent</span>
                HUBUNGI KAMI
            </span>

            <h1 class="font-display font-extrabold text-4xl md:text-5xl leading-tight text-on-bg">
                Kami Siap Membantu <br>
                <span class="text-primary-con">Kesehatan Anda</span>
            </h1>

            <p class="text-on-sv text-[17px] leading-relaxed mt-6 max-w-xl">
                Hubungi tim KlinikOS 2.0 untuk konsultasi layanan,
                informasi jadwal dokter, reservasi pemeriksaan,
                maupun bantuan administrasi pasien.
            </p>

            <div class="flex flex-wrap gap-4 mt-8">
                <a href="#form-kontak"
                   class="bg-primary-con text-white px-6 py-3 rounded-xl font-semibold hover:brightness-110 transition-all shadow-lg shadow-primary-con/20">
                    Kirim Pesan
                </a>

                <a href="tel:+62241234567"
                   class="border border-outline text-on-bg px-6 py-3 rounded-xl font-semibold hover:bg-white transition-all">
                    Hubungi Sekarang
                </a>
            </div>
        </div>

        <div class="relative hidden md:block">
            <div class="absolute -top-10 -right-10 w-64 h-64 bg-primary-con/20 blur-3xl rounded-full"></div>

            <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?q=80&w=1200&auto=format&fit=crop"
                 alt="Kontak Klinik"
                 class="relative z-10 rounded-3xl clinic-shadow h-[460px] w-full object-cover">
        </div>
    </div>
</section>


<!-- CONTACT SECTION -->
<section class="pb-20 px-6" id="form-kontak">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-8">

        <!-- FORM -->
        <div class="lg:col-span-7 bg-white rounded-3xl p-8 md:p-10 clinic-shadow border border-outline/20">

            <div class="mb-8">
                <h2 class="font-display font-extrabold text-3xl text-on-bg mb-3">
                    Kirim Pesan
                </h2>

                <p class="text-on-sv">
                    Isi formulir berikut dan tim kami akan segera menghubungi Anda.
                </p>
            </div>

            <form action="#" method="post" class="space-y-6">
                <?= csrf_field() ?>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-[14px] font-semibold text-on-bg mb-2">
                            Nama Lengkap
                        </label>

                        <input type="text"
                               placeholder="Masukkan nama Anda"
                               class="w-full rounded-xl border border-outline/50 bg-surface-low px-4 py-3 focus:border-primary-con focus:ring-primary-con">
                    </div>

                    <div>
                        <label class="block text-[14px] font-semibold text-on-bg mb-2">
                            Email
                        </label>

                        <input type="email"
                               placeholder="nama@email.com"
                               class="w-full rounded-xl border border-outline/50 bg-surface-low px-4 py-3 focus:border-primary-con focus:ring-primary-con">
                    </div>
                </div>

                <div>
                    <label class="block text-[14px] font-semibold text-on-bg mb-2">
                        Subjek
                    </label>

                    <select class="w-full rounded-xl border border-outline/50 bg-surface-low px-4 py-3 focus:border-primary-con focus:ring-primary-con">
                        <option>Konsultasi Umum</option>
                        <option>Janji Temu</option>
                        <option>Asuransi & Pembayaran</option>
                        <option>Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[14px] font-semibold text-on-bg mb-2">
                        Pesan
                    </label>

                    <textarea rows="5"
                              placeholder="Tuliskan pesan Anda..."
                              class="w-full rounded-xl border border-outline/50 bg-surface-low px-4 py-3 resize-none focus:border-primary-con focus:ring-primary-con"></textarea>
                </div>

                <button type="submit"
                        class="inline-flex items-center gap-2 bg-primary text-white px-7 py-3 rounded-xl font-semibold hover:bg-primary-con transition-all shadow-md shadow-primary/20">

                    <span class="material-symbols-outlined text-[18px]">send</span>
                    Kirim Pesan
                </button>
            </form>
        </div>


        <!-- SIDEBAR -->
        <div class="lg:col-span-5 space-y-6">

            <?php
            $kontak = [
                ['icon'=>'location_on','judul'=>'Alamat','isi'=>'Jl. Kesehatan No. 123, Semarang'],
                ['icon'=>'call','judul'=>'Telepon','isi'=>'(024) 123-4567'],
                ['icon'=>'mail','judul'=>'Email','isi'=>'info@klinikos.id'],
            ];

            foreach($kontak as $k): ?>

            <div class="bg-white rounded-2xl p-6 clinic-shadow border border-outline/20 flex gap-4 card-lift">
                <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined"><?= $k['icon'] ?></span>
                </div>

                <div>
                    <h4 class="font-display font-bold text-[17px] text-on-bg mb-1">
                        <?= esc($k['judul']) ?>
                    </h4>

                    <p class="text-on-sv text-[15px]">
                        <?= esc($k['isi']) ?>
                    </p>
                </div>
            </div>

            <?php endforeach; ?>


            <!-- JAM OPERASIONAL -->
            <div class="bg-gradient-to-br from-primary to-primary-con rounded-3xl p-8 text-white relative overflow-hidden"
                 style="box-shadow:0 12px 40px rgba(33,54,217,.22)">

                <div class="absolute -right-8 -bottom-8 opacity-10">
                    <span class="material-symbols-outlined text-[120px]">schedule</span>
                </div>

                <div class="relative z-10">
                    <h3 class="font-display font-extrabold text-2xl mb-6">
                        Jam Operasional
                    </h3>

                    <div class="space-y-4 text-[15px]">

                        <div class="flex justify-between border-b border-white/20 pb-2">
                            <span>Senin - Jumat</span>
                            <span class="font-semibold">08:00 - 20:00</span>
                        </div>

                        <div class="flex justify-between border-b border-white/20 pb-2">
                            <span>Sabtu</span>
                            <span class="font-semibold">08:00 - 17:00</span>
                        </div>

                        <div class="flex justify-between border-b border-white/20 pb-2">
                            <span>Minggu</span>
                            <span class="font-semibold">Tutup</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- ═══════════════════════════════════════
     FOOTER
════════════════════════════════════════ -->
<footer class="bg-on-bg text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 pb-12 border-b border-white/10">

            <!-- Brand -->
            <div class="space-y-4">

                <!-- Logo -->
                <a href="<?= base_url('/') ?>" class="flex items-center gap-3">

                    <!-- Icon Logo -->
                    <img 
                        src="<?= base_url('NiceAdmin/assets/img/logo.png') ?>" 
                        alt="KlinikOS Logo"
                        class="w-10 h-10 object-contain"
                    >

                    <!-- Text Logo -->
                    <div class="flex flex-col leading-tight">
                        <span class="text-2xl font-extrabold text-white tracking-tight">
                            KlinikOS 2.0
                        </span>
                        <span class="text-xs text-white/70 font-medium hidden md:block">
                            Sistem Klinik Modern
                        </span>
                    </div>

                </a>

                <!-- Description -->
                <p class="text-white/60 text-[14px] leading-relaxed max-w-xs">
                    Melayani dengan hati, mengobati dengan teknologi. Klinik modern untuk keluarga Indonesia yang lebih sehat.
                </p>

                <!-- Social Media -->
                <div class="flex gap-3">
                    <?php foreach(['social_leaderboard','camera','share'] as $icon): ?>
                    <a href="#" class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center text-white/60 hover:text-white hover:border-white/50 transition-colors">
                        <span class="material-symbols-outlined text-[18px]"><?= $icon ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>

            </div>

            <!-- Navigation -->
            <div class="space-y-4">
                <h4 class="font-semibold text-[13px] text-white/50 uppercase tracking-widest">
                    Navigasi
                </h4>

                <ul class="space-y-3">
                    <?php
                    $nav_links = [
                        ['Home','general'],
                        ['Tentang Kami','about'],
                        ['Layanan','service'],
                        ['Kontak','contact']
                    ];

                    foreach($nav_links as [$label,$url]): ?>
                    <li>
                        <a href="<?= base_url($url) ?>" 
                           class="text-[15px] text-white/70 hover:text-white transition-colors">
                            <?= esc($label) ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Information -->
            <div class="space-y-4">
                <h4 class="font-semibold text-[13px] text-white/50 uppercase tracking-widest">
                    Informasi
                </h4>

                <ul class="space-y-3 text-[14px] text-white/70">

                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-[17px] mt-0.5 text-primary-con">
                            location_on
                        </span>
                        Jl. Kesehatan No. 123, Semarang
                    </li>

                    <li class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[17px] text-primary-con">
                            call
                        </span>
                        (024) 123-4567
                    </li>

                    <li class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[17px] text-primary-con">
                            mail
                        </span>
                        info@klinikos.id
                    </li>

                    <li class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[17px] text-primary-con">
                            schedule
                        </span>
                        Senin – Sabtu: 08:00 – 20:00
                    </li>

                </ul>
            </div>

        </div>

        <!-- Bottom Footer -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-[13px] text-white/40">

            <p>
                &copy; <?= date('Y') ?> KlinikOS 2.0. Hak cipta dilindungi.
            </p>

            <div class="flex gap-5">
                <a href="#" class="hover:text-white/70 transition-colors">
                    Kebijakan Privasi
                </a>

                <a href="#" class="hover:text-white/70 transition-colors">
                    Syarat &amp; Ketentuan
                </a>
            </div>

        </div>

    </div>
</footer>


<!-- Sidebar mobile -->
<script>
(function(){
    const openBtn  = document.getElementById('sidebar-open');
    const closeBtn = document.getElementById('sidebar-close');
    const sidebar  = document.getElementById('mobile-sidebar');
    const overlay  = document.getElementById('sidebar-overlay');

    if (!openBtn || !sidebar) return;

    let isOpen = false;

    function openSidebar() {
        sidebar.style.transform = 'translateX(0)';
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        isOpen = true;
    }

    function closeSidebar() {
        sidebar.style.transform = 'translateX(100%)';
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
        isOpen = false;
    }

    openBtn.addEventListener('click', function() {
        if (isOpen) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
})();
</script>

</body>
</html>