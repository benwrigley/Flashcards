<x-layout :topic="$topic">
<div x-data="{ topicForm:false, flashcardForm:false }">
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">



        <div class="italic text-5xl text-center mb-20">
            '{{ $topic->description }}'
        </div>

        @if ($topic->flashcards->count())
            <div class="text-4xl italic text-center p-12">
                You have {{ $topic->flashcards->count() }} cards
            </div>

        @elseif ($topic->children->count())

            <x-subtopics-grid :topics="$topic->children"/>

        @else
            <div class="md:flex justify-center h-1/3 mt-10">
                <div class="border-r-4 p-10" >
                    <button x-on:click="topicForm = ! topicForm; flashcardForm = false">Add subtopics?</button>
                </div>
                <div class="p-10">
                    <button x-on:click="flashcardForm = ! flashcardForm; topicForm = false">Add flashcards?</button>
                </div>
            </div>

        @endif
    </main>

    @if (!$topic->flashcards()->exists())
         @include ('topics/_create-form', ['topic' => $topic])
         @include ('flashcards/_create-form')
    @endif

    </div>
</x-layout>
