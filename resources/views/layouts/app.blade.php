<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @routes

    <script>
        window.App = {!!  json_encode([
            'currentUser' => auth()->user(),
            'signedIn' => auth()->check(),
        ]) !!}
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        @include('layouts.partials.nav')

        <main class="py-4">
            @yield('content')
        </main>

        <flash :timeout="5000" :display-icons="true" transition="fade"></flash>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

    @if (session()->has('flash'))
        <script>
            flash('{{ session('flash') }}', '{{ session('flashType') }}');
        </script>
    @endif
</body>
</html>
