@push('scripts')
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
@endpush
