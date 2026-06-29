<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Layanan - KlinikOS 2.0') ?></title>
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

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .nav-blur { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }

        .clinic-shadow { box-shadow: 0 10px 30px rgba(65,84,241,.08); }

        .card-lift { transition: transform .25s ease, box-shadow .25s ease; }
        .card-lift:hover { transform: translateY(-5px); box-shadow: 0 18px 40px rgba(1,41,112,.12); }

        section { scroll-margin-top: 80px; }

        /* Thumbnail image zoom on hover */
        .service-thumb { transition: transform .5s ease; }
        .group:hover .service-thumb { transform: scale(1.06); }
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
    <a href="<?= base_url('service') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-primary font-bold bg-surface-low text-[15px]">
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
            <li><a href="<?= base_url('about') ?>"   class="text-secondary hover:text-primary transition" style="padding-bottom:4px">Tentang Kami</a></li>
            <li><a href="<?= base_url('service') ?>" class="text-primary font-bold" style="padding-bottom:4px; border-bottom:2px solid #2136d9">Layanan</a></li>
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


<!-- ═══════════════════════════════
     PAGE HEADER
═══════════════════════════════ -->
<div class="pt-28 pb-16 bg-gradient-to-b from-surface-high to-surface px-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-2 text-[13px] text-on-sv mb-4">
            <a href="<?= base_url('general') ?>" class="hover:text-primary transition-colors">Home</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-primary font-medium">Layanan</span>
        </div>
        <h1 class="font-display font-extrabold text-4xl md:text-5xl text-on-bg">
            Layanan <span class="text-primary-con">KlinikOS 2.0</span>
        </h1>
        <p class="text-on-sv text-[17px] mt-4 max-w-2xl leading-relaxed">
            Kami menyediakan berbagai layanan kesehatan modern dengan dukungan
            tenaga medis profesional dan sistem digital yang terintegrasi.
        </p>
    </div>
</div>


<!-- ═══════════════════════════════
     GRID LAYANAN — card dengan gambar
