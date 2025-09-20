<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function index()
    {
        // Tüm postları en yeni oluşturulandan eskiye sıralayarak al
        $posts = Post::latest()->get();

        // posts/index.blade.php dosyasına 'posts' değişkenini gönder
        return view('posts.index', compact('posts'));
    }
    public function create()
    {   
        // Yeni post ekleme formunu göster
        return view('posts.create');
    }
   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);
    // Eğer kullanıcı giriş yapmamışsa redirect et
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Lütfen giriş yapın!');
    }
    Post::create([
        'title' => $request->title,
        'content' => $request->content,
        'user_id' => Auth::id(), // burada artık null olmayacak
    ]);

    return redirect()->route('posts.index')->with('success', 'Yazı başarıyla eklendi!');
}
    public function show(string $id)
    {
        // Belirtilen id'ye sahip postu al
        $post = Post::findOrFail($id);

        // posts/show.blade.php dosyasına gönder
        return view('posts.show', compact('post'));
    }
    public function edit(string $id)
    {
        // Düzenlenecek postu al
        $post = Post::findOrFail($id);

        // posts/edit.blade.php dosyasına gönder
        return view('posts.edit', compact('post'));
    }
    public function update(Request $request, string $id)
    {
        // Form verilerini doğrula
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Güncellenecek postu al
        $post = Post::findOrFail($id);

        // Verileri güncelle
        $post->update($request->only(['title', 'content']));

        // Başarılı mesajıyla index sayfasına yönlendir
        return redirect()->route('posts.index')->with('success', 'Yazı Güncellendi.');
    }
    public function destroy(string $id)
    {
        // Silinecek postu al
        $post = Post::findOrFail($id);

        // Postu sil
        $post->delete();

        // Başarılı mesajıyla index sayfasına yönlendir
        return redirect()->route('posts.index')->with('success', 'Yazı Silindi.');
    }
}
