# 🎬 CinemaTicket

**Your Movie Experience Starts Here.**

CinemaTicket merupakan aplikasi web pemesanan tiket bioskop berbasis Laravel yang dirancang untuk memberikan kemudahan kepada pengguna dalam mencari film, memilih jadwal penayangan, menentukan kursi, melakukan pemesanan, hingga memperoleh tiket digital dengan QR Code.

Aplikasi ini dilengkapi dengan sistem autentikasi customer dan administrator sehingga setiap pengguna dapat mengakses riwayat pemesanan dan tiket yang telah dibeli melalui akun masing-masing.

---

## ✨ Fitur Utama

### 👤 Customer

- **Registrasi dan Login** — Pengguna dapat membuat akun dan masuk sebelum melakukan pemesanan tiket.
- **Jelajah Film** — Melihat daftar film yang sedang tayang beserta informasi dan detailnya.
- **Informasi Jadwal** — Memilih jadwal penayangan berdasarkan film dan studio.
- **Pemilihan Kursi** — Menentukan kursi bioskop yang tersedia.
- **Pemesanan Tiket** — Mengisi data pemesan dan menyelesaikan proses booking.
- **Pembayaran** — Memilih metode pembayaran dan melakukan simulasi transaksi.
- **E-Ticket QR Code** — Mendapatkan tiket digital dengan kode QR setelah pembayaran berhasil.
- **Riwayat Pemesanan** — Melihat kembali transaksi dan tiket yang pernah dibeli melalui dashboard customer.

### 🔐 Administrator

- **Admin Authentication** — Login khusus administrator.
- **Dashboard Admin** — Mengakses informasi dan pengelolaan sistem.
- **Manajemen Film** — Menambah, melihat, mengubah, dan menghapus data film.
- **Manajemen Studio** — Mengelola data studio bioskop.
- **Manajemen Jadwal** — Mengatur jadwal penayangan film.
- **Manajemen Pemesanan** — Memantau dan mengelola data pemesanan tiket.

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Kegunaan |
|---|---|
| PHP 8.4 | Backend programming |
| Laravel 12 | Web application framework |
| MySQL | Database management |
| HTML5 | Struktur halaman |
| CSS3 | Desain dan styling |
| JavaScript | Interaktivitas antarmuka |
| Blade Template | Laravel view engine |
| Linkxtr Laravel QR Code | Pembuatan QR Code tiket |
| Composer | PHP dependency management |
| NPM | Frontend dependency management |

---

## 📸 Alur Pemesanan Tiket

1. Pengguna melakukan registrasi atau login.
2. Pengguna memilih film yang ingin ditonton.
3. Pengguna memilih jadwal penayangan.
4. Sistem menampilkan konfirmasi jadwal yang dipilih.
5. Pengguna melanjutkan ke halaman pemilihan kursi.
6. Pengguna mengisi data pemesan.
7. Pengguna memilih metode pembayaran.
8. Sistem memproses simulasi pembayaran.
9. Setelah pembayaran berhasil, sistem menyediakan e-ticket dengan QR Code.
10. Pengguna dapat mengakses kembali tiket melalui dashboard dan riwayat pemesanan.

---

## ⚙️ Instalasi dan Konfigurasi

Ikuti langkah berikut untuk menjalankan CinemaTicket di lingkungan lokal.

### 1. Clone Repository

```bash
git clone https://github.com/akmalmarsya/cinema-ticket.git
```

Masuk ke direktori project:

```bash
cd cinema-ticket
```

### 2. Install Dependencies

Install dependency Laravel:

```bash
composer install
```

Install dependency frontend:

```bash
npm install
```

### 3. Konfigurasi Environment

Salin file konfigurasi:

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 4. Konfigurasi Database

Buat database MySQL dengan nama:

```sql
CREATE DATABASE cinema_ticket;
```

Kemudian sesuaikan konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cinema_ticket
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username dan password dengan konfigurasi MySQL lokal.

### 5. Jalankan Migration

```bash
php artisan migrate
```

### 6. Konfigurasi Storage

Buat symbolic link agar file poster film dapat diakses:

```bash
php artisan storage:link
```

### 7. Build Frontend

```bash
npm run build
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Buka aplikasi melalui browser:

```text
http://127.0.0.1:8000
```

---

## 📁 Struktur Project

```text
cinema-ticket/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminAuthController.php
│   │   │   ├── BookingController.php
│   │   │   ├── CustomerAuthController.php
│   │   │   ├── CustomerDashboardController.php
│   │   │   ├── FilmController.php
│   │   │   ├── FilmDetailController.php
│   │   │   ├── JadwalController.php
│   │   │   ├── PaymentController.php
│   │   │   └── StudioController.php
│   │   └── Middleware/
│   │
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   └── storage/
│
├── resources/
│   └── views/
│       ├── admin/
│       ├── booking/
│       ├── customer/
│       ├── films/
│       └── layouts/
│
├── routes/
│   └── web.php
│
├── storage/
│
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

## 🔗 Halaman Aplikasi

| Halaman | URL |
|---|---|
| Homepage | `/` |
| Detail Film | `/film/{film}` |
| Customer Login | `/customer/login` |
| Customer Register | `/customer/register` |
| Customer Dashboard | `/customer/dashboard` |
| Admin Login | `/admin/login` |
| Admin Dashboard | `/admin/dashboard` |

---

## 🔒 Keamanan

- Autentikasi customer dan administrator dipisahkan.
- Middleware digunakan untuk membatasi akses halaman berdasarkan peran pengguna.
- Informasi konfigurasi sensitif disimpan dalam file `.env`.
- Pemesanan tiket dikaitkan dengan akun customer.
- Pengelolaan data dilakukan melalui mekanisme autentikasi dan validasi aplikasi.

---

## 👨‍💻 Developer

**Akmal Marsya**

Project: CinemaTicket

Framework: Laravel 12

Repository: [github.com/akmalmarsya/cinema-ticket](https://github.com/akmalmarsya/cinema-ticket)

---

## 📄 License

This project is developed for educational and academic purposes.