@props(['topic','ancestors'])

{{-- Large screen --}}
<div class="justify-center items-baseline w-2/3 hidden lg:flex">

    <x-topic.button href="/" label="Main Topics" click="" />

    @if (isset($ancestors))
        @foreach($ancestors as $ancestor)
            &nbsp;//&nbsp;
            <x-topic.button :href="'/topics/' . $ancestor->slug" :label="$ancestor->name" click=''/>
        @endforeach
    @endif


</div>

{{-- Small Screen --}}
<div class="relative w-1/3 lg:hidden text-center" x-data="{ open: false }" x-on:click.outside="open = false" x-on:click="open=!open">

    @if(isset($topic))
        <div class="flex items-center justify-center">
            <x-topic.button label="{{$topic->name}}" click="" />
            @include('icons.chevrondown',['width' => 10, 'height' => 10])
        </div>

        @if(isset($ancestors))
            <div class="bg-gray-800 absolute text-center w-full" x-show="open" style="display:none">

                @foreach($ancestors->reverse()->skip(1) as $ancestor)
                    <div class="block">
                        <x-topic.button :href="'/topics/' . $ancestor->slug" :label="$ancestor->name" click=''/>
                    </div>
                @endforeach

                <div class="block">
                    <x-topic.button href="/" label="Main Topics" click=''/>
                </div>


            </div>
        @endif
        {{-- <button x-on:click="open = !open">
          {{ $topic->name }}
        </button> --}}
    @else
        <x-topic.button href="/" label="Main Topics" click="" />
    @endif

</div>
