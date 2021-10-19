<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,500;0,900;1,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>

    <!-- Ph Locations -->
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
</head>

<body class="bg-custom-black">
    <header class="py-8 text-white font-light text-base flex justify-center items-center w-full">
        <h1 class="py-4 px-10"><a href="#">HOME</a></h1>
        <h1 class="py-4 px-10">ABOUT</h1>
        <h1 class="py-4 px-10">FAQ</h1>
        <img class="py-2 px-12" src="img/Group 12.svg" />
        <h1 class="py-4 px-12">CUSTOMIZE</h1>
        @if (Route::has('login'))
        @auth
        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
        <h1 class="py-4 px-12">@else<a href="{{ route('login') }}">LOGIN</a></h1>
        <h1 class="py-4 px-12"> @if (Route::has('register'))<a href="{{ route('register') }}">REGISTER</a></h1>
        @endif
        @endauth
        @endif

    </header>

    </section>
    {{ $slot }}
    </div>
</body>

</html>
