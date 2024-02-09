<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased min-h-screen bg-gray-100">
    @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        @auth
        <a href="{{ url('/dashboard') }}" class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-800 whitespace-nowrap">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-800 whitespace-nowrap">Log in</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 bg-blue-500 text-white px-4 py-2 hover:bg-blue-800 whitespace-nowrap">Register</a>
        @endif
        @endauth
    </div>
    @endif
    <div class="w-[90vw] md:w-[60vw] lg:w-[40vw] mx-auto  mt-16 px-6 py-4 bg-white shadow-md sm:rounded-lg ">
        <div class="w-full flex justify-center items-center">
            <form class="w-full" action="{{ route('home') }}" method="post">
                @csrf
                <label class="block mb-2 text-center text-xl" for="url">Paste the URL to be shortened</label>
                <div class="flex max-w-md mx-auto">
                    <input class="w-full text-black" type="url" name="url" required>
                    <button class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-800 whitespace-nowrap" type="submit">Shorten URL</button>
                </div>
            </form>
        </div>
        <div class="w-[80vw] md:w-[60vw] lg:w-[40vw] mx-auto mt-2 p-1">
            <div class="w-full">
                <p class="w-full break-words"><span class="font-bold text-lg">Original URL: </span> {{ $originalUrl??null }}</p>
                <p class="w-full break-words mt-2"><span class="font-bold text-lg">Shortened URL: </span> {{ url("url/" . $shortUrl)??null }}</p>
            </div>
        </div>
    </div>
</body>

</html>