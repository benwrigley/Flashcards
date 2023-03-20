@props(['href','label','click','description'])

<div
    x-on:click="{{$click}}"
    class="p-1 m-2 text-white hover:scale-125 duration-500 lg:text-xl text-sm"
    x-data="{description:false}"
    x-on:mouseover="description = true"
    x-on:mouseleave="description = false"
>

    {{ $slot }}

    <a
        {{ isset($href) ? "href=$href" : '' }}
        onclick="{{isset($href) ? '' : 'return false;'}}"
        {{ $attributes->merge(['class' => 'px-3 py-1 rounded-full uppercase font-semibold']) }}
    >
        {{$label}}
    </a>
    @isset($description)
        <div x-show="description" class="text-xs bg-gray-600 w-1/2 absolute left-1/2 rounded invisible lg:visible">
            {{$description}}
        </div>
    @endisset
</div>
