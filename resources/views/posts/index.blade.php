<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infocraft - Berita Terbaru</title>
    {{-- Ini untuk CSS custom Anda dari `npm run dev` --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- Tambahkan link CSS Bootstrap 5 ini --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('posts.index') }}">Infocraft</a>
            
            {{-- Tombol Toggler untuk Navbar (penting untuk mobile) --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        {{-- Jika belum login, tampilkan Login dan Daftar --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @else
                        {{-- Jika sudah login, tampilkan dropdown nama user --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                {{-- Link Tambah Postingan ada di sini --}}
                                <li><a class="dropdown-item" href="{{ route('posts.create') }}">Tambah Postingan</a></li>
                                <li><hr class="dropdown-divider"></li> {{-- Garis pemisah --}}
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
        <h1>Berita Terbaru</h1>
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

        {{-- Ini adalah bagian di mana postingan-postingan akan ditampilkan --}}
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-3" alt="{{ $post->title }}" style="max-height: 200px; object-fit: cover;">
                    @endif
                    <p class="card-text">{{ Str::limit($post->content, 150) }}</p> {{-- Batasi teks --}}
                    <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
            </div>
        @endforeach
        {{-- Jika tidak ada postingan, tampilkan pesan --}}
        @if($posts->isEmpty())
            <div class="alert alert-info" role="alert">
                Belum ada postingan berita. Jadilah yang pertama membuat!
            </div>
        @endif
    </div>

    {{-- Tambahkan link JavaScript Bootstrap 5 ini (penting untuk dropdown navbar) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Ini untuk JS custom Anda dari `npm run dev` --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>