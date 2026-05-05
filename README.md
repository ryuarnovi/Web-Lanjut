# KlinikOS 2.0 - Clinical Management System

KlinikOS 2.0 is a modern, scalable clinical management system built on the CodeIgniter 4 framework. It utilizes a Modular (HMVC) architecture to ensure separation of concerns and maintainability across various clinical operations. The user interface is strictly styled using Tailwind CSS v4, delivering a responsive and highly performant experience.

## Project Structure (Modular Architecture)

KlinikOS utilizes a modular approach where each primary feature is isolated within the `app/Modules` directory. This ensures that business logic, controllers, and views are encapsulated per domain.

```text
KlinikOS/
├── app/
│   ├── Modules/              
│   │   ├── Auth/             (Authentication, Session, Role-Based Access Control)
│   │   ├── Dashboard/        (Home, User Profile, Reports)
│   │   ├── Resepsionis/      (Patient Registration & Queue Management)
│   │   ├── Dokter/           (Medical Assessment, EMR, SOAP, E-Prescription)
│   │   ├── Apoteker/         (Pharmacy, Inventory Management)
│   │   ├── Kasir/            (Billing, Invoicing, Payment Gateway)
│   │   └── Shared/           (Global Layouts, Sidebar, Header components)
│   └── Config/               (Autoload configurations for Modules)
├── public/
│   └── assets/               (Compiled CSS, Static Images, Vendor JS)
├── docker-compose.yml        (Container orchestration configuration)
└── Dockerfile                (Build instructions for PHP 8.4-apache image)
```

## Setup and Installation

The development and production environments are strictly containerized using Docker. Follow these instructions to deploy the application locally.

### 1. Environment Configuration
Copy the example environment file to initialize your local configuration:
```bash
cp env.example .env
```

### 2. Docker Orchestration
Use Docker Compose to build the required images and start the containers.
*Note: The build process now automatically installs Node.js 20 and dependencies (NPM & Composer) inside the container.*
```bash
docker compose up --build -d
```
*Note: The `-d` flag runs the containers in the background.*

### 3. Application Access
Once the containers are running, access the application via your web browser:
- **URL**: `http://localhost:9092`
- **Default Credentials**:
  - Username: `admin`
  - Password: `admin`

## Development Guidelines

### Tailwind CSS v4 Build System
The project uses Tailwind CSS v4 with an NPM-based workflow integrated into Docker. You do not need Node.js or the Tailwind binary on your host machine.

- **Development (Automatic)**:
  The `tailwind` service in `docker-compose.yml` automatically watches for changes and recompiles CSS using `npm run dev`.
- **Production Build (Manual/CI)**:
  The Dockerfile automatically runs `npm run build` during the image creation process.

### General Notes
- **Creating New Modules**: To add a new module, create a new directory under `app/Modules/` containing the respective `Controllers`, `Views`, and `Models`. The namespace is automatically detected via `app/Config/Autoload.php`.
- **Asset Referencing**: Always utilize the `base_url()` helper function when calling static assets to ensure link validity across different environments and Docker setups.

## Troubleshooting

### 1. Writable Directory Permission Denied
If you encounter permission errors regarding the `writable` directory, adjust the ownership from within the host or container:
```bash
# Host Machine (Mac/Linux)
chmod -R 777 writable

# Or inside the Docker Container
docker exec -it web-lanjut-app-1 chown -R www-data:www-data writable
```

### 2. Port Conflict (9092)
If port `9092` is already bound to another service on your host machine, modify the port mapping in the `docker-compose.yml` file:
```yaml
ports:
  - "9093:80"
```

### 3. Tailwind Recompilation Issues
If the CSS does not update, ensure the `tailwind` service is running in Docker:
```bash
docker compose ps
```
If it's down, restart it: `docker compose up -d tailwind`.

## Project Documentation

Detailed documentation regarding logic implementation, feature roadmaps, known issues, and testing scenarios have been segregated per module. Please refer to the following documents in the `docs/` directory:

1. [Global Progress & Roadmap](docs/PROGRESS.md)
2. [Resepsionis Logic (Front Desk)](docs/FEATURE_RESEPSIONIS.md)
3. [Dokter Logic (Medical Services)](docs/FEATURE_DOKTER.md)
4. [Apoteker Logic (Pharmacy & Inventory)](docs/FEATURE_APOTEKER.md)
5. [Kasir Logic (Billing & Payment)](docs/FEATURE_KASIR.md)
6. [Core Logic (Authentication, Reports, Settings)](docs/FEATURE_CORE.md)
