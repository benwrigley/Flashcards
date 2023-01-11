@props(['flashcards','href'])


    <div class="bg-gray-600 flex flex-col items-center p-10 rounded-2xl text-5xl text-center"
        x-data="{
            answershow : false,
            thumbs : false,
            answered : false,
            error : '',
            ans : '',

            isAnswered(){
                if (this.answered){
                    this.error = null;
                    this.answershow = true;
                    this.thumbs = true;
                }
                else
                {
                    this.error = 'Please answer the question first'
                }

            }
        }
    ">

        <div x-show="!answershow">
            {{$flashcards[0]->question}}
        </div>
        <div x-show="answershow">
            {{$flashcards[0]->answer}}
        </div>
        <div x-show="answershow" x-text="ans" class="mt-4">
        </div>

        <div class="w-2/3 flex items-end flex-col">
            <form class="w-full" x-show="!answershow">
                <div class="text-lg mt-10">

                    <textarea class="border border-gray-400 p-2 w-full text-gray-700 rounded" x-model="ans" x-on:change="answered=true"
                        name="answer"
                        placeholder="Type your answer ... "
                        id="answer"
                        required
                    >{{ old('answer') }}</textarea>
                    <p class="text-red-400 p-2 mb" x-text="error" ></p>
                </div>
            </form>
            <div x-show="!thumbs">
                <button class="text-2xl bg-gray-400 p-3 rounded-3xl" x-on:click="isAnswered">
                    Reveal Answer!
                </button>
            </div>
            <div x-show="thumbs" class="flex">

                <div>
                    <x-thumb-link icon="up" :href="$href . '&' . http_build_query(['correct' => 1])" />
                </div>
                <div>
                    <x-thumb-link icon="down" :href="$href . '&' . http_build_query(['correct' => 0])" />
                </div>

            </div>


        </div>
    </div>

    {{-- <div>
        {{ $flashcards->appends(['foo' => 'bar'])->nextPageUrl() }}
        {{ $flashcards->links() }}
    </div> --}}

