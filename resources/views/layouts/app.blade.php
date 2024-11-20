{{-- ! erstellt html struktur --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-green-300">
    <nav class="bg-cyan-200 shadow-md">

        <div class="container mx-auto px-4 py-4">
            <h1 class="text-xl font-bold">{{config('app.name')}}</h1>
        </div>
    </nav>

    {{-- inject frontend code with yield ( get data)  || yield als platzhalter--}}
    {{-- section keyword will be as keyout to get frontend code as layout --}}
    <main class="container mx-auto px-6">
        @yield('content')
    </main>
</body>
</html>
