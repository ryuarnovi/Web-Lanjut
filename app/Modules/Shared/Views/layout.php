<?php
$hlm = "Home";
if(uri_string()!=""){
  $hlm = ucwords(uri_string());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>KlinikOS 2.0 - <?= $hlm ?></title>
  <meta content="Sistem Informasi Klinik" name="description">

  <!-- Favicons -->
  <link href="<?= base_url()?>NiceAdmin/assets/img/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS (Compiled) -->
  <link href="<?= base_url()?>assets/css/app.css" rel="stylesheet">

</head>

<body class="font-[Nunito]">

  <?= $this->include('Modules\Shared\Views\components\header') ?>

  <?= $this->include('Modules\Shared\Views\components\sidebar') ?>

  <main class="admin-main">

    <?= $this->renderSection('content') ?>

  </main><!-- End #main -->

  <?= $this->include('Modules\Shared\Views\components\footer') ?>

  <!-- ApexCharts (for dashboard charts) -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <!-- ECharts (for pie charts) -->
  <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

  <!-- Admin Layout JS -->
  <script>
  (function() {
    'use strict';

    // Sidebar toggle
    const toggleBtns = document.querySelectorAll('.toggle-sidebar-btn');
    toggleBtns.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.stopPropagation();
        document.body.classList.toggle('sidebar-open');
        
        // Trigger resize for charts
        setTimeout(() => {
          window.dispatchEvent(new Event('resize'));
        }, 300);
      });
    });

    // Close sidebar when clicking outside (on overlay/backdrop)
    document.addEventListener('click', function(e) {
      if (document.body.classList.contains('sidebar-open')) {
        const sidebar = document.querySelector('.admin-sidebar');
        const header = document.querySelector('.admin-header');
        if (sidebar && !sidebar.contains(e.target) && header && !header.contains(e.target)) {
          document.body.classList.remove('sidebar-open');
        }
      }
    });

    // Sidebar collapsible sections
    document.querySelectorAll('.admin-sidebar .nav-link[data-toggle="collapse"]').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('data-target'));
        if (target) {
          target.classList.toggle('open');
          this.classList.toggle('expanded');
        }
      });
    });

    // Dropdown toggles
    document.querySelectorAll('[data-dropdown]').forEach(trigger => {
      trigger.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const panel = document.querySelector(this.getAttribute('data-dropdown'));
        // Close all other dropdowns
        document.querySelectorAll('.dropdown-panel.show').forEach(p => {
          if (p !== panel) p.classList.remove('show');
        });
        if (panel) panel.classList.toggle('show');
      });
    });

    // Close dropdowns on outside click
    document.addEventListener('click', function() {
      document.querySelectorAll('.dropdown-panel.show').forEach(p => p.classList.remove('show'));
    });

    // Tabs
      document.querySelectorAll('.tw-tab').forEach(tab => {
      tab.addEventListener('click', function() {
        const group = this.closest('.tw-tabs');
        
        // Remove active from all tabs in group
        group.querySelectorAll('.tw-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        // Show corresponding content
        const target = this.getAttribute('data-tab');
        const targetEl = document.querySelector(target);
        if (targetEl) {
          const contentContainer = targetEl.parentElement;
          contentContainer.querySelectorAll('.tw-tab-content').forEach(c => c.classList.remove('active'));
          targetEl.classList.add('active');
        }
      });
    });

    // Back to top
    const backToTop = document.querySelector('.back-to-top');
    if (backToTop) {
      window.addEventListener('scroll', function() {
        if (window.scrollY > 100) backToTop.classList.add('active');
        else backToTop.classList.remove('active');
      });
    }
  })();
  </script>

</body>

</html>
