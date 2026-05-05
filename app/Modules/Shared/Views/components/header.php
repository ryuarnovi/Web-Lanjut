  <!-- ======= Header ======= -->
  <header class="admin-header">

    <div class="flex items-center gap-4">
      <a href="<?= base_url() ?>" class="logo">
        <img src="<?= base_url()?>NiceAdmin/assets/img/logo.png" alt="">
        <span class="hidden lg:inline">KlinikOS 2.0</span>
      </a>
      <button class="toggle-sidebar-btn p-2 rounded-lg hover:bg-slate-100 transition cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-klinik-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div><!-- End Logo -->

    <div class="search-bar hidden md:block">
      <input type="text" placeholder="Cari menu, pasien, fitur..." class="text-sm">
    </div><!-- End Search Bar -->

    <nav class="header-nav flex items-center gap-2">
      <!-- Notification -->
      <div class="relative">
        <button data-dropdown="#dropdown-notif" class="p-2 rounded-lg hover:bg-slate-100 transition relative cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
          <span class="absolute -top-0.5 -right-0.5 w-5 h-5 bg-klinik-primary text-white text-[10px] font-bold rounded-full flex items-center justify-center">4</span>
        </button>
        <div id="dropdown-notif" class="dropdown-panel">
          <div class="dropdown-header">
            <span>You have 4 new notifications</span>
            <a href="#" class="text-xs text-klinik-primary font-semibold">View all</a>
          </div>
          <div class="dropdown-divider"></div>
          <div class="dropdown-item">
            <span class="text-yellow-500">⚠</span>
            <div>
              <p class="font-semibold text-sm">Lorem Ipsum</p>
              <p class="text-xs text-slate-400">30 min. ago</p>
            </div>
          </div>
          <div class="dropdown-divider"></div>
          <div class="dropdown-item">
            <span class="text-green-500">✓</span>
            <div>
              <p class="font-semibold text-sm">Sit rerum fuga</p>
              <p class="text-xs text-slate-400">2 hrs. ago</p>
            </div>
          </div>
          <div class="dropdown-divider"></div>
          <a href="#" class="block text-center text-sm text-klinik-primary font-semibold py-2">Show all notifications</a>
        </div>
      </div>

      <!-- Messages -->
      <div class="relative">
        <button data-dropdown="#dropdown-msgs" class="p-2 rounded-lg hover:bg-slate-100 transition relative cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
          </svg>
          <span class="absolute -top-0.5 -right-0.5 w-5 h-5 bg-green-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">3</span>
        </button>
        <div id="dropdown-msgs" class="dropdown-panel">
          <div class="dropdown-header">
            <span>You have 3 new messages</span>
            <a href="#" class="text-xs text-klinik-primary font-semibold">View all</a>
          </div>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <img src="<?= base_url()?>NiceAdmin/assets/img/messages-1.jpg" alt="" class="w-9 h-9 rounded-full object-cover">
            <div>
              <p class="font-semibold text-sm">Maria Hudson</p>
              <p class="text-xs text-slate-400 line-clamp-1">Velit asperiores et ducimus...</p>
              <p class="text-xs text-slate-400">4 hrs. ago</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <img src="<?= base_url()?>NiceAdmin/assets/img/messages-2.jpg" alt="" class="w-9 h-9 rounded-full object-cover">
            <div>
              <p class="font-semibold text-sm">Anna Nelson</p>
              <p class="text-xs text-slate-400 line-clamp-1">Velit asperiores et ducimus...</p>
              <p class="text-xs text-slate-400">6 hrs. ago</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="block text-center text-sm text-klinik-primary font-semibold py-2">Show all messages</a>
        </div>
      </div>

      <!-- Profile -->
      <div class="relative ml-2">
        <button data-dropdown="#dropdown-profile" class="flex items-center gap-2 p-1 rounded-lg hover:bg-slate-100 transition cursor-pointer">
          <img src="<?= base_url()?>NiceAdmin/assets/img/profile-img.jpg" alt="Profile" class="nav-profile w-9 h-9 rounded-full object-cover">
          <span class="hidden md:inline text-sm font-semibold text-klinik-dark"><?= session()->get('username') ?? 'Admin' ?></span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 hidden md:inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
        </button>
        <div id="dropdown-profile" class="dropdown-panel">
          <div class="px-4 py-3">
            <p class="font-bold text-sm text-klinik-dark"><?= session()->get('name') ?? 'User KlinikOS' ?></p>
            <p class="text-xs text-slate-400"><?= ucfirst(session()->get('role') ?? 'Staff') ?></p>
          </div>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('profile') ?>" class="dropdown-item">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            <span>My Profile</span>
          </a>
          <a href="<?= base_url('pengaturan') ?>" class="dropdown-item">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            <span>Account Settings</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('logout') ?>" class="dropdown-item text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
            <span>Sign Out</span>
          </a>
        </div>
      </div>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
