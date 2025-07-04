@extends('layouts.app')

{{-- Mengisi bagian 'title' di master layout --}}
@section('title', 'Berita Terbaru')

{{-- Mengisi bagian 'content' di master layout --}}
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Berita Terbaru</h1>

            {{-- Menampilkan pesan sukses setelah hapus/edit/buat postingan --}}
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Perulangan untuk setiap postingan --}}
            @forelse ($posts as $post)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            {{-- Kolom untuk Gambar --}}
                            @if ($post->image)
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded" alt="{{ $post->title }}">
                                </div>
                            @endif

                            {{-- Kolom untuk Judul, Konten, dan Tombol --}}
                            <div class="col-md-{{ $post->image ? '8' : '12' }}">
                                <h3>{{ $post->title }}</h3>
                                <p class="text-muted small">
                                    Oleh: {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}
                                </p>
                                <p>{{ Str::limit($post->content, 150) }}</p>
                                <div>
                                    <a href="{{ route('posts.show', $post) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                                    
                                    {{-- Tombol Edit & Hapus hanya untuk pemilik --}}
                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    Belum ada postingan.
                </div>
            @endforelse

            {{-- Untuk navigasi halaman jika postingan banyak --}}
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection