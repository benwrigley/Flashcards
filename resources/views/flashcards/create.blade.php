<x-layout>

    <x-form-layout :title="'Create Flashcard in ' . $topic->name" method="post" :action="route('flashcard.store')">

        <x-form-textarea type="textarea" id="question" placeholder="Question" :value="old('question')" required="required" rows="3" />
        <x-form-textarea type="textarea" id="answer" placeholder="Answer" :value="old('answer')" required="required" rows="3" />
        <x-form-field type="text" id="max_score" placeholder="Max Score (1-5)" :value="old('max_score')" required="required" length="1" size="2" />
        <x-form-submit label="Create Flashcard" />
        <input
            type="hidden"
            name="topic_id"
            value="{{ $topic->id ?? ''}}"
        >

    </x-form-layout>



</x-layout>
