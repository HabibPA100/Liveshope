<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @include('frontend.layouts.components.meta')
    <link rel="stylesheet" href="{{ asset('frontend/css/right-slider.css') }}">
    @stack('style')
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-100 ">
    <main>
        {{ $slot }}
    </main>


    @include('frontend.layouts.components.js')
    @stack('scripts')
    @livewireScripts
</body>
</html>