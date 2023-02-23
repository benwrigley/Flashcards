@props(['color'])
<div x-data="{ show:true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="text-white fixed bottom-2 lg:bottom-10 right-2 lg:right-10 {{ $color }} p-2 lg:p-5 rounded-2xl">
    <p>{{ $slot }} </p>
</div>

