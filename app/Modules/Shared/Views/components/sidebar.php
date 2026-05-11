  <!-- ======= Sidebar ======= -->
  <aside class="admin-sidebar">
    <ul>

      <li class="nav-item">
        <a class="nav-link <?= (uri_string() == '' || uri_string() == 'dashboard') ? 'active' : '' ?>" href="<?= base_url() ?>">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
          <span>Executive Dashboard</span>
        </a>
      </li>

      <?php $role = session()->get('role'); ?>

      <!-- Section: Resepsionis -->
      <?php if (in_array($role, ['admin', 'resepsionis'])): ?>
      <li class="nav-heading">Layanan Depan</li>
      <li class="nav-item">
        <button class="nav-link <?= str_contains(uri_string(), 'resepsionis') ? 'expanded' : '' ?>" data-toggle="collapse" data-target="#nav-mod-resepsionis">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
          <span>Resepsionis</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="chevron h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
        </button>
        <div id="nav-mod-resepsionis" class="nav-sub <?= str_contains(uri_string(), 'resepsionis') ? 'open' : '' ?>">
          <a href="<?= base_url('resepsionis/pendaftaran') ?>" class="<?= uri_string() == 'resepsionis/pendaftaran' ? 'active' : '' ?>">Pendaftaran Pasien</a>
          <a href="<?= base_url('resepsionis/antrean') ?>" class="<?= uri_string() == 'resepsionis/antrean' ? 'active' : '' ?>">Plotting Antrean</a>
        </div>
      </li>
      <?php endif; ?>

      <!-- Section: Dokter -->
      <?php if (in_array($role, ['admin', 'dokter'])): ?>
      <li class="nav-heading">Layanan Medis</li>
      <li class="nav-item">
        <button class="nav-link <?= str_contains(uri_string(), 'dokter') ? 'expanded' : '' ?>" data-toggle="collapse" data-target="#nav-mod-dokter">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
          <span>Dokter</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="chevron h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
        </button>
        <div id="nav-mod-dokter" class="nav-sub <?= str_contains(uri_string(), 'dokter') ? 'open' : '' ?>">
          <a href="<?= base_url('dokter/antrean') ?>" class="<?= uri_string() == 'dokter/antrean' ? 'active' : '' ?>">Daftar Tunggu</a>
          <a href="<?= base_url('dokter/soap') ?>" class="<?= uri_string() == 'dokter/soap' ? 'active' : '' ?>">Input Rekam Medis</a>
        </div>
      </li>
      <?php endif; ?>

      <!-- Section: Apoteker -->
      <?php if (in_array($role, ['admin', 'apoteker'])): ?>
      <li class="nav-heading">Layanan Farmasi</li>
      <li class="nav-item">
        <button class="nav-link <?= str_contains(uri_string(), 'apoteker') ? 'expanded' : '' ?>" data-toggle="collapse" data-target="#nav-mod-apoteker">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
          <span>Apoteker</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="chevron h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
        </button>
        <div id="nav-mod-apoteker" class="nav-sub <?= str_contains(uri_string(), 'apoteker') ? 'open' : '' ?>">
          <a href="<?= base_url('apoteker/resep') ?>" class="<?= uri_string() == 'apoteker/resep' ? 'active' : '' ?>">Resep Masuk</a>
          <a href="<?= base_url('apoteker/stok') ?>" class="<?= uri_string() == 'apoteker/stok' ? 'active' : '' ?>">Stok Obat</a>
        </div>
      </li>
      <?php endif; ?>

      <!-- Section: Kasir (Billing) -->
      <?php if (in_array($role, ['admin', 'kasir'])): ?>
      <li class="nav-heading">Keuangan & Tagihan</li>
      <li class="nav-item">
        <button class="nav-link <?= str_contains(uri_string(), 'kasir') ? 'expanded' : '' ?>" data-toggle="collapse" data-target="#nav-mod-kasir">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
          <span>Kasir</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="chevron h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
        </button>
        <div id="nav-mod-kasir" class="nav-sub <?= str_contains(uri_string(), 'kasir') ? 'open' : '' ?>">
          <a href="<?= base_url('kasir/data') ?>" class="<?= uri_string() == 'kasir/data' ? 'active' : '' ?>">Daftar Tagihan</a>
          <a href="<?= base_url('kasir/billing') ?>" class="<?= uri_string() == 'kasir/billing' ? 'active' : '' ?>">Proses Pembayaran</a>
        </div>
      </li>
      <?php endif; ?>

      <li class="nav-heading">Akun & Sistem</li>
      <li class="nav-item">
        <a class="nav-link <?= (uri_string() == 'profile') ? 'active' : '' ?>" href="<?= base_url('profile') ?>">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
          <span>Profil Saya</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (uri_string() == 'pengaturan') ? 'active' : '' ?>" href="<?= base_url('pengaturan') ?>">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
          <span>Konfigurasi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger" href="<?= base_url('logout') ?>">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon h-[18px] w-[18px] text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
          <span>Keluar</span>
        </a>
      </li>
    </ul>
  </aside><!-- End Sidebar-->
