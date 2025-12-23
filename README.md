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
1. **Clone the Repository:**
   
   ```bash
     composer global require laravel/installer
    ```
    ```bash
    git clone https://github.com/Abdul-Mutaleb/e_commerce-mini-project.git
    ```
    ```bash
    cd e_commerce-mini-project
     ```
3. **Install Dependencies:**


```bash
    composer install
```
```bash
    npm install
```
=> spatie media library install

```bash
    composer require "spatie/laravel-medialibrary"
```
```bash
    php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-  migrations"
```
```bash
   php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-config" 
```

```bash
    php artisan storage:link
```


3. **Environment Configuration:**

    - Using Command Prompt (CMD):

    ```cmd
    copy .env.example .env
    ```

    - Using Git Bash:

    ```bash
    cp .env.example .env
    ```
4. **Generate Application Key:**

    ```bash
     php artisan key:generate
    ```
5. **Run Database Migrations:**

   go to mysql server and ceate new database
   ```
    e_commerce_mini_project
    ```
   .env file set up
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=e_commerce_mini_project
    DB_USERNAME=root
    DB_PASSWORD=
   ```
   ```bash
     php artisan migrate 
    ```
    ```bash
     php artisan migrate --seed
    ```
8. **Start the Development Server:**

    ```bash
     composer run dev 
    ```

&nbsp;
## 👤 Admin Login Information

* Admin account is created using **database seeder**
* Seeder file is included in the project
 Admin Login 
 email: admin@gmail.com
 password: 12345678

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
