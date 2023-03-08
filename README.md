# Surplus-TEST-PROJECT

## Requirements Server

-   PHP 8.2
-   Minimal Composer Versi 2
-   MySQL versi 8.0.32

## Langkah-langkah instalisasi

Berikut adalah contoh cara instalasi Laravel menggunakan Composer:

1. Pastikan Composer telah terpasang di komputer Anda. Jika belum, unduh dan instal Composer dari https://getcomposer.org.
2. Buka terminal atau command prompt dan arahkan ke direktori tempat Anda ingin menginstal Laravel.
3. Clone coding dengan perintah `git clone https://github.com/tbfajri/test-surplus.git`
4. Salin file .env.example ke .env
5. install vendor yang digunakan projek diantaranya

```sh
laravel/sail
laravel/passport
laravel/sanctum
```

6. Salin file .env.example ke .env
7. Konfigurasi database pada file .env

```sh
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
```

8. Jalankan migration dan seeder

```sh
php artisan migrate --seed
```

9. Jalankan server

```
php artisan serve
```

## Docker

Jika anda menggunakan Docker aplikasi ini sangat mendukung dengan bantuan dari laravel, cara nya mudah cukup jalankan code dibawah ini

```
composer require laravel/sail --dev
php artisan sail:install

alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
sail up
```

selanjutnya anda tinggal menambahkan kata 'sail'sebelum memberi perintah di terminal
contoh

```
sail php artisan serve
```

## Features

-   Register User
-   Login User
-   CRUD Category
-   CRUD Produk
-   CRUD Category Produk
-   CRUD Produk Image

## Tech

-   Laravel 10
-   Docker
-   PHP Versi 8.2

## License

MIT
