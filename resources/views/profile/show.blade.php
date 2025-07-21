@extends('layouts.app')

@section('title', 'Profil ' . $user->name)

@section('content')
    {{-- Informasi Dasar Pengguna --}}
    <div class="card mb-4">
        <div class="card-body">
            <h1 class="card-title">{{ $user->name }}</h1>
            <p class="card-text text-muted">
                Bergabung pada {{ $user->created_at->format('d M Y') }}
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            {{-- Daftar Postingan Milik Pengguna --}}
            <h3>Postingan oleh {{ $user->name }}</h3>
            <hr>
            @forelse ($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        </h5>
                        <p class="card-text text-muted small">
                            {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <p>{{ $user->name }} belum membuat postingan.</p>
            @endforelse

            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>

        <div class="col-md-6">
            {{-- Daftar Komentar Milik Pengguna --}}
            <h3>Komentar oleh {{ $user->name }}</h3>
            <hr>
            @forelse ($comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-text">
                            {{ $comment->body }}
                        </p>
                        <p class="card-text text-muted small">
                            Pada postingan: <a href="{{ route('posts.show', $comment->post) }}">{{ Str::limit($comment->post->title, 40) }}</a>
                        </p>
                    </div>
                </div>
            @empty
                <p>{{ $user->name }} belum pernah berkomentar.</p>
            @endforelse

            <div class="d-flex justify-content-center">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection