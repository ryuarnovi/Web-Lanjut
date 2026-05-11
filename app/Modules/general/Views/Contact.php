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

    <main class="max-w-7xl mx-auto px-4 py-16">
        <h1 class="text-4xl font-bold text-dark mb-6">Kontak Kami</h1>
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <p class="text-gray-600 mb-4">Silakan hubungi kami untuk informasi lebih lanjut atau untuk membuat janji.</p>
                <ul class="text-gray-700 space-y-2">
                    <li><strong>Alamat:</strong> Jl. Kesehatan No.123, Semarang</li>
                    <li><strong>Telepon:</strong> (024) 123-4567</li>
                    <li><strong>Email:</strong> info@klinikkehats.com</li>
                    <li><strong>Jam Operasional:</strong> Senin-Jumat 08:00 - 17:00</li>
                </ul>

                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-2">Form Kontak</h3>
                    <form action="<?= base_url('contact/send') ?>" method="post" class="space-y-4">
                        <input name="name" class="w-full border rounded px-3 py-2" placeholder="Nama" required>
                        <input name="email" type="email" class="w-full border rounded px-3 py-2" placeholder="Email" required>
                        <textarea name="message" rows="5" class="w-full border rounded px-3 py-2" placeholder="Pesan" required></textarea>
                        <button type="submit" class="bg-klinik text-white px-4 py-2 rounded">Kirim Pesan</button>
                    </form>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-semibold mb-4">Lokasi</h3>
                <div class="w-full h-64 bg-gray-200 rounded overflow-hidden">
                    <!-- Placeholder map; replace src with real embed when available -->
                    <iframe class="w-full h-full" src="https://maps.google.com/maps?q=Semarang&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
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
