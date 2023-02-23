@props(['topic'])

<div class="hidden lg:block" x-on:click="topicForm=true;flashcardForm=false" >
    <x-form.submit label="New Subtopic..." />
</div>

<a href="{{ route('topic.create',['topic' => $topic->id]) }}" class="block lg:hidden">
    <x-form.submit label="New Subtopic..." />
</a>
