@props(['flashcards'])

@if ($flashcards->count() > 0)
    <div class="grid grid-cols-12">
        <div class="col-span-8"> </div>
        <div class="col-span-1 flex justify-center">
            @include('icons/thumbsup', ['width' => 30, 'height' => 30])
        </div>
        <div class="col-span-1 flex justify-center">
            @include('icons/thumbsdown', ['width' => 30, 'height' => 30])
        </div>
        <div class="col-span-2"></div>


        @foreach ($flashcards as $flashcard)

            <div class="italic col-span-8 text-left">
                '{{ Str::limit($flashcard->question, $limit = 50, $end = '...') }}'
            </div>
            <div class="col-span-1 text-center">
                {{$flashcard->correct}}
            </div>
            <div class="col-span-1 text-center">
                {{$flashcard->incorrect}}
            </div>
            <div class="text-sm italic col-span-1 flex">
                @include('icons/edit', ['width' => 20, 'height' => 20]) &nbsp;&nbsp;
                @include('icons/delete', ['width' => 20, 'height' => 20])
            </div>

        @endforeach
    </div>

    <div>
        {{ $flashcards->links("pagination::tailwind") }}
    </div>
@endif
