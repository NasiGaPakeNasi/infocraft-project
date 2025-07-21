@extends('layouts.app')

@section('title', 'Manajemen Postingan')

@section('content')
<div class="row">
    {{-- Navigasi Samping Admin --}}
    <div class="col-md-3">
<div class="list-group">
    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        Manajemen User
    </a>
    <a href="{{ route('admin.posts.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.posts.index') ? 'active' : '' }}">
        Manajemen Postingan
    </a>
    <a href="{{ route('admin.comments.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.comments.index') ? 'active' : '' }}">
        Manajemen Komentar
    </a>
        <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        Manajemen Kategori
    </a>    
</div>
    </div>

    {{-- Konten Utama --}}
    <div class="col-md-9">
        <h1>Manajemen Postingan</h1>
        <p>Di sini Anda bisa mengelola semua postingan yang ada di website.</p>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="card mt-4">
            <div class="card-header">
                <h4>Semua Postingan</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <th>{{ $post->id }}</th>
                            <td>{{ Str::limit($post->title, 40) }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                @foreach($post->categories as $category)
                                    <span class="badge bg-secondary">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-info btn-sm" target="_blank">Lihat</a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus postingan ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection