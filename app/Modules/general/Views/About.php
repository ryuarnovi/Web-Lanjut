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

    <!-- NAVBAR (sama seperti General.php) -->
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

    <!-- About Content -->
    <main class="max-w-7xl mx-auto px-4 py-16">
        <h1 class="text-4xl font-bold text-dark mb-6">Tentang Klinik Sehat Waras</h1>
        <p class="text-gray-600 mb-6">Klinik Sehat Waras didirikan pada 2018 dengan tujuan memberikan layanan kesehatan korporat dan masyarakat dengan standar keamanan dan profesionalisme tinggi.</p>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Visi</h3>
                <p class="text-gray-600">Menjadi mitra kesehatan terpercaya yang menjaga produktivitas dan kesejahteraan tenaga kerja.</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Misi</h3>
                <ul class="text-gray-600 list-disc list-inside">
                    <li>Menyediakan layanan medis berkualitas.</li>
                    <li>Mengedukasi masyarakat tentang pencegahan penyakit.</li>
                    <li>Menjaga standar keselamatan dan etika pelayanan.</li>
                </ul>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-2">Sertifikasi</h3>
                <p class="text-gray-600">Terakreditasi sesuai peraturan kesehatan setempat. (tambahkan detail sertifikat jika ada)</p>
            </div>
        </div>

        <section class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Tim Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="w-24 h-24 rounded-full bg-gray-200 mb-4 flex items-center justify-center">Dr</div>
                    <h4 class="font-semibold">Dr. Anita</h4>
                    <p class="text-sm text-gray-500">Dokter Umum</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="w-24 h-24 rounded-full bg-gray-200 mb-4 flex items-center justify-center">Ms</div>
                    <h4 class="font-semibold">Suster Rina</h4>
                    <p class="text-sm text-gray-500">Perawat</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="w-24 h-24 rounded-full bg-gray-200 mb-4 flex items-center justify-center">Ph</div>
                    <h4 class="font-semibold">Apoteker Budi</h4>
                    <p class="text-sm text-gray-500">Apoteker</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white py-12">
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
