@props(['label'])

<div class="flex flex-col">
    <label class="mb-1 font-semibold">{{ $label }}</label>
    <textarea {{ $attributes->merge(['class' => 'border rounded px-3 py-2']) }}></textarea>
    @error($attributes->wire('model')->value)
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>
