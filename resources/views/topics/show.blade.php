<x-layout :topic="$topic">


<div x-data="{ topicForm:false, flashcardForm:false, testshow:false}">

    @if ($errors->flashcardCreate->count())
        <div x-init="flashcardForm = true" />
    @endif

    @if ($errors->topicCreate->count())
        <div x-init="topicForm = true" />
    @endif

    <main class="sm:mt-10 md:mt-20 max-w-6xl mx-auto space-y-6 bg-gray-800 p-4 rounded">

        <div class="p-4 border-b-2 md:mb-10 md:mx-3" >
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

                <div class="italic text-center bg-gray-700 rounded-3xl ml-2 md:m-3 md:p-4 p-2 w-full">
                    <div class="md:text-4xl text-2xl">
                        {{$topic->name}}
                    </div>
                    <div class=" text-sm md:text-2xl">
                        {{ $topic->description }}
                    </div>
                </div>

            </div>

            {{-- Test Section --}}
            @if ($topic->flashcards->count() || $topic->children->count())

                {{-- Larger --}}
                <div class="fixed top-50 left-5 md:block hidden" x-cloak>
                    <x-test-grid :topic="$topic"/>
                </div>

                {{-- Smaller --}}
                <div class="fixed right-1 bottom-1 md:hidden block" x-on:click="testshow = ! testshow" x-cloak>
                    <x-form-submit label="Test Me!" bgcolor="bg-blue-500" />
                </div>

                <div class="mx-auto fixed inset-x-0 inset-y-0 top-10 left-10" x-show="testshow" x-cloak>
                    <x-test-grid :topic="$topic"/>
                </div>
            @endif
        </div>

        @if ($topic->children->count())
            <x-subtopics-grid :topics="$topic->children"/>
        @elseif ($topic->flashcards->count())
            <x-flashcards-grid :flashcards="$topic->flashcards()->paginate(10)"/>
        @endif

    </main>

    {{-- New topic and Flashcard buttons --}}
    <div class="max-w-6xl mx-auto space-y-6 mt-5">
        @if ($topic->children->count())
            <x-topic-new-button :topic="$topic" />
        @elseif ($topic->flashcards->count())
            <x-flashcard-new-button :topic="$topic" />
        @endif

        @if (!$topic->flashcards->count() && !$topic->children->count())

            <div class="flex justify-center p-16 items-baseline">

                <x-flashcard-new-button :topic="$topic" />

                <div class="mx-10">
                    OR
                </div>

                <x-topic-new-button :topic="$topic" />
            </div>

        @endif
    </div>


    @include ('topics/_create-form', ['topic' => $topic])
    @include ('flashcards/_create-form')

    </div>
</x-layout>
