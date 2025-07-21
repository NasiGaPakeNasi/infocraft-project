@extends('layouts.app')

@section('title', 'Kategori: ' . $category->name)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Postingan dalam Kategori: <span class="badge bg-primary">{{ $category->name }}</span></h1>

            {{-- Kita bisa menggunakan kembali tampilan daftar postingan yang sudah ada --}}
            @forelse ($posts as $post)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            @if ($post->image)
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded" alt="{{ $post->title }}">
                                </div>
                            @endif
                            <div class="col-md-{{ $post->image ? '8' : '12' }}">
                                <h3>{{ $post->title }}</h3>
                                <p class="text-muted small">
                                    Oleh: {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}
                                </p>
                                <p>{{ Str::limit($post->content, 150) }}</p>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    Belum ada postingan dalam kategori ini.
                </div>
            @endforelse

            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection