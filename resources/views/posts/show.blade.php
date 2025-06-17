<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title> {{-- Judul halaman dari judul postingan --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('posts.index') }}">Infocraft</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
        <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm mb-3">Kembali ke Daftar Postingan</a>

        <h1>{{ $post->title }}</h1>


{{-- ... kode sebelumnya (setelah img atau setelah div card p-4) ... --}}

        <div class="card p-4 mb-4">
            <p class="card-text">{{ nl2br($post->content) }}</p>
        </div>

        {{-- Tombol Edit dan Delete (hanya untuk user yang login dan pemilik postingan) --}}
        @auth {{-- Hanya tampilkan jika user sudah login --}}
            @if(Auth::id() === $post->user_id) {{-- Hanya tampilkan jika user yang login adalah pemilik postingan --}}
                <div class="mb-4">
                
            @auth
                @if(Auth::id() === $post->user_id)
                    <div class="mb-4">
                        <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-warning me-2">Edit Postingan</a>

                        {{-- Tombol Delete --}}
                        <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE') {{-- Penting! Menggunakan method DELETE --}}
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">Hapus Postingan</button>
                        </form>
                    </div>
                @endif
            @endauth
{{-- ... kode selanjutnya ... --}}
                </div>
            @endif

    

        @endauth

        <h3>Komentar</h3>
{{-- ... kode selanjutnya ... --}}

        <p class="text-muted">Diposting oleh: {{ $post->user->name }} pada {{ $post->created_at->format('d M Y') }}</p>

        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}">
        @endif

        <div class="card p-4 mb-4">
            {{-- Gunakan nl2br untuk menampilkan baris baru dari textarea --}}
            <p class="card-text">{{ nl2br($post->content) }}</p>
        </div>

        {{-- Bagian Komentar akan kita tambahkan nanti --}}
        <h3>Komentar</h3>
        <div class="alert alert-info" role="alert">
            Fitur komentar akan ditambahkan di langkah selanjutnya!
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>