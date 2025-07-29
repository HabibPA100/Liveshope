@extends('frontend.layouts.master')

@section('title', 'Live Shope')

@section('content')

    {{-- Slider --}}
    @include('frontend.layouts.components.slider')

    {{-- Livewire Components --}}
    <livewire:other-product-show />
    <livewire:gift-cart-show />
    <livewire:all-product-show />
    <livewire:panjabi-show />
    
    {{-- Product List --}}
  
     <div class="max-w-7xl mx-auto px-4 py-10">
        <h2 class="text-3xl font-bold text-center mb-8 text-indigo-700">📂 সকল ক্যাটেগরি</h2>

        <div class="bg-white shadow-xl rounded-xl p-6 space-y-3">
            <ul class="space-y-2">
                @foreach ($categories as $category)
                    @include('frontend.partials.category-dropdown', ['category' => $category, 'level' => 0])
                @endforeach
            </ul>
        </div>
    </div>
    {{-- Scripts --}}
    @push('scripts')
        <script src="{{ asset('frontend/js/index.js') }}"></script>
        <script src="{{ asset('frontend/js/alpin-for-add-to-card.js') }}"></script>
    @endpush
@endsection
