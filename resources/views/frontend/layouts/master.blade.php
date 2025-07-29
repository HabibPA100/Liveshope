<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @include('frontend.layouts.components.meta')
    @yield('head')
    @stack('style')
    @livewireStyles
</head>
<body class="min-h-[200vh] bg-gray-100 ">
    <header>
        @include('frontend.layouts.header')
    </header>

    <main>
        <div class="container max-w-[1300px] mx-auto">
            @yield('content')
        </div>
    </main>

    <footer>
        @include('frontend.layouts.footer')
        @include('frontend.layouts.components.sm_nav')
    </footer>

    @stack('scripts')
    @livewireScripts
    @include('frontend.layouts.components.sweet-alert')
    @include('frontend.layouts.components.js')
</body>
</html>