  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?= (uri_string() == '' || uri_string() == 'dashboard') ? '' : 'collapsed' ?>" href="<?= base_url() ?>">
          <i class="bi bi-grid"></i>
          <span>Executive Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Resepsionis (Front-Office)</li>

      <li class="nav-item">
        <a class="nav-link <?= (str_contains(uri_string(), 'resepsionis')) ? '' : 'collapsed' ?>" data-bs-target="#resepsionis-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Pendaftaran & Antrean</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="resepsionis-nav" class="nav-content collapse <?= (str_contains(uri_string(), 'resepsionis')) ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('resepsionis/pendaftaran') ?>" class="<?= (uri_string() == 'resepsionis/pendaftaran') ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Pendaftaran Pasien</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('resepsionis/antrean') ?>" class="<?= (uri_string() == 'resepsionis/antrean') ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Plotting Antrean</span>
            </a>
          </li>
        </ul>
      </li><!-- End Resepsionis Nav -->

      <li class="nav-heading">Dokter (Medical)</li>

      <li class="nav-item">
        <a class="nav-link <?= (str_contains(uri_string(), 'dokter')) ? '' : 'collapsed' ?>" data-bs-target="#dokter-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard-pulse"></i><span>Pemeriksaan Medis</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="dokter-nav" class="nav-content collapse <?= (str_contains(uri_string(), 'dokter')) ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('dokter/antrean') ?>" class="<?= (uri_string() == 'dokter/antrean') ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Daftar Tunggu Pasien</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('dokter/soap') ?>" class="<?= (uri_string() == 'dokter/soap') ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Panel Rekam Medis (SOAP)</span>
            </a>
          </li>
        </ul>
      </li><!-- End Dokter Nav -->

      <li class="nav-heading">Apoteker (Pharmacy)</li>

      <li class="nav-item">
        <a class="nav-link <?= (str_contains(uri_string(), 'apoteker')) ? '' : 'collapsed' ?>" data-bs-target="#apoteker-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-capsule"></i><span>Farmasi & Inventory</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="apoteker-nav" class="nav-content collapse <?= (str_contains(uri_string(), 'apoteker')) ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('apoteker/resep') ?>" class="<?= (uri_string() == 'apoteker/resep') ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Penebusan Obat</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('apoteker/stok') ?>" class="<?= (uri_string() == 'apoteker/stok') ? 'active' : '' ?>">
              <i class="bi bi-circle"></i><span>Stok Obat & Logistik</span>
            </a>
          </li>
        </ul>
      </li><!-- End Apoteker Nav -->

      <li class="nav-heading">Kasir (Payment)</li>

      <li class="nav-item">
        <a class="nav-link <?= (str_contains(uri_string(), 'kasir')) ? '' : 'collapsed' ?>" href="<?= base_url('kasir/billing') ?>">
          <i class="bi bi-cash-coin"></i>
          <span>Billing & Pembayaran</span>
        </a>
      </li><!-- End Kasir Nav -->

      <li class="nav-heading">Executive</li>

      <li class="nav-item">
        <a class="nav-link <?= (uri_string() == 'laporan') ? '' : 'collapsed' ?>" href="<?= base_url('laporan') ?>">
          <i class="bi bi-graph-up"></i>
          <span>Laporan & BI Dashboard</span>
        </a>
      </li><!-- End Laporan Nav -->

      <li class="nav-heading">Sistem</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('profile') ?>">
          <i class="bi bi-person"></i>
          <span>Profile Saya</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('pengaturan') ?>">
          <i class="bi bi-gear"></i>
          <span>Pengaturan Sistem</span>
        </a>
      </li><!-- End Settings Nav -->

    </ul>

  </aside><!-- End Sidebar-->
