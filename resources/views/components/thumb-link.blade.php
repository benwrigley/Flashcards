@props(['icon','href'])

<a href="{{ $href}} ">
    @if ($icon === "up")
        @include('icons/thumbsup', ['width' => 30, 'height' => 30])
    @else
        @include('icons/thumbsdown', ['width' => 30, 'height' => 30])
    @endif
</a>
