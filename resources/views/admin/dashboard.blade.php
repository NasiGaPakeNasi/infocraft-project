@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    {{-- CUKUP SATU BLOK NAVIGASI SAMPING --}}
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action active">
                Manajemen User
            </a>
            <a href="{{ route('admin.posts.index') }}" class="list-group-item list-group-item-action">
                Manajemen Postingan
            </a>
            <a href="{{ route('admin.comments.index') }}" class="list-group-item list-group-item-action">
                Manajemen Komentar
            </a>
            <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">
                Manajemen Kategori
            </a>
        </div>
    </div>

    {{-- Bagian Konten Utama --}}
    <div class="col-md-9">
        <h1>Selamat Datang di Dashboard Admin</h1>
        <p>Ini adalah halaman yang hanya bisa diakses oleh admin.</p>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Daftar Pengguna</h4>
            </div>
            <div class="card-body">
                {{-- Tabel Daftar Pengguna --}}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Peran</th>
                            <th scope="col">Bergabung Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->isAdmin() ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection