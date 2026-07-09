# TODO - Timesheet2 initial skeleton

- [x] Inspect existing routing/controller/migrations.
- [x] Create RBAC middleware: `app/Http/Middleware/AdminMiddleware.php`.
- [x] Create controller stubs:
  - `app/Http/Controllers/Web/User/AttendanceController.php`
  - `app/Http/Controllers/Web/Admin/AdminDashboardController.php`
  - `app/Http/Controllers/Api/AttendanceApiController.php`
- [x] Create API routes skeleton in `routes/api.php`.
- [x] Restructure `routes/web.php` into guest/user/admin groups.
- [x] Add migration for `attendances` table: `database/migrations/2026_07_09_060000_create_attendances_table.php`.
- [ ] Ensure middleware alias `admin` is registered (may require adding `app/Http/Kernel.php` or route middleware registration depending on Laravel version).
- [ ] Run `php artisan migrate`.
- [ ] Run `php artisan route:list` for final verification.

