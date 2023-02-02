@props(['href','label','click'])

<div x-on:click="{{$click}}" class="p-1 m-2 text-white hover:scale-125 duration-500">

    {{ $slot }}

    <a
        href="{{$href}}"
        onclick="{{isset($href) ? '' : 'return false;'}}"
        {{ $attributes->merge(['class' => 'px-3 py-1 rounded-full uppercase font-semibold']) }}
    >
        {{$label}}
    </a>
</div>
