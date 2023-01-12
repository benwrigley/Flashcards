<x-layout :topic="$test->topic">

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
    <div class="flex justify-between">
        <div class="text-sm italic">
            {{$count + 1 }} of {{$flashcards->count()}}
        </div>
        <div>
           <a href="/closetest/{{ $test->id }} ">@include('icons/cross',['width' => 30, 'height' => 30, 'color' => 'red'])</a>
        </div>
    </div>
    <div>

        <x-flashcard-view :flashcard="$flashcards[$count]" :count="$count" :test="$test"/>

    </div>
    </main>

</x-layout>
