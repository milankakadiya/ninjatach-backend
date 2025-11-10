This is the **backend API** built with **Laravel 11**, serving as the RESTful service for the NinjaTach Admin Panel.
It handles authentication (via Laravel Sanctum), user management, and client CRUD operations for admin users.

---

## 🚀 Tech Stack

- **Laravel 11** (PHP 8.2+)
- **MySQL** (or MariaDB)
- **Laravel Sanctum** for authentication
- **Spatie Query Builder** (for clean sorting/filtering, optional)
- **RESTful API structure**

---

## 📦 Installation

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/yourname/ninjatach-backend.git
cd ninjatach-backend

2️⃣ Install Dependencies

composer install

3️⃣ Create Environment File

Copy .env.example to .env and update credentials:

cp .env.example .env

Set these important keys:

APP_NAME=NinjaTach
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ninjatach_assessment
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=cookie
SESSION_LIFETIME=120
SESSION_DOMAIN=127.0.0.1
SESSION_SECURE_COOKIE=false

SANCTUM_STATEFUL_DOMAINS=127.0.0.1:5173
FRONTEND_URL=http://127.0.0.1:5173

Then generate the app key:

php artisan key:generate

🧰 Database Setup

Run migrations and seed demo data:

php artisan migrate --seed

🔄 Running the Server

Start the Laravel development server:

php artisan serve

🧩 Available API Endpoints

| Method     | Endpoint            | Description                  |
| ---------- | ------------------- | ---------------------------- |
| **POST**   | `/api/register`     | Register a new user          |
| **POST**   | `/api/login`        | Login and receive token      |
| **POST**   | `/api/logout`       | Logout current user          |
| **GET**    | `/api/clients`      | List all clients (paginated) |
| **POST**   | `/api/clients`      | Create a new client          |
| **PUT**    | `/api/clients/{id}` | Update client                |
| **DELETE** | `/api/clients/{id}` | Delete client                |


🧠 Authentication Flow

Uses Laravel Sanctum for SPA authentication.
The frontend (Vue app) calls:
GET /sanctum/csrf-cookie
POST /api/login or /api/register
Token is returned and stored in localStorage.

🧩 Example Response (GET /api/clients)

{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "first_name": "John",
      "last_name": "Doe",
      "email": "john@example.com",
      "interests": [{ "id": 1, "name": "Sports" }]
    }
  ],
  "per_page": 10,
  "total": 20
}

🧠 Tips

Always call /sanctum/csrf-cookie before login/register when using SPA frontend.
For CORS errors, ensure SESSION_DOMAIN and SANCTUM_STATEFUL_DOMAINS are set properly.
Use Postman or Thunder Client for testing your APIs.