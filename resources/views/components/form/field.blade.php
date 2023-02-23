@props([
    'id',
    'type',
    'placeholder',
    'value',
    'size',
    'length',
    'required'])

{{-- <div class="mb-4 w-4/6"> --}}
    <input class="border border-gray-400 p-2 text-gray-700 rounded text-sm lg:text-xl w-full"
            type = "{{$type}}"
            id = "{{$id}}"
            name= "{{$id}}"
            maxlength ="{{ $length ?? 20}}"
            size= "{{$size ?? 20}}"
            placeholder = "{{$placeholder}}"
            value="{{ $value }}"
            {{ $required ?? '' }}
    >
    @error($id)
        <p class="text-red-700 text-sm lg:text-xl lg:p-2 mb">{{ $message }}</p>
    @enderror
{{-- </div> --}}
