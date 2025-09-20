@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Yazıyı Düzenle</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Başlık</label>
            <input type="text" name="title" id="title" value="{{ $post->title }}"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                   required>
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">İçerik</label>
            <textarea name="content" id="content" rows="5"
                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                      required>{{ $post->content }}</textarea>
        </div>

        <div class="flex space-x-2">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Güncelle</button>
            <a href="{{ route('posts.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Geri</a>
        </div>
    </form>
</div>
@endsection
