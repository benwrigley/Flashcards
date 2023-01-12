<x-layout :topic="$topic">
<div x-data="{ topicForm:false, flashcardForm:false }">
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        <div class="pt-4">
            <hr />
        </div>
        <div class="italic text-4xl text-center">
            {{$topic->name}} -  {{ $topic->description }}
        </div>
        <div class="pb-4">
            <hr />
        </div>

        @if ($topic->flashcards->count() || $topic->children->count())

            <a href="/test/{{$topic->id}}">
                <div class="flex justify-center">
                        <div class="bg-blue-400 p-2 rounded-3xl text-center text-3xl w-1/6"> Test Me! </div>
                </div>
            </a>
        @endif

        @if ($topic->flashcards->count())

            <div class="text-center p-12">
                <x-flashcards-grid :flashcards="$topic->flashcards()->paginate(10)" />
                <div x-on:click="flashcardForm=true" class="bg-gray-400 p-2 rounded-3xl w-1/5 mt-10">
                    New Flashcard ...
                </div>
            </div>

        @elseif ($topic->children->count())
            <x-subtopics-grid :topics="$topic->children"/>

        @else
            <div class="md:flex justify-center h-1/3 mt-10">
                <div class="border-r-4 p-10" >
                    <button x-on:click="topicForm = ! topicForm; flashcardForm = false" class="bg-gray-600 p-3 rounded-2xl">Add subtopics?</button>
                </div>
                <div class="p-10">
                    <button x-on:click="flashcardForm = ! flashcardForm; topicForm = false" class="bg-gray-600 p-3 rounded-2xl">Add flashcards?</button>
                </div>
            </div>

        @endif
    </main>


    @include ('topics/_create-form', ['topic' => $topic])
    @include ('flashcards/_create-form')

    </div>
</x-layout>