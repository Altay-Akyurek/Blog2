<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Ana Navigation Menü -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Menü Linkleri -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- Dashboard Linki -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Kullanıcı giriş yapmışsa Yazılar linki göster -->
                    @auth
                        <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')">
                            {{ __('Yazılar') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Sağ taraf: Kullanıcı linkleri -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Kullanıcı giriş yapmışsa -->
                @auth
                    <!-- Kullanıcı menüsü (profil + çıkış) -->
                    <x-dropdown align="right" width="48">
                        <!-- Menü açma butonu -->
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <!-- Ok ikonu -->
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <!-- Açılır menü içeriği -->
                        <x-slot name="content">
                            <!-- Profil linki -->
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil') }}
                            </x-dropdown-link>

                            <!-- Çıkış yapma formu -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Çıkış Yap') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                <!-- Kullanıcı giriş yapmamışsa -->
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-300 underline">Giriş Yap</a>
                    <a href="{{ route('register') }}" class="ms-4 text-sm text-gray-700 dark:text-gray-300 underline">Kayıt Ol</a>
                @endguest
            </div>

            <!-- Mobilde hamburger menü butonu -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400">
                    <!-- Menü ikonları -->
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <!-- Menü Açık değilken -->
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <!-- Menü Açıkken -->
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobilde açılır menü -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Dashboard linki -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Kullanıcı bilgileri ve ayarları -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
                <div class="px-4">
                    <!-- Kullanıcı adı ve mail -->
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <!-- Profil ve çıkış linkleri -->
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">Profil</x-responsive-nav-link>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            Çıkış Yap
                        </x-responsive-nav-link>
                        
                    </form>
                </div>
            @endauth

            <!-- Kullanıcı giriş yapmamışsa -->
            @guest
                <div class="px-4 space-y-1">
                    <a href="{{ route('login') }}" class="block text-sm text-gray-700 dark:text-gray-300 underline">Giriş Yap</a>
                    <a href="{{ route('register') }}" class="block text-sm text-gray-700 dark:text-gray-300 underline">Kayıt Ol</a>
                </div>
            @endguest
        </div>
    </div>
</nav>
