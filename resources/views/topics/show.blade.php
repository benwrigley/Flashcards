<x-layout :topic="$topic">


<div x-data="{ topicForm:false, flashcardForm:false, testOptions:false }">

    @if ($errors->flashcardCreate->count())
        <div x-init="flashcardForm = true" />
    @endif

    @if ($errors->topicCreate->count())
        <div x-init="topicForm = true" />
    @endif

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        <div class="border-t-2 p-4 border-b-2" >
            <div class="flex justify-around items-baseline ">

                <div class="italic text-4xl text-center w-10/12">
                    {{$topic->name}} -  {{ $topic->description }}
                </div>

                @if ($topic->flashcards->count() || $topic->children->count())

                    <div x-on:click="testOptions = ! testOptions">
                        <div class="bg-blue-400 p-4 rounded-3xl text-center text-3xl hover:bg-blue-300"> Test Me! </div>
                    </div>
                @endif
            </div>

            <div x-show="testOptions" class="flex justify-evenly mt-3">
                <a href="{{ route('test.store',[$topic->id,'*']) }}">
                    <div class="bg-blue-400 p-3 rounded-3xl text-center ">
                        Everything!
                    </div >
                </a>
                <a href="{{ route('test.store',[$topic->id,'5']) }}">
                    <div class="bg-blue-400 p-3 rounded-3xl text-center ">
                        Worst 5
                    </div>
                </a>
                <a href="{{ route('test.store',[$topic->id,'10']) }}">
                    <div class="bg-blue-400 p-3 rounded-3xl text-center ">
                        Worst 10
                    </div>
                </a>
            </div>
        </div>

        @if ($topic->flashcards->count())

            <div class="text-center p-12">
                <x-flashcards-grid :flashcards="$topic->flashcards()->paginate(10)" />
                <div x-on:click="flashcardForm=true" class="px-3 py-1 rounded-full uppercase font-semibold bg-gray-600 w-1/5 mt-8 text-center hover:bg-gray-400">
                    New Flashcard ...
                </div>
            </div>

        @elseif ($topic->children->count())
            <x-subtopics-grid :topics="$topic->children"/>
            <div x-on:click="topicForm=true" class="px-3 py-1 rounded-full uppercase font-semibold bg-gray-600 w-1/5 mt-8 text-center hover:bg-gray-400">
                New Subtopic ...
            </div>


        @else

        <div class="flex justify-center p-16 items-baseline">

            <div x-on:click="flashcardForm = ! flashcardForm; topicForm = false" class="px-3 py-1 rounded-full uppercase font-semibold bg-gray-600 mr-4 hover:bg-gray-400">
                New Flashcard ...
            </div>
            <div>
                OR
            </div>
            <div x-on:click="topicForm = ! topicForm; flashcardForm = false" class="px-3 py-1 rounded-full uppercase font-semibold bg-gray-600 ml-4 hover:bg-gray-400">
                New Subtopic ...
            </div>

        </div>
            {{-- <div class="md:flex justify-center h-1/3 mt-10">
                <div class="border-r-4 p-10" >
                    <button x-on:click="topicForm = ! topicForm; flashcardForm = false" class="bg-gray-600 p-3 rounded-2xl">Add subtopics?</button>
                </div>
                <div class="p-10">
                    <button x-on:click="flashcardForm = ! flashcardForm; topicForm = false" class="bg-gray-600 p-3 rounded-2xl">Add flashcards?</button>
                </div>
            </div> --}}

        @endif
    </main>


    @include ('topics/_create-form', ['topic' => $topic])
    @include ('flashcards/_create-form')

    </div>
</x-layout>
