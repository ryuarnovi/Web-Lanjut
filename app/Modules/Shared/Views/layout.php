<?php
$hlm = "Home";
if(uri_string()!=""){
  $hlm = ucwords(str_replace('/', ' › ', uri_string()));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>KlinikOS 2.0 — <?= $hlm ?></title>

  <!-- Favicon -->
  <link href="<?= base_url()?>NiceAdmin/assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- CDN: Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Tailwind CSS (Compiled — sudah berisi semua komponen admin) -->
  <link href="<?= base_url()?>assets/css/app.css" rel="stylesheet">

  <style>
    /* Pastikan sidebar & dropdown benar di semua layar */
    .admin-sidebar { left: -280px; }
    body.sidebar-open .admin-sidebar { left: 0; }
  </style>
</head>

<body class="font-[Nunito]">

  <?= $this->include('Modules\Shared\Views\components\header') ?>
  <?= $this->include('Modules\Shared\Views\components\sidebar') ?>

  <main class="admin-main">
    <?= $this->renderSection('content') ?>
  </main>

  <?= $this->include('Modules\Shared\Views\components\footer') ?>

  <!-- CDN: ApexCharts -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.0/dist/apexcharts.min.js"></script>

  <!-- CDN: ECharts -->
  <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

  <!-- CDN: Simple DataTables -->
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3/dist/umd/simple-datatables.js"></script>

  <!-- Main JS — sidebar, dropdown, tabs, collapse -->
  <script>
  (function () {
    'use strict';

    /* ── 1. SIDEBAR TOGGLE ── */
    const sidebarToggleBtn = document.querySelector('.toggle-sidebar-btn');
    const body = document.body;

    if (sidebarToggleBtn) {
      sidebarToggleBtn.addEventListener('click', () => {
        body.classList.toggle('sidebar-open');
      });
    }

    // Tutup sidebar saat klik backdrop
    document.addEventListener('click', (e) => {
      if (!body.classList.contains('sidebar-open')) return;
      const sidebar = document.querySelector('.admin-sidebar');
      const btn = document.querySelector('.toggle-sidebar-btn');
      if (sidebar && !sidebar.contains(e.target) && btn && !btn.contains(e.target)) {
        body.classList.remove('sidebar-open');
      }
    });

    /* ── 2. SIDEBAR COLLAPSE (sub-menu) ── */
    document.querySelectorAll('[data-toggle="collapse"]').forEach(btn => {
      btn.addEventListener('click', () => {
        const targetSel = btn.getAttribute('data-target');
        const target = document.querySelector(targetSel);
        if (!target) return;

        const isOpen = target.classList.contains('open');

        // Tutup semua sub-menu lain
        document.querySelectorAll('.nav-sub.open').forEach(sub => {
          sub.classList.remove('open');
          const parentBtn = document.querySelector(`[data-target="#${sub.id}"]`);
          if (parentBtn) parentBtn.classList.remove('expanded');
        });

        // Toggle yang diklik
        if (!isOpen) {
          target.classList.add('open');
          btn.classList.add('expanded');
        }
      });
    });

    /* ── 3. DROPDOWN (notif, pesan, profil) ── */
    document.querySelectorAll('[data-dropdown]').forEach(trigger => {
      trigger.addEventListener('click', (e) => {
        e.stopPropagation();
        const panel = document.querySelector(trigger.getAttribute('data-dropdown'));
        if (!panel) return;

        const isShown = panel.classList.contains('show');

        // Tutup semua dropdown
        document.querySelectorAll('.dropdown-panel.show').forEach(p => p.classList.remove('show'));

        if (!isShown) panel.classList.add('show');
      });
    });

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', () => {
      document.querySelectorAll('.dropdown-panel.show').forEach(p => p.classList.remove('show'));
    });

    /* ── 4. TABS ── */
    document.querySelectorAll('.tw-tab').forEach(tab => {
      tab.addEventListener('click', () => {
        const parent = tab.closest('[data-tabs]') || tab.parentElement;
        const target = tab.getAttribute('data-tab');

        // De-aktifkan semua tab & content di group yang sama
        parent.querySelectorAll('.tw-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tw-tab-content').forEach(c => {
          if (c.getAttribute('data-tab-content') === target || parent.contains(c)) {
            c.classList.remove('active');
          }
        });

        tab.classList.add('active');
        const content = document.querySelector(`[data-tab-content="${target}"]`);
        if (content) content.classList.add('active');
      });
    });

    /* ── 5. BACK TO TOP ── */
    const backToTop = document.querySelector('.back-to-top');
    if (backToTop) {
      const toggleBackTop = () => {
        backToTop.style.display = window.scrollY > 100 ? 'flex' : 'none';
      };
      window.addEventListener('scroll', toggleBackTop);
      toggleBackTop();
      backToTop.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    }

    /* ── 6. ACTIVE NAV LINK ── */
    const currentPath = window.location.pathname.replace(/\/+$/, '');
    document.querySelectorAll('.admin-sidebar .nav-sub a').forEach(link => {
      const linkPath = new URL(link.href).pathname.replace(/\/+$/, '');
      if (linkPath === currentPath) link.classList.add('active');
    });

  })();
  </script>

</body>
</html>