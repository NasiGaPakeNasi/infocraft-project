{{-- File: resources/views/partials/_comment_replies.blade.php --}}

@foreach($comments as $comment)
    <div class="card mb-3 {{ $comment->parent_id != null ? 'ms-4' : '' }}">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <strong>{{ $comment->user->name }}</strong>
                    <small class="text-muted ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <div>
                    {{-- Tombol Balas --}}
                    <button class="btn btn-sm btn-primary" onclick="toggleReplyForm({{ $comment->id }})">Balas</button>
                    @can(['update', 'delete'], $comment)
                        <button class="btn btn-sm btn-warning" onclick="toggleEditForm({{ $comment->id }})">Edit</button>
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus komentar ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    @endcan
                </div>
            </div>

            <p class="card-text mt-2" id="comment-body-{{ $comment->id }}">{{ $comment->body }}</p>

            @can('update', $comment)
                <form action="{{ route('comments.update', $comment) }}" method="POST" class="d-none mt-2" id="edit-form-{{ $comment->id }}">
                    @csrf @method('PATCH')
                    <textarea class="form-control" name="body" rows="2" required>{{ $comment->body }}</textarea>
                    <button type="submit" class="btn btn-sm btn-primary mt-2">Simpan</button>
                    <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="toggleEditForm({{ $comment->id }})">Batal</button>
                </form>
            @endcan

            {{-- Form Balasan (tersembunyi) --}}
            <form action="{{ route('comments.store', $post) }}" method="POST" class="d-none mt-3" id="reply-form-{{ $comment->id }}">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <div class="mb-2">
                    <textarea class="form-control" name="body" rows="2" placeholder="Tulis balasan Anda..." required></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Kirim Balasan</button>
            </form>

            {{-- Panggil Diri Sendiri (Rekursif) untuk Menampilkan Balasan --}}
            @if($comment->replies->isNotEmpty())
                @include('partials._comment_replies', ['comments' => $comment->replies])
            @endif
        </div>
    </div>
@endforeach