@props(['name','selected'])
<div class="flex justify mb-2">
    @foreach([
        'bg-blue-300',
        'bg-purple-400',
        'bg-red-400',
        'bg-green-400',
        'bg-yellow-400',
        'bg-gray-600',
        'bg-pink-400'
        ] as $color)
        <div class="rounded ml-2 p-2 hover:bg-gray-200 {{ $color }}" x-on:click="color = '{{ $color }}'">
            <input type="radio" value="{{ $color }}" name="{{ $name }}" {{ (isSet($selected) && ($selected === $color)) ? 'checked' : ''  }}>
        </div>
    @endforeach
</div>

