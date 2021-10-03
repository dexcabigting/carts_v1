<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <script src="https://unpkg.com/three@0.87.1/examples/js/controls/OrbitControls.js"></script>
        <script type="module">
        
            import {GLTFLoader}from 'https://cdn.skypack.dev/three@0.128/examples/jsm/loaders/GLTFLoader.js';
            //import {OrbitControls}from 'https://cdn.skypack.dev/three@0.128/examples/jsm/controls/OrbitControl.js';
            //import threeJs from 'https://cdn.skypack.dev/three.js';

            function render3d(id, fileName, three = THREE) {
                const container3d =  document.getElementById(id);
                const scene = new three.Scene();
                const camera = new three.PerspectiveCamera(
                    20,
                    container3d.offsetWidth/container3d.offsetHeight,
                    0.001,
                    1000);

                const renderer = new three.WebGLRenderer();
                renderer.setSize(container3d.offsetWidth, container3d.offsetHeight);
                container3d.appendChild(renderer.domElement);
                renderer.setClearColor('rgb(255,255,255)');

                camera.position.x = 0;
                camera.position.y = 4;
                camera.position.z = 2.5;

                camera.lookAt(new THREE.Vector3(0, 0, 0));
                // camera.rotation.x = -0.22;
                // camera.rotation.y = -0.001; 
                // camera.rotation.z = 0;

                const controls = new THREE.OrbitControls(camera);
                controls.enableRotate = true;
                //controls.enablePan = false;
                //controls.enableDamping = true;
                controls.minPolarAngle = 1.3;
                controls.maxPolarAngle = 1.6;
                controls.enableZoom = false;
                //controls.dampingFactor = 0.05;

                const light = new three.HemisphereLight(0xFFFFFF, 0x068840, 1);
                scene.add(light);
                renderer.outputEncoding = three.sRGBEncoding;

                let importedScene = undefined;
                const loader = new GLTFLoader();

                loader.load(fileName, gltf => {
                    importedScene = gltf.scene.children[0];
                    //importedScene.scale.set(150,150,150);
                    //importedScene.position.set(0, -500, -800);

                    scene.add(importedScene);
                    animate();
                }, undefined, console.error);

                function animate() {

                    requestAnimationFrame(animate);
                    if (scene) renderer.render(scene, camera);
                }
                animate();
            }
            window.render3d = render3d;
        </script>
        @livewireStyles
    </head>
    <body class="font-sans antialiased z-0">
        <div class="min-h-screen bg-gray-200">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
