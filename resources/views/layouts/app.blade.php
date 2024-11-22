<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{config('app.name')}} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <nav class="shadow-xl ">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
               <h1 class="text-xl font-bold">{{ config('app.name')}}</h1>
               <a href="{{ route('blog.index') }}" class="flex items-center text-lg font-bold text-gray-800 hover:text-gray-600">
                <!-- Используем иконку домика из Heroicons -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2 7-7 7 7 2 2M5 12v6a2 2 0 002 2h3m10-8v6a2 2 0 01-2 2h-3m-7 0h6"></path>
                </svg> </a>
        </div>

    </nav>
    <main class="container mx-auto px-6 py-4">
        @yield('content')

    </main>



</body>
</html>
