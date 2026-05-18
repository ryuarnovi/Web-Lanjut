<!-- ======= Footer Admin ======= -->
<footer class="admin-footer" style="background:#021b3b;color:rgba(255,255,255,0.5)">
    <div class="max-w-full px-8 py-10">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 pb-8 border-b border-white/10">

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

            <!-- Navigasi -->
            <div class="space-y-4">
                <h4 class="font-semibold text-[11px] text-white/40 uppercase tracking-widest">Navigasi</h4>
                <ul class="space-y-2.5">
                    <li>
                        <a href="<?= base_url('general') ?>"
                           class="text-white/60 hover:text-white transition-colors text-[13px] flex items-center gap-1.5">
                            <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                            Halaman Publik
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('dashboard') ?>"
                           class="text-white/60 hover:text-white transition-colors text-[13px] flex items-center gap-1.5">
                            <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('profile') ?>"
                           class="text-white/60 hover:text-white transition-colors text-[13px] flex items-center gap-1.5">
                            <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                            Profil Saya
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('logout') ?>"
                           class="text-red-400 hover:text-red-300 transition-colors text-[13px] flex items-center gap-1.5">
                            <svg class="w-3 h-3 opacity-70" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Informasi -->
            <div class="space-y-4">
                <h4 class="font-semibold text-[11px] text-white/40 uppercase tracking-widest">Informasi Klinik</h4>
                <ul class="space-y-3 text-[13px] text-white/60">
                    <li class="flex gap-2.5 items-start">
                        <svg class="w-4 h-4 text-[#4154f1] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Jl. Kesehatan No. 123, Semarang
                    </li>
                    <li class="flex gap-2.5 items-center">
                        <svg class="w-4 h-4 text-[#4154f1] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        (024) 123-4567
                    </li>
                    <li class="flex gap-2.5 items-center">
                        <svg class="w-4 h-4 text-[#4154f1] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        info@klinikos.id
                    </li>
                    <li class="flex gap-2.5 items-center">
                        <svg class="w-4 h-4 text-[#4154f1] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Senin – Sabtu: 08:00 – 20:00
                    </li>
                </ul>
            </div>

        </div>

        <!-- Bottom bar -->
        <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-[12px] text-white/30">
            <p>
                &copy; <?= date('Y') ?> KlinikOS 2.0. Hak cipta dilindungi.
                <span class="mx-2 opacity-50">·</span>
                Login sebagai:
                <span class="text-white/50 font-semibold">
                    <?= ucfirst(session()->get('role') ?? 'Staff') ?>
                    — <?= session()->get('username') ?? '' ?>
                </span>
            </p>
            <div class="flex gap-5">
                <a href="#" class="hover:text-white/60 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-white/60 transition-colors">Syarat &amp; Ketentuan</a>
            </div>
        </div>

    </div>
</footer>
<!-- End Footer -->