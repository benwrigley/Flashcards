<x-layout :topic="$test->topic">

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
    <div class="flex justify-between">
        <div class="text-sm italic">
            {{$flashcards->currentPage() }} of {{$flashcards->total() }}
        </div>
        <div>
           <a href="/test/close/{{ $test->id }} ">@include('icons/cross',['width' => 30, 'height' => 30, 'color' => 'red'])</a>
        </div>
    </div>
    <div>

        <x-flashcard-view :flashcards="$flashcards" :href="$href" />

    </div>
    </main>

</x-layout>
