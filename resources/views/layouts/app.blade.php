<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-500">
    <nav class="bg-white shadow-md-8">
        <div class="container mx-auto px-6 py-4">
            <h1 class="text-xl font-bold">{{ config('app.name') }}</h1>
        </div>
    </nav>
    <main class="container mx-auto px-6">
        @yield('content')
    </main>
</body>

</html>
