<x-layout :topic="$test->topic">

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <div class="flex justify-between">
            <div class="text-sm italic">
                {{$count + 1 }} of {{$flashcards->count()}}
            </div>
            <div>
                <form action={{route('test.close', $test->id)}} onsubmit="return confirm('Are you sure you want to stop? This will not update your streak OR your total tests complete.')" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="GET">

                    <button type="submit">
                        @include('icons/cross',['width' => 30, 'height' => 30, 'color' => 'red'])
                    </button>
                </form>
            </div>
        </div>
        <div>

            <x-flashcard-view :flashcard="$flashcards[$count]" :count="$count" :test="$test"/>

        </div>
    </main>

</x-layout>
