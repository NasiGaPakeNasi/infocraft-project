   <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Postingan: {{ $post->title }}</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
<a class="navbar-brand" href="{{ route('posts.index') }}">Infocraft</a>
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
        <h1>Edit Postingan: {{ $post->title }}</h1>

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

        <form method="POST" action="{{ route('posts.update', $post->slug) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Ini penting! Laravel menggunakan PUT/PATCH untuk update --}}

            <div class="mb-3">
                <label for="title" class="form-label">Judul Postingan</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="current_image" class="form-label">Gambar Saat Ini</label>
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid d-block mb-2" style="max-height: 150px; object-fit: cover;">
                @else
                    <p>Tidak ada gambar saat ini.</p>
                @endif
                <label for="image" class="form-label">Ganti Gambar (opsional)</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Isi Postingan</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Postingan</button>
            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
```
