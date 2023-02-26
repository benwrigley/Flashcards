@props(['flashcard','count','test'])


    <div class="bg-gray-800 flex flex-col items-center p-2 lg:p-10 rounded-2xl text-center border"
        x-data="{
            answershow : false,
            thumbs : false,
            answered : false,
            reveal : false,
            error : '',
            ans : '',

            isAnswered(){
                if (this.answered){
                    this.error = null;
                    this.answershow = true;
                    this.thumbs = true;
                    this.reveal = false;
                }
                else
                {
                    this.error = 'Please answer the question first'
                }

            }
        }
    ">

        {{-- Question --}}
        <div x-show="!answershow" class="m-1 p-1 lg:p-4 text-xl lg:text-3xl bg-gray-700 rounded w-full">
            {{$flashcard->question}}
        </div>
        {{-- Answer --}}
        <div x-show="answershow" class="m-1 p-1 lg:p-4 text-xl lg:text-3xl bg-gray-700 rounded w-full" x-cloak>
            {{$flashcard->answer}}
        </div>
        {{-- Your Answer --}}
        <div x-show="answershow" x-text="ans" class="m-1 p-1 lg:p-4 text-xl lg:text-3xl bg-gray-600 rounded w-full" x-cloak>
        </div>

        <div class="w-2/3 flex items-end flex-col">
            <form class="w-full" x-show="!answershow">
                <div class="text-lg mt-10">

                    <textarea class="border border-gray-400 p-2 w-full text-gray-700 rounded" x-model="ans" x-on:keydown="answered=true;reveal=true"
                        name="answer"
                        placeholder="Type your answer ... "
                        id="answer"
                        required
                    >{{ old('answer') }}</textarea>
                    <p class="text-red-400 p-2 mb" x-text="error" ></p>
                </div>
            </form>
            <div x-show="reveal" x-on:click="isAnswered" class="text-xl lg:text-2xl" x-cloak>
                <x-form.submit label="Reveal answer ..." />
            </div>

            <form method="POST" action="/answertest" class="flex justify mt-10 text-3xl p-2" x-show="thumbs" x-cloak x-ref="scoreForm">
                @csrf


                <div class="flex justify-center p-2 mb-4 items-center">
                    <div class="text-xl lg:text-3xl mr-4">
                        Select score :
                    </div>
                    <x-form.radio :list="range(0,$flashcard->max_score)" name="score" click="$refs.scoreForm.submit()"/>

                </div>

                <input type="hidden" name="count" value="{{$count}}"/>
                <input type="hidden" name="test" value="{{$test->id}}"/>

            </form>


        </div>
    </div>