═══════════════════════════════ -->
<section class="py-20 px-6">
    <div class="max-w-7xl mx-auto">

        <?php
        $services = [
            [
                'img'   => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=700&auto=format&fit=crop',
                'icon'  => 'stethoscope',
                'title' => 'Pemeriksaan Umum',
                'desc'  => 'Layanan konsultasi dan pemeriksaan kesehatan dasar untuk berbagai keluhan pasien.',
                'items' => ['Konsultasi dokter umum', 'Pemeriksaan kesehatan rutin', 'Medical check up'],
            ],
            [
                'img'   => 'https://images.unsplash.com/photo-1609840114035-3c981b782dfe?q=80&w=700&auto=format&fit=crop',
                'icon'  => 'dentistry',
                'title' => 'Kesehatan Gigi',
                'desc'  => 'Pelayanan kesehatan dan perawatan gigi dengan teknologi modern dan nyaman.',
                'items' => ['Pembersihan karang gigi', 'Tambal & cabut gigi', 'Konsultasi kesehatan mulut'],
            ],
            [
                'img'   => 'https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?q=80&w=700&auto=format&fit=crop',
                'icon'  => 'child_care',
                'title' => 'Spesialis Anak',
                'desc'  => 'Layanan kesehatan khusus anak untuk memantau tumbuh kembang secara optimal.',
                'items' => ['Konsultasi dokter anak', 'Pemantauan tumbuh kembang', 'Perawatan kesehatan bayi'],
            ],
            [
                'img'   => 'https://images.unsplash.com/photo-1581595219315-a187dd40c322?q=80&w=700&auto=format&fit=crop',
                'icon'  => 'biotech',
                'title' => 'Radiologi & Lab',
                'desc'  => 'Fasilitas laboratorium dan radiologi modern untuk diagnosis cepat dan akurat.',
                'items' => ['Tes darah lengkap', 'Rontgen & USG', 'Pemeriksaan laboratorium'],
            ],
            [
                'img'   => 'https://images.unsplash.com/photo-1584118624012-df056829fbd0?q=80&w=700&auto=format&fit=crop',
                'icon'  => 'vaccines',
                'title' => 'Vaksinasi',
                'desc'  => 'Program vaksinasi lengkap untuk menjaga kesehatan anak maupun dewasa.',
                'items' => ['Vaksin anak', 'Vaksin influenza', 'Vaksin booster'],
            ],
            [
                'img'   => 'https://images.unsplash.com/photo-1628348068343-c6a848d2b6dd?q=80&w=700&auto=format&fit=crop',
                'icon'  => 'favorite',
                'title' => 'Kesehatan Jantung',
                'desc'  => 'Pemeriksaan kesehatan jantung dan konsultasi pencegahan penyakit kardiovaskular.',
                'items' => ['Pemeriksaan tekanan darah', 'EKG jantung', 'Konsultasi gaya hidup sehat'],
            ],
            [
                'img'   => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?q=80&w=700&auto=format&fit=crop',
                'icon'  => 'monitor_heart',
                'title' => 'Pemeriksaan Digital',
                'desc'  => 'Sistem rekam medis dan hasil pemeriksaan yang terintegrasi secara digital.',
                'items' => ['Rekam medis online', 'Hasil lab digital', 'Pendaftaran cepat'],
            ],
            [
                'img'   => 'https://images.unsplash.com/photo-1519824145371-296894a0daa9?q=80&w=700&auto=format&fit=crop',
                'icon'  => 'healing',
                'title' => 'Fisioterapi',
                'desc'  => 'Terapi pemulihan untuk membantu meningkatkan mobilitas dan kualitas hidup pasien.',
                'items' => ['Terapi cedera otot', 'Latihan rehabilitasi', 'Pemulihan pasca operasi'],
            ],
            [
                'img'   => 'https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?q=80&w=700&auto=format&fit=crop',
                'icon'  => 'local_hospital',
                'title' => 'Tindakan Medis',
                'desc'  => 'Pelayanan tindakan medis ringan dengan penanganan profesional dan aman.',
                'items' => ['Perawatan luka', 'Jahit luka ringan', 'Tindakan medis minor'],
            ],
        ];
        ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            <?php foreach($services as $s): ?>

            <div class="bg-white rounded-2xl overflow-hidden clinic-shadow border border-outline/20 card-lift group flex flex-col">

                <!-- ── Thumbnail gambar (sama gaya dengan home) ── -->
                <div class="overflow-hidden h-[200px] relative">
                    <img src="<?= esc($s['img']) ?>"
                         alt="<?= esc($s['title']) ?>"
                         class="service-thumb w-full h-full object-cover">

                    <!-- Badge ikon layanan di atas gambar -->
                    <div class="absolute top-4 left-4">
                        <div class="w-10 h-10 bg-white/90 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-primary-con text-[20px]">
                                <?= esc($s['icon']) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- ── Body card ── -->
                <div class="p-7 flex flex-col gap-3 flex-1">

                    <!-- Judul -->
                    <h3 class="font-display font-bold text-[20px] text-on-bg">
                        <?= esc($s['title']) ?>
                    </h3>

                    <!-- Deskripsi -->
                    <p class="text-on-sv text-[14px] leading-relaxed">
                        <?= esc($s['desc']) ?>
                    </p>

                    <!-- Divider -->
                    <div class="border-t border-outline/30 my-1"></div>

                    <!-- Item checklist -->
                    <ul class="space-y-2.5 flex-1">
                        <?php foreach($s['items'] as $item): ?>
                        <li class="flex items-center gap-2.5 text-[13px] text-on-sv">
                            <span class="material-symbols-outlined text-primary-con text-[18px] flex-shrink-0"
                                  style="font-variation-settings:'FILL' 1">
                                check_circle
                            </span>
                            <?= esc($item) ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- CTA link -->
                    <a href="<?= base_url('contact') ?>"
                       class="inline-flex items-center gap-1.5 text-primary-con text-[13px] font-semibold mt-3 hover:underline">
                        Buat Janji Temu
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>

                </div>
            </div>

            <?php endforeach; ?>
        </div>

    </div>
