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
    <!-- Alpine -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
   

    <!-- Ph Locations -->
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
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
        </main>
    </div>
    @livewireScripts
</body>
<script>
window.onload = function() {

let slider = document.querySelector('#slider');
let move = document.querySelector('#move');
let moveLi = Array.from(document.querySelectorAll('#slider #move li'));
let forword = document.querySelector('#slider #forword');
let back = document.querySelector('#slider #back');
let counter = 1;
let time = 3000;
let line = document.querySelector('#slider #line');
let dots = document.querySelector('#slider #dots');
let dot;

for (i = 0; i < moveLi.length; i++) {

    dot = document.createElement('li');
    dots.appendChild(dot);
    dot.value = i;
}

dot = dots.getElementsByTagName('li');

line.style.animation = 'line ' + (time / 1000) + 's linear infinite';
dot[0].classList.add('active');

function moveUP() {

    if (counter == moveLi.length) {

        moveLi[0].style.marginLeft = '0%';
        counter = 1;

    } else if (counter >= 1) {

        moveLi[0].style.marginLeft = '-' + counter * 100 + '%';
        counter++;
    } 

    if (counter == 1) {

        dot[moveLi.length - 1].classList.remove('active');
        dot[0].classList.add('active');

    } else if (counter > 1) {

        dot[counter - 2].classList.remove('active');
        dot[counter - 1].classList.add('active');

    }

}

function moveDOWN() {

    if (counter == 1) {

        moveLi[0].style.marginLeft = '-' + (moveLi.length - 1) * 100 + '%';
        counter = moveLi.length;
        dot[0].classList.remove('active');
        dot[moveLi.length - 1].classList.add('active');

    } else if (counter <= moveLi.length) {

        counter = counter - 2;
        moveLi[0].style.marginLeft = '-' + counter * 100 + '%';   
        counter++;

        dot[counter].classList.remove('active');
        dot[counter - 1].classList.add('active');

    }  

}

for (i = 0; i < dot.length; i++) {

    dot[i].addEventListener('click', function(e) {

        dot[counter - 1].classList.remove('active');
        counter = e.target.value + 1;
        dot[e.target.value].classList.add('active');
        moveLi[0].style.marginLeft = '-' + (counter - 1) * 100 + '%';

    });

}

forword.onclick = moveUP;
back.onclick = moveDOWN;

let autoPlay = setInterval(moveUP, time);

slider.onmouseover = function() {

    autoPlay = clearInterval(autoPlay);
    line.style.animation = '';

}

slider.onmouseout = function() {

    autoPlay = setInterval(moveUP, time);
    line.style.animation = 'line ' + (time / 1000) + 's linear infinite';

}

}

</script>

</html>
