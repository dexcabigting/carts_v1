<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>C.A.R.T.S</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
         <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,500;0,900;1,700&display=swap"
        rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>
         <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        <style>
            body {
                font-family: 'Raleway', serif;
            }
        </style>
    </head>
    <body class="bg-custom-black">
      
    <section class="g-gradient-to-r from-custom-black via-custom-blacki to-custom-black pb-28 md:h-screen">
    <!-- Hamburger -->
    <div class="md:hidden pb-12" x-data="{showMenu : false} ">
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
      
        
      <img class="sm:block py-2 px-12 h-40 w-40 -mt-24 md:h-auto md:w-auto md:mt-0 " src="img/Group 12.svg" />
     
    
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
    <div class="relative flex justify-center items-center">
      <button
        class="hover:bg-purple-900 hover:text-purple-100 text-4xl font-semibold text-white px-12 py-6 absolute md:bottom-24 -bottom-16 bg-custom-violet">SHOP
        NOW</button>
        <div class="contents">
      <img class=" w-2/3 sm:w-1/2 h-auto -mr-10" src="../img/Group 18.png" alt="">
      </div>
    </div>
  </section>
       
        

            <div class="relative flex justify-center items-center py-24">
    <h1 class="absolute md:text-2xl top-36 md:top-48 text-gray-100 text-center w-1/2">EJ EZON SPORTSWEAR IS A CLOTHING LINE MAINLY
      FOCUS ON
      CREATING <span class="underline">QUALITY</span> BASKETBALL JERSEY. </h1>
    <h1 class="text-7xl md:text-9xl text-custom-text font-extrabold  top-2">ABOUT</h1>
        </div>
  <div class="flex-row flex justify-center items-center">
    <img class="hidden sm:block md:w-1/3 md:ml-64" src="img/Group 5.svg" alt="">
    <div class="flex justify-center items-center">
      <div class="flex flex-col mx-12 md:mx-32">
        <img class="w-10 h-10" src="img/Rectangle 6.svg" alt="">
        <h1 class="text-gray-100 text-2xl md:text-4xl font-semibold my-2">What's inside?</h1>
        <p class="text-gray-100 md:text-2xl md:w-2/3 my-4">The best of the best quality precision crafted
          by the experts for professional basketball players.</p>
        <div class="flex flex-col md:mx-8">

          <div class="flex-row flex my-6">
            <img class="w-14 h-14 md:w-24 md:h-24" src="img/mico.svg" alt="">
            <div class="flex flex-col my-1 mx-7">
              <h1 class="font-semibold text-2xl text-gray-100">Microfiber</h1>
              <p class="w-full text-md text-gray-100">as the name suggests, is a material
                made of fine tiny thread fibers with a linear
                density of not more than one denier. </p>
            </div>
          </div>

          <div class="flex-row flex my-6">
            <img class="w-14 h-14 md:w-24 md:h-24" src="img/poly.svg" alt="">
            <div class="flex flex-col my-1 mx-7">
              <h1 class="font-semibold text-2xl text-gray-100">Polyester</h1>
              <p class="w-full text-md text-gray-100">A cloth made out of plastic fibers making it light-weight,
                wrinkle-free, long lasting and breathable. </p>
            </div>
          </div>

          <div class="flex-row flex my-6">
            <img class="w-14 h-14 md:w-24 md:h-24" src="img/x.svg" alt="">
            <div class="flex flex-col my-1 mx-7">
              <h1 class="font-semibold text-2xl text-gray-100">X- Static</h1>
              <p class="w-full text-md text-gray-100">Silver is a metal with anti-bacterial properties that prevents
                the accumulation of bacteria and fungus. X-Static sportswear is,
                therefore, clean and free of odor even after excessive use.</p>
            </div>

          </div>

        </div>
        <button
          class="hover:bg-purple-900 hover:text-purple-100 text-4xl font-semibold text-white px-2 py-6 uppercase bg-custom-violet">Get
          yours now</button>
      </div>

    </div>
  </div>
  <section class=" md:mx-0 relative flex justify-center items-center py-24">
    <div class="absolute top-44 md:left-64">
      <p class="md:text-2xl text-gray-100 md:text-left text-center font-semibold">CUSTOMIZE YOUR JERSEY, WEAR IT AND</p>
      <h1 class="text-7xl md:text-9xl text-gray-100 font-extrabold">BE A WINNER</h1>
    </div>

    <h1 class="text-7xl md:text-9xl text-custom-text font-extrabold  top-2">CUSTOMIZE</h1>
  </section>
  <div class="flex flex-col justify-center items-center">
    <img class="w-1/2" src="img/Group 15.png" alt="">
    <button
      class="hover:bg-purple-900 hover:text-purple-100 text-2xl md:text-4xl font-semibold text-white my-12 px-10 py-6 uppercase bg-custom-violet">CUSTOMIZE
      YOURS NOW</button>
  </div>
  <section class="relative flex justify-center items-center my-24">
    <h1 class="text-7xl md:text-9xl text-custom-text font-extrabold  top-2">SHOP NOW</h1>
    <img class="w-1/2 absolute top-12" src="img/Group 19.png" alt="">
  </section>
  <div class="relative md:h-screen">
    <div class="absolute left-16 md:right-3 top-32 md:top-64">
      <div class="flex flex-col justify-center items-center">
        <p class="text-2xl text-gray-100 text-left font-semibold">CHOOSE WHAT YOU WEAR</p>
        <h1 class="text-5xl md:text-9xl text-gray-100 font-extrabold">VISIT OUR SHOP</h1>

        <button
          class="my-12 hover:bg-purple-900 hover:text-purple-100 text-4xl font-semibold text-white px-12 py-6 uppercase bg-custom-violet">SHOP
          NOW</button>
      </div>
    </div>

  </div>
    </body>
    <footer class="relatve w-full pt-96 md:pt-0 md:bg-no-repeat md:bg-contain flex justify-center items-center"
  style="background-image: url('img/Rectangle 11.png');">
  <div class="flex flex-row">
    <div class="flex flex-col mr-32">
      <ul class="text-gray-100">
        <h1 class="font-semibold text-2xl">CONTENTS</h1>
        <div class="font-md">
          <li class="py-4 font-semibold">HOME</li>
          <li class="py-4 font-semibold">ABOUT</li>
          <h1 class="py-4 font-semibold">PRODUCTS</h1>
          <li class="py-4 font-semibold">CUSTOMIZE</li>

        </div>
      </ul>

    </div>
    <div class="flex flex-col mx-24">
      <ul class="text-gray-100">
        <h1 class="font-semibold text-2xl">BE A MEMBER</h1>
        <div class="font-md">
          <li class="py-4 font-semibold">LOGIN</li>
          <li class="py-4 font-semibold">REGISTER</li>

        </div>
      </ul>

    </div>
    <div class="flex flex-col mx-32">
      <ul class="text-gray-100">
        <h1 class="font-semibold text-2xl">CONTACT</h1>
        <div class="font-md">
          <li class="py-4">example@gmail.com</li>
          <li></li>
          <li></li>
        </div>
      </ul>

    </div>

    <img class="w-12 h-12 hover:bg-gray-200 fill-current ml-32" src="img/Icon awesome-facebook-square.svg" alt="">
  </div>
  <div class="py-24 flex flex-col justify-center items-center text-gray-100">
    <h1>Copyright by EJ SPORTS JERSEY 2020</h1>
    <h1 class="py-4">All Rights Reserved</h1>
  </div>
</footer>
</html>
