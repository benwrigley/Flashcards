<x-layout>

    <x-form.layout method="Post" title="Update Flashcard" :action="route('flashcard.update',$flashcard->id)">
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-2 w-5/6">
            <x-form.textarea id="question" placeholder="Question" :value="old('question',$flashcard->question)" rows="3" required="required" />
        </div>
        <div class="mb-2 w-5/6">
            <x-form.textarea id="answer" placeholder="Answer" :value="old('answer',$flashcard->answer)" rows="3" required="required" />
        </div>
        <div class="mb-6 w-5/6 text-center">
            <label class="mb-2 font-bold text-vs text-gray-200"
                for="topic_id"
            >
                Parent
            </label>
            <select id="topic_id" name="topic_id" class="text-gray-900 rounded p-1.5">
                @foreach ($topics as $name => $id)
                    <option value="{{ $id }}" {{ ($id === $flashcard->topic_id) ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-5/6 flex justify-center p-2 mb-4 items-center">
            <div class="mr-4">
                Max Score:
            </div>
            <x-form.radio :list="range(1,5)" name="max_score" class="" :select="old('max_score',$flashcard->max_score)"/>

        </div>
        <x-form.submit label="Update" />
    </x-form.layout>

</x-layout>
