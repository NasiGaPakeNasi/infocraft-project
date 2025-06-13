  <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Postingan Baru</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
{{-- Jika Anda menggunakan Bootstrap, pastikan CSS Bootstrap juga di-load --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
<a class="navbar-brand" href="/">Infocraft</a>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ms-auto">
@guest
<li class="nav-item">
<a class="nav-link" href="{{ route('login') }}">Login</a>
</li>
<li class="nav-item">
<a class="nav-link" href="{{ route('register') }}">Daftar</a>
</li>
@else
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
{{ Auth::user()->name }}
</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('posts.create') }}">Tambah Postingan</a></li>
<li><hr class="dropdown-divider"></li>
<li>
<a class="dropdown-item" href="{{ route('logout') }}"
onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
Logout
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
</form>
</li>
</ul>
</li>
@endguest
</ul>
</div>
</div>
</nav>

    <div class="container mt-4">
        <h1>Tambah Postingan Baru</h1>

        {{-- Tampilkan pesan sukses/error jika ada --}}
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf {{-- Ini penting! Untuk keamanan form Laravel --}}

            <div class="mb-3">
                <label for="title" class="form-label">Judul Postingan</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar Postingan</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Isi Postingan</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit Postingan</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    {{-- Jika Anda menggunakan Bootstrap JS, pastikan di-load juga --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
```
{{-- * **Penjelasan Kode:**
    * `@csrf`: Ini adalah direktif Blade yang sangat penting untuk keamanan form Laravel. Jangan pernah menghapusnya.
    * `method="POST" action="{{ route('posts.store') }}"`: Mengatur form untuk mengirim data ke rute `posts.store`.
    * `enctype="multipart/form-data"`: Penting untuk form yang memiliki *file upload* (gambar).
    * `@error('nama_field') ... @enderror`: Direktif Blade ini akan menampilkan pesan error validasi jika ada masalah dengan input tersebut.
    * `old('nama_field')`: Akan mengisi kembali input dengan nilai yang terakhir kali diisi pengguna jika validasi gagal, sehingga pengguna tidak perlu mengetik ulang.
    * `<textarea>`: Untuk input konten yang panjang. --}}