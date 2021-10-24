<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app-user.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,500;0,900;1,700&display=swap"
        rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        @livewireStyles
    </head>
    <body class="font-Raleway antialiased bg-custom-text">
        <div>       
         

            <!-- Page Heading -->
            @livewireScripts

            <!-- Page Content -->
            <main class= "bg-custom-black">
            <div class="flex-shrink flex">
            @include('layouts.navigation')
                {{ $slot }}
              
            </main>
           
            </div>
        </div>
       
    
    </body>
    <footer class="mt-12">
        <div class="flex justify-center items-center">
        <h1 class="text-xs text-white font-light">Copyright by EJ SPORTSWEAR 2021</h1>
        </div>
    </footer>   
</html>
