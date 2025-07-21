@extends('layouts.app')

@section('title', 'Manajemen Komentar')

@section('content')
<div class="row">
    {{-- Navigasi Samping Admin --}}
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Manajemen User</a>
            <a href="{{ route('admin.posts.index') }}" class="list-group-item list-group-item-action">Manajemen Postingan</a>
            <a href="{{ route('admin.comments.index') }}" class="list-group-item list-group-item-action active">Manajemen Komentar</a>
            <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Manajemen Kategori</a>
        </div>
    </div>

    {{-- Konten Utama --}}
    <div class="col-md-9">
        <h1>Manajemen Komentar</h1>
        <p>Di sini Anda bisa mengelola semua komentar yang ada di website.</p>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-header">
                <h4>Semua Komentar</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Penulis</th>
                            <th>Komentar</th>
                            <th>Pada Postingan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ Str::limit($comment->body, 50) }}</td>
                            <td>
                                <a href="{{ route('posts.show', $comment->post) }}" target="_blank">
                                    {{ Str::limit($comment->post->title, 30) }}
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus komentar ini?');">
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
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection