@props(['cat' => 'button'])
@php
    $class = "border-2 border-primary px-3 py-1 rounded text-secondary transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:bg-primary hover:text-white duration-300";
@endphp
@if ($cat === 'button')
    <button {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</button>
@else
    <a {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</a>
@endif