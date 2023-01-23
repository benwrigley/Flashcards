@props(['href','label','click'])

<div x-on:click="{{$click}}" class="p-1 m-2 text-white">

    {{ $slot }}

    <a
        href="{{$href}}"
        onclick="{{isset($href) ? '' : 'return false;'}}"
        {{ $attributes->merge(['class' => 'px-3 py-1 rounded-full uppercase font-semibold hover:text-blue-200']) }}
    >
        {{$label}}
    </a>
</div>
