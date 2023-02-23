@props(['topic'])

<div class="hidden lg:block" x-on:click="flashcardForm=true;topicForm=false" >
    <x-form.submit label="New Flashcard..." />
</div>

<a href="{{ route('flashcard.create',['topic' => $topic->id]) }}" class="block lg:hidden">
    <x-form.submit label="New Flashcard..." />
</a>
