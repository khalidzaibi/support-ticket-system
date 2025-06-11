<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# 🛠️ Support Ticket System

This is a Laravel 12 and Vue.js-based multi-database Support Ticket System using Element Plus for the frontend. Each department (Technical, Account, Product, General, Feedback) has its own dedicated MySQL database connection.

---

## ✅ Full Project Setup Guide

Follow all steps below to install and configure this project on your local machine.

---

## 📋 Prerequisites

Before starting, make sure you have the following installed:

- PHP 8.1 or higher
- Composer for PHP dependency management
- Node.js and NPM for frontend assets
- MySQL server

---

## 🔧 Step-by-Step Instructions

1. **Clone the project repository** to your local machine.
    ```bash
    git clone https://github.com/khalidzaibi/support-ticket-system.git
    cd support-ticket-system
    ```
2. After navigating into the project directory, install all PHP dependencies using Composer.
    ```bash
    composer update
    ```

3. Next, install all JavaScript dependencies using NPM to set up the frontend (Vue + Element Plus).
    ```bash
    npm install
    ```
4. Copy the `.env.example` file to a new file named `.env`. This file will store all your environment configurations.
    ```bash
    cp .env.example .env
    ```
5. Generate the application key. This is required by Laravel for encryption and app security.
    ```bash
    php artisan key:generate
    ```


6. Now, create the following six MySQL databases manually using a tool like phpMyAdmin, MySQL Workbench, or the command line:

   - assignment
   - assignment_feedback
   - assignment_general
   - assignment_product
   - assignment_account
   - assignment_technical


7. Once the connections are ready, run the Laravel migrations. Start by running the default migrations to create tables in the main database. Then run the custom `php artisan migrate:tickets` command which will handle migrations for all department-specific databases.
    ```bash
    php artisan migrate
    php artisan migrate:tickets    
    ```
8. After migrating, seed the database with a default admin user by running the AdminSeeder class.
    ```bash
    php artisan db:seed --class=AdminSeeder
    ```

9. Once everything is migrated and seeded, start the Laravel backend server using `php artisan serve`. It will launch the backend at `http://127.0.0.1:8000` by default.

10. To run the Vue frontend (handled by Vite), start the dev server using `npm run dev`.

11. Open your browser and navigate to the Laravel serve URL to start using the Support Ticket System.
    `http://127.0.0.1:8000`

12. For admin login URL `http://127.0.0.1:8000/admin/login`

---

## 🔑 Default Admin Credentials

If the database was seeded using the `AdminSeeder`, you can log in using:

- Email: admin@admin.com
- Password: password

(You can modify these values in the seeder file before running the seed command.)

---

## 📁 Project Overview

- Laravel is used for the backend, APIs, and database handling.
- Vue 3 + Element Plus is used for the frontend interface.
- Each department has a dedicated MySQL database to manage its own tickets separately.
- The application supports multi-database connections in a clean and organized architecture.



## 👤 Author

Developed by [Muhammad Khalid](https://github.com/khalidzaibi)

---
