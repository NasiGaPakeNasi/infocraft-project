Bagian 2: Instruksi untuk Teman Anda Mengakses Proyek

Teman Anda perlu melakukan langkah-langkah ini di komputer mereka setelah Anda mengunggah proyeknya ke GitHub.

    Clone Repositori:
        Buka terminal mereka.
        Jalankan perintah berikut:
        Bash

    git clone https://github.com/USERNAME/infocraft-project.git

        Ganti USERNAME dan infocraft-project dengan informasi repositori Anda.

Masuk ke Folder Proyek:

    Setelah clone selesai, masuk ke folder proyek:
    Bash

    cd infocraft-project

Instal Dependensi PHP (Composer):

    Laravel menggunakan Composer untuk mengelola dependensi PHP.
    Jalankan:
    Bash

    composer install

Konfigurasi File .env:

    File .env berisi konfigurasi sensitif (seperti kredensial database dan app key) dan tidak diunggah ke Git karena .gitignore sudah mengaturnya. Teman Anda perlu membuat salinannya:
    Bash

    cp .env.example .env

Buat App Key Laravel:

    Setiap instalasi Laravel memerlukan app key unik.
    Jalankan:
    Bash

    php artisan key:generate

Konfigurasi Database Lokal:

    Teman Anda perlu mengedit file .env yang baru dibuat.
    Ubah bagian database agar sesuai dengan pengaturan XAMPP/Laragon mereka.

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=infocraft_db # Ganti dengan nama database yang mereka inginkan di local
    DB_USERNAME=root         # Biasanya 'root' untuk XAMPP/Laragon
    DB_PASSWORD=             # Biasanya kosong untuk XAMPP/Laragon

    Mereka juga perlu membuat database baru di phpMyAdmin mereka (misalnya dengan nama infocraft_db) jika belum ada.

Jalankan Migrasi Database:

    Ini akan membuat semua tabel yang dibutuhkan aplikasi di database lokal teman Anda.
    Jalankan:
    Bash

    php artisan migrate

Instal Dependensi Frontend (NPM):

    Jika aplikasi menggunakan aset JavaScript/CSS modern (Vite/Mix).
    Jalankan:
    Bash

npm install

Lalu, untuk mengompilasi aset frontend dalam mode pengembangan:
Bash

    npm run dev

Buat Storage Link (Jika Menggunakan Upload File):

    Jika aplikasi Anda mengizinkan upload file (seperti gambar postingan yang sudah kita atur), symlink ini penting agar file yang diupload dapat diakses dari browser.
    Jalankan:
    Bash

    php artisan storage:link

Jalankan Server Laravel:

    Terakhir, teman Anda bisa menjalankan server pengembangan Laravel:
    Bash

php artisan serve

Dan mengaksesnya di browser mereka di http://127.0.0.1:8000.


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
