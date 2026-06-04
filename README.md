# KlinikOS 2.0 — Clinical Management System

KlinikOS 2.0 is a modern clinical management system built on **CodeIgniter 4** (HMVC Modular) with **Tailwind CSS v4**. The backend was ported from Go (KlinikOS-2.0) into PHP CI4 controllers with full REST API endpoints for every module.

## Architecture

```
app/Modules/
├── Auth/           Login, Register, User CRUD, Profile
├── Dashboard/      Executive Dashboard, Laporan, Pengaturan
├── Resepsionis/    Patient Registration, Queue Management (dengan sistem Loket)
├── Dokter/         SOAP EMR, ICD-10/9, Resep, Rujukan
├── Apoteker/       Drug Inventory, Prescription Fulfillment
├── Kasir/          Billing, Payment (Midtrans), Multi-channel
└── Shared/         Global Layout, Sidebar, Header, Footer
```

## Quick Start

```bash
cp env.example .env
docker compose up -d
```

| Service | URL |
|---------|-----|
| App | http://localhost:9092 |
| MySQL | localhost:3307 |

### Seed Users (password: `root210605`)

| Username | Role |
|----------|------|
| `admin` | admin |
| `resepsionis1` | resepsionis |
| `dokter1` | dokter |
| `apoteker1` | apoteker |
| `kasir1` | kasir |
| `admin2` | admin |

## API Endpoints (all under `/api/`, session auth)

### Auth
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/auth/login` | JSON login |
| POST | `/api/auth/register` | Register user |
| GET | `/api/users/me` | Current user profile |
| POST | `/api/users/me` | Update profile |
| POST | `/api/users/me/photo` | Upload foto profil |
| GET | `/api/users` | List all users |
| GET/POST/PUT/DELETE | `/api/users/{id}` | CRUD user |

### Resepsionis
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET/POST | `/api/patients` | List / Create pasien |
| GET/PUT/DELETE | `/api/patients/{id}` | Get / Update / Delete pasien |
| GET | `/api/patients/payments` | Riwayat pembayaran pasien |
| GET/POST | `/api/queues` | List / Create antrean |
| GET/PUT/DELETE | `/api/queues/{id}` | Get / Update (call/complete) / Delete |
| GET | `/api/activity-logs` | Log aktivitas sistem |

### Dokter
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET/POST | `/api/medical-records` | List / Create rekam medis (SOAP) |
| PUT/DELETE | `/api/medical-records/{id}` | Update / Delete |
| GET/POST/PUT/DELETE | `/api/referrals` | CRUD rujukan |
| GET/POST/PUT/DELETE | `/api/schedules` | CRUD jadwal dokter |
| GET/POST/PUT/DELETE | `/api/shifts` | CRUD shift staf |
| GET | `/api/icd10/search` | Cari diagnosis ICD-10 |
| GET | `/api/icd9/search` | Cari tindakan ICD-9 |

### Apoteker
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET/POST | `/api/drugs` | List / Create obat |
| GET | `/api/drugs/detail` | Detail stok obat |
| GET | `/api/drugs/low-stock` | Obat stok menipis |
| GET/PUT/DELETE | `/api/drugs/{id}` | Get / Update / Delete obat |
| GET/POST/PUT/DELETE | `/api/prescriptions` | CRUD resep |
| GET/POST | `/api/prescription-items` | Item resep |

### Kasir
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET/POST | `/api/payments` | List / Create tagihan |
| PUT/DELETE | `/api/payments/{id}` | Update (bayar) / Delete |
| GET | `/api/midtrans/status/{order}` | Cek status Midtrans |
| POST | `/api/midtrans/snap` | Buat Snap Midtrans |
| POST | `/api/midtrans/webhook` | Webhook Midtrans |

## Fitur Unggulan

### Sistem Antrean dengan Loket (Counter)
- 3 loket real-time (Loket 1, 2, 3) dengan status **Tersedia** / **Sibuk**
- Klik **Panggil** → auto-assign ke loket tersedia → countdown 10 detik → auto **Selesai**
- Tampilan monitor loket dengan animasi pulse, progress bar, dan polling 3 detik
- Data tersimpan di kolom `loket` tabel `queues`

### JavaScript Fetch()
Semua view sudah terhubung ke API endpoint via `fetch()` tanpa mengubah HTML template — data dimuat dinamis dari backend.

## Docker

```yaml
services:
  app:   php:8.4-apache (port 9092)
  db:    mysql:8.0 (port 3307)
  tailwind: node:20-alpine (profile, opsional)
```

Tailwind hanya jalan saat `docker compose --profile tailwind up -d`.

## Development

```bash
# Masuk container
docker compose exec app bash

# Run migration (jika perlu)
php spark migrate

# Build CSS (manual)
docker compose --profile tailwind up -d
```
