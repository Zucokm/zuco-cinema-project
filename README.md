# ZUCO Cinema Ticket & Food Ordering System

A comprehensive web-based platform that allows customers to seamlessly book cinema tickets and order food combos. This system features dynamic seat selection, combo management, and an admin dashboard for efficient cinema operations. Developed as a final year BSc (Hons) Computing project.

## 🛠 Tech Stack
- **Backend Framework:** Laravel 11 (PHP)
- **Frontend:** Vue.js / Blade with Tailwind CSS
- **Database:** MySQL
- **Authentication:** Laravel Session/Sanctum

## 🚀 Getting Started

Follow these steps to set up the project on your local machine.

### 1. Clone the Repository
```bash
git clone git@github.com:Zucokm/zuco-cinema-project.git
cd zuco-cinema
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Configure Environment
```bash
cp .env.example .env
```

Open the `.env` file and configure your database settings:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=zuco_cinema
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Application
```bash
php artisan key:generate
php artisan migrate --seed
```

### 5. Run the Application

Terminal 1 (Vite):
```bash
npm run dev
```

Terminal 2 (Server - Optional for Herd users):
```bash
php artisan serve