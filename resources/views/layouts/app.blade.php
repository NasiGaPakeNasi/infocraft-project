<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Infocraft')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('posts.index') }}">Infocraft</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            {{-- Ini adalah satu-satunya div .collapse --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Menu Kategori --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @foreach ($global_categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>

                {{-- Formulir Pencarian --}}
                <form class="d-flex" action="{{ route('search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Cari..." value="{{ request('query') }}">
                    <button class="btn btn-outline-success" type="submit">Cari</button>
                </form>

                {{-- Menu User (Login/Register atau Dropdown) --}}
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
                                <a class="dropdown-item" href="{{ route('profile.show', Auth::user()) }}">
                                    Profil Saya
                                </a>
                                @can('is_admin')
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        Dashboard Admin
                                    </a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('posts.create') }}">
                                    Tambah Postingan
                                </a>
                                <div class="dropdown-divider"></div>
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
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
    
    @yield('scripts')

{{-- Tambahkan ini sebelum </body> --}}

<footer class="mt-5 py-4 bg-light text-center text-muted fixed-bottom">
    <div class="container">
        <p class="mb-0">Infocraft &copy; 2025 | Versi 1.0.0</p>
    </div>
</footer>

@yield('scripts')

</body>


</html>