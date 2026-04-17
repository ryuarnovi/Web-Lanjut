  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?= (uri_string() == '' || uri_string() == 'dashboard') ? '' : 'collapsed' ?>" href="<?= base_url() ?>">
          <i class="bi bi-grid"></i>
          <span>Executive Dashboard</span>
        </a>
      </li>

      <?php $role = session()->get('role'); ?>

      <!-- Section: Resepsionis -->
      <?php if (in_array($role, ['admin', 'resepsionis'])): ?>
      <li class="nav-heading">Layanan Depan</li>
      <li class="nav-item">
        <a class="nav-link <?= str_contains(uri_string(), 'resepsionis') ? '' : 'collapsed' ?>" data-bs-target="#nav-mod-resepsionis" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Resepsionis</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="nav-mod-resepsionis" class="nav-content collapse <?= str_contains(uri_string(), 'resepsionis') ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('resepsionis/pendaftaran') ?>" class="<?= uri_string() == 'resepsionis/pendaftaran' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Pendaftaran Pasien</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('resepsionis/antrean') ?>" class="<?= uri_string() == 'resepsionis/antrean' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Plotting Antrean</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>

      <!-- Section: Dokter -->
      <?php if (in_array($role, ['admin', 'dokter'])): ?>
      <li class="nav-heading">Layanan Medis</li>
      <li class="nav-item">
        <a class="nav-link <?= str_contains(uri_string(), 'dokter') ? '' : 'collapsed' ?>" data-bs-target="#nav-mod-dokter" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard-pulse"></i><span>Dokter</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="nav-mod-dokter" class="nav-content collapse <?= str_contains(uri_string(), 'dokter') ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('dokter/antrean') ?>" class="<?= uri_string() == 'dokter/antrean' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Daftar Tunggu</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('dokter/soap') ?>" class="<?= uri_string() == 'dokter/soap' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Input Rekam Medis</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>

      <!-- Section: Apoteker -->
      <?php if (in_array($role, ['admin', 'apoteker'])): ?>
      <li class="nav-heading">Layanan Farmasi</li>
      <li class="nav-item">
        <a class="nav-link <?= str_contains(uri_string(), 'apoteker') ? '' : 'collapsed' ?>" data-bs-target="#nav-mod-apoteker" data-bs-toggle="collapse" href="#">
          <i class="bi bi-capsule"></i><span>Apoteker</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="nav-mod-apoteker" class="nav-content collapse <?= str_contains(uri_string(), 'apoteker') ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('apoteker/resep') ?>" class="<?= uri_string() == 'apoteker/resep' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Resep Masuk</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('apoteker/stok') ?>" class="<?= uri_string() == 'apoteker/stok' ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Stok Obat</span>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>

      <li class="nav-heading">Akun & Sistem</li>
      <li class="nav-item">
        <a class="nav-link <?= (uri_string() == 'profile') ? '' : 'collapsed' ?>" href="<?= base_url('profile') ?>">
          <i class="bi bi-person"></i>
          <span>Profil Saya</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= (uri_string() == 'pengaturan') ? '' : 'collapsed' ?>" href="<?= base_url('pengaturan') ?>">
          <i class="bi bi-gear"></i>
          <span>Konfigurasi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger collapsed" href="<?= base_url('logout') ?>">
          <i class="bi bi-box-arrow-right text-danger"></i>
          <span>Keluar</span>
        </a>
      </li>
    </ul>
  </aside><!-- End Sidebar-->
