<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Surfside Media</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.ico">
    @include('frontend.body.style')
    @livewireStyles
</head>

<body>

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