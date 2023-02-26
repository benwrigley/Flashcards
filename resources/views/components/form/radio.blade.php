@props(['list','name','select' => null,'class' => null,'click' => null])

@foreach($list as $item)
    <div class="mx-1 rounded-full text-xl lg:text-3xl" x-on:click="{{ $click }}">

        <input type="radio" id="{{$item}}" name="{{$name}}" value="{{$item}}" class="peer hidden" {{strval($item) === strval($select) ? 'checked' : ''}}>
        <label for="{{$item}}" class="peer-checked:bg-blue-500 select-none p-2 rounded-full bg-gray-700 hover:bg-gray-600 ring ring-gray-500 {{$class ?? ''}} text-xl">{{$item}}</label>

    </div>
@endforeach
