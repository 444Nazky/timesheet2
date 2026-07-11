# Timesheet2

## Overview
Timesheet2 is a multi-user timesheet web application with role-based access control (RBAC):
- **Admin**: manages employees, timesheets, approvals, and reports
- **Employee (Regular User)**: takes attendance (clock in/out) and views history/profile

This codebase is structured to support both:
- **Web views** (Laravel Blade routes)
- **REST API endpoints** (for future Flutter mobile integration)

---

## Web Structure (Views + Web Routes)

### 1) Guest Routes
Mounted in `routes/web.php` under middleware `guest`:
- `GET /login` → login page
- `POST /login` → login action
- `GET /forgot-password` → forgot password (stub)

### 2) User Panel Routes (Authenticated)
Mounted in `routes/web.php` under middleware `auth`:
- `GET /dashboard`
- `GET /attendance` → Attendance history/list (UI stub)
- `POST /clock-in` → clock-in (currently uses `TimesheetController`)
- `POST /clock-out` → clock-out (currently uses `TimesheetController`)
- `GET /history` → history page (stub)
- `GET /leave-request` → leave request page (stub)
- `GET /profile` → profile page (stub)
- `GET /reports` → reports page (existing view)

Key controller stub:
- `App\Http\Controllers\Web\User\AttendanceController`

### 3) Admin Panel Routes
Mounted in `routes/web.php` under:
- prefix: `/admin`
- middleware: `admin` (RBAC)

Admin routes (UI stubs):
- `GET /admin/` → `AdminDashboardController@index`
- `GET /admin/employees` → stub
- `GET /admin/timesheets` → stub
- `GET /admin/approvals` → stub
- `GET /admin/reports` → stub

Key controller stub:
- `App\Http\Controllers\Web\Admin\AdminDashboardController`

---

## API Structure (REST / Future Flutter)

Routes live in `routes/api.php`.

### 1) Authentication (stub)
- `POST /api/auth/login` → stub response (501)

### 2) Attendance API (stub)
Protected by `auth:sanctum` (currently assumes Sanctum-style auth):
- `POST /api/attendance/clock-in` → `AttendanceApiController@storeClockIn`
- `POST /api/attendance/clock-out` → `AttendanceApiController@storeClockOut`
- `GET /api/attendance/history` → stub response (501)

Key controller stub:
- `App\Http\Controllers\Api\AttendanceApiController`

---

## RBAC Middleware

### AdminMiddleware
File: `app/Http/Middleware/AdminMiddleware.php`

Behavior:
- Requires authenticated user (the route group should also include `auth`).
- Determines admin status by:
  - Using `$user->role->name` if relation exists, else
  - Loading `Role` by `$user->role_id` and checking `name === 'admin'`.
- If not admin:
  - JSON requests: `403 Forbidden`
  - Web requests: redirect to route `dashboard`

---

## Database

### Existing RBAC Tables
- `roles`
- `users.role_id` (foreign key)

### Attendance Migration (added)
Migration created:
- `database/migrations/2026_07_09_060000_create_attendances_table.php`

Table: `attendances`
- `id`
- `user_id` (FK)
- `clock_in` (datetime)
- `clock_out` (datetime, nullable)
- `ip_address` (string)
- `latitude` (string, nullable)
- `longitude` (string, nullable)
- `timestamps`

---

## How to Run (Localhost)

### Prerequisites
- PHP **8.3**
- Composer
- Node.js + npm
- A database (project migrations include `roles`, `users`, `timesheets`, `attendances`, etc.)

### 1) Install dependencies
```bash
composer install
npm install
```

### 2) Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set at least:
- `APP_URL=http://127.0.0.1:8000`
- `DB_CONNECTION` (mysql/pgsql/sqlite/etc.)
- your DB credentials (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)

### 3) Create tables
```bash
php artisan migrate
```

(Recommended) Seed a test user:
```bash
php artisan db:seed
```

The current `DatabaseSeeder` creates:
- **email:** `test@example.com`
- **name:** `Test User`

### 4) Run the app
In one terminal:
```bash
php artisan serve
```
This usually starts the server at:
- http://127.0.0.1:8000

In another terminal (for Vite assets):
```bash
npm run dev
```

### 5) Quick sanity checks
```bash
php artisan route:list
```

### Login
Because `routes/web.php` uses a temporary development login stub, it logs in the **first user found in the database** (so after running `migrate` + `db:seed`, login should work).

---

## Notes
- `AdminMiddleware` checks the authenticated user’s `role` relation (or falls back to `role_id`) and requires `role->name === 'admin'`.
- If `/admin/...` routes are returning 403, ensure the middleware alias is registered in your Laravel bootstrap/middleware configuration (this repo snapshot does not include `app/Http/Kernel.php`).


