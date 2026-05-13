<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'KlinikOS 2.0 - Beranda') ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('NiceAdmin/assets/img/favicon.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('NiceAdmin/assets/img/apple-touch-icon.png') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">

    <!-- Tailwind -->
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
        body { font-family:'Inter',sans-serif; }

        .material-symbols-outlined {
            font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;
            vertical-align: middle;
        }

        .nav-blur { backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px); }

        .clinic-shadow { box-shadow:0 10px 30px rgba(65,84,241,.08); }

        .card-lift { transition:transform .25s ease, box-shadow .25s ease; }
        .card-lift:hover { transform:translateY(-6px); box-shadow:0 20px 45px rgba(1,41,112,.12); }

        .nav-active { border-bottom:2px solid #2136d9; color:#2136d9; font-weight:700; }

        .text-gradient {
            background:linear-gradient(135deg,#2136d9 0%,#4154f1 50%,#304d94 100%);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
        }

        @keyframes pulse-dot {
            0%,100% { opacity:1; transform:scale(1); }
            50%      { opacity:.6; transform:scale(1.15); }
        }
        .pulse-dot { animation:pulse-dot 2s infinite; }

        /* Hero full-bleed overlay */
        .hero-overlay {
            background:linear-gradient(
                to right,
                rgba(255,255,255,.97) 0%,
                rgba(255,255,255,.88) 45%,
                rgba(255,255,255,.05) 100%
            );
        }

        /* Bento highlight card */
        .bento-blue { background:#2136d9; }

        /* Artikel badge small */
        .badge { font-size:11px; font-weight:600; letter-spacing:.05em; text-transform:uppercase; }

        /* Quote decoration */
        .quote-decor {
            position:absolute; top:-6px; right:16px;
            font-size:72px; line-height:1; font-family:'Manrope',sans-serif;
            font-weight:800; color:#4154f1; opacity:.12; pointer-events:none; select:none;
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
        <a href="<?= base_url('general') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-primary font-bold bg-surface-low text-[15px]">
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
        <a href="<?= base_url('contact') ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-secondary hover:text-primary hover:bg-surface-low transition text-[15px]">
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
            <li><a href="<?= base_url('general') ?>" class="text-primary font-bold" style="padding-bottom:4px; border-bottom:2px solid #2136d9">Home</a></li>
            <li><a href="<?= base_url('about') ?>"   class="text-secondary hover:text-primary transition" style="padding-bottom:4px">Tentang Kami</a></li>
            <li><a href="<?= base_url('service') ?>" class="text-secondary hover:text-primary transition" style="padding-bottom:4px">Layanan</a></li>
            <li><a href="<?= base_url('contact') ?>" class="text-secondary hover:text-primary transition" style="padding-bottom:4px">Kontak</a></li>
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


<!-- ═══════════════════════════════
     HERO — full-bleed image + card
═══════════════════════════════ -->
<section id="home" class="relative min-h-screen flex items-center overflow-hidden">

    <!-- Background clinic photo -->
    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=1800&auto=format&fit=crop"
     alt="Interior Rumah Sakit"
     class="absolute inset-0 w-full h-full object-cover object-center">

    <!-- White gradient overlay (left heavy, fades right) -->
    <div class="hero-overlay absolute inset-0"></div>

    <!-- Content -->
    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 pt-32 pb-24">
        <div class="max-w-[560px] space-y-7">

            <!-- Badge -->
            <div class="inline-flex items-center gap-2 bg-primary-con/10 text-primary-con px-4 py-2 rounded-full text-[13px] font-semibold">
                <span class="pulse-dot w-2 h-2 rounded-full bg-primary-con inline-block"></span>
                Solusi Kesehatan Terpercaya
            </div>

            <!-- Headline -->
            <h1 class="font-display font-extrabold text-[52px] lg:text-[62px] leading-[1.08] text-on-bg">
                Kesehatan Anda,<br>
                <span class="text-gradient">Prioritas Utama</span><br>
                Kami
            </h1>

            <!-- Sub -->
            <p class="text-[17px] text-on-sv leading-relaxed">
                Nikmati layanan medis berstandar internasional dengan pendekatan
                personal yang mengutamakan kenyamanan dan kesembuhan pasien.
            </p>

            <!-- CTA buttons -->
            <div class="flex flex-wrap gap-4">
                <a href="<?= base_url('contact') ?>"
                   class="inline-flex items-center gap-2 bg-primary-con text-white px-8 py-4 rounded-2xl font-semibold shadow-lg shadow-primary-con/25 hover:-translate-y-1 transition-all">
                    <span class="material-symbols-outlined">calendar_month</span>
                    Buat Janji Temu
                </a>
                <a href="<?= base_url('service') ?>"
                   class="inline-flex items-center gap-2 border-2 border-primary-con/80 text-primary-con bg-white/70 backdrop-blur-sm px-8 py-4 rounded-2xl font-semibold hover:bg-primary-con hover:text-white transition-all">
                    Lihat Layanan
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════
     STATS BAR
═══════════════════════════════ -->
<section class="bg-white border-b border-outline/30 py-10">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-3 divide-x divide-outline/30 text-center">
            <?php
            $stats_bar = [
                ['50+',   'Tenaga Medis Profesional'],
                ['10rb+', 'Pasien Telah Dilayani'],
                ['15+','Tahun Pengalaman'],
            ];
            foreach($stats_bar as [$val,$label]): ?>
            <div class="px-6 py-2">
                <div class="font-display font-extrabold text-4xl text-primary-con"><?= esc($val) ?></div>
                <div class="text-[14px] text-on-sv mt-1"><?= esc($label) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════
     JAM OPERASIONAL
═══════════════════════════════ -->
<section class="bg-surface py-14 px-6">
    <div class="max-w-7xl mx-auto">

        <div class="bg-white rounded-3xl p-7 md:p-8 clinic-shadow border border-outline/20">

            <!-- Header -->
            <div class="flex items-center gap-3 mb-6">

                <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-primary text-[24px]">
                        public
                    </span>
                </div>

                <div>
                    <h3 class="font-display font-bold text-[22px] text-on-bg">
                        klinikos.com
                    </h3>

                    <p class="text-[13px] text-on-sv">
                        Portal Kesehatan & Sistem Klinik Modern
                    </p>
                </div>

                <!-- Status -->
                <span id="status-badge"
                    class="ml-auto text-[11px] font-semibold px-3 py-1.5 rounded-full">
                </span>

            </div>

            <!-- Jam Operasional -->

                <div class="flex items-center gap-3 mb-5">

                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-amber-500 text-[20px]">
                            schedule
                        </span>
                    </div>

                    <div>
                        <h3 class="font-display font-bold text-[22px] text-on-bg">
                            Jam Operasional
                        </h3>

                        <p class="text-[13px] text-on-sv">
                        Kami siap melayani Anda
                        </p>
                    </div>

                </div>

                <ul class="space-y-3">
                    <?php
                    $jadwal = [
                        ['hari' => 'Senin – Jumat', 'jam' => '08:00 – 20:00'],
                        ['hari' => 'Sabtu', 'jam' => '08:00 – 17:00'],
                        ['hari' => 'Minggu', 'jam' => 'Tutup'],
                    ];

                    foreach($jadwal as $j):
                        $isTutup = $j['jam'] === 'Tutup';
                    ?>

                    <li class="flex items-center justify-between text-[14px]">

                        <span class="flex items-center gap-2 <?= $isTutup ? 'text-red-500' : 'text-on-sv' ?>">

                            <span class="w-1.5 h-1.5 rounded-full <?= $isTutup ? 'bg-red-500' : 'bg-emerald-400' ?> inline-block"></span>

                            <?= esc($j['hari']) ?>

                        </span>

                        <span class="font-semibold <?= $isTutup ? 'text-red-500' : 'text-on-bg' ?>">
                            <?= esc($j['jam']) ?>
                        </span>

                    </li>

                    <?php endforeach; ?>
                </ul>

            </div>

        </div>

    </div>
</section>

<!-- ═══════════════════════════════
     MENGAPA MEMILIH KAMI — bento
═══════════════════════════════ -->
<section class="py-24 px-6 bg-surface-low" id="keunggulan">
    <div class="max-w-7xl mx-auto">

        <div class="text-center mb-14">
            <h2 class="font-display font-bold text-[38px] text-on-bg">Mengapa Memilih KlinikOS 2.0?</h2>
            <div class="w-12 h-1 bg-primary-con rounded-full mx-auto mt-4"></div>
        </div>

        <!-- Row 1: 2 card + 1 blue card -->
        <div class="grid md:grid-cols-3 gap-5 mb-5">

            <!-- Teknologi Medis -->
            <div class="bg-white rounded-3xl p-7 clinic-shadow border border-outline/20 card-lift flex flex-col gap-4">
                <div class="w-12 h-12 bg-primary-con/10 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary-con text-[24px]">biotech</span>
                </div>
                <div>
                    <h3 class="font-display font-bold text-[19px] text-on-bg mb-2">Teknologi Medis Mutakhir</h3>
                    <p class="text-on-sv text-[14px] leading-relaxed">
                        Kami menginvestasikan pada peralatan diagnostik terbaru untuk memastikan akurasi hasil pemeriksaan Anda.
                    </p>
                </div>
            </div>

            <!-- Kualitas Terjamin (blue highlight) -->
            <div class="bento-blue rounded-3xl p-7 flex flex-col gap-4 card-lift">
                <div class="w-12 h-12 bg-white/15 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-[24px]">verified_user</span>
                </div>
                <div>
                    <h3 class="font-display font-bold text-[19px] text-white mb-2">Kualitas Terjamin</h3>
                    <p class="text-white/75 text-[14px] leading-relaxed">
                        Akreditasi nasional dan internasional yang menjamin standar operasional prosedur terbaik di setiap lini pelayanan.
                    </p>
                </div>
            </div>

            <!-- Dokter Profesional -->
            <div class="bg-white rounded-3xl p-7 clinic-shadow border border-outline/20 card-lift flex flex-col gap-4">
                <div class="w-12 h-12 bg-primary-con/10 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary-con text-[24px]">medical_services</span>
                </div>
                <div>
                    <h3 class="font-display font-bold text-[19px] text-on-bg mb-2">Dokter Profesional</h3>
                    <p class="text-on-sv text-[14px] leading-relaxed">
                        Tim dokter kami bersertifikat dan berpengalaman, siap menangani berbagai keluhan kesehatan Anda.
                    </p>
                </div>
            </div>
        </div>

        <!-- Row 2: card + gambar tim + card -->
        <div class="grid md:grid-cols-3 gap-5">

            <!-- Pendekatan Humanis -->
            <div class="bg-white rounded-3xl p-7 clinic-shadow border border-outline/20 card-lift flex flex-col gap-4">
                <div class="w-12 h-12 bg-primary-con/10 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary-con text-[24px]">diversity_3</span>
                </div>
                <div>
                    <h3 class="font-display font-bold text-[19px] text-on-bg mb-2">Pendekatan Humanis</h3>
                    <p class="text-on-sv text-[14px] leading-relaxed">
                        Kami melayani dengan empati, memastikan setiap pasien merasa dihargai dan didengarkan.
                    </p>
                </div>
            </div>

            <!-- Gambar tim dokter tengah -->
            <div class="rounded-3xl overflow-hidden relative min-h-[220px]">
                <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?q=80&w=700&auto=format&fit=crop"
                alt="Tim Dokter KlinikOS"
                class="absolute inset-0 w-full h-full object-cover object-center">
                <div class="absolute inset-0 bg-gradient-to-t from-on-bg/65 via-on-bg/10 to-transparent"></div>
                <div class="absolute bottom-5 left-5 right-5">
                    <span class="text-white font-display font-bold text-[16px] leading-snug">
                        Tim Medis Profesional &amp; Berdedikasi
                    </span>
                </div>
            </div>

            <!-- Rekam Medis Digital -->
            <div class="bg-white rounded-3xl p-7 clinic-shadow border border-outline/20 card-lift flex flex-col gap-4">
                <div class="w-12 h-12 bg-primary-con/10 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary-con text-[24px]">folder_shared</span>
                </div>
                <div>
                    <h3 class="font-display font-bold text-[19px] text-on-bg mb-2">Rekam Medis Terintegrasi</h3>
                    <p class="text-on-sv text-[14px] leading-relaxed">
                        Akses data kesehatan Anda secara aman dan instan melalui platform digital kami yang user-friendly.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════
     LAYANAN UNGGULAN — 4 kolom foto
═══════════════════════════════ -->
<section class="py-24 px-6" id="layanan">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 mb-14">
            <div class="space-y-3">
                <h2 class="font-display font-bold text-[38px] text-on-bg">Layanan Unggulan Kami</h2>
                <p class="text-on-sv max-w-xl">Solusi kesehatan lengkap untuk seluruh anggota keluarga.</p>
            </div>
            <a href="<?= base_url('service') ?>"
               class="inline-flex items-center gap-1.5 text-primary-con font-semibold text-[14px] hover:underline whitespace-nowrap">
                Lihat Semua Layanan
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $layanan = [
                [
                    'img'   => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=600&auto=format&fit=crop',
                    'judul' => 'Pemeriksaan Umum',
                    'desc'  => 'Layanan konsultasi dan pemeriksaan kesehatan oleh dokter profesional.',
                ],
                [
                    'img'   => 'https://images.unsplash.com/photo-1609840114035-3c981b782dfe?q=80&w=600&auto=format&fit=crop',
                    'judul' => 'Kesehatan Gigi',
                    'desc'  => 'Perawatan gigi lengkap dan estetika tingkat medis mutakhir.',
                ],
                [
                    'img'   => 'https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?q=80&w=600&auto=format&fit=crop',
                    'judul' => 'Spesialis Anak',
                    'desc'  => 'Perhatian khusus untuk tumbuh kembang buah hati Anda.',
                ],
                [
                    'img'   => 'https://images.unsplash.com/photo-1581595219315-a187dd40c322?q=80&w=1200&auto=format&fit=crop',
                    'judul' => 'Radiologi & Lab',
                    'desc'  => 'Fasilitas laboratorium lengkap untuk diagnosis yang cepat dan tepat.',
                ],
            ];
            foreach($layanan as $l): ?>
            <div class="bg-white rounded-2xl overflow-hidden clinic-shadow border border-outline/20 card-lift group flex flex-col">
                <div class="overflow-hidden h-[180px]">
                    <img src="<?= esc($l['img']) ?>"
                         alt="<?= esc($l['judul']) ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-5 flex flex-col gap-2 flex-1">
                    <h3 class="font-display font-bold text-[17px] text-on-bg"><?= esc($l['judul']) ?></h3>
                    <p class="text-[13px] text-on-sv leading-relaxed flex-1"><?= esc($l['desc']) ?></p>
                    <a href="<?= base_url('service') ?>"
                       class="inline-flex items-center gap-1 text-primary-con text-[13px] font-semibold mt-2 hover:underline">
                        Pelajari Lebih Lanjut
                        <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════
     TESTIMONI
═══════════════════════════════ -->
<section class="py-24 px-6 bg-surface-low" id="testimoni">
    <div class="max-w-7xl mx-auto">

        <div class="text-center mb-14 space-y-3">
            <span class="text-primary-con font-semibold text-[13px] uppercase tracking-widest">Ulasan Pasien</span>
            <h2 class="font-display font-bold text-[38px] text-on-bg">Apa Kata Pasien Kami</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-7">
            <?php
            $testimoni = [
                [
                    'init'  => 'BP',
                    'nama'  => 'Budi Pratama',
                    'peran' => 'Pasien Rawat Jalan',
                    'bg'    => 'bg-primary-con',
                    'text'  => 'Pelayanannya ramah dan efisien. Saya tidak perlu menunggu lama untuk konsultasi dengan dokter spesialis. Sangat senang dengan suasana bersih dan nyaman.',
                ],
                [
                    'init'  => 'SK',
                    'nama'  => 'Sari Kusuma',
                    'peran' => 'Ibu Rumah Tangga',
                    'bg'    => 'bg-tertiary',
                    'text'  => 'Dokter anak di sini sangat sabar dan detail penjelasannya. Anak saya jadi tidak takut lagi pergi ke dokter. Sangat direkomendasikan untuk keluarga!',
                ],
                [
                    'init'  => 'AH',
                    'nama'  => 'Adi Haryanto',
                    'peran' => 'Karyawan Swasta',
                    'bg'    => 'bg-primary',
                    'text'  => 'Fasilitas radiologinya sangat modern. Hasil lab keluar dengan cepat dan bisa diakses lewat handphone. Benar-benar memudahkan pasien.',
                ],
            ];
            foreach($testimoni as $t): ?>
            <div class="bg-white rounded-3xl p-8 clinic-shadow border border-outline/20 card-lift relative overflow-hidden">
                <!-- Decorative quote -->
                <div class="quote-decor">"</div>

                <!-- Stars -->
                <div class="flex gap-0.5 mb-5">
                    <?php for($s=0;$s<5;$s++): ?>
                    <span class="material-symbols-outlined text-amber-400 text-[18px]"
                          style="font-variation-settings:'FILL' 1">star</span>
                    <?php endfor; ?>
                </div>

                <!-- Text -->
                <p class="text-[14px] text-on-sv leading-relaxed italic mb-6">
                    "<?= esc($t['text']) ?>"
                </p>

                <!-- Author -->
                <div class="flex items-center gap-3 pt-5 border-t border-outline/30">
                    <div class="w-11 h-11 rounded-full <?= $t['bg'] ?> flex items-center justify-center text-white font-bold text-[13px] flex-shrink-0">
                        <?= esc($t['init']) ?>
                    </div>
                    <div>
                        <div class="font-display font-bold text-[15px] text-on-bg"><?= esc($t['nama']) ?></div>
                        <div class="text-[12px] text-on-sv"><?= esc($t['peran']) ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════
     ARTIKEL KESEHATAN
═══════════════════════════════ -->
<section class="py-24 px-6" id="artikel">

    <div class="max-w-7xl mx-auto">

        <!-- Heading -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 mb-14">

            <div class="space-y-3">

                <span class="text-primary-con font-semibold text-[13px] uppercase tracking-widest">
                    Tips & Edukasi
                </span>

                <h2 class="font-display font-bold text-[38px] text-on-bg">
                    Artikel Kesehatan Terkini
                </h2>

                <p class="text-on-sv max-w-xl">
                    Informasi dan tips kesehatan terpercaya dari tim medis KlinikOS 2.0.
                </p>

            </div>

            
            

        </div>

        <!-- Artikel Grid -->
        <div class="grid md:grid-cols-3 gap-7 items-start">

            <?php
            $artikel = [
                [
                    'img'      => 'https://images.unsplash.com/photo-1493836512294-502baa1986e2?q=80&w=700&auto=format&fit=crop',
                    'kategori' => 'Gaya Hidup',
                    'kat_cls'  => 'bg-emerald-50 text-emerald-700',
                    'judul'    => '7 Kebiasaan Pagi yang Meningkatkan Imunitas Tubuh',
                    'ringkas'  => 'Memulai hari dengan rutinitas yang tepat terbukti dapat memperkuat sistem kekebalan tubuh dan meningkatkan energi sepanjang hari.',
                    'author'   => 'dr. Anita Dewi',
                    'tanggal'  => '5 Mei 2025',
                    'durasi'   => '4 menit baca',
                ],
                [
                    'img'      => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=700&auto=format&fit=crop',
                    'kategori' => 'Nutrisi',
                    'kat_cls'  => 'bg-amber-50 text-amber-700',
                    'judul'    => 'Panduan Pola Makan Sehat untuk Cegah Diabetes Tipe 2',
                    'ringkas'  => 'Mengatur asupan karbohidrat dan gula tidak harus membosankan. Pelajari strategi makan cerdas yang direkomendasikan dokter kami.',
                    'author'   => 'Ahli Gizi Klinik',
                    'tanggal'  => '28 Apr 2025',
                    'durasi'   => '6 menit baca',
                ],
                [
                    'img'      => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?q=80&w=700&auto=format&fit=crop',
                    'kategori' => 'Olahraga',
                    'kat_cls'  => 'bg-blue-50 text-blue-700',
                    'judul'    => 'Olahraga 30 Menit Sehari: Manfaat Besar untuk Jantung',
                    'ringkas'  => 'Penelitian terbaru membuktikan aktivitas fisik ringan selama 30 menit sudah cukup untuk menjaga kesehatan kardiovaskular Anda secara optimal.',
                    'author'   => 'dr. Budi Santoso',
                    'tanggal'  => '20 Apr 2025',
                    'durasi'   => '5 menit baca',
                ],
            ];

            foreach($artikel as $a): ?>

            <!-- CARD -->
            <article class="bg-white rounded-3xl overflow-hidden clinic-shadow border border-outline/20 card-lift group flex flex-col">

                <!-- Thumbnail -->
                <div class="overflow-hidden h-52">

                    <img 
                        src="<?= esc($a['img']) ?>"
                        alt="<?= esc($a['judul']) ?>"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    >

                </div>

                <!-- Body -->
                <div class="p-7 flex flex-col gap-3 flex-1">

                    <!-- Kategori -->
                    <div class="flex items-center gap-3 flex-wrap">

                        <span class="badge px-3 py-1 rounded-full <?= $a['kat_cls'] ?>">
                            <?= esc($a['kategori']) ?>
                        </span>

                        <span class="text-[12px] text-on-sv flex items-center gap-1">

                            <span class="material-symbols-outlined text-[13px]">
                                schedule
                            </span>

                            <?= esc($a['durasi']) ?>

                        </span>

                    </div>

                    <!-- Judul -->
                    <h3 class="font-display font-bold text-[18px] text-on-bg leading-snug group-hover:text-primary-con transition-colors">

                        <?= esc($a['judul']) ?>

                    </h3>

                    <!-- Ringkasan -->
                    <p class="text-[13px] text-on-sv leading-relaxed flex-1">

                        <?= esc($a['ringkas']) ?>

                    </p>

                    <!-- Meta -->
                    <div class="flex items-center justify-between pt-4 border-t border-outline/30 mt-2">

                        <div class="flex items-center gap-2">

                            <div class="w-7 h-7 rounded-full bg-primary-con/12 flex items-center justify-center">

                                <span class="material-symbols-outlined text-primary-con text-[14px]">
                                    person
                                </span>

                            </div>

                            <span class="text-[12px] font-semibold text-on-bg">
                                <?= esc($a['author']) ?>
                            </span>

                        </div>

                        <span class="text-[12px] text-on-sv">
                            <?= esc($a['tanggal']) ?>
                        </span>

                    </div>

                    <!-- Dropdown Artikel -->
                    <div class="pt-2">

                        <!-- Button -->
                        <button
                            onclick="toggleArtikel(this)"
                            class="inline-flex items-center gap-1.5 text-primary-con text-[13px] font-semibold hover:underline">

                            Baca Selengkapnya

                            <span class="material-symbols-outlined text-[18px] transition-transform duration-300">
                                keyboard_arrow_down
                            </span>

                        </button>

                        <!-- Hidden Content -->
                        <div class="artikel-content hidden mt-4">

                            <div class="bg-surface-low rounded-2xl p-5 border border-outline/20">

                                <p class="text-[13px] text-on-sv leading-relaxed mb-3">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>

                                <p class="text-[13px] text-on-sv leading-relaxed mb-3">
                                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>

                                <p class="text-[13px] text-on-sv leading-relaxed">
                                    Curabitur pretium tincidunt lacus. Nulla gravida orci a odio.
                                    Nullam varius, turpis et commodo pharetra, est eros bibendum elit.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </article>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<!-- ═══════════════════════════════
     CTA BANNER
═══════════════════════════════ -->
<section class="py-24 px-6 bg-surface-low">
    <div class="max-w-6xl mx-auto">
        <div class="relative overflow-hidden rounded-[40px] bg-gradient-to-r from-primary to-primary-con p-12 lg:p-16 text-center"
             style="box-shadow:0 24px 60px rgba(33,54,217,.25)">

            <div class="absolute top-0 left-0 w-72 h-72 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mx-auto space-y-6">

                <span class="inline-flex items-center gap-2 bg-white/15 px-4 py-2 rounded-full text-white text-[13px] font-semibold">
                    <span class="material-symbols-outlined text-[18px]">favorite</span>
                    Klinik Pilihan Keluarga Indonesia
                </span>

                <h2 class="font-display font-extrabold text-4xl lg:text-5xl text-white leading-tight">
                    Siap Untuk Hidup Lebih Sehat?
                </h2>

                <p class="text-white/80 text-[17px] leading-relaxed">
                    Jadwalkan konsultasi Anda hari ini dan mulai perjalanan menuju kesehatan
                    optimal bersama tim KlinikOS 2.0.
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="<?= base_url('contact') ?>"
                       class="inline-flex items-center gap-2 bg-white text-primary font-bold px-8 py-4 rounded-2xl hover:brightness-95 transition-all">
                        <span class="material-symbols-outlined">calendar_month</span>
                        Buat Janji Temu
                    </a>
                    <a href="<?= base_url('contact') ?>"
                       class="inline-flex items-center gap-2 border border-white/30 text-white px-8 py-4 rounded-2xl font-semibold hover:bg-white/10 transition-all">
                        <span class="material-symbols-outlined">call</span>
                        Hubungi CS Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════
     FOOTER (tidak diubah)
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
                    Melayani dengan hati, mengobati dengan teknologi. Klinik modern untuk keluarga Indonesia.
                </p>
            </div>

            <!-- Navigation -->
            <div class="space-y-4">
                <h4 class="font-semibold text-[13px] text-white/50 uppercase tracking-widest">Navigasi</h4>
                <ul class="space-y-3">
                    <li><a href="<?= base_url('general') ?>" class="text-white/70 hover:text-white transition-colors text-[15px]">Home</a></li>
                    <li><a href="<?= base_url('about') ?>"   class="text-white/70 hover:text-white transition-colors text-[15px]">Tentang Kami</a></li>
                    <li><a href="<?= base_url('service') ?>" class="text-white/70 hover:text-white transition-colors text-[15px]">Layanan</a></li>
                    <li><a href="<?= base_url('contact') ?>" class="text-white/70 hover:text-white transition-colors text-[15px]">Kontak</a></li>
                </ul>
            </div>

            <!-- Info -->
            <div class="space-y-4">
                <h4 class="font-semibold text-[13px] text-white/50 uppercase tracking-widest">Informasi</h4>
                <ul class="space-y-3 text-[14px] text-white/70">
                    <li class="flex gap-2.5 items-start">
                        <span class="material-symbols-outlined text-primary-con text-[18px] flex-shrink-0 mt-0.5">location_on</span>
                        Jl. Kesehatan No. 123, Semarang
                    </li>
                    <li class="flex gap-2.5 items-center">
                        <span class="material-symbols-outlined text-primary-con text-[18px]">call</span>
                        (024) 123-4567
                    </li>
                    <li class="flex gap-2.5 items-center">
                        <span class="material-symbols-outlined text-primary-con text-[18px]">mail</span>
                        info@klinikos.id
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
<!-- END FOOTER -->


<!-- ═══════════════════════════════
     SCRIPTS
═══════════════════════════════ -->
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

// Status buka / tutup otomatis
(function(){

    const badge = document.getElementById('status-badge');

    if(!badge) return;

    const now  = new Date();
    const day  = now.getDay();
    const hour = now.getHours();
    const min  = now.getMinutes();

    const time = hour * 60 + min;

    // Senin–Jumat 08:00–20:00
    // Sabtu 08:00–17:00
    const openMin  = 8 * 60;
    const closeMin = (day === 6) ? 17 * 60 : 20 * 60;

    const isOpen = day >= 1 && day <= 6 &&
                   time >= openMin &&
                   time < closeMin;

    if(isOpen){

        badge.textContent = '● Buka Sekarang';

        badge.classList.add(
            'bg-emerald-50',
            'text-emerald-700'
        );

    } else {

        badge.textContent = '● Tutup';

        badge.classList.add(
            'bg-red-50',
            'text-red-600'
        );
    }

})();

// <!-- SCRIPT DROPDOWN -->

function toggleArtikel(button) {

    const currentContent = button.parentElement.querySelector('.artikel-content');
    const currentIcon = button.querySelector('.material-symbols-outlined');

    // Tutup semua artikel lain
    document.querySelectorAll('.artikel-content').forEach(content => {

        if(content !== currentContent) {

            content.classList.add('hidden');

        }

    });

    // Reset semua icon lain
    document.querySelectorAll('.artikel-content').forEach(content => {

        const btn = content.parentElement.querySelector('button');
        const icon = btn.querySelector('.material-symbols-outlined');

        if(content !== currentContent) {

            icon.style.transform = 'rotate(0deg)';

        }

    });

    // Toggle artikel aktif
    currentContent.classList.toggle('hidden');

    // Rotate icon
    if(currentContent.classList.contains('hidden')) {

        currentIcon.style.transform = 'rotate(0deg)';

    } else {

        currentIcon.style.transform = 'rotate(180deg)';

    }
}

</script>

</body>
</html>