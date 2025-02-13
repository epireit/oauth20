<!DOCTYPE html>
<html lang="de" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-bind:class="darkMode ? 'dark' : ''">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    @include('admin.layouts.sidebar')
    <div class="ml-64 p-6">
        @include('admin.layouts.navbar')
        <main>@yield('content')</main>
    </div>

</body>
</html>
