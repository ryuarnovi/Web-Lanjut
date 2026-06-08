# KlinikOS 2.0 — Modular CI4 Scaffold

Struktur modular HMVC siap copy ke project CodeIgniter 4 Anda.

## Cara Install

1. **Copy folder `app/`** ke root project CI4 Anda (timpa file yang ada).
2. **Pastikan namespace `App\Modules` terdaftar** di `app/Config/Autoload.php`:

   ```php
   public $psr4 = [
       APP_NAMESPACE   => APPPATH,
       'App\Modules'   => APPPATH . 'Modules',
   ];
   ```

3. Pastikan tabel berikut sudah ada (sesuai schema Anda):
   `users`, `patients`, `queues`, `medical_records`, `prescriptions`, `payments`, `drugs`, `activity_logs`, `settings`.

4. Buat user admin awal (password `root210605`):
   ```sql
   INSERT INTO users (username, password_hash, full_name, role, is_active)
   VALUES ('admin',
     '$2y$10$abcdefghijklmnopqrstuv', -- ganti dgn password_hash('root210605', PASSWORD_BCRYPT)
     'Administrator', 'admin', 1);
   ```

5. Akses: `/login` → login → otomatis redirect ke dashboard sesuai role.

## Struktur

```
app/
├── Config/
│   ├── Routes.php           # Semua routing (web + api)
│   └── Filters.php          # Aliased filter 'auth'
├── Filters/
│   └── AuthFilter.php       # Session check + RBAC
└── Modules/
    ├── Auth/                # Login, User CRUD API
    ├── Dashboard/           # ✅ FULL: stats, users, settings, reports, logs, profile
    ├── Resepsionis/         # Stub: pendaftaran, antrean
    ├── Dokter/              # Stub: antrean, SOAP
    ├── Perawat/             # Stub: antrean, triase
    ├── Apoteker/            # Stub: stok, form, resep, supplier
    ├── Kasir/               # Stub: billing, riwayat
    ├── general/             # Landing publik
    └── Shared/Views/
        ├── layout.php       # Layout utama + dark mode + helpers JS
        └── components/      # sidebar, header, footer
```

## Yang Sudah Jadi (Modul Dashboard Admin)

- ✅ Login + RBAC filter (`auth:admin,dokter,...`)
- ✅ Sidebar adaptif per role (otomatis ganti menu sesuai login)
- ✅ Dark mode (persisten via localStorage)
- ✅ Dashboard executive: 6 stat card + 2 chart (ApexCharts) + quick links
- ✅ Manajemen User (tabel, modal create/edit, delete, search, filter role)
- ✅ Pengaturan klinik (key-value)
- ✅ Laporan + ekspor CSV (stub endpoint)
- ✅ Log Aktivitas (200 entry terakhir)
- ✅ Profil saya
- ✅ Helper JS global: `apiFetch`, `showToast`, `confirmDialog`
- ✅ CSRF auto-inject di semua API call

## Yang Perlu Anda Lengkapi

Untuk setiap modul role (Resepsionis, Dokter, Perawat, Apoteker, Kasir),
file `Views/*.php` masih placeholder. Tempel logic existing Anda atau
bangun mengikuti pola yang sama (Dashboard `users.php` adalah contoh full).

API endpoint yang harus Anda implementasikan (sebagian sudah ada di prompt asli):
- `/api/patients`, `/api/queues`, `/api/medical-records`, `/api/prescriptions`,
  `/api/drugs`, `/api/payments`, `/api/suppliers`, dll.

## Konvensi

- **Controller** render via `$this->render('namaView', $data)` → otomatis dibungkus layout.
- **Frontend**: pakai `apiFetch(url, opts)` (sudah auto CSRF).
- **Notifikasi**: `showToast(msg, 'success'|'error'|'info'|'warning')`.
- **Konfirmasi**: `confirmDialog({ title, message, onConfirm })`.
