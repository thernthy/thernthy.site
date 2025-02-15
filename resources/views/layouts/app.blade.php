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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Main Layout with Sidebar -->
            <div class="flex">
                <!-- Sidebar -->
                <aside class="w-64 bg-gray-800 text-white">
                    <div class="p-4">
                        <h2 class="text-2xl font-bold">THY SEVER</h2>
                        <nav class="mt-4">
                            <ul>
                                <li class="mb-2">
                                    <a href="{{ url('/dashboard') }}" class="block p-2 hover:bg-gray-700">Dashboard</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ url('/') }}" class="block p-2 hover:bg-gray-700">Users</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ url('/') }}" class="block p-2 hover:bg-gray-700">Settings</a>
                                </li>
                                <li class="mb-2">
                                    <a href="{{ url('/') }}" class="block p-2 hover:bg-gray-700">Logout</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>

                <!-- Main Content -->
                <div class="flex-1">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <header class="bg-white shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif

                    <!-- Page Content -->
                    <main class="p-6">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
