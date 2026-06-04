# Feature: General (Landing Page & Profil Klinik Publik)

## Deskripsi Logic
Modul General menyediakan halaman-halaman publik (tanpa login) yang berfungsi sebagai Company Profile / Landing Page klinik. Halaman ini menampilkan informasi umum tentang klinik, layanan yang tersedia, profil tim medis, serta informasi kontak dan lokasi.

## Halaman

### 1. Home (`/`)
Halaman utama landing page klinik. Menampilkan overview umum, hero section, dan navigasi ke halaman publik lainnya.

### 2. Layanan (`/service`)
Halaman informasi layanan medis yang disediakan klinik. Menampilkan daftar spesialisasi dan fasilitas yang tersedia.

### 3. Tentang (`/about`)
Halaman profil klinik berisi visi, misi, sejarah, dan informasi tim medis klinik.

### 4. Kontak (`/contact`)
Halaman informasi kontak klinik: alamat, nomor telepon, email, dan peta lokasi.

## Status Implementasi

### ✅ Sudah Jadi
- **Landing Page** — Halaman utama `/` dengan layout company profile.
- **Halaman Layanan** — `/service` menampilkan informasi layanan klinik.
- **Halaman Tentang** — `/about` berisi profil dan informasi klinik.
- **Halaman Kontak** — `/contact` dengan informasi kontak lengkap.
- **Controller Routing** — Controller `General` menangani routing ke semua halaman publik.
- **View Templates** — 4 template view: `General.php`, `Service.php`, `About.php`, `Contact.php`.

### ❌ Belum / Kurang
- **Integrasi Settings API** — Konten halaman belum dinamis dari `/api/settings` (masih hardcoded di view).
- **SEO Meta Tags** — Belum ada meta description, Open Graph, dan structured data per halaman.
- **Form Kontak** — Belum ada form kontak yang bisa mengirim pesan/email ke admin klinik.
- **Pendaftaran Online** — Belum ada fitur pendaftaran pasien baru dari landing page.

## Skenario Testing
- [x] **Akses Tanpa Login** — Semua halaman publik bisa diakses tanpa autentikasi.
- [x] **Navigasi** — Link antar halaman publik berfungsi dengan benar.
- [ ] **Konten Dinamis** — Data klinik dari settings API muncul di halaman publik.
- [ ] **Form Submit** — Pesan kontak terkirim ke admin.
