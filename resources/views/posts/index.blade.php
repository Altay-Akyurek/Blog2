@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Yazılar</h1>
        @auth
            <a href="{{ route('posts.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">Yeni Yazı Ekle</a>
        @endauth
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($posts as $post)
            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg shadow-md p-5 flex flex-col justify-between">
                <div>
                    <h2 class="text-lg font-semibold mb-2">{{ $post->title }}</h2>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">{{ Str::limit($post->content, 100) }}</p>
                </div>
                <div class="flex justify-between items-center mt-auto">
                    <a href="{{ route('posts.show', $post->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Göster</a>
                    @auth
                        <a href="{{ route('posts.edit', $post->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">Düzenle</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm">Sil</button>
                        </form>
                    @endauth
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                    {{ $post->created_at->format('d-m-Y H:i') }}
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div class="text-center p-6 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-md">
                    Henüz yazı eklenmemiş.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
