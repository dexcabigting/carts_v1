<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'C.A.R.T.S') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,500;0,900;1,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Alpine -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>

<style>

#slider {
	position: relative;
	width: 100%;
	overflow: hidden;
}

#slider #line {
	height: 1px;
	background: rgba(0,0,0,0.5);
	z-index: 1;
	position: absolute;
	bottom: 0;
	right: 0;
}

#slider #dots {
	position: absolute;
	left: 0;
	right: 0;
	bottom: 16px;
	display: flex;
	justify-content: center;
}

#slider #dots li {
	transition: 0.9s;
	list-style-type: none;
	width: 12px;
	height: 2px;
	border-radius: 100%;
	background: rgba(0,0,0,0.5);
	margin: 0 0.25em;
	cursor: pointer;
}

#slider #dots li:hover,
#slider #dots li.active {
	background: white;
}

@keyframes line {

	0% {width: 0%;}
	100% {width: 100%;}

}

#slider #back,
#slider #forword {
	width: 6%;
	display: flex;
	justify-content: center;
	align-items: center;
	opacity: 0;
	transition: 0.9s;
	cursor: pointer;
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	color: white;
	font-weight: 700;
    font-size: 2rem;
	
}

#slider #forword {
	left: auto;
	right: 0;
	
}

#slider:hover #back,
#slider:hover #forword {
	opacity: 0.7;
}

ul#move {
	margin: 0;
	padding: 0;
	display: flex;
	width: 100%;
	background: #171717;
	margin-right: 100%;
}


ul#move li {
	transition: 0.6s;
	min-width: 100%;
	color: white;
	list-style-type: none;
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
}

ul#move li img {
	width: 100%;
    height: 75%;
}

ul#move li:nth-child(1) {
	background: #171717;
}

ul#move li:nth-child(2) {
	background: #171717;
}

ul#move li:nth-child(3) {
	background: #171717;
}

ul#move li:nth-child(4) {
	background: #171717;
}

ul#move li:nth-child(5) {
	background: #171717;
}
</style>

    @livewireStyles
</head>

<body class="font-Raleway antialiased bg-custom-black">
    <div>
        @include('layouts.user-navigation')

        <!-- Page Heading -->


        <!-- Page Content -->
        <main class="bg-custom-black">
            {{ $slot }}

            <div>
                @yield('content')
            </div>
        </main>
    </div>
    @livewireScripts
</body>


</html>
