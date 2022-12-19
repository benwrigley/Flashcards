@props(['trigger'])

<div x-data="{show : false}">

    <div @click="show = ! show" >
        {{ $trigger }}
    </div>

    <div x-show="show" class="py-2 absolute rounded-xl w-full z-50 overflow-auto max-h-52 mt-2 bg-gray-100" style="display: none">

        {{ $slot }}

    </div>
</div>
