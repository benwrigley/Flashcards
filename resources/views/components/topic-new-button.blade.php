@props(['topic'])

<div class="hidden md:block" x-on:click="topicForm=true" >
    <x-form-submit label="New Subtopic..." />
</div>

<a href="{{ route('topic.create',['topic' => $topic->id]) }}" class="block md:hidden">
    <x-form-submit label="New Subtopic..." />
</a>
