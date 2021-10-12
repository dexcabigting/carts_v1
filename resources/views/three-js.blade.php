<x-guest-layout>

<script src="https://unpkg.com/three@0.87.1/examples/js/controls/OrbitControls.js"></script>
<script type="module">
        import {GLTFLoader}from 'https://cdn.skypack.dev/three@0.128/examples/jsm/loaders/GLTFLoader.js';
        //import {OrbitControls}from 'https://cdn.skypack.dev/three@0.128/examples/jsm/controls/OrbitControl.js';
        //import threeJs from 'https://cdn.skypack.dev/three.js';

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
            renderer.domElement.style.width='1500px';
            document.body.appendChild(renderer.domElement);
            renderer.setClearColor('rgb(255,255,255)');

            camera.position.x = 0;
            camera.position.y = 6;
            camera.position.z = 5;

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

            loader.load("{{ asset('images/models/cleveland.gltf') }}", gltf => {
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
        }(THREE));

    </script>
    
</x-guest-layout>

