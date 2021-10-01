<x-guest-layout>

<script type="module">
        import {
            GLTFLoader

        }from 'https://cdn.skypack.dev/three@0.128/examples/jsm/loaders/GLTFLoader.js';

        (function (three) {
            'use strict';

            const scene = new three.Scene();
            const camera = new three.PerspectiveCamera(
                20,
                window.innerWidth / window.outerHeight,
                0.001,
                1000);

            const renderer = new three.WebGLRenderer();
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.domElement.style.width='500px';
            document.body.appendChild(renderer.domElement);

            camera.position.x = 0;
            camera.position.y = 0.955;
            camera.position.z = 2.525;
            camera.rotation.x = -0.22;
            camera.rotation.y = -0.001;
            camera.rotation.z = 0;

            const light = new three.HemisphereLight(0xFFFFFF, 0x068840, 1);
            scene.add(light);
            renderer.outputEncoding = three.sRGBEncoding;

            let importedScene = null;

            const loader = new GLTFLoader();

            loader.load("{{ Storage::url('public/models/LAKERS/scene.gltf') }}", gltf => {
                importedScene = gltf.scene;
                scene.add(importedScene);
            }, undefined, console.error);

            function animate() {
                requestAnimationFrame(animate);
                if (scene) renderer.render(scene, camera);
            }
            animate();
        }(THREE));

    </script>
    
</x-guest-layout>

