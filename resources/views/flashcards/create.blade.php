<x-layout>

    <x-form.layout :title="'Create Flashcard in ' . $topic->name" method="post" :action="route('flashcard.store')">

        <div class="mb-4 w-5/6">
            <x-form.textarea type="textarea" id="question" placeholder="Question" :value="old('question')" required="required" rows="3" />
        </div>
        <div class="mb-4 w-5/6">
            <x-form.textarea type="textarea" id="answer" placeholder="Answer" :value="old('answer')" required="required" rows="3" />
        </div>
        <div class="w-5/6 flex justify-center p-2 mb-4 items-center">
            <div class="mr-4">
                Max Score:
            </div>
            <x-form.radio :list="range(1,5)" name="max_score" class="" :select="old('max_score')"/>

        </div>
            <x-form.submit label="Create Flashcard" />
        <input
            type="hidden"
            name="topic_id"
            value="{{ $topic->id ?? ''}}"
        >

    </x-form.layout>



</x-layout>
