@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Yeni Yazı Ekle</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Başlık</label>
                <input type="text" name="title" id="title" required
                       class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">İçerik</label>
                <textarea name="content" id="content" rows="5" required
                          class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('posts.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Geri</a>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">Kaydet</button>
            </div>
        </form>
    </div>
</div>
@endsection
