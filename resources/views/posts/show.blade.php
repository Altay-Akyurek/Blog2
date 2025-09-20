@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $post->title }}</h1>
    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
        Yazar: <span class="font-medium">{{ $post->user->name ?? 'Bilinmiyor' }}</span> • 
        {{ $post->created_at->diffForHumans() }}
    </p>

    

    <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-6 rounded-lg shadow-md mb-6">
        {{ $post->content }}
    </div>
<!-- Yorumlar Bölümü -->
<h2 class="text-xl font-bold mb-4">Yorumlar</h2>

@if ($post->comments->count() > 0)
    @foreach ($post->comments as $comment)
        <div class="mb-3 p-3 border rounded bg-gray-50">
            <strong class="text-blue-600">{{ $comment->user->name }}</strong>
            <p class="mt-1 text-gray-700">{{ $comment->content }}</p>
            <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
        </div>
    @endforeach
@else
    <p class="text-gray-500">Henüz yorum yapılmamış. İlk yorumu sen yap!</p>
@endif

<!-- Yorum Ekleme Formu -->
@auth
    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-6">
        @csrf
        <textarea 
            name="content" 
            rows="3" 
            class="w-full border rounded p-2 focus:outline-none focus:ring focus:border-blue-300" 
            placeholder="Yorum Yaz..."></textarea>
        
        <button 
            type="submit" 
            class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Gönder
        </button>
    </form>
@else
    <p class="text-gray-500 mt-4">
        Yorum yapmak için 
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">giriş yapınız</a>.
    </p>
@endauth
<br>


    <div class="flex space-x-2">
        <a href="{{ route('posts.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Geri</a>
        @auth
            <a href="{{ route('posts.edit', $post->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md">Düzenle</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-block"
                  onsubmit="return confirm('Silmek istediğinize emin misiniz? Bu işlem geri alınamaz.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Sil</button>
            </form>
        @endauth
    </div>
</div>
@endsection
