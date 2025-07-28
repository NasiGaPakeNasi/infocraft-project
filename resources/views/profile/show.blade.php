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

    {{-- Navigasi Tab --}}
    <ul class="nav nav-tabs" id="profileTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button" role="tab">Postingan</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab">Komentar</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="liked-posts-tab" data-bs-toggle="tab" data-bs-target="#liked-posts" type="button" role="tab">Disukai</button>
        </li>
    </ul>

    {{-- Konten Tab --}}
    <div class="tab-content" id="profileTabContent">
        {{-- 1. Tab Postingan --}}
        <div class="tab-pane fade show active" id="posts" role="tabpanel">
            <div class="py-3">
                @forelse ($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                            <p class="card-text text-muted small">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">{{ $user->name }} belum membuat postingan.</p>
                @endforelse
                {{ $posts->links() }}
            </div>
        </div>

        {{-- 2. Tab Komentar --}}
        <div class="tab-pane fade" id="comments" role="tabpanel">
            <div class="py-3">
                @forelse ($comments as $comment)
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="card-text">"{{ $comment->body }}"</p>
                            <p class="card-text text-muted small">Pada postingan: <a href="{{ route('posts.show', $comment->post) }}">{{ Str::limit($comment->post->title, 40) }}</a></p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">{{ $user->name }} belum pernah berkomentar.</p>
                @endforelse
                {{ $comments->links() }}
            </div>
        </div>

        {{-- 3. Tab Postingan yang Disukai --}}
        <div class="tab-pane fade" id="liked-posts" role="tabpanel">
            <div class="py-3">
                @forelse ($likedPosts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                            <p class="card-text text-muted small">Oleh: {{ $post->user->name }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">{{ $user->name }} belum menyukai postingan apa pun.</p>
                @endforelse
                {{ $likedPosts->links() }}
            </div>
        </div>
    </div>
@endsection