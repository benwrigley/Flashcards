@props(['href','label','click'])

<div class="mb-3 flex justify-center" x-on:click="{{$click}}">

    {{ $slot }}

    <a
        href="{{$href}}"
        onclick="{{isset($href) ? '' : 'return false;'}}"
        {{ $attributes->merge(['class' => 'px-3 py-1 rounded-full uppercase font-semibold hover:text-blue-200']) }}
    >
        {{$label}}
    </a>
</div>
