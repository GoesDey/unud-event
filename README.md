<h1 align="center">Welcome to sisakti-plus 👋</h1>
<p>
</p>

> Sisakti Plus adalah pengembangan dari sistem milik udayana bernama sisakti. Sistem ini dibuat untuk memenuhi tugas akhir matakuliah Pemrograman Berbasis Web dan Sistem Informasi.

## Tech Stack

- **Framework:** Laravel (v13)
- **Frontend Interactivity:** Livewire (v4)
- **Database:** MySQL
- **Styling:** Tailwind CSS

---

## Author

👤 **Satria, Candra, Gusde, Deas, Rio**

---

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL Server

---

## Installation Guide

Follow these steps to set up the project locally:

1. **Clone the repository:**

    ```bash
    git clone https://github.com/GoesDey/unud-event.git
    cd unud-event
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Install Frontend dependencies:**

    ```bash
    npm install
    ```

4. **Setup Environment:**

    Copy the .env.example file to .env

    ```bash
    cp .env.example .env
    ```

5. **Database Configuration:**

    Configure your database credentials in the .env file:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=unud-event
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

7. **Run Database Migrations:**

    ```bash
    php artisan migrate
    ```

8. **Run Development Server:**

    You can start the application using one of the following methods:

    **Run Frontend and Backend simultaneously**

    ```bash
    composer run dev
    ```

    **Run Frontend and Backend separately**

    Open two terminal windows:

    **Terminal 1: Frontend**

    ```bash
    npm run dev
    ```

    **Terminal 2: Backend**

    ```bash
    php artisan serve
    ```

9. **Access the Application**

    Open your web browser and navigate to::

    ```bash
    http://localhost:8000
    ```

---

## Show your support

Give a ⭐️ if this project helped you!

---
