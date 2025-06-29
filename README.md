# Proyek Infocraft 🚀

Selamat datang di repositori proyek Infocraft! Dokumen ini adalah panduan lengkap untuk melakukan instalasi proyek ini di komputer lokal Anda dari awal hingga akhir. Ikuti langkah-langkah di bawah ini dengan teliti.

## ⚠️ Prasyarat (Wajib Di-install Dahulu)

Sebelum memulai, pastikan perangkat lunak berikut sudah ter-install di komputer Anda. Jika belum, silakan unduh dan install dari link di bawah ini.

1.  **XAMPP** atau **Laragon**: Untuk membuat server lokal dan database MySQL.
    * [Unduh XAMPP](https://www.apachefriends.org/download.html)
    * [Unduh Laragon](https://laragon.org/download/) (Sangat direkomendasikan untuk kemudahan)
2.  **Composer**: Untuk mengelola paket-paket dependensi PHP.
    * [Unduh Composer](https://getcomposer.org/download/)
3.  **Node.js**: Untuk mengelola aset frontend (CSS & JavaScript).
    * [Unduh Node.js (versi LTS)](https://nodejs.org/en/download/)
4.  **GitHub Desktop**: Untuk mempermudah proses `clone`, `pull`, dan `push` tanpa perlu terminal.
    * [Unduh GitHub Desktop](https://desktop.github.com/)

---

## ⚙️ Langkah-Langkah Instalasi

Ikuti semua langkah ini secara berurutan.

### 1. Clone Repositori
Ini adalah langkah untuk mengunduh proyek dari GitHub ke komputer Anda.

**Cara Termudah (Pakai GitHub Desktop):**
   - Buka GitHub Desktop.
   - Klik `File` -> `Clone repository...`.
   - Pilih tab `URL`, masukkan `https://github.com/NasiGaPakeNasi/infocraft-project.git` dan klik `Clone`.

**Cara Alternatif (Pakai Terminal/CMD):**
   ```bash
   git clone [https://github.com/NasiGaPakeNasi/infocraft-project.git](https://github.com/NasiGaPakeNasi/infocraft-project.git)
   ```

### 2. Masuk ke Folder Proyek
Buka terminal atau CMD Anda, lalu masuk ke direktori proyek yang baru saja di-clone.
```bash
cd infocraft-project
```

### 3. Konfigurasi File Environment (`.env`)
File ini berisi semua konfigurasi rahasia seperti koneksi database.
```bash
# Untuk pengguna Windows
copy .env.example .env

# Untuk pengguna Mac/Linux
cp .env.example .env
```

### 4. Generate Kunci Aplikasi 🔑
Ini adalah langkah **KRUSIAL** untuk keamanan aplikasi. Jalankan perintah ini:
```bash
php artisan key:generate
```
Anda akan melihat pesan "Application key set successfully."

### 5. Buat Database Baru
- Jalankan **XAMPP** atau **Laragon** Anda. Pastikan Apache dan MySQL berjalan.
- Buka `phpMyAdmin` (biasanya di `http://localhost/phpmyadmin`) atau HeidiSQL/DBeaver.
- Buat sebuah database **kosong** baru. Beri nama yang mudah diingat, misalnya `infocraft_db`.

### 6. Hubungkan Database ke Proyek
- Buka file `.env` yang tadi kita buat di langkah 3.
- Cari baris-baris berikut dan ubah sesuai dengan konfigurasi database Anda.

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=infocraft_db  <-- Ganti dengan nama database yang Anda buat
DB_USERNAME=root         <-- Biasanya 'root' untuk XAMPP/Laragon
DB_PASSWORD=             <-- Kosongkan jika tidak ada password
```

### 7. Install Semua Dependensi
Perintah ini akan mengunduh semua "perpustakaan" kode yang dibutuhkan oleh proyek.
```bash
# Install dependensi PHP
composer install

# Install dependensi JavaScript
npm install
```

### 8. Jalankan Migrasi Database 🏗️
Perintah ini akan membuat semua tabel (seperti `users`, `posts`, `comments`) yang kita butuhkan di dalam database Anda.
```bash
php artisan migrate
```

### 9. Jalankan Server Pengembangan ✅
Ini adalah langkah terakhir untuk menjalankan website di komputer Anda.
```bash
php artisan serve
```
Buka browser Anda dan kunjungi alamat **http://127.0.0.1:8000**. Jika semua langkah benar, Anda akan melihat halaman utama Infocraft.

---

## 🤝 Alur Kerja Kolaborasi (Sangat Penting!)

Agar pekerjaan kita tidak tumpang tindih, ikuti alur ini **setiap saat**.

### Sebelum Mulai Bekerja
Selalu ambil versi terbaru dari kode yang ada di GitHub.
- **Di GitHub Desktop:** Klik tombol **`Fetch origin`**, lalu klik **`Pull origin`**.
- **Di Terminal:** `git pull origin main`

### Setelah Selesai Bekerja
Kirim hasil pekerjaan Anda ke GitHub.
- **Di GitHub Desktop:**
  1. Buka aplikasi, Anda akan lihat daftar file yang Anda ubah.
  2. Tulis ringkasan perubahan di kolom "Summary" (misal: "Memperbaiki tampilan halaman login").
  3. Klik tombol biru **`Commit to main`**.
  4. Klik tombol **`Push origin`** yang muncul di atas.
- **Di Terminal:**
  ```bash
  git add .
  git commit -m "Tulis pesan perubahan Anda di sini"
  git push origin main
  ```
