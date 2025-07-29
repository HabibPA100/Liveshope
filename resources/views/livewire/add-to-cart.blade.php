<button 
    wire:click="add" 
    class="{{ $buttonClass }} {{ $isDisabled ? 'bg-gray-400 cursor-not-allowed pointer-events-none' : '' }}"
    >
    Add to <i class="fa-solid fa-cart-shopping"></i>
</button>