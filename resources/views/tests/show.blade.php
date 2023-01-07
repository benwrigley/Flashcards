<x-layout :topic="$test->topic">

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
    <div class="flex justify-end">
        <a href="/test/close/{{ $test->id }} ">@include('icons/cross',['width' => 30, 'height' => 30, 'color' => 'red'])</a>
    </div>
    <div>

        <x-flashcard-view :flashcards="$test->flashcards()->paginate(1)" />

    </div>
    </main>

</x-layout>
