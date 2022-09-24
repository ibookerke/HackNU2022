<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <script src="https://unpkg.com/@googlemaps/js-api-loader@1.0.0/dist/index.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.js" integrity="sha512-NLtnLBS9Q2w7GKK9rKxdtgL7rA7CAS85uC/0xd9im4J/yOL4F9ZVlv634NAM7run8hz3wI2GabaA6vv8vJtHiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body style="width: 100vw; height: 100vh">
        <div id="map" style="width: 100%; height: 100%"></div>
        <script>
            const apiOptions = {
                apiKey: 'AIzaSyAIWHrDVstufAUU7oYtTMvAeUkFF0muki8',
                version: 'beta',
            };

            const mapOptions = {
                tilt: 0,
                heading: 20,
                zoom: 18.6,
                center: { lat: 51.127991376189974, lng: 71.42366247642266 },
                mapId: '53d3134b5ce0578e',
            };

            async function initMap() {
                const mapDiv = document.getElementById('map');
                const apiLoader = new google.maps.plugins.loader.Loader(apiOptions);
                await apiLoader.load();
                return new google.maps.Map(mapDiv, mapOptions);
            }

            const WIDTH = 70;
            const LENGTH = 105;
            const HEIGHT = 11;
            // const ROTATION = -Math.PI / 12;
            const ROTATION = 0;
            const INITIAL_POS = { x: 0, y: 18, z: -50 + HEIGHT / 2 };

            const Cube = (level, color) => {
                const geometry = new THREE.BoxGeometry(WIDTH, LENGTH, HEIGHT);
                const material = new THREE.MeshBasicMaterial({
                    color,
                    opacity: 0.1,
                    transparent: true,
                });

                const cube = new THREE.Mesh(geometry, material);
                cube.rotation.z = ROTATION;
                cube.position.z = INITIAL_POS.z + level * HEIGHT;
                cube.position.y = INITIAL_POS.y;
                // cube.position.z = INITIAL_POS.z + level * HEIGHT + level * 10;
                return cube;
            };

            const CUBIK_NUM_X = 10;
            const CUBIK_NUM_Y = 10;
            const CUBIK_INITIAL = {
                x: INITIAL_POS.x - WIDTH / 2 + WIDTH / (10 * 2),
                // x: WIDTH / 2 + INITIAL_POS.x + WIDTH / 10,
                y: INITIAL_POS.y - LENGTH / 2 + LENGTH / (10 * 2),
                // y: INITIAL_POS.y,
                z: INITIAL_POS.z,
            };

            function findXYrotations() {
                const radius = Math.sqrt(
                    (Math.pow(WIDTH, 2) + Math.pow(HEIGHT, 2)) / 2
                );
                const stick = radius * Math.sin(ROTATION) * 2;
            }

            const Cubik = ({ x, y, z }, density) => {
                const geometry = new THREE.BoxGeometry(
                    WIDTH / CUBIK_NUM_X,
                    LENGTH / CUBIK_NUM_Y,
                    HEIGHT
                );

                const material = new THREE.MeshBasicMaterial({
                    color: 0xff0000,
                    opacity: density,
                    transparent: true,
                });

                const cube = new THREE.Mesh(geometry, material);
                cube.rotation.z = ROTATION;
                console.log(x);
                cube.position.x = CUBIK_INITIAL.x + (x * WIDTH) / CUBIK_NUM_X;
                cube.position.y = CUBIK_INITIAL.y + (y * LENGTH) / CUBIK_NUM_Y;
                cube.position.z = CUBIK_INITIAL.z + z * HEIGHT;
                // cube.position.y = 30;
                // cube.position.y = CUBIK_INITIAL.y;
                // cube.position.z = 30;
                // cube.position.z = INITIAL_POS.z + level * HEIGHT + level * 10;
                return cube;
            };

            const cubes = [0x00ff00, 0x00ff00, 0x00ff00, 0x00ff00].map(
                (color, num) => Cube(num, color)
            );

            const python_range = (num) => Array.from(Array(num).keys());

            const cubiks_layers = python_range(10).map((e, i) =>
                python_range(10).map((ee, ii) =>
                    python_range(10).map((eee, iii) =>
                        Cubik({ x: iii, y: ii, z: i }, Math.max(Math.random() - 0.6, 0))
                    )
                )
            );

            function initWebGLOverlayView(map) {
                let scene, renderer, camera, loader;
                // WebGLOverlayView code goes here
                const webGLOverlayView = new google.maps.WebGLOverlayView();
                webGLOverlayView.onAdd = () => {
                    scene = new THREE.Scene();
                    camera = new THREE.PerspectiveCamera();
                    const ambientLight = new THREE.AmbientLight(0xffffff, 0.75);
                    scene.add(ambientLight);
                    const directionalLight = new THREE.DirectionalLight(
                        0xffffff,
                        0.25
                    );
                    directionalLight.position.set(0.5, -1, 0.5);
                    scene.add(directionalLight);
                    // cubes.map((cube) => {
                    //   scene.add(cube);
                    // });
                    cubiks_layers.map((e, i) => {
                        e.map((ee, ii) =>
                            ee.map((eee, iii) => {
                                // console.log(eee);
                                scene.add(eee);
                            })
                        );
                    });
                };
                webGLOverlayView.onContextRestored = ({ gl }) => {
                    renderer = new THREE.WebGLRenderer({
                        canvas: gl.canvas,
                        context: gl,
                        ...gl.getContextAttributes(),
                    });

                    renderer.autoClear = false;

                    renderer.setAnimationLoop(() => {
                        map.moveCamera({
                            tilt: mapOptions.tilt,
                            heading: mapOptions.heading,
                            zoom: mapOptions.zoom,
                        });
                        if (mapOptions.tilt < 67.5) {
                            mapOptions.tilt += 0.5;
                        } else if (mapOptions.heading <= 360) {
                            mapOptions.heading += 1;
                        } else {
                            renderer.setAnimationLoop(null);
                        }
                    });
                };
                webGLOverlayView.onDraw = ({ gl, transformer }) => {
                    webGLOverlayView.requestRedraw();
                    renderer.render(scene, camera);
                    renderer.resetState();
                    const latLngAltitudeLiteral = {
                        lat: mapOptions.center.lat,
                        lng: mapOptions.center.lng,
                        altitude: 50,
                    };
                    const matrix = transformer.fromLatLngAltitude(
                        latLngAltitudeLiteral
                    );
                    camera.projectionMatrix = new THREE.Matrix4().fromArray(matrix);
                };
                webGLOverlayView.setMap(map);
            }

            (async () => {
                const map = await initMap();
                initWebGLOverlayView(map);
            })();
        </script>
    </body>
</html>
