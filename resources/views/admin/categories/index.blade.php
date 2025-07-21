@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="row">
    {{-- CUKUP SATU BLOK NAVIGASI SAMPING --}}
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Manajemen User</a>
            <a href="{{ route('admin.posts.index') }}" class="list-group-item list-group-item-action">Manajemen Postingan</a>
            <a href="{{ route('admin.comments.index') }}" class="list-group-item list-group-item-action">Manajemen Komentar</a>
            <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action active">Manajemen Kategori</a>
        </div>
    </div>

    {{-- Bagian Konten Utama --}}
    <div class="col-md-9">
        <h1>Manajemen Kategori</h1>
        <p>Tambah, edit, atau hapus kategori postingan.</p>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-header">
                <h4>Daftar Kategori <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm float-end">Tambah Kategori</a></h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <th>{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus kategori ini?');">
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection