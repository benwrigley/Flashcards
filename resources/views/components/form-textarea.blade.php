@props(['id','type','placeholder','value','required','rows'])

<div class="mb-4 w-4/6">

    <textarea
        class="border border-gray-400 p-2 w-full text-gray-700 rounded text-sm md:text-xl"
        name="{{ $id }}"
        id="{{ $id }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
    >{{ $value  }}</textarea>
    @error($id)
        <p class="text-red-700 p-2 mb">{{ $message }}</p>
    @enderror
</div>
