@props(['xdata','value','label'])

{{-- <button @click="{{$xdata}} = '{{$value}}'"> --}}
<button @click="alert('Hello World!')">
    {{$label}}
</button>
