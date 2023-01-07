@props(['flashcards'])

    <div class="bg-gray-600 flex flex-col items-center p-10 rounded-2xl text-5xl text-center" x-data="{answershow : false, thumbs : false}">
        <div x-show="!answershow">
        {{$flashcards[0]->question}}
        </div>
        <div x-show="answershow">
            {{$flashcards[0]->answer}}
        </div>

        <div class="w-2/3 flex items-end flex-col">
            <form class="w-full">
                <div class="text-lg mt-10">

                    <textarea class="border border-gray-400 p-2 w-full text-gray-700 rounded"
                        name="answer"
                        placeholder="Type your answer ... "
                        id="answer"
                        required
                    >{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="text-red-700 p-2 mb">{{ $message }}</p>
                    @enderror
                </div>
            </form>
            <div x-show="!thumbs">
                <button class="text-2xl bg-gray-400 p-3 rounded-3xl" @click="answershow = ! answershow; thumbs=true">
                    Reveal Answer!
                </button>
            </div>
            <div x-show="thumbs" class="flex">
                <div>
                    @include('icons/thumbsup', ['width' => 30, 'height' => 30])
                </div>
                <div>
                    @include('icons/thumbsdown', ['width' => 30, 'height' => 30])
                </div>
            </div>


        </div>
    </div>

    <div>
        {{ $flashcards->links("pagination::tailwind") }}
    </div>