</section>


<!-- ═══════════════════════════════
     KEUNGGULAN
═══════════════════════════════ -->
<section class="py-20 bg-surface-low px-6">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">

        <div class="relative">
            <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?q=80&w=1200&auto=format&fit=crop"
                 alt="Klinik Modern"
                 class="rounded-3xl object-cover h-[500px] w-full clinic-shadow">
            <div class="absolute bottom-6 right-6 bg-primary-con text-white rounded-2xl px-6 py-5 clinic-shadow hidden md:block">
                <div class="font-display font-extrabold text-3xl">15+</div>
                <div class="text-[13px] uppercase tracking-widest text-white/80">Tahun Pengalaman</div>
            </div>
        </div>

        <div>
            <span class="text-primary-con font-semibold text-[13px] uppercase tracking-widest">Mengapa Kami</span>
            <h2 class="font-display font-extrabold text-4xl text-on-bg mt-3 mb-8">
                Mengapa Memilih Layanan Kami?
            </h2>

            <?php
            $why = [
                ['precision_manufacturing', 'Peralatan Modern',   'Teknologi medis terbaru untuk hasil pemeriksaan lebih akurat.'],
                ['groups',                  'Tim Profesional',    'Dokter dan tenaga medis berpengalaman dan penuh empati.'],
                ['speed',                   'Pelayanan Cepat',    'Sistem digital mempermudah antrean dan pengelolaan pasien.'],
            ];
            foreach($why as [$icon,$title,$desc]): ?>
            <div class="flex gap-5 mb-8 last:mb-0">
                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center clinic-shadow flex-shrink-0">
                    <span class="material-symbols-outlined text-primary-con"><?= $icon ?></span>
                </div>
                <div>
                    <h4 class="font-display font-bold text-[20px] text-on-bg mb-1"><?= esc($title) ?></h4>
                    <p class="text-on-sv leading-relaxed"><?= esc($desc) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════
     CTA
═══════════════════════════════ -->
<section class="py-20 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-gradient-to-br from-primary to-primary-con rounded-[32px] p-10 md:p-16 text-center text-white relative overflow-hidden"
             style="box-shadow:0 20px 50px rgba(33,54,217,.25)">

            <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-3xl mx-auto relative z-10">
                <h2 class="font-display font-extrabold text-4xl mb-5">
                    Siap Menjaga Kesehatan Anda?
                </h2>
                <p class="text-white/80 text-[17px] leading-relaxed mb-10">
                    Jadwalkan konsultasi bersama dokter kami dan dapatkan
                    pelayanan kesehatan terbaik dengan cepat dan nyaman.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="<?= base_url('contact') ?>"
                       class="inline-flex items-center justify-center gap-2 bg-white text-primary-con font-bold px-8 py-4 rounded-2xl hover:brightness-95 transition-all">
                        <span class="material-symbols-outlined">calendar_month</span>
                        Buat Janji Temu
                    </a>
                    <a href="<?= base_url('contact') ?>"
                       class="inline-flex items-center justify-center gap-2 border border-white/30 text-white font-semibold px-8 py-4 rounded-2xl hover:bg-white/10 transition-all">
                        <span class="material-symbols-outlined">call</span>
                        Kontak
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════
     FOOTER
═══════════════════════════════ -->
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
                    <li>
                        <a href="<?= base_url($url) ?>" class="text-[15px] text-white/70 hover:text-white transition-colors">
                            <?= esc($label) ?>
                        </a>
                    </li>
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
</script>

</body>
</html>