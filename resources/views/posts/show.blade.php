<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Anda bisa menambahkan link ke CSS custom Anda di sini jika perlu --}}
</head>
<body>
    {{-- 1. BAGIAN NAVIGASI --}}
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

    {{-- 2. BAGIAN KONTEN POSTINGAN --}}
    <div class="container mt-4">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm mb-3">Kembali ke Daftar Postingan</a>

        <h1>{{ $post->title }}</h1>
<p class="text-muted">
    Oleh: {{ $post->user->name }} | {{ $post->created_at->format('d M Y') }} | 👁️ Dilihat {{ $post->views_count }} kali
</p>

<div class="mt-2 mb-4">
    {{-- Tampilkan jumlah like --}}
    <span>❤️ {{ $post->likes->count() }} Suka</span>

    @auth
        {{-- Jika user SUDAH me-like, tampilkan tombol Unlike --}}
        @if ($post->likes->contains(auth()->user()->id))
            <form action="{{ route('posts.unlike', $post) }}" method="POST" class="d-inline ms-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Batal Suka</button>
            </form>
        {{-- Jika user BELUM me-like, tampilkan tombol Like --}}
        @else
            <form action="{{ route('posts.like', $post) }}" method="POST" class="d-inline ms-2">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm">Suka</button>
            </form>
        @endif
    @endauth
</div>

<div class="mb-3">
    @foreach($post->categories as $category)
        <span class="badge bg-secondary">{{ $category->name }}</span>
    @endforeach
</div>

        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}">
        @endif

        <div class="card p-4 mb-4" style="font-size: 1.1rem; line-height: 1.6;">
            {!! nl2br(e($post->content)) !!} {{-- Menggunakan e() untuk keamanan dan nl2br() untuk baris baru --}}
        </div>

        {{-- Tombol Aksi untuk Postingan --}}
        @can('update', $post) {{-- Cara yang lebih baik menggunakan Policy --}}
            <div class="mb-4">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning me-2">Edit Postingan</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Postingan</button>
                </form>
            </div>
        @endcan

        <hr>

        {{-- 3. BAGIAN DISKUSI (KOMENTAR) --}}
        <div class="mt-4">
            <h3 class="mb-3">Diskusi</h3>

            {{-- Tampilkan Pesan Sukses (jika ada) --}}
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form Komentar Utama --}}
            @auth
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tinggalkan Komentar</h5>
                        <form action="{{ route('comments.store', $post) }}" method="POST">
                            @csrf
                            <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="3" required placeholder="Tulis komentar Anda..."></textarea>
                            @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <button type="submit" class="btn btn-primary mt-2">Kirim Komentar</button>
                        </form>
                    </div>
                </div>
            @endauth
            @guest
                <p><a href="{{ route('login') }}">Login</a> untuk ikut berdiskusi.</p>
            @endguest

            {{-- Tampilkan Komentar dan Balasannya secara Rekursif --}}
            @include('partials._comment_replies', ['comments' => $post->comments])
        </div>

    </div>

    

    {{-- 4. BAGIAN SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleEditForm(id) {
            document.getElementById('edit-form-' + id).classList.toggle('d-none');
            document.getElementById('comment-body-' + id).classList.toggle('d-none');
        }
        function toggleReplyForm(id) {
            document.getElementById('reply-form-' + id).classList.toggle('d-none');
        }
    </script>
</body>
</html>