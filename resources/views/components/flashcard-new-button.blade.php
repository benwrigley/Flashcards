@props(['topic'])

<div class="hidden md:block" x-on:click="flashcardForm=true" >
    <x-form-submit label="New Flashcard..." />
</div>

<a href="{{ route('flashcard.create',['topic' => $topic->id]) }}" class="block md:hidden">
    <x-form-submit label="New Flashcard..." />
</a>
