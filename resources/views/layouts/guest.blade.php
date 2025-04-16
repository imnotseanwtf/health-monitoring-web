<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite('resources/sass/app.scss')
</head>

<body>
    <main>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center" style="background:  linear-gradient(90deg, rgba(0, 120, 166, 0.7), rgba(93, 224, 230, 0.7), rgba(0, 120, 166, 0.7));">
            @yield('content')
        </section>
    </main>
</body>

</html>
