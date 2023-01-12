@props(['xdata','value','label'])

<button @click="{{$xdata}} = {{$value}}">
    {{$label}}
</button>
