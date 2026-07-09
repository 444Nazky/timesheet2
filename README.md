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

## How to Run

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan route:list
npm install
npm run dev
```

---

## Notes
- The `admin` middleware alias registration depends on the Laravel middleware bootstrap configuration in this project.
- This repo snapshot does not include `app/Http/Kernel.php`, so you may need to register the `AdminMiddleware` alias in the Laravel bootstrap/middleware configuration (version-dependent). 

