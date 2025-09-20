# 🍽️ Restaurant Ordering System API

Backend RESTful API berbasis **Laravel** untuk sistem pemesanan restoran.  
Fitur utama:

- Multiple Role Authentication (Kasir, Pelayan)
- Manajemen Menu (CRUD makanan & minuman)
- Manajemen Meja
- Pemesanan (Open / Add Item / Close Order)

---

## 🚀 Tech Stack

- [Laravel 12](https://laravel.com/) (Backend Framework)
- [MySQL](https://www.mysql.com/) (Database)
- [Sanctum](https://laravel.com/docs/sanctum) (Authentication Token)

---

## 📂 Struktur Project (utama)

```
app/
 ├── Http/
 │    ├── Controllers/
 │    │     ├── AuthController.php
 │    │     ├── MenuController.php
 │    │     ├── OrderController.php
 │    │     ├── TableController.php
 │    └── Middleware/
 │
 ├── Models/
 │    ├── User.php
 │    ├── Menu.php
 │    ├── TableRestaurant.php
 │    ├── Order.php
 │    └── OrderItem.php
 │
database/
 ├── migrations/
 │    ├── create_users_table.php
 │    ├── create_menus_table.php
 │    ├── create_table_restaurants_table.php
 │    ├── create_orders_table.php
 │    └── create_order_items_table.php
 └── seeders/
      ├── UserSeeder.php
      └── TableSeeder.php
```

---

## ⚙️ Instalasi & Setup

1. **Clone repo & install dependency**

   ```bash
   git clone https://github.com/bagusizzanm/backend_restaurant.git
   cd restaurant-backend
   composer install
   ```

2. **Buat file environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Atur koneksi database** di `.env`

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=restaurant_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Migrasi & seeder**

   ```bash
   php artisan migrate --seed
   ```

   Seeder akan otomatis membuat:

   - 10 meja (`table_restaurants`). Atau di dalam seeder dapat diubah sesuai keinginan.
   - User role Kasir & Pelayan.

5. **Publish CORS**

   ```bash
   php artisan publish:cors
   ```

6. **Jalankan server**

   ```bash
   php artisan serve
   ```

   API berjalan di `http://127.0.0.1:8000/api`

---

## 🔑 Authentication

Menggunakan **Laravel Sanctum**.  
Login menghasilkan token untuk setiap user role.

### Endpoint Login

`POST /api/login`

**Request Body**

```json
{
  "email": "kasir@example.com",
  "password": "password"
}
{
  "email": "server@example.com",
  "password": "password"
}
```

**Response**

```json
{
  "user": {
    "id": 1,
    "name": "Kasir",
    "role": "kasir"
  },
  "token": "xxxxxxxxxxxxxxxxxxxx"
}
```

Gunakan `Authorization: Bearer <token>` di setiap request setelah login.

---

## 📖 API Endpoints

### 🔹 Auth

| Method | Endpoint  | Deskripsi   |
| ------ | --------- | ----------- |
| POST   | `/login`  | Login user  |
| POST   | `/logout` | Logout user |

---

### 🔹 Menu (CRUD)

| Method | Endpoint      | Deskripsi       |
| ------ | ------------- | --------------- |
| GET    | `/menus`      | List semua menu |
| POST   | `/menus`      | Tambah menu     |
| PUT    | `/menus/{id}` | Update menu     |
| DELETE | `/menus/{id}` | Hapus menu      |

**Contoh Tambah Menu**

```json
{
  "name": "Nasi Goreng",
  "price": 20000,
  "type": "main course",
  "description": "Nasi goreng spesial"
}
```

---

### 🔹 Table

| Method | Endpoint  | Deskripsi                |
| ------ | --------- | ------------------------ |
| GET    | `/tables` | List semua meja (status) |

Status meja: `available`, `occupied`, `inactive`, `reserved`

---

### 🔹 Orders

| Method | Endpoint             | Deskripsi                                      |
| ------ | -------------------- | ---------------------------------------------- |
| GET    | `/orders`            | List semua order (filter `status`, `table_id`) |
| GET    | `/orders/{id}`       | Detail order                                   |
| POST   | `/orders`            | Buat order baru (open order)                   |
| POST   | `/orders/{id}/items` | Tambah item ke order                           |
| POST   | `/orders/{id}/close` | Tutup order                                    |

**Contoh Buat Order**

```json
{
  "table_restaurant_id": 2
}
```

**Contoh Tambah Item**

```json
{
  "menu_id": 1,
  "qty": 2
}
```

---

## 📌 Fitur yang Tersedia

- [x] Login multi-role (Kasir, Pelayan)
- [x] CRUD Menu
- [x] List Table (via Seeder)
- [x] Open Order ke meja available
- [x] Tambah item ke order
- [x] Detail Order
- [x] Tutup Order (meja jadi available lagi)
- [x] List Order (filter by table/status)
- [x] Generate Receipt PDF

---
