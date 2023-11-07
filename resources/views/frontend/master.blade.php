<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comforty - eCommerce HTML template</title>
    @include('frontend.body.style')
    @livewireStyles
</head>


<body class="font-display">

    @include('frontend.body.header')


    {{$slot}}

    @yield('frontend')


    <!-- footer -->

    @include('frontend.body.footer')

    <!-- Vendor JS-->
    @include('frontend.body.scripts')
    @livewireScripts
</body>

</html>