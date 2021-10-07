@php
    // generate default values
    if (!isset($navbar)) $navbar = true;
    if (!isset($footer)) $footer = true;
    if (!isset($title)) $title = '';

    //
    $titleTemplate = '%s - ' . config('app.name');

    // set title
    $title = ($title === '') ? config('app.name') : sprintf($titleTemplate, $title);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <!-- Styles -->
    @stack('styles:start')
    @if (app()->environment() === 'production')
        <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @else
        <link rel="stylesheet" href="{{ mix('css/vendor.css') }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @endif
    @stack('styles')
</head>
<body>
    <!-- App -->
    <div id="app">
        @if ($navbar) <x-navbar /> @endif
        <main class="my-4">
            @yield('content')
        </main>
        @if ($footer) <x-footer /> @endif
    </div>
    <!-- Scripts -->
    @stack('scripts:start')
    @if (app()->environment() === 'production')
        <script src="{{ asset('js/app.js') }}"></script>
    @else
        <script src="{{ mix('js/app.js') }}"></script>
    @endif
    @stack('scripts')
</body>
</html>
