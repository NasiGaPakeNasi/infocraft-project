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
Ini adalah langkah untuk mengunduh proyek dari GitHub ke komputer Anda. Pilih **salah satu** cara yang paling nyaman bagi Anda.

**Cara 1: GitHub Desktop (Paling Mudah)**
   - Buka aplikasi GitHub Desktop.
   - Klik `File` -> `Clone repository...`.
   - Pilih tab `URL`, masukkan `https://github.com/NasiGaPakeNasi/infocraft-project.git` dan klik `Clone`.

**Cara 2: Langsung di VS Code (Terintegrasi)**
   - Buka VS Code.
   - Buka *Command Palette* dengan menekan `Ctrl+Shift+P` (atau `Cmd+Shift+P` di Mac).
   - Ketik `Git: Clone` lalu tekan Enter.
   - Tempelkan URL repositori: `https://github.com/NasiGaPakeNasi/infocraft-project.git` lalu tekan Enter.
   - Pilih folder di komputer Anda untuk menyimpan proyek.
   - Setelah selesai, VS Code akan bertanya apakah Anda ingin membuka proyek tersebut. Klik "Open".

**Cara 3: Terminal / CMD (Tradisional)**
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

### 4. Install Semua Dependensi
Perintah ini akan mengunduh semua "perpustakaan" kode yang dibutuhkan oleh proyek.
```bash
# Install dependensi PHP
composer install

# Install dependensi JavaScript
npm install
```

### 5. Generate Kunci Aplikasi 🔑
Ini adalah langkah **KRUSIAL** untuk keamanan aplikasi. Jalankan perintah ini:
```bash
php artisan key:generate
```
Anda akan melihat pesan "Application key set successfully."

### 6. Buat Database & Hubungkan ke Proyek
- Jalankan **XAMPP** atau **Laragon** Anda. Pastikan Apache dan MySQL berjalan.
- Buka `phpMyAdmin` (atau HeidiSQL/DBeaver). Buat sebuah database **kosong** baru. Beri nama **`infocraft_db`**.
- Buka file `.env` yang tadi kita buat di langkah 3.
- Pastikan bagian `DB_` sudah sesuai seperti ini:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=infocraft_db
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Jalankan Migrasi & Seeder Database 🏗️
Perintah ini akan membuat semua tabel di database Anda dan **mengisinya dengan data contoh** (akun admin, postingan, dan komentar) agar website tidak kosong.
```bash
php artisan migrate --seed
```

### 8. Buat Symlink untuk Penyimpanan Gambar
Agar gambar yang di-upload bisa tampil di website, jalankan perintah ini:
```bash
php artisan storage:link
```
Anda akan melihat pesan "The [public/storage] directory has been linked."

### 9. Jalankan Proyek! ✅
Ini adalah langkah terakhir untuk menjalankan website di komputer Anda.
```bash
# Compile aset frontend
npm run dev

# Jalankan server pengembangan
php artisan serve
```
Buka browser Anda dan kunjungi alamat **http://127.0.0.1:8000**. Jika semua langkah benar, Anda akan melihat halaman utama Infocraft.

**Untuk Login Admin:**
- **Email:** `admin@infocraft.com`
- **Password:** `password`

---

## 🤝 Alur Kerja Kolaborasi (Sangat Penting!)

Agar pekerjaan kita tidak tumpang tindih, ikuti alur ini **setiap saat**.

**Catatan Penting:** Anda hanya bisa melakukan `Push` jika sudah diundang sebagai **Kolaborator** oleh pemilik repositori (`NasiGaPakeNasi`). Pastikan Anda sudah menerima undangan kolaborasi di email GitHub Anda dan sudah menyetujuinya.

### Sebelum Mulai Bekerja (WAJIB)
Selalu ambil versi terbaru dari kode yang ada di GitHub agar pekerjaan Anda tidak menimpa pekerjaan orang lain.
- **Di GitHub Desktop:** Klik tombol **`Fetch origin`**, lalu klik **`Pull origin`**.
- **Di VS Code:** Klik ikon *Source Control* (logo cabang), klik menu `...` di atas, lalu pilih `Pull`.
- **Di Terminal:** `git pull origin main`

### Setelah Selesai Bekerja
Kirim hasil pekerjaan Anda ke GitHub agar bisa dilihat oleh tim.
- **Di GitHub Desktop:**
  1. Buka aplikasi, Anda akan lihat daftar file yang Anda ubah.
  2. Tulis ringkasan perubahan di kolom "Summary" (misal: "Memperbaiki tampilan halaman login").
  3. Klik tombol biru **`Commit to main`**.
  4. Klik tombol **`Push origin`** yang muncul di atas.
- **Di VS Code:**
  1. Klik ikon *Source Control*.
  2. Tulis pesan commit di kotak pesan di atas.
  3. Klik tanda centang (✓) untuk melakukan *Commit*.
  4. Klik tombol *Sync Changes* (logo awan dengan panah) di status bar bawah untuk melakukan *Pull* dan *Push*.
- **Di Terminal:**
  ```bash
  git add .
  git commit -m "Tulis pesan perubahan Anda di sini"
  git push origin main
  ```
