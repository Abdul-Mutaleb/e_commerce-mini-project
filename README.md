# E-Commerce Mini Project (Laravel 12)

## Setup Guide

## 📦 System Requirements (Global Installation Required)

Make sure the following are installed globally on your system before running the project:

* PHP >= 8.2
* Composer (latest, global)
* Node.js (LTS) & npm
* MySQL 8.0+
* Git Bash
* Apache / Nginx (or Laravel built-in server)

Check versions:

```bash
php -v
composer -V
node -v
npm -v
```

### Installation
```bash
git clone https://github.com/Abdul-Mutaleb/e_commerce-mini-project.git
cd e_commerce-mini-project
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate



## 👤 Admin Login Information

* Admin account is created using **database seeder**
* Seeder file is included in the project

Run seeder if needed:

```bash
php artisan db:seed
```

> Admin credentials can be found inside the seeder file.

---

## 🗄️ Database Import (Optional – Recommended)

An exported database `.sql` file is provided for quick setup.

### Steps to Import:

1. Create a database in MySQL
2. Open **phpMyAdmin**
3. Select the database
4. Click **Import**
5. Upload the provided `.sql` file
6. Click **Go**

After import, update `.env` file accordingly.

### ✨ Developed By

**Abdul Mutaleb**
Full-Stack Web Developer
