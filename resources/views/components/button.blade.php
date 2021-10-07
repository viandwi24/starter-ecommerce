@php
    if (!isset($tag)) $tag = 'button';
    if (!isset($size)) $size = 'md';
    if (!isset($color)) $color = 'primary';
@endphp

<button
    class="
        {{ generate_class('button') }}
        {{ $color }}
        {{ $size }}
    "
>
    @if(isset($text))
        {{ $text }}
    @else
        {!! $slot !!}
    @endif
</button>
