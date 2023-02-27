<x-layout :topic="$topic">


   {{-- Test Section --}}
@if ($topic->flashcards->count() || $topic->children->count())
    <div x-data="{ testshow:false }" class="absolute w-auto">
        <div class="fixed right-1 bottom-1 lg:left-10 lg:top-1/2 block lg:text-3xl w-fit">
            <x-form.submit label="Test Me!" bgcolor="bg-blue-500" click="testshow = ! testshow" type="button"/>
        </div>

        <div class="flex h-screen justify-center items-center" x-show="testshow" x-cloak>
            <x-test.grid :topic="$topic"/>
        </div>
    </div>
@endif



<div x-data="{ topicForm:false, flashcardForm:false}">

    @if ($errors->flashcardCreate->count())
        <div x-init="flashcardForm = true" />
    @endif

    @if ($errors->topicCreate->count())
        <div x-init="topicForm = true" />
    @endif

    <main class="sm:mt-10 lg:mt-20 max-w-6xl mx-auto space-y-6 bg-gray-800 p-4 rounded">

        <div class="p-4 border-b-2 lg:mb-10 lg:mx-3" >
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

                <div class="italic text-center bg-gray-700 rounded-3xl ml-2 lg:m-3 lg:p-4 p-2 w-full">
                    <div class="lg:text-4xl text-2xl">
                        {{$topic->name}}
                    </div>
                    <div class=" text-sm lg:text-2xl">
                        {{ $topic->description }}
                    </div>
                </div>

            </div>

        </div>

        @if ($topic->children->count())
            <x-topic.grid :topics="$topic->children"/>
        @elseif ($topic->flashcards->count())
            <x-flashcard.grid :flashcards="$topic->flashcards()->paginate(10)"/>
        @endif

    </main>

    {{-- New topic and Flashcard buttons --}}
    <div class="max-w-6xl mx-auto space-y-6 mt-5">
        @if ($topic->children->count())
            <x-topic.new-button :topic="$topic" />
        @elseif ($topic->flashcards->count())
            <x-flashcard.new-button :topic="$topic" />
        @endif

        @if (!$topic->flashcards->count() && !$topic->children->count())

            <div class="flex justify-center p-16 items-baseline">

                <x-flashcard.new-button :topic="$topic" />

                <div class="mx-10">
                    OR
                </div>

                <x-topic.new-button :topic="$topic" />
            </div>

        @endif
    </div>


    @include ('topics/_create-form', ['topic' => $topic])
    @include ('flashcards/_create-form')

    </div>
</x-layout>
