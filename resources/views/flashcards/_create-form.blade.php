
<div x-show="flashcardForm" class="fixed bottom-10 w-full flex justify-center">
    <form method="POST" action="{{route('flashcard.store')}}" class="bg-gray-700 rounded p-4 w-10/12">
        @csrf

        <div class="lg:grid lg:grid-cols-5 items-center">
            <div class="text-right">
                <span class=" mr-4 align-middle"> New Flashcard: </span>
            </div>
            <div >

                <textarea class="border border-gray-400 p-2 w-full text-gray-700"
                    name="question"
                    placeholder="Question"
                    id="question"
                    required
                >{{ old('question') }}</textarea>
                @error('question','flashcardCreate')
                    <p class="text-red-700 p-2 mb">{{ $message }}</p>
                @enderror
            </div>

            <div class="ml-6">

                <textarea class="border border-gray-400 p-2 w-full text-gray-700"
                    name="answer"
                    placeholder="Answer"
                    id="answer"
                    required
                >{{ old('answer') }}</textarea>
                @error('answer','flashcardCreate')
                    <p class="text-red-700 p-2 mb">{{ $message }}</p>
                @enderror
            </div>

            <div class="ml-6 w-100">

                <input class="border border-gray-400 p-2 w-full text-gray-700"
                    type="text"
                    name="max_score"
                    id="max_score"
                    placeholder="Max Score (max is 5)"
                    value="{{ old('max_score') }}"
                >
                @error('max_score', 'flashcardCreate')
                <p class="text-red-700 p-2 mb">{{ $message }}</p>
            @enderror
            </div>

            <input
                type="hidden"
                name="topic_id"
                value="{{ $topic->id ?? ''}}"
            >

            <div class="ml-6">
                <button type="submit"
                        class="bg-gray-600 text-white rounded py-2 px-4 hover:bg-blue-500"
                >
                Create
                </button>
            </div>
        </div>
    </form>
</div>
