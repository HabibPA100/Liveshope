<a href="{{ route('buyer.dashboard') }}" class="relative">
    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h14l1-5H8.4M7 13L5.4 6H21M7 13l-1.293 5.293a1 1 0 001.415 1.414L8.828 19M17 21a1 1 0 102 0 1 1 0 00-2 0zm-8 0a1 1 0 102 0 1 1 0 00-2 0z"/>
    </svg>
    @if($count > 0)
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 text-center leading-5">
            {{ $count }}
        </span>
    @endif
    <span>কার্ড</span>
</a>
