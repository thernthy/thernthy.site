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

    <!-- Main Content Section -->
    <main class="py-6">
        @yield('content')  <!-- This is where the content from specific pages will be injected -->
    </main>

    <!-- Include the Footer -->
    @include('admin.partials.footer')

    @stack('scripts')

</body>
</html>
