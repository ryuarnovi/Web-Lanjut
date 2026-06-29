<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Tentang Kami - KlinikOS 2.0') ?></title>
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
                        primary:        '#2136d9',
                        'primary-con':  '#4154f1',
                        'on-primary':   '#ffffff',
                        secondary:      '#5b5f64',
                        surface:        '#f9f9ff',
                        'surface-low':  '#f0f3ff',
                        'surface-high': '#dee8ff',
                        'on-bg':        '#021b3b',
                        'on-sv':        '#454655',
                        outline:        '#c5c5d8',
                        tertiary:       '#304d94',
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .nav-blur { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .clinic-shadow { box-shadow: 0 10px 30px rgba(65,84,241,.08); }
        .card-lift { transition: transform .25s ease, box-shadow .25s ease; }
        .card-lift:hover { transform: translateY(-5px); box-shadow: 0 18px 40px rgba(1,41,112,.12); }
        section { scroll-margin-top: 80px; }
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
    <a href="<?= base_url('about') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-primary font-bold bg-surface-low text-[15px]">
        <span class="material-symbols-outlined text-[20px]">info</span>
        Tentang Kami
    </a>
    <a href="<?= base_url('service') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-secondary hover:text-primary hover:bg-surface-low transition text-[15px]">
        <span class="material-symbols-outlined text-[20px]">medical_services</span>
        Layanan
    </a>
    <a href="<?= base_url('contact') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-secondary hover:text-primary hover:bg-surface-low transition text-[15px]">
        <span class="material-symbols-outlined text-[20px]">call</span>
        Kontak
    </a>
    </nav>

    <!-- Sidebar footer CTA -->
    <div class="px-4 py-5 border-t border-outline/30">
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center justify-center gap-2 bg-primary-con text-white text-[14px] font-semibold px-5 py-3 rounded-xl hover:brightness-110 transition-all w-full">
                <span class="material-symbols-outlined text-[17px]">lock</span>
                Akses Internal
                <span class="material-symbols-outlined text-[16px]" :class="open ? 'rotate-180' : ''" style="transition:transform .2s">expand_more</span>
            </button>
            <div x-show="open" @click.outside="open = false" class="mt-2 bg-white rounded-xl shadow-xl border border-outline/30 overflow-hidden" style="display:none">
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition border-b border-outline/10">
                    <span class="w-7 h-7 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-primary text-[16px]">admin_panel_settings</span></span>
                    Admin
                </a>
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition border-b border-outline/10">
                    <span class="w-7 h-7 rounded-full bg-emerald-50 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-emerald-600 text-[16px]">front_hand</span></span>
                    Resepsionis
                </a>
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition border-b border-outline/10">
                    <span class="w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-blue-600 text-[16px]">stethoscope</span></span>
                    Dokter
                </a>
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition border-b border-outline/10">
                    <span class="w-7 h-7 rounded-full bg-purple-50 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-purple-600 text-[16px]">vaccines</span></span>
                    Perawat
                </a>
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition border-b border-outline/10">
                    <span class="w-7 h-7 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-amber-600 text-[16px]">medication</span></span>
                    Apoteker
                </a>
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition">
                    <span class="w-7 h-7 rounded-full bg-rose-50 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-rose-600 text-[16px]">receipt_long</span></span>
                    Kasir
                </a>
            </div>
        </div>
    </div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
            <li><a href="<?= base_url('about') ?>"   class="text-primary font-bold" style="padding-bottom:4px; border-bottom:2px solid #2136d9">Tentang Kami</a></li>
            <li><a href="<?= base_url('service') ?>" class="text-secondary hover:text-primary transition" style="padding-bottom:4px">Layanan</a></li>
            <li><a href="<?= base_url('contact') ?>" class="text-secondary hover:text-primary transition" style="padding-bottom:4px">Kontak</a></li>
        </ul>

        <!-- CTA Desktop -->
        <div class="relative hidden md:block" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-2 bg-primary-con text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-primary-con/20 hover:brightness-110 transition-all">
                <span class="material-symbols-outlined text-[18px]">lock</span>
                Akses Internal
                <span class="material-symbols-outlined text-[16px]" :class="open ? 'rotate-180' : ''" style="transition:transform .2s">expand_more</span>
            </button>
            <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-outline/30 overflow-hidden z-50" style="display:none">
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition border-b border-outline/10">
                    <span class="w-7 h-7 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-primary text-[16px]">admin_panel_settings</span></span>
                    Admin
                </a>
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition border-b border-outline/10">
                    <span class="w-7 h-7 rounded-full bg-emerald-50 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-emerald-600 text-[16px]">front_hand</span></span>
                    Resepsionis
                </a>
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition border-b border-outline/10">
                    <span class="w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-blue-600 text-[16px]">stethoscope</span></span>
                    Dokter
                </a>
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition border-b border-outline/10">
                    <span class="w-7 h-7 rounded-full bg-purple-50 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-purple-600 text-[16px]">vaccines</span></span>
                    Perawat
                </a>
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition border-b border-outline/10">
                    <span class="w-7 h-7 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-amber-600 text-[16px]">medication</span></span>
                    Apoteker
                </a>
                <a href="<?= base_url('login') ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-on-bg hover:bg-surface-low transition">
                    <span class="w-7 h-7 rounded-full bg-rose-50 flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-rose-600 text-[16px]">receipt_long</span></span>
                    Kasir
                </a>
            </div>
        </div>

        <!-- Mobile hamburger -->
        <button id="sidebar-open" class="md:hidden p-2 rounded-lg hover:bg-surface-high">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</nav>
<!-- END NAVBAR -->


<!-- PAGE HEADER -->
<div class="pt-28 pb-16 bg-gradient-to-b from-surface-high to-surface px-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-2 text-[13px] text-on-sv mb-4">
            <a href="<?= base_url('general') ?>" class="hover:text-primary transition-colors">Home</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-primary font-medium">Tentang Kami</span>
        </div>
        <h1 class="font-display font-extrabold text-4xl md:text-5xl text-on-bg">
            Tentang <span class="text-primary-con">KlinikOS 2.0</span>
        </h1>
        <p class="text-on-sv text-[17px] mt-4 max-w-2xl leading-relaxed">
            Berdiri dengan komitmen menghadirkan layanan kesehatan yang terjangkau dan berkualitas.
            Kami percaya kesehatan adalah investasi masa depan yang paling berharga.
        </p>
    </div>
</div>


<!-- VISI & MISI -->
<section class="py-20 px-6" id="tentang-kami">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-8 items-start">

        <!-- ── Kolom Kiri: Visi & Misi ── -->
        <div class="space-y-6">

            <!-- Visi -->
            <div class="bg-white rounded-2xl p-8 clinic-shadow border border-outline/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-[20px]">visibility</span>
                    </div>
                    <h3 class="font-display font-bold text-[20px] text-primary-con">Visi Kami</h3>
                </div>
                <p class="text-on-sv leading-relaxed">
                    Menjadi pusat pelayanan kesehatan primer pilihan masyarakat yang unggul dalam
                    kualitas pelayanan, inovasi teknologi medis, dan kepuasan pasien.
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-white rounded-2xl p-8 clinic-shadow border border-outline/20">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 bg-tertiary/10 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-tertiary text-[20px]">flag</span>
                    </div>
                    <h3 class="font-display font-bold text-[20px] text-tertiary">Misi Kami</h3>
                </div>
                <ul class="space-y-3">
                    <?php
                    $misi = [
                        'Memberikan pelayanan medis secara profesional dan penuh empati.',
                        'Menyediakan fasilitas medis modern, bersih, dan higienis.',
                        'Mempermudah akses kesehatan melalui sistem digital yang terintegrasi.',
                        'Mengedukasi pasien tentang pencegahan dan gaya hidup sehat.',
                    ];
                    foreach($misi as $m): ?>
                    <li class="flex items-start gap-3 text-on-sv text-[15px]">
                        <span class="material-symbols-outlined text-primary-con text-[20px] mt-0.5 flex-shrink-0">check_circle</span>
                        <?= esc($m) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

        <!-- ── Kolom Kanan: Stats + Akreditasi + Jam + Hubungi ── -->
        <div class="space-y-5">

            <!-- Stats 2 kolom -->
            <div class="grid grid-cols-2 gap-4">
                <?php
                $stats = [
                    ['val'=>'2018','label'=>'Tahun Berdiri',   'icon'=>'calendar_today','bg'=>'bg-primary/10',  'color'=>'text-primary'],
                    ['val'=>'99%', 'label'=>'Kepuasan Pasien', 'icon'=>'thumb_up',      'bg'=>'bg-emerald-50',  'color'=>'text-emerald-600'],
                ];
                foreach($stats as $s): ?>
                <div class="bg-white rounded-2xl p-6 clinic-shadow text-center border border-outline/20 card-lift">
                    <div class="w-10 h-10 <?= $s['bg'] ?> rounded-xl flex items-center justify-center mx-auto mb-3">
                        <span class="material-symbols-outlined <?= $s['color'] ?> text-[20px]"><?= $s['icon'] ?></span>
                    </div>
                    <div class="font-display font-extrabold text-2xl text-on-bg"><?= $s['val'] ?></div>
                    <div class="text-[12px] text-on-sv mt-1"><?= $s['label'] ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Terakreditasi Kemenkes -->
            <div class="bg-gradient-to-br from-primary to-primary-con rounded-2xl p-7 text-white"
                 style="box-shadow:0 12px 40px rgba(33,54,217,.2)">
                <span class="material-symbols-outlined text-[28px] text-white/80 mb-3 block">verified</span>
                <h4 class="font-display font-bold text-[18px] mb-2">Terakreditasi Kemenkes RI</h4>
                <p class="text-white/75 text-[14px] leading-relaxed">
                    Fasilitas dan tenaga medis kami telah memenuhi standar akreditasi pelayanan
                    kesehatan primer nasional dari Kementerian Kesehatan Republik Indonesia.
                </p>
            </div>

            <!-- ══════════════════════════════════════════
     INFO KLINIK
══════════════════════════════════════════ -->
<div class="bg-white rounded-2xl p-6 clinic-shadow border border-outline/20">

    <!-- Website Klinik -->
    <div class="flex items-center gap-4 p-4 rounded-xl bg-surface-low mb-4">

        <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
            <span class="material-symbols-outlined text-primary">
                language
            </span>
        </div>

        <div>
            <p class="text-[12px] text-on-sv">
                Website Resmi
            </p>

            <p class="font-semibold text-on-bg text-[15px]">
                www.klinikoshealth.com
            </p>
        </div>

    </div>

    <div class="space-y-4">

        <!-- Telepon -->
        <div class="flex items-center gap-4 p-4 rounded-xl bg-surface-low">

            <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-primary">
                    call
                </span>
            </div>

            <div>
                <p class="text-[12px] text-on-sv">
                    Nomor Telepon
                </p>

                <p class="font-semibold text-on-bg text-[15px]">
                    (024) 123-4567
                </p>
            </div>

        </div>

    </div>

</div>
        <!-- END Kolom Kanan -->

    </div>
</section>


<!-- KEUNGGULAN GRID -->
<section class="py-20 bg-surface-low px-6">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-xl mx-auto mb-14 space-y-3">
            <span class="text-primary-con font-semibold text-[13px] uppercase tracking-widest">Keunggulan</span>
            <h2 class="font-display font-bold text-[32px] text-on-bg">Apa yang Membuat Kami Berbeda</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <?php
            $unggulan = [
                ['icon'=>'medical_services', 'judul'=>'Dokter Profesional', 'desc'=>'Bersertifikat dan berpengalaman.'],
                ['icon'=>'bolt',             'judul'=>'Pelayanan Cepat',    'desc'=>'Antrean digital yang efisien.'],
                ['icon'=>'biotech',          'judul'=>'Fasilitas Modern',   'desc'=>'Peralatan medis generasi terbaru.'],
                ['icon'=>'forum',            'judul'=>'Konsultasi Nyaman',  'desc'=>'Privasi dan kenyamanan terjaga.'],
                ['icon'=>'payments',         'judul'=>'Harga Transparan',   'desc'=>'Biaya jelas, tanpa biaya tersembunyi.'],
                ['icon'=>'schedule',         'judul'=>'Buka 6 Hari',        'desc'=>'Senin–Sabtu, 08:00–20:00 WIB.'],
                ['icon'=>'wifi',             'judul'=>'Sistem Digital',     'desc'=>'Antrian & rekam medis online.'],
                ['icon'=>'local_pharmacy',   'judul'=>'Apotek Terintegrasi','desc'=>'Obat langsung disiapkan di klinik.'],
            ];
            foreach($unggulan as $u): ?>
            <div class="bg-white rounded-xl p-5 text-center clinic-shadow card-lift border border-outline/20">
                <div class="w-11 h-11 bg-primary/10 text-primary rounded-xl flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-[20px]"><?= $u['icon'] ?></span>
                </div>
                <h4 class="font-display font-bold text-[14px] text-on-bg mb-1"><?= esc($u['judul']) ?></h4>
                <p class="text-[12px] text-on-sv"><?= esc($u['desc']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- FAQ -->
<section class="py-20 bg-surface-low px-6">
    <div class="max-w-7xl mx-auto">

        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-primary-con font-semibold text-[13px] uppercase tracking-widest">FAQ</span>
            <h2 class="font-display font-extrabold text-3xl md:text-4xl text-on-bg mt-3 mb-4">Pertanyaan Umum</h2>
            <p class="text-on-sv text-[16px] leading-relaxed">Beberapa pertanyaan yang sering ditanyakan pasien kepada kami.</p>
        </div>

        <div class="space-y-5">
            <?php
            $faq = [
                ['q'=>'Apakah menerima asuransi?',          'a'=>'Kami bekerja sama dengan berbagai penyedia asuransi nasional dan swasta.'],
                ['q'=>'Bagaimana cara reservasi?',           'a'=>'Reservasi dapat dilakukan melalui WhatsApp, telepon, atau formulir online.'],
                ['q'=>'Apa dokumen yang harus dibawa?',      'a'=>'Pasien baru cukup membawa KTP dan kartu asuransi jika tersedia.'],
                ['q'=>'Apakah tersedia layanan darurat?',    'a'=>'Ya, layanan UGD kami tersedia selama jam operasional klinik.'],
            ];
            foreach($faq as $index => $f): ?>
            <div class="bg-white rounded-2xl clinic-shadow border border-outline/20 overflow-hidden">
                <button class="faq-btn w-full flex items-center justify-between text-left px-6 py-5 hover:bg-surface transition-all"
                        data-target="faq-<?= $index ?>">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-[20px]">help</span>
                        </div>
                        <h4 class="font-display font-bold text-[17px] text-on-bg"><?= esc($f['q']) ?></h4>
                    </div>
                    <span class="material-symbols-outlined text-primary faq-icon transition-transform duration-300">expand_more</span>
                </button>
                <div id="faq-<?= $index ?>" class="hidden px-6 pb-6">
                    <div class="pl-14">
                        <p class="text-on-sv text-[15px] leading-relaxed"><?= esc($f['a']) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- FOOTER -->
<footer class="bg-on-bg text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 pb-12 border-b border-white/10">

            <!-- Brand -->
            <div class="space-y-4">
                <a href="<?= base_url('/') ?>" class="flex items-center gap-3">
                    <img src="<?= base_url('NiceAdmin/assets/img/logo.png') ?>"
                         alt="KlinikOS Logo" class="w-10 h-10 object-contain">
                    <div class="flex flex-col leading-tight">
                        <span class="text-2xl font-extrabold text-white tracking-tight">KlinikOS 2.0</span>
                        <span class="text-xs text-white/70 font-medium hidden md:block">Sistem Klinik Modern</span>
                    </div>
                </a>
                <p class="text-white/60 text-[14px] leading-relaxed max-w-xs">
                    Melayani dengan hati, mengobati dengan teknologi. Klinik modern untuk keluarga Indonesia yang lebih sehat.
                </p>
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
                <h4 class="font-semibold text-[13px] text-white/50 uppercase tracking-widest">Navigasi</h4>
                <ul class="space-y-3">
                    <?php foreach([['Home','general'],['Tentang Kami','about'],['Layanan','service'],['Kontak','contact']] as [$label,$url]): ?>
                    <li><a href="<?= base_url($url) ?>" class="text-[15px] text-white/70 hover:text-white transition-colors"><?= esc($label) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Information -->
            <div class="space-y-4">
                <h4 class="font-semibold text-[13px] text-white/50 uppercase tracking-widest">Informasi</h4>
                <ul class="space-y-3 text-[14px] text-white/70">
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-[17px] mt-0.5 text-primary-con">location_on</span>
                        Jl. Kesehatan No. 123, Semarang
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[17px] text-primary-con">call</span>
                        (024) 123-4567
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[17px] text-primary-con">mail</span>
                        info@klinikos.id
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[17px] text-primary-con">schedule</span>
                        Senin – Sabtu: 08:00 – 20:00
                    </li>
                </ul>
            </div>

        </div>

        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-[13px] text-white/40">
            <p>&copy; <?= date('Y') ?> KlinikOS 2.0. Hak cipta dilindungi.</p>
            <div class="flex gap-5">
                <a href="#" class="hover:text-white/70 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-white/70 transition-colors">Syarat &amp; Ketentuan</a>
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

// FAQ dropdown
document.querySelectorAll('.faq-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const content = document.getElementById(btn.getAttribute('data-target'));
        const icon    = btn.querySelector('.faq-icon');
        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    });
});


</script>

</body>
</html>