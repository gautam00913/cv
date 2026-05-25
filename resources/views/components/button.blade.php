@props(['cat' => 'button', 'target' => null])
@php
    $class = "border-2 border-primary px-3 py-1 rounded text-secondary transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:bg-primary hover:text-white duration-300 disabled:opacity-25 disabled:cursor-none";
    $tab = [];
    if($target)
        $tab['wire:target'] = $target;
@endphp
@if ($cat === 'button')
    <button {{ $attributes->merge(['class' => $class, 'wire:loading.class.disabled'] + $tab) }}>
        <div class="flex items-center justify-center">
            @if($target)
                <svg wire:target="{{ $target }}" wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            @endif
            {{ $slot }} 
        </div>
    </button>
@else
    <a {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</a>
@endif