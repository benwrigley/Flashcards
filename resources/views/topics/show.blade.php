<x-layout :topic="$topic">


<div x-data="{ topicForm:false, flashcardForm:false}">

    @if ($errors->flashcardCreate->count())
        <div x-init="flashcardForm = true" />
    @endif

    @if ($errors->topicCreate->count())
        <div x-init="topicForm = true" />
    @endif

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6 bg-gray-800 p-4 rounded">

        <div class="p-4 border-b-2 mb-10 ml-3 mr-3" >
            <div class="flex items-baseline mb-4 ">

                <div class="text-right mr-2">
                    <a href="{{route('topic.edit', $topic->id)}}">
                        @include('icons/edit', ['width' => 20, 'height' => 20])
                    </a>
                </div>
                <div>
                    <form action={{route('topic.destroy', $topic->id)}} onsubmit="return confirm('Are you sure you want to delete?')" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">

                        <button type="submit">
                            @include('icons/delete', ['width' => 20, 'height' => 20])
                        </button>
                    </form>
                </div>

                <div class="italic text-4xl text-center bg-gray-700 rounded-3xl m-3 p-4 w-full">
                    <div>
                        {{$topic->name}}
                    </div>
                    <div class="text-2xl">
                        {{ $topic->description }}
                    </div>
                </div>

            </div>

            {{-- Test Section --}}
            @if ($topic->flashcards->count() || $topic->children->count())
                <x-test-grid :topic="$topic"/>
            @endif
        </div>


        @if ($topic->children->count())
            {{-- <div class="text-center text-3xl italic">
                Subtopics
            </div> --}}
            <x-subtopics-grid :topics="$topic->children"/>
            <div x-on:click="topicForm=true" class="px-3 py-1 rounded-full uppercase font-semibold bg-gray-600 w-1/5 mt-12 text-center hover:bg-gray-400">
                New Subtopic ...
            </div>
        @elseif ($topic->flashcards->count())

            <x-flashcards-grid :flashcards="$topic->flashcards()->paginate(10)"/>
            <div x-on:click="flashcardForm=true" class="px-3 py-1 rounded-full uppercase font-semibold bg-gray-600 w-1/5 mt-12 text-center hover:bg-gray-500">
                New Flashcard ...
            </div>

        @endif

    </main>


    @if (!$topic->flashcards->count() && !$topic->children->count())

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

    @endif


    @include ('topics/_create-form', ['topic' => $topic])
    @include ('flashcards/_create-form')

    </div>
</x-layout>
