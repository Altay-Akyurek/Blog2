<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Yorum ekleme metodu
     */
    public function store(Request $request, $postId)
    {
        // 1. Yorum içeriğini doğrula
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // 2. İlgili postu bul
        $post = Post::findOrFail($postId);

        // 3. Yorum oluştur
        // -> comments() ile morphMany ilişkisini kullandığımız için
        // commentable_id = $post->id
        // commentable_type = App\Models\Post
        // otomatik olarak kaydedilir.
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        // 4. Kullanıcıya geri dön
        return redirect()->back()->with('success', 'Yorum başarıyla eklendi.');
    }

    /**
     * Yorum silme metodu
     */
    public function destroy(Comment $comment)
    {
        // 1. Kullanıcı ya yorumu yazan kişi ya da admin olmalı
        if (auth()->id() === $comment->user_id || auth()->user()->hasRole('admin')) {
            // 2. Yorumu sil
            $comment->delete();
            return back()->with('success', 'Yorum silindi.');
        }

        // 3. Yetkisi olmayan için hata mesajı
        return back()->with('error', 'Bu yorumu silme yetkiniz yok.');
    }
}
