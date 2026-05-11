<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Sehat Waras - Company Profile</title>
    <meta name="description" content="Klinik Sehat Waras - layanan medis berkualitas untuk karyawan dan masyarakat. Buat janji, lihat layanan, dan hubungi kami.">
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
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="<?= base_url('general') ?>" class="block py-2 text-gray-700 hover:text-klinik">Home</a>
                <a href="<?= base_url('about') ?>" class="block py-2 text-gray-700 hover:text-klinik">Tentang</a>
                <a href="<?= base_url('service') ?>" class="block py-2 text-gray-700 hover:text-klinik">Layanan</a>
                <a href="<?= base_url('contact') ?>" class="block py-2 text-gray-700 hover:text-klinik">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="bg-sky-50 py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-extrabold text-dark leading-tight">
                Kesehatan Anda Adalah <br> <span class="text-klinik">Prioritas Utama</span>
            </h1>
            <p class="text-gray-600 mt-6 max-w-2xl mx-auto text-lg">
                Klinik Sehat Waras menyediakan layanan medis berkualitas tinggi dengan tenaga profesional dan fasilitas modern untuk kenyamanan Anda.
            </p>
            <div class="mt-10">
                <a href="#booking" class="bg-klinik text-white px-8 py-3 rounded-full font-semibold text-lg hover:bg-sky-600 shadow-lg">Buat Janji Temu</a>
            </div>
        </div>
    </section>

    <!-- LAYANAN SECTION -->
    <section id="services" class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-dark mb-16">Layanan Unggulan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition">
                    <div class="text-4xl mb-4">🩺</div>
                    <h3 class="text-xl font-bold text-dark">Poli Umum</h3>
                    <p class="text-gray-600 mt-2">Pemeriksaan kesehatan umum oleh dokter berpengalaman.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition">
                    <div class="text-4xl mb-4">🦷</div>
                    <h3 class="text-xl font-bold text-dark">Kesehatan Gigi</h3>
                    <p class="text-gray-600 mt-2">Perawatan gigi lengkap untuk senyum lebih cerah.</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition">
                    <div class="text-4xl mb-4">🧪</div>
                    <h3 class="text-xl font-bold text-dark">Laboratorium</h3>
                    <p class="text-gray-600 mt-2">Pengecekan darah dan sampel medis cepat & akurat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2026 Klinik Sehat Waras. All rights reserved.</p>
            <p class="text-gray-400 mt-2">Jl. Kesehatan No. 123, Semarang</p>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var toggle = document.getElementById('nav-toggle');
        var menu = document.getElementById('mobile-menu');
        if       (toggle && menu) {
            toggle.addEventListener('click', function() {
                var expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', (!expanded).toString());
                menu.classList.toggle('hidden');
            });
        }
    });
    </script>

</body>
</html>