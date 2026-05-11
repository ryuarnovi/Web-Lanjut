<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Klinik Sehat Waras</title>
    <meta name="description" content="Layanan lengkap Klinik Sehat Waras: poli umum, gigi, laboratorium, MCU, vaksinasi, paket corporate, dan konsultasi dokter.">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        klinik: '#0ea5e9', // Sky 500
                        dark: '#0f172a',  // Slate 900
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="<?= base_url('general') ?>" class="text-2xl font-bold text-klinik flex items-center gap-2">
                <span class="bg-klinik text-white p-2 rounded-lg">🏥</span> Klinik Sehat
            </a>
            <div class="space-x-6 text-gray-600 hidden md:flex">
                <a href="<?= base_url('general') ?>" class="hover:text-klinik">Home</a>
                <a href="<?= base_url('about') ?>" class="hover:text-klinik">Tentang</a>
                <a href="<?= base_url('service') ?>" class="hover:text-klinik">Layanan</a>
                <a href="<?= base_url('contact') ?>" class="hover:text-klinik">Kontak</a>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?= base_url('login') ?>" class="hidden md:inline-block bg-klinik text-white px-4 py-2 rounded-full hover:bg-sky-600">Akses Internal</a>
                <button id="nav-toggle" aria-controls="mobile-menu" aria-expanded="false" class="md:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-klinik">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
        <!-- Mobile menu (hidden by default) -->
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="<?= base_url('general') ?>" class="block py-2 text-gray-700 hover:text-klinik">Home</a>
                <a href="<?= base_url('about') ?>" class="block py-2 text-gray-700 hover:text-klinik">Tentang</a>
                <a href="<?= base_url('service') ?>" class="block py-2 text-gray-700 hover:text-klinik">Layanan</a>
                <a href="<?= base_url('contact') ?>" class="block py-2 text-gray-700 hover:text-klinik">Kontak</a>
            </div>
        </div>
    </nav>

    <section class="bg-sky-50 py-14">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-dark leading-tight">Layanan Lengkap Klinik Sehat Waras</h1>
            <p class="text-gray-600 mt-4 max-w-3xl">Dari pemeriksaan rutin hingga layanan corporate, kami menghadirkan layanan medis yang cepat, akurat, dan ramah pasien.</p>
        </div>
    </section>

    <section id="services" class="py-14">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-dark mb-8">Layanan Utama</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <article class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold">Poli Umum</h3>
                    <p class="text-gray-600 mt-2">Konsultasi dokter umum, skrining gejala, dan terapi awal penyakit ringan-sedang.</p>
                    <ul class="text-sm text-gray-600 mt-3 space-y-1">
                        <li>Durasi: 20-30 menit</li>
                        <li>Mulai dari: Rp 100.000</li>
                    </ul>
                    <a href="<?= base_url('booking') ?>" class="mt-4 inline-block bg-klinik text-white px-4 py-2 rounded w-full text-center hover:bg-sky-600">Buat Janji</a>
                </article>

                <article class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold">Poli Gigi</h3>
                    <p class="text-gray-600 mt-2">Pemeriksaan gigi, pembersihan karang gigi, dan konsultasi kesehatan mulut.</p>
                    <ul class="text-sm text-gray-600 mt-3 space-y-1">
                        <li>Durasi: 30-45 menit</li>
                        <li>Mulai dari: Rp 150.000</li>
                    </ul>
                    <a href="<?= base_url('booking') ?>" class="mt-4 inline-block bg-klinik text-white px-4 py-2 rounded w-full text-center hover:bg-sky-600">Buat Janji</a>
                </article>

                <article class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold">Laboratorium</h3>
                    <p class="text-gray-600 mt-2">Pemeriksaan darah, urine, gula darah, kolesterol, dan parameter kesehatan lainnya.</p>
                    <ul class="text-sm text-gray-600 mt-3 space-y-1">
                        <li>Durasi: 15-20 menit</li>
                        <li>Mulai dari: Rp 120.000</li>
                    </ul>
                    <a href="<?= base_url('booking') ?>" class="mt-4 inline-block bg-klinik text-white px-4 py-2 rounded w-full text-center hover:bg-sky-600">Buat Janji</a>
                </article>

                <article class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold">Vaksinasi</h3>
                    <p class="text-gray-600 mt-2">Vaksin influenza, hepatitis, dan vaksinasi kebutuhan kerja sesuai rekomendasi medis.</p>
                    <ul class="text-sm text-gray-600 mt-3 space-y-1">
                        <li>Durasi: 10-15 menit</li>
                        <li>Mulai dari: Rp 180.000</li>
                    </ul>
                    <a href="<?= base_url('booking') ?>" class="mt-4 inline-block bg-klinik text-white px-4 py-2 rounded w-full text-center hover:bg-sky-600">Buat Janji</a>
                </article>

                <article class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold">Medical Check Up (MCU)</h3>
                    <p class="text-gray-600 mt-2">Paket pemeriksaan kesehatan menyeluruh untuk personal maupun kebutuhan perusahaan.</p>
                    <ul class="text-sm text-gray-600 mt-3 space-y-1">
                        <li>Durasi: 60-120 menit</li>
                        <li>Mulai dari: Rp 450.000</li>
                    </ul>
                    <a href="<?= base_url('booking') ?>" class="mt-4 inline-block bg-klinik text-white px-4 py-2 rounded w-full text-center hover:bg-sky-600">Buat Janji</a>
                </article>

                <article class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold">Konsultasi Online</h3>
                    <p class="text-gray-600 mt-2">Konsultasi cepat via telemedicine untuk keluhan awal dan tindak lanjut pengobatan.</p>
                    <ul class="text-sm text-gray-600 mt-3 space-y-1">
                        <li>Durasi: 15-20 menit</li>
                        <li>Mulai dari: Rp 90.000</li>
                    </ul>
                    <a href="<?= base_url('booking') ?>" class="mt-4 inline-block bg-klinik text-white px-4 py-2 rounded w-full text-center hover:bg-sky-600">Buat Janji</a>
                </article>
            </div>
        </div>
    </section>

    <section class="py-14 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-dark mb-8">Paket Layanan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl border border-gray-200">
                    <h3 class="text-xl font-semibold">Paket Basic Check</h3>
                    <p class="text-3xl font-bold text-klinik mt-3">Rp 250.000</p>
                    <ul class="text-sm text-gray-600 mt-4 space-y-2">
                        <li>Konsultasi dokter umum</li>
                        <li>Tekanan darah & BMI</li>
                        <li>Gula darah sewaktu</li>
                    </ul>
                </div>
                <div class="bg-white p-6 rounded-xl border-2 border-klinik">
                    <p class="text-xs font-semibold text-klinik uppercase">Paling Populer</p>
                    <h3 class="text-xl font-semibold mt-1">Paket MCU Standard</h3>
                    <p class="text-3xl font-bold text-klinik mt-3">Rp 650.000</p>
                    <ul class="text-sm text-gray-600 mt-4 space-y-2">
                        <li>Semua benefit Basic Check</li>
                        <li>Hematologi lengkap</li>
                        <li>Urinalisis & kolesterol</li>
                        <li>Rontgen thorax</li>
                    </ul>
                </div>
                <div class="bg-white p-6 rounded-xl border border-gray-200">
                    <h3 class="text-xl font-semibold">Paket Executive</h3>
                    <p class="text-3xl font-bold text-klinik mt-3">Rp 1.250.000</p>
                    <ul class="text-sm text-gray-600 mt-4 space-y-2">
                        <li>Semua benefit MCU Standard</li>
                        <li>USG abdomen</li>
                        <li>EKG</li>
                        <li>Konsultasi hasil prioritas</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-14">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-dark mb-8">Layanan Corporate</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-xl font-semibold">Program Kesehatan Karyawan</h3>
                    <p class="text-gray-600 mt-2">Paket monitoring kesehatan berkala, edukasi, dan laporan ringkas untuk HR perusahaan.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-xl font-semibold">Vaksinasi On-site</h3>
                    <p class="text-gray-600 mt-2">Pelayanan vaksinasi massal langsung di kantor untuk efisiensi waktu dan operasional.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-xl font-semibold">Fit to Work & Return to Work</h3>
                    <p class="text-gray-600 mt-2">Pemeriksaan kelayakan kerja untuk kebutuhan rekrutmen, rotasi, dan kembali bekerja.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-xl font-semibold">Kemitraan Tahunan</h3>
                    <p class="text-gray-600 mt-2">Skema kerjasama tahunan dengan prioritas slot layanan dan tarif khusus korporasi.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-14 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-dark mb-8 text-center">FAQ Layanan</h2>
            <div class="space-y-4">
                <details class="bg-white rounded-lg p-4 border border-gray-100" open>
                    <summary class="font-semibold cursor-pointer">Apakah harus booking dulu?</summary>
                    <p class="text-gray-600 mt-2">Disarankan booking agar mendapat slot cepat, namun walk-in tetap dilayani sesuai antrean.</p>
                </details>
                <details class="bg-white rounded-lg p-4 border border-gray-100">
                    <summary class="font-semibold cursor-pointer">Apakah menerima asuransi perusahaan?</summary>
                    <p class="text-gray-600 mt-2">Ya, kami menerima beberapa provider asuransi. Silakan konfirmasi saat pendaftaran.</p>
                </details>
                <details class="bg-white rounded-lg p-4 border border-gray-100">
                    <summary class="font-semibold cursor-pointer">Perlu puasa sebelum tes laboratorium?</summary>
                    <p class="text-gray-600 mt-2">Untuk parameter tertentu diperlukan puasa 8-10 jam. Tim kami akan menginformasikan sebelum pemeriksaan.</p>
                </details>
            </div>

            <div class="mt-10 text-center">
                <a href="<?= base_url('booking') ?>" class="inline-block bg-klinik text-white px-8 py-3 rounded-full font-semibold hover:bg-sky-600 shadow-lg">Booking Sekarang</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2026 Klinik Sehat Waras. All rights reserved.</p>
            <p class="text-gray-400 mt-2">Jl. Kesehatan No. 123, Semarang</p>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
        var toggle = document.getElementById('nav-toggle');
        var menu = document.getElementById('mobile-menu');
        if(toggle && menu){
            toggle.addEventListener('click', function(){
                var expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', (!expanded).toString());
                menu.classList.toggle('hidden');
            });
        }
    });
    </script>

</body>
</html>




