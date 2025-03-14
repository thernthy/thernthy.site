
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="https://thernthy.site/assets/thy/thernthy.site_42.jpg" type="image/x-icon" sizes="42x42">
        <title>THY SEVER</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- CodeMirror CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css" />

        <!-- CodeMirror JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>

        <!-- Addons (optional) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased"
            style="
              background: url(https://i.postimg.cc/054d9xdf/img.jpg);
              background-size: 100%;
              background-repeat: repeat-y;
            "
        >
        <x-banner />
        <div class="min-h-screen"

        >
            <!-- Main Layout with Sidebar -->
            <div class="flex-1">
                <!-- Sidebar -->
                <aside class="bg-[#02194fe0] shadow-md top-0 text-white"
                   style="
                        position: fixed;
                        height: 100vh;
                        width: 260px;
                        background:#02194fe0;
                    "
                >
                    <div class="p-4">
                        <h2 class="text-2xl font-bold">THY SEVER</h2>
                        <nav class="mt-4">
                            <ul>
                            <li class="mb-2">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                    <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                                </button>
                                            @else
                                                <span class="inline-flex rounded-md">
                                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                        {{ Auth::user()->name }}
                
                                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                        </svg>
                                                    </button>
                                                </span>
                                            @endif
                                        </x-slot>
                
                                        <x-slot name="content">
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Account') }}
                                            </div>
                
                                            <x-dropdown-link href="{{ route('profile.show') }}">
                                                {{ __('Profile') }}
                                            </x-dropdown-link>
                
                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                                    {{ __('API Tokens') }}
                                                </x-dropdown-link>
                                            @endif
                
                                            <div class="border-t border-gray-200"></div>
                
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}" x-data>
                                                @csrf
                
                                                <x-dropdown-link href="{{ route('logout') }}"
                                                         @click.prevent="$root.submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('manager') }}" class="block p-2 hover:bg-gray-700">Dashboard</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('page_manager') }}" class="block p-2 hover:bg-gray-700">Pages manager</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('manager.blogs.list') }}" class="block p-2 hover:bg-gray-700">Manage Blogs</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ route('manager.galary') }}" class="block p-2 hover:bg-gray-700">Galary</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
                <!-- Page Content -->
                <main style="padding-left:260px;">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
