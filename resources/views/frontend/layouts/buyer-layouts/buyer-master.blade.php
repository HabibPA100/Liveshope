<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @include('frontend.layouts.components.meta')
    @stack('style')
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-100 ">
    @include('frontend.layouts.buyer-layouts.header')

    <main>
        <div class="container max-w-[1300px] mx-auto">
            @yield('content')
        </div>
    </main>


    @include('frontend.layouts.buyer-layouts.footer')


    @stack('scripts')
    @livewireScripts
    @include('frontend.layouts.components.sweet-alert')
    @include('frontend.layouts.components.js')
</body>
</html>