<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Kemplast') }}</title>
    <title>Kemplast</title>
    <!-- Favicon -->
    <link rel="icon"
          href="{{ asset('assets/images/brand-logos/favicon.ico') }}"
          type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/authentication-main.js') }}"></script>

    <!-- Bootstrap Css -->
    <link id="style"
          href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.css') }}"
          rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}"
          rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect"
          href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet" />
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Show Password JS -->
    <script src="{{ asset('assets/js/show-password.js') }}"></script>
    <!-- Scripts -->

</head>

<body class="bg-white">


    {{ $slot }}

</body>

</html>
