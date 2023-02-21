@props(['flashcards'])

@if ($flashcards->count() > 0)
    <div class="grid grid-cols-12 ml-10 items-center md:space-y-2">
        <div class="col-span-6 md:col-span-8 italic underline">
            Flashcards
        </div>
        <div class="col-span-4 md:col-span-2 flex justify-center italic underline">
            Average Score
        </div>
        <div class="col-span-2"></div>


        @foreach ($flashcards as $flashcard)

            <div class="italic col-span-8 text-left pt-2">
                {{-- larger --}}
                <div class="md:block hidden">
                    '{{$flashcard->shorterQuestion(80)}}'
                </div>
                {{-- smaller --}}
                <div class="md:hidden block">
                    '{{$flashcard->shorterQuestion(30)}}'
                </div>
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
