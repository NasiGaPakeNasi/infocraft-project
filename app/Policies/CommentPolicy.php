<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Tentukan apakah user bisa mengupdate komentar.
     * Hanya boleh jika ID user sama dengan ID pemilik komentar.
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }

    /**
     * Tentukan apakah user bisa menghapus komentar.
     * Hanya boleh jika ID user sama dengan ID pemilik komentar.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }
}