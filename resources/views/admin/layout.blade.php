<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Include the Header -->
    @include('admin.partials.header')
    <!-- Main Layout with Sidebar -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h2 class="text-2xl font-bold">Admin Panel</h2>
                <nav class="mt-4">
                    <ul>
                        <li class="mb-2">
                            <a href="{{ route('admin.dashboard') }}" class="block p-2 hover:bg-gray-700">Dashboard</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('admin.users') }}" class="block p-2 hover:bg-gray-700">Users</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('admin.settings') }}" class="block p-2 hover:bg-gray-700">Settings</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('admin.logout') }}" class="block p-2 hover:bg-gray-700">Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')  <!-- This is where the content from specific pages will be injected -->
        </main>
    </div>

    <!-- Include the Footer -->
    @include('admin.partials.footer')
    @stack('scripts')

</body>
</html>
