<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans bg-bg">
    <div id="app">
        @include('partials.nav')

        <main class="flex align-items-center h-full">
            @include('partials.sidenav')

            <div class="flex-1 pt-20 px-4 h-screen overflow-y-auto">
                @yield('content')
                @for ($i = 0; $i <=1000;$i++)
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt incidunt sunt id minus eveniet neque, necessitatibus amet, exercitationem aspernatur, omnis voluptates earum praesentium. Error quaerat aspernatur animi, ipsa quibusdam blanditiis?</p>
                @endfor
            </div>
        </main>
    </div>
</body>
</html>
