# CeviCheck MVP

CeviCheck es una plataforma web para el registro y control sanitario de vendedores de ceviche ambulante. El repositorio está dividido en `backend/` (Laravel 12 + JWT + PostgreSQL) y `frontend/` (React 19 + Vite + Bootstrap 5).

## Stack

- Frontend: React 19, Vite, React Router DOM, Axios, Bootstrap 5, Bootstrap Icons
- Backend: Laravel 12, PHP 8.3, JWT (`tymon/jwt-auth`), Controllers + Services + Repositories
- Base de datos: PostgreSQL
- Deploy: Render
- CI/CD: GitHub Actions

## Estructura

- `backend/`: API REST con arquitectura por capas
- `frontend/`: SPA con dashboards por rol
- `.github/workflows/ci.yml`: pipeline de integración continua
- `render.yaml`: infraestructura declarativa para Render

## Instalación local

### 1. Backend

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

### 2. Frontend

```bash
cd frontend
npm install
cp .env.example .env
npm run dev
```

## Variables de entorno

### Backend (`backend/.env`)

- `APP_NAME`, `APP_ENV`, `APP_KEY`, `APP_URL`
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `DATABASE_URL`
- `JWT_SECRET`, `JWT_TTL`, `JWT_REFRESH_TTL`
- `CORS_ALLOWED_ORIGINS`
- `FILESYSTEM_DISK`, `CACHE_STORE`, `QUEUE_CONNECTION`, `SESSION_DRIVER`

### Frontend (`frontend/.env`)

- `VITE_API_URL`: URL base del backend (`http://localhost:8000/api/v1`)

## Migraciones y seeders

El backend crea las tablas:

- `users`
- `vendors`
- `food_stalls`
- `licenses`
- `inspections`
- `documents`
- `reports`

Seeders incluidos:

- 3 administradores
- 5 vendedores
- 4 ciudadanos de prueba
- 8 puestos
- 5 licencias
- 6 inspecciones
- 6 documentos
- 10 reportes ciudadanos

## API principal

Base URL: `/api/v1`

- Auth: `POST /auth/register`, `POST /auth/login`, `GET /auth/me`, `POST /auth/logout`, `POST /auth/refresh`
- Vendors: `GET /vendors`, `GET /vendors/{id}`, admin CRUD en `/admin/vendors`
- Stalls: `GET /stalls`, `GET /stalls/{id}`, vendor/admin CRUD
- Licenses: `/licenses`
- Inspections: `/inspections`
- Reports: `/reports`
- Documents: `/documents`
- Users: `/users`

Todas las respuestas están en JSON.

## Render

El archivo `render.yaml` provisiona:

- `cevicheck-postgres`: PostgreSQL administrado
- `cevicheck-api`: backend Laravel en servicio web Docker
- `cevicheck-web`: frontend React como static site

También puedes desplegar manualmente:

1. Crear la base PostgreSQL en Render.
2. Crear un Web Service apuntando a `backend/Dockerfile`.
3. Crear un Static Site apuntando a `frontend/`.
4. Configurar `VITE_API_URL` con la URL pública del backend.
5. Si quieres poblar datos demo en Render, define `SEED_DEMO_DATA=true` solo en el primer arranque.

## Docker

El backend incluye:

- `backend/Dockerfile`
- `backend/.dockerignore`
- `backend/start.sh`
- `backend/Procfile`

## Flujo sugerido de commits

- `feat(auth): implement jwt authentication`
- `feat(database): create postgres migrations and seeders`
- `feat(vendors): add vendors and stalls modules`
- `feat(inspections): add sanitary inspections workflow`
- `feat(reports): add citizen reports workflow`
- `feat(frontend): build role-based dashboard`
- `feat(ci): add github actions pipeline`
- `feat(deploy): add render and docker configuration`

## Notas

- El frontend persiste el JWT en `localStorage`.
- Las rutas protegidas validan autenticación y rol.
- Los estados sanitarios y licencias usan badges y vistas responsive con Bootstrap 5.
