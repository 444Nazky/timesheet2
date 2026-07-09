# Timesheet Application

## Overview
A secure, multi-user timesheet application built with Laravel. It features Role-Based Access Control (RBAC), real-time time tracking with geolocation, and is API-ready.

## Architecture & Design
- **Backend:** Laravel 11 (PHP 8.x) provides secure MVC architecture, ORM, and request validation.
- **Database:** MySQL.
- **Frontend:** Laravel Blade + Tailwind CSS (via Vite).
- **Security:**
  - Prepared statements (Eloquent ORM) prevent SQL Injection.
  - Laravel's built-in CSRF protection is enabled by default.
  - XSS protection via Blade escaping.

## How to Run
1.  **Environment:** Ensure PHP 8.x, Composer, and MySQL are installed.
2.  **Setup:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    # Configure your DB credentials in .env
    php artisan migrate
    ```
3.  **Start:**
    ```bash
    npm install && npm run dev
    php artisan serve
    ```

## Debugging
- **Logs:** Check `storage/logs/laravel.log`.
- **Debugging:** Use `dd($variable)` or `dump($variable)` to inspect variables.
- **Database:** Inspect tables using a tool like phpMyAdmin or TablePlus.
