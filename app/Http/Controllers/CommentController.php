<?php

namespace App\Http\Controllers;

// app/Http/Controllers/CommentController.php

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
// Ganti method store() Anda dengan yang ini
public function store(Request $request, Post $post)
{
    // Validasi input
    $request->validate([
        'body' => 'required|string|max:2500',
        'parent_id' => 'nullable|exists:comments,id', // Validasi parent_id jika ada
    ]);

    // Buat komentar baru
    $comment = new Comment();
    $comment->body = $request->body;
    $comment->user_id = auth()->id();
    $comment->post_id = $post->id;
    $comment->parent_id = $request->parent_id; // Simpan parent_id
    $comment->save();

    return back()->with('success', 'Komentar berhasil ditambahkan!');
}
  /**
     * Update komentar yang ada di database.
     */
    public function update(Request $request, Comment $comment)
    {
        // 1. Otorisasi: Pastikan user yang login boleh mengupdate
        $this->authorize('update', $comment);

        // 2. Validasi input
        $validated = $request->validate([
            'body' => 'required|string|max:2500',
        ]);

        // 3. Update komentar
        $comment->update($validated);

        // 4. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Komentar berhasil diperbarui!');
    }
     /**
     * Hapus komentar dari database.
     */
    public function destroy(Comment $comment)
    {
        // 1. Otorisasi: Pastikan user yang login boleh menghapus
        $this->authorize('delete', $comment);

        // 2. Hapus komentar
        $comment->delete();

        // 3. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}