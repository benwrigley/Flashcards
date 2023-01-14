<x-layout :topic="$topic">


<div x-data="{ topicForm:false, flashcardForm:false }">

    @if ($errors->flashcardCreate->count())
        <div x-init="flashcardForm = true" />
    @endif

    @if ($errors->topicCreate->count())
        <div x-init="topicForm = true" />
    @endif

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        <div class="pt-4">
            <hr />
        </div>

        <div class="flex justify-around align-baseline">

            <div class="italic text-4xl text-center w-10/12">
                {{$topic->name}} -  {{ $topic->description }}
            </div>

            @if ($topic->flashcards->count() || $topic->children->count())

            <a href="/test/{{$topic->id}}">
                <div>
                        <div class="bg-blue-400 p-4 rounded-3xl text-center text-3xl"> Test Me! </div>
                </div>
            </a>
            @else
                <div />
            @endif
        </div>

        <div class="pb-4">
            <hr />
        </div>

        @if ($topic->flashcards->count())

            <div class="text-center p-12">
                <x-flashcards-grid :flashcards="$topic->flashcards()->paginate(10)" />
                <div x-on:click="flashcardForm=true" class="px-3 py-1 rounded-full uppercase font-semibold bg-gray-600 w-1/5 mt-8">
                    New Flashcard ...
                </div>
            </div>

        @elseif ($topic->children->count())
            <x-subtopics-grid :topics="$topic->children"/>
            <div x-on:click="topicForm=true" class="pl-4 pr-4 pt-2 pb-2 rounded-full uppercase font-semibold bg-gray-600 mt-8 text-center fixed bottom-10">
                New Subtopic ...
            </div>


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
