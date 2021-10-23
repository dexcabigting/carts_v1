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
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,500;0,900;1,700&display=swap"
        rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- three.js -->
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <!-- <script src=""></script> -->
    </head>
    <body class="bg-custom-black">
        <!-- Hamburger -->
    <div class="md:hidden" x-data="{showMenu : false} ">
        <button @click.prevent="showMenu = !showMenu " class="px-2 py-4 flex justify-end pt-8 w-full text-white">
            <svg x-show="!showMenu" class="w-6 h-6 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg x-show="showMenu" class="w-6 h-6 mr-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12"></path></svg>
           
        </button>
        <div x-show="showMenu">
            
            <nav class="flex flex-col">
                <a href="#" class="px-2 py-4 text-white bg-custom-blacki flex justify-between w-full border-b border-custom-text hover:text-gray-200 hover:bg-custom-violet">
                    HOME
                    <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7"></path></svg>    
                </a>
                <a href="#" class="px-2 py-4 text-white bg-custom-blacki flex justify-between w-full border-b border-custom-text hover:text-gray-200 hover:bg-custom-violet">
                    ABOUT
                    <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7"></path></svg>    
                </a>
                <a href="#" class="px-2 py-4 text-white bg-custom-blacki flex justify-between w-full border-b border-custom-text hover:text-gray-200 hover:bg-custom-violet">
                    FAQ
                    <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7"></path></svg>    
                </a>
                <a href="#" class="px-2 py-4 text-white bg-custom-blacki flex justify-between w-full border-b border-custom-text hover:text-gray-200 hover:bg-custom-violet">
                CUSTOMIZE
                    <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7"></path></svg>    
                </a>
                @if (Route::has('login'))
      @auth
      @else<a href="{{ route('login') }}" class="px-2 py-4 text-white bg-custom-blacki flex justify-between w-full border-b border-custom-text hover:text-gray-200 hover:bg-custom-violet">
                    LOGIN
                    <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7"></path></svg>    
                </a>
                @if (Route::has('register'))
                <a  href="{{ route('register') }}" class="px-2 py-4 text-white bg-custom-blacki flex justify-between w-full border-b border-custom-text hover:text-gray-200 hover:bg-custom-violet">
                   REGISTER
                    <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7"></path></svg>    
                </a>
                @endif
                    @endauth
                    @endif
            </nav>
        </div>
        </div>
    <!-- .bg-blue-500 -->
    <header class="flex py-8 text-white font-light text-base justify-center items-center w-full">
      <h1 class="hidden sm:block  py-4 px-10"><a href="index.html">HOME</a></h1>
      <h1 class="hidden sm:block  py-4 px-10">ABOUT</h1>
      <h1 class="hidden sm:block  py-4 px-10">FAQ</h1>
      
        
      <img class="hidden sm:block py-2 px-12 h-40 w-40 -mt-24 md:h-auto md:w-auto md:mt-0 " src="img/Group 12.svg" />
     
    
      <h1 class="hidden sm:block py-4 px-12">CUSTOMIZE</h1>
      
      @if (Route::has('login'))
      @auth
                        <a  href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
      <h1 class="hidden sm:block py-4 px-12">@else<a class="hidden sm:block" href="{{ route('login') }}">LOGIN</a></h1>
      <h1 class="hidden sm:block py-4 px-12"> @if (Route::has('register'))<a href="{{ route('register') }}">REGISTER</a></h1>
      @endif
                    @endauth
                    @endif
                    
    </header>
  
    </section>
            {{ $slot }}
        </div>
    </body>
</html>
