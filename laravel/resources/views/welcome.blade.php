<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://unpkg.com/@googlemaps/js-api-loader@1.0.0/dist/index.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.js" integrity="sha512-NLtnLBS9Q2w7GKK9rKxdtgL7rA7CAS85uC/0xd9im4J/yOL4F9ZVlv634NAM7run8hz3wI2GabaA6vv8vJtHiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @stack('css')

    </head>
    <body style="width: 100vw; height: 100vh">

        <div id="map" class="container" style="width: 100%; height: 100%"></div>

        <x-main_modal />


        <x-berkut_map />
        @stack('scripts')
    </body>
</html>
