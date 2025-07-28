# Catatan Perubahan (Changelog) Infocraft

Semua perubahan penting pada proyek ini akan didokumentasikan di file ini.

---

## [1.0.0] - 2025-07-29

Versi rilis stabil pertama yang mencakup semua fungsionalitas inti untuk portal berita dan komunitas.

### Ditambahkan (Added)
- **Sistem Postingan (13 Juni 2025):** Fungsionalitas CRUD (Create, Read, Update, Delete) penuh untuk postingan.
- **Sistem Komentar (29 Juni 2025):** Pengguna dapat membuat, mengedit, menghapus, dan membalas komentar.
- **Sistem Kategori (21 Juli 2025):** Postingan dapat dikelompokkan ke dalam beberapa kategori.
- **Fitur Pencarian (21 Juli 2025):** Menambahkan search bar untuk mencari postingan.
- **Panel Admin Lengkap (21 Juli 2025):**
    - Sistem Peran (Role) untuk membedakan Admin dan User.
    - Dashboard admin yang dilindungi Middleware.
    - Manajemen Pengguna, Postingan, Komentar, dan Kategori.
- **Fitur Interaksi Pengguna (21 Juli 2025):**
    - Sistem Suka (Like) untuk postingan.
    - Penghitung Jumlah Pembaca (Views Counter) untuk setiap postingan.
- **Halaman Profil Pengguna (21 Juli 2025):**
    - Halaman profil publik yang menampilkan postingan, komentar, dan postingan yang disukai.
- **Struktur & Tampilan (29 Juli 2025):**
    - Implementasi Master Layout dengan Blade.
    - Menambahkan Footer dengan nomor versi proyek.
- **Persiapan Kolaborasi (21 Juli 2025):**
    - Membuat Database Seeder untuk data contoh.
    - Membuat dokumentasi `README.md` yang detail.

### Diubah (Changed)
- **(21 Juli 2025)** Navbar utama sekarang dinamis dan menampilkan daftar kategori.
- **(29 Juli 2025)** Navbar sekarang bersifat *sticky* dan footer bersifat *fixed*.
- **(21 Juli 2025)** Memperbaiki gaya pagination agar menggunakan style Bootstrap 5.

### Diperbaiki (Fixed)
- Memperbaiki berbagai bug terkait relasi model, *namespace*, dan kesalahan sintaks selama pengembangan.

---