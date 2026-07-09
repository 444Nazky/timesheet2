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

## How to Run on Localhost
1.  **Environment Setup:**
    Ensure you have PHP 8.x, Composer, and a MySQL server running locally.
    
2.  **Configuration:**
    - Copy the environment file: `cp .env.example .env`
    - Generate your app key: `php artisan key:generate`
    - Open `.env` and update the `DB_*` settings with your local MySQL credentials:
      ```ini
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=your_database_name
      DB_USERNAME=your_database_username
      DB_PASSWORD=your_database_password
      ```

3.  **Database Migration:**
    Run the migrations to create the necessary tables:
    ```bash
    php artisan migrate
    ```

4.  **Start the Server:**
    Start the Laravel development server:
    ```bash
    php artisan serve
    ```
    Access the application at `http://127.0.0.1:8000`.

    **To stop the server:** Press `Ctrl + C` in the terminal where it is running.
    If running in the background, find and kill the process:
    ```bash
    # Find the PID
    lsof -i :8000
    # Kill the process
    kill <PID>
    ```

*Note: The application uses `auth` middleware. You must implement authentication (e.g., via Laravel Breeze or Jetstream) before the routes are fully accessible.*

## Debugging
- **Logs:** Check `storage/logs/laravel.log`.
- **Debugging:** Use `dd($variable)` or `dump($variable)` to inspect variables.
- **Database:** Inspect tables using a tool like phpMyAdmin or TablePlus.
