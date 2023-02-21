<x-layout>

    <x-form-layout method="Post" title="Update Flashcard" :action="route('flashcard.update',$flashcard->id)">
        <input type="hidden" name="_method" value="PUT">
        <x-form-textarea id="question" placeholder="Question" :value="old('question',$flashcard->question)" rows="3" required="required" />
        <x-form-textarea id="answer" placeholder="Answer" :value="old('answer',$flashcard->answer)" rows="3" required="required" />
        <x-form-field type="text" id="max_score" placeholder="Max Score(1-5)" :value="old('max_score',$flashcard->max_score)" length="1" required="required" />
        <x-form-submit label="Update" />
    </x-form-layout>

</x-layout>
