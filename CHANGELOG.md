# Catatan Perubahan (Changelog) Infocraft

Semua perubahan penting pada proyek ini akan didokumentasikan di file ini.

---

## [1.0.0] - 2025-07-29

### Ditambahkan (Added)
- **Sistem Postingan:** Fungsionalitas CRUD (Create, Read, Update, Delete) penuh untuk postingan.
- **Sistem Komentar:** Pengguna dapat membuat, mengedit, menghapus, dan membalas komentar.
- **Sistem Kategori:** Postingan dapat dikelompokkan ke dalam beberapa kategori.
- **Fitur Pencarian:** Menambahkan search bar untuk mencari postingan berdasarkan judul atau konten.
- **Panel Admin Lengkap:**
    - Sistem Peran (Role) untuk membedakan Admin dan User.
    - Dashboard admin yang dilindungi Middleware.
    - Manajemen Pengguna (melihat daftar semua user).
    - Manajemen Postingan (melihat dan menghapus semua postingan).
    - Manajemen Komentar (melihat dan menghapus semua komentar).
    - Manajemen Kategori (CRUD lengkap untuk kategori).
- **Fitur Interaksi Pengguna:**
    - Sistem Suka (Like) untuk postingan.
    - Penghitung Jumlah Pembaca (Views Counter) untuk setiap postingan.
- **Halaman Profil Pengguna:**
    - Halaman profil publik untuk setiap pengguna.
    - Menampilkan daftar postingan yang dibuat, komentar yang ditulis, dan postingan yang disukai.
- **Struktur & Tampilan:**
    - Implementasi Master Layout dengan Blade untuk tampilan yang konsisten.
    - Menambahkan Footer dengan nomor versi proyek.
- **Persiapan Kolaborasi:**
    - Membuat Database Seeder untuk data contoh (user, post, comment, category).
    - Membuat dokumentasi `README.md` yang detail untuk instalasi dan alur kerja tim.

### Diubah (Changed)
- Navbar utama sekarang dinamis dan menampilkan daftar kategori dari database.
- Navbar sekarang bersifat *sticky* (menempel di atas saat di-scroll).
- Memperbaiki gaya pagination agar menggunakan style Bootstrap 5.

### Diperbaiki (Fixed)
- Memperbaiki berbagai bug terkait relasi model, *namespace*, dan kesalahan sintaks selama pengembangan.

---