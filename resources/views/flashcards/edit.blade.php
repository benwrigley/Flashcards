<x-layout>

    <section class="px-6 py-8">

        <main class="w-1/2 mx-auto bg-gray-400 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl text-gray-900">Update Flashcard</h1>
            <form action="{{route('flashcard.update',$flashcard->id)}}" class="mt-10" method="POST">
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <div class="mb-6">
                    <label class="block mb-2  font-bold text-vs text-gray-700"
                        for="question"
                    >
                        Question
                    </label>

                    <textarea
                        class="border border-gray-400 p-2 w-full text-gray-700"
                        name="question"
                        id="question"
                        rows="10"
                        required
                    >{{ old('answer',$flashcard->question)}}</textarea>
                    @error('question')
                        <p class="text-red-700 p-2 mb">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2  font-bold text-vs text-gray-700"
                        for="name"
                    >
                        Answer
                    </label>

                    <textarea
                        class="border border-gray-400 p-2 w-full text-gray-700"
                        name="answer"
                        id="answer"
                        rows="10"
                        required
                    >{{ old('answer',$flashcard->answer) }}</textarea>
                    @error('answer')
                        <p class="text-red-700 p-2 mb">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2  font-bold text-vs text-gray-700"
                        for="max_score"
                    >
                        Max Score
                    </label>

                    <input class="border border-gray-400 p-2 text-gray-700"
                            type="text"
                            name="max_score"
                            id="max_score"
                            length="1"
                            size="2"
                            value="{{ old('max_score', $flashcard->max_score)  }}"
                            required
                    >
                    @error('max_score')
                        <p class="text-red-700 p-2 mb">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button type="submit"
                            class="bg-gray-900 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
                    Update
                </button>
            </form>
        </main>
    </section>



</x-layout>
