@props(['slug','label'])

<div class="mb-3 flex justify-center">

    <a href="{{isset($slug) ? '/topics/' . $slug : '/' }}"
    {{ $attributes->merge(['class' => 'px-3 py-1 rounded-full uppercase font-semibold']) }}
    >{{$label}}</a>
</div>
