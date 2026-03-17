# User Management System (RBAC)

A robust and professional User Management System built with **Laravel 12.0**, featuring Role-Based Access Control (RBAC), dynamic permission management, and a premium administrative dashboard.

[![Laravel Version](https://img.shields.io/badge/Laravel-12.0-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.3-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

---

## 🚀 Features

### 1. **Advanced RBAC & Permission System**
- **Dynamic Roles**: Pre-configured roles for **Admin**, **Manager**, and **User**.
- **Module-Level Access**: Granular control over which sidebar modules each role can access.
- **Permission Management UI**: Dedicated interface for Admins to assign or revoke permissions in real-time.
- **Dynamic Gates**: Built-in Laravel Gates and Middleware ensuring secure route and UI-level authorization.

### 2. **User Management (CRUD)**
- **Full Control**: Create, read, update, and delete users via an intuitive interface.
- **Safety Locks**: Admin protection prevents the deletion of active users and critical accounts.
- **Status Control**: Quick toggle for enabling/disabling user accounts.
- **Secure Handling**: Native password hashing (Bcrypt) and protected profile updates.

### 3. **Premium Dashboard**
- **Sleek Interface**: Modern, responsive dashboard with mini-stat cards for quick system health checks.
- **Activity Tracking**: Real-time "Recently Joined Users" list with role and status indicators.
- **Login Monitoring**: Tracks user login timestamps (`last_login_at`) for security auditing.

### 4. **Modern UI/UX**
- **Responsive Design**: Mobile-first architecture with a slide-out drawer menu and overlay for seamless tablet/phone usage.
- **Premium Aesthetics**: Styled with a professional Inter font, custom scrollbars, and a clean, consistent theme based on Bootstrap 5.
- **SweetAlert2 Notifications**: Beautiful, non-intrusive toast alerts for all system actions (Save, Update, Delete).

---

## 🛠️ Tech Stack

- **Backend**: Laravel 12.0 (PHP 8.3)
- **Database**: MySQL
- **Frontend**: Blade Templating, Bootstrap 5, Custom Vanilla CSS
- **Icons**: Font Awesome 6
- **Notifications**: SweetAlert2 (JS)

---

## 📥 Installation Guide

Follow these steps to set up the project locally:

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/user-management-system.git
cd user-management-system
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run build
```

### 3. Environment Configuration
Copy the `.env.example` file to `.env` and configure your database settings:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup & Seeding
Run migrations and seed the database with initial roles, permissions, and an admin account:
```bash
php artisan migrate --seed
```

### 5. Start the Application
```bash
php artisan serve
```
Visit `http://localhost:8000` to access the login page.

---

## 🔑 Default Credentials

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@example.com` | `password` |
| **Manager** | `manager@example.com` | `password` |
| **User** | `user@example.com` | `password` |

---

## 📂 Project Structure Highlights

- `app/Http/Middleware/RoleMiddleware.php`: Handles multi-role route protection.
- `app/Http/Controllers/RolePermissionController.php`: Manages dynamic permission syncing.
- `resources/views/layouts/partials/sidebar.blade.php`: Dynamically renders menus based on `@can` permissions.
- `app/Providers/AppServiceProvider.php`: Dynamically registers Gates for all database permissions at boot.

---

## 📈 Dashboard Statistics
- **Total Users**: Overall user count.
- **Active Users**: Count of users with "Active" status.
- **System Roles**: Total available roles.
- **New Users (Month)**: Registration count for the current month.

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---
*Created with ❤️ for professional user management.*
