@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="row">
    <div class="col-md-3">
        {{-- Navigasi Samping Admin --}}
        <div class="list-group">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Manajemen User</a>
            <a href="{{ route('admin.posts.index') }}" class="list-group-item list-group-item-action">Manajemen Postingan</a>
            <a href="{{ route('admin.comments.index') }}" class="list-group-item list-group-item-action">Manajemen Komentar</a>
            <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action active">Manajemen Kategori</a>
        </div>
    </div>
    <div class="col-md-9">
        <h1>Edit Kategori: {{ $category->name }}</h1>
        <div class="card mt-4">
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 