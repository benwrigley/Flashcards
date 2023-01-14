@props(['flashcards'])

@if ($flashcards->count() > 0)
    <div class="grid grid-cols-12">
        <div class="col-span-8"> </div>
        <div class="col-span-2 flex justify-center">
            Average Score
        </div>
        <div class="col-span-2"></div>


        @foreach ($flashcards as $flashcard)

            <div class="italic col-span-8 text-left pt-2">
                '{{ Str::limit($flashcard->question, $limit = 50, $end = '...') }}'
            </div>
            <div class="col-span-2 text-center">
                {{$flashcard->avg_score}}%
            </div>
            <div class="text-sm italic col-span-1 flex">
                <div class="mr-2">
                    <a href="{{route('flashcard.edit', $flashcard->id)}}">
                        @include('icons/edit', ['width' => 20, 'height' => 20])
                    </a>
                </div>
                <div>
                    <form action={{route('flashcard.destroy', $flashcard->id)}} onsubmit="return confirm('Are you sure you want to delete?')" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">

                        <button type="submit">
                            @include('icons/delete', ['width' => 20, 'height' => 20])
                        </button>
                    </form>
                </div>
            </div>

        @endforeach
    </div>

    <div>
        {{ $flashcards->links("pagination::tailwind") }}
    </div>
@endif
