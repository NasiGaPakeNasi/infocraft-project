{{-- File: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Infocraft')</title> {{-- Judul halaman dinamis --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container"> {{-- INI KUNCI UNTUK MASALAH #1 --}}
            <a class="navbar-brand" href="{{ route('posts.index') }}">Infocraft</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Formulir Pencarian --}}
<form class="d-flex mx-auto" action="{{ route('search') }}" method="GET">
    <input class="form-control me-2" type="search" name="query" placeholder="Cari postingan..." aria-label="Search" value="{{ request('query') }}">
    <button class="btn btn-outline-success" type="submit">Cari</button>
</form>
                <ul class="navbar-nav ms-auto">
                   {{-- Ganti seluruh isi <ul class="navbar-nav ms-auto"> dengan ini --}}
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
    {{-- Loop untuk setiap kategori dari database --}}
    @foreach ($global_categories as $category)
        <li class="nav-item">
           <a class="nav-link" href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
        </li>
    @endforeach
</ul>

<ul class="navbar-nav ms-auto">
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('posts.create') }}">
                    Tambah Postingan
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @yield('content') {{-- Di sini konten setiap halaman akan ditampilkan --}}
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts') {{-- Untuk script tambahan jika diperlukan --}}
</body>
</html>