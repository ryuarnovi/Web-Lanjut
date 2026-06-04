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

  <!-- CSRF Meta Tags -->
  <meta name="csrf-token-name" content="<?= csrf_token() ?>">
  <meta name="csrf-token-value" content="<?= csrf_hash() ?>">

  <style>
    .admin-sidebar { left: -280px; }
    body.sidebar-open .admin-sidebar { left: 0; }
    .admin-main { padding-bottom: 80px; }
    .admin-footer { position: relative; z-index: 1; clear: both; }

    /* Toast Notifications */
    .toast-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
      display: flex;
      flex-direction: column;
      gap: 10px;
      pointer-events: none;
    }
    .toast-box {
      min-width: 280px;
      max-width: 400px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      padding: 16px;
      display: flex;
      align-items: center;
      gap: 12px;
      border-left: 4px solid #4154f1;
      transform: translateX(120%);
      transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55), opacity 0.3s;
      opacity: 0;
      pointer-events: auto;
    }
    .toast-box.show {
      transform: translateX(0);
      opacity: 1;
    }
    .toast-box.success { border-left-color: #10b981; }
    .toast-box.error { border-left-color: #ef4444; }
    .toast-box.warning { border-left-color: #f59e0b; }
    .toast-box.info { border-left-color: #3b82f6; }

    /* Dark Mode overrides */
    body.dark {
      background-color: #0f172a;
      color: #cbd5e1;
    }
    body.dark .card,
    body.dark .admin-header,
    body.dark .admin-sidebar,
    body.dark .dropdown-panel,
    body.dark .modal-content,
    body.dark .dropdown-panel div,
    body.dark .dropdown-panel a {
      background-color: #1e293b !important;
      border-color: #334155 !important;
      color: #cbd5e1 !important;
    }
    body.dark select,
    body.dark input,
    body.dark textarea {
      background-color: #0f172a !important;
      border-color: #334155 !important;
      color: #f1f5f9 !important;
    }
    body.dark label,
    body.dark h1,
    body.dark h2,
    body.dark h3,
    body.dark h4,
    body.dark h5,
    body.dark h6 {
      color: #f1f5f9 !important;
    }
    body.dark .text-slate-600,
    body.dark .text-slate-500,
    body.dark .text-slate-800 {
      color: #94a3b8 !important;
    }
    body.dark .bg-slate-50,
    body.dark .bg-slate-100 {
      background-color: #0f172a !important;
    }
    body.dark .border-slate-100,
    body.dark .border-slate-200 {
      border-color: #334155 !important;
    }
    body.dark .dropdown-item:hover,
    body.dark .dropdown-item span:hover {
      background-color: #334155 !important;
      color: white !important;
    }
    body.dark .tw-table thead {
      background-color: #0f172a !important;
    }
    body.dark .tw-table th,
    body.dark .tw-table td {
      border-color: #334155 !important;
      color: #cbd5e1 !important;
    }
    body.dark .card-icon {
      background-color: #334155 !important;
    }
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

    /* ── 0. GLOBAL UTILITIES (CSRF, Toast, DarkMode, Confirm, Pagination) ── */

    // Auto-inject CSRF token to all state-changing AJAX requests
    const originalFetch = window.fetch;
    window.fetch = function(url, options = {}) {
        options.headers = options.headers || {};
        const method = (options.method || 'GET').toUpperCase();
        if (['POST', 'PUT', 'DELETE', 'PATCH'].includes(method)) {
            const tokenNameMeta = document.querySelector('meta[name="csrf-token-name"]');
            const tokenValueMeta = document.querySelector('meta[name="csrf-token-value"]');
            if (tokenNameMeta && tokenValueMeta) {
                const tokenName = tokenNameMeta.getAttribute('content');
                const tokenValue = tokenValueMeta.getAttribute('content');
                
                options.headers['X-CSRF-TOKEN'] = tokenValue;
                options.headers['X-Requested-With'] = 'XMLHttpRequest';
                
                if (options.body && options.body instanceof FormData) {
                    options.body.append(tokenName, tokenValue);
                } else if (options.body && typeof options.body === 'string') {
                    try {
                        const parsed = JSON.parse(options.body);
                        if (!parsed[tokenName]) {
                            parsed[tokenName] = tokenValue;
                            options.body = JSON.stringify(parsed);
                        }
                    } catch(e) {}
                }
            }
        }
        return originalFetch(url, options);
    };

    // Toast Notification System
    window.showToast = function(message, type = 'success') {
        let container = document.querySelector('.toast-container');
        if (!container) {
            container = document.createElement('div');
            container.className = 'toast-container';
            document.body.appendChild(container);
        }
        const toast = document.createElement('div');
        toast.className = `toast-box ${type}`;
        
        const icons = {
            success: `<svg class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`,
            error: `<svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`,
            warning: `<svg class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>`,
            info: `<svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`
        };
        
        toast.innerHTML = `
            <div class="flex-shrink-0">${icons[type] || icons.success}</div>
            <div class="flex-1 text-sm font-semibold text-slate-800">${message}</div>
            <button class="text-slate-400 hover:text-slate-600 transition" onclick="this.parentElement.remove()">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        `;
        container.appendChild(toast);
        setTimeout(() => toast.classList.add('show'), 10);
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    };

    // Override native alert with custom toast
    window.alert = function(msg, type = 'info') {
        window.showToast(msg, type);
    };

    // Dark Mode Toggle Initialization
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (darkModeToggle) {
        const toggleIcon = darkModeToggle.querySelector('i');
        const enableDarkMode = () => {
            document.body.classList.add('dark');
            if (toggleIcon) {
                toggleIcon.classList.remove('bi-moon', 'text-slate-600');
                toggleIcon.classList.add('bi-sun', 'text-amber-400');
            }
            localStorage.setItem('dark-mode', 'enabled');
        };
        const disableDarkMode = () => {
            document.body.classList.remove('dark');
            if (toggleIcon) {
                toggleIcon.classList.remove('bi-sun', 'text-amber-400');
                toggleIcon.classList.add('bi-moon', 'text-slate-600');
            }
            localStorage.setItem('dark-mode', 'disabled');
        };
        
        if (localStorage.getItem('dark-mode') === 'enabled') {
            enableDarkMode();
        }
        
        darkModeToggle.addEventListener('click', () => {
            if (document.body.classList.contains('dark')) {
                disableDarkMode();
            } else {
                enableDarkMode();
            }
        });
    }

    // Custom confirm dialog replacement helper
    window.confirmDialog = function(message, onConfirm) {
        const overlay = document.createElement('div');
        overlay.className = 'fixed inset-0 z-[99999] bg-black/40 flex items-center justify-center';
        overlay.innerHTML = `
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4 p-6 modal-content">
                <h5 class="text-lg font-bold text-slate-800 mb-2">Konfirmasi</h5>
                <p class="text-sm text-slate-500 mb-6">${message}</p>
                <div class="flex justify-end gap-3">
                    <button class="btn btn-outline-secondary py-1.5 px-4" id="confirmCancelBtn">Batal</button>
                    <button class="btn btn-danger py-1.5 px-4" id="confirmOkBtn">Ya</button>
                </div>
            </div>
        `;
        document.body.appendChild(overlay);
        document.getElementById('confirmCancelBtn').addEventListener('click', () => overlay.remove());
        document.getElementById('confirmOkBtn').addEventListener('click', () => {
            overlay.remove();
            onConfirm();
        });
    };

    // Client-side pagination utility
    window.paginateTable = function(tableSelector, data, itemsPerPage, renderRowFn) {
        const table = document.querySelector(tableSelector);
        if (!table) return;
        const tbody = table.querySelector('tbody');
        if (!tbody) return;

        let currentPage = 1;
        const totalPages = Math.ceil(data.length / itemsPerPage);

        function displayPage(page) {
            currentPage = page;
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageData = data.slice(start, end);

            tbody.innerHTML = pageData.length 
                ? pageData.map(renderRowFn).join('') 
                : `<tr><td colspan="20" class="text-center py-4 text-slate-400">Tidak ada data</td></tr>`;

            renderPaginationControls();
        }

        function renderPaginationControls() {
            let controlsContainer = table.nextElementSibling;
            if (!controlsContainer || !controlsContainer.classList.contains('table-pagination')) {
                controlsContainer = document.createElement('div');
                controlsContainer.className = 'table-pagination flex justify-between items-center mt-4 text-sm';
                table.after(controlsContainer);
            }

            if (data.length <= itemsPerPage) {
                controlsContainer.innerHTML = '';
                return;
            }

            controlsContainer.innerHTML = `
                <div class="text-slate-500">Menampilkan ${Math.min(data.length, (currentPage - 1) * itemsPerPage + 1)} - ${Math.min(data.length, currentPage * itemsPerPage)} dari ${data.length} data</div>
                <div class="flex gap-1">
                    <button class="btn btn-sm btn-outline-secondary py-1 px-3" ${currentPage === 1 ? 'disabled' : ''} id="prevPageBtn">Prev</button>
                    <span class="py-1 px-3 font-semibold text-slate-700">${currentPage} / ${totalPages}</span>
                    <button class="btn btn-sm btn-outline-secondary py-1 px-3" ${currentPage === totalPages ? 'disabled' : ''} id="nextPageBtn">Next</button>
                </div>
            `;

            const prevBtn = controlsContainer.querySelector('#prevPageBtn');
            const nextBtn = controlsContainer.querySelector('#nextPageBtn');
            if (prevBtn) prevBtn.addEventListener('click', () => displayPage(currentPage - 1));
            if (nextBtn) nextBtn.addEventListener('click', () => displayPage(currentPage + 1));
        }

        displayPage(1);
    };

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
        
        // Find and deactivate all tab contents under the same parent section
        const container = parent.parentElement;
        if (container) {
          container.querySelectorAll('.tw-tab-content').forEach(c => {
            c.classList.remove('active');
          });
        }

        tab.classList.add('active');
        
        // Support both ID hash selector (e.g. #tab-soap) and data-tab-content (e.g. stok-obat)
        let content = null;
        if (target.startsWith('#')) {
          content = document.getElementById(target.substring(1));
        } else {
          content = document.querySelector(`[data-tab-content="${target}"]`);
        }
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