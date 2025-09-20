<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

                <h1>Merhaba, {{ Auth::user()->name }}</h1>

                <h3>Kullanıcının Rolleri:</h3>
                <ul>
                    @foreach(Auth::user()->roles as $role)
                        <li>{{ $role->name }}</li>
                    @endforeach
                </ul>

                @if(Auth::user()->hasRole('admin'))
                    <div class="mt-4 p-4 bg-blue-100 rounded">
                        <h3>Admin Paneline Hoşgeldiniz!</h3>
                        <a href="{{ route('posts.index') }}" class="text-blue-600 underline">Yazıları Yönet</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
