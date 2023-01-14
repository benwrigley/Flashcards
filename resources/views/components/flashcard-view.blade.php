@props(['flashcard','count','test'])


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
            {{$flashcard->question}}
        </div>
        <div x-show="answershow">
            {{$flashcard->answer}}
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

            <form method="POST" action="/answertest" x-data="{score : 1, answer : ''}" class="flex justify mt-10 text-3xl" x-show="thumbs">
                @csrf
                <div>
                    Select score :
                </div>
                @for($i=0; $i < $flashcard->max_score + 1; $i++ )
                    <div class="ml-2 bg-gray-400 rounded-full pl-1 pr-1 hover:bg-gray-200">
                        <x-radio-element :value="$i" :label="$i" xdata="answer" />
                    </div>
                @endfor
                <input type="hidden" name="score" x-model="answer"/>
                <input type="hidden" name="count" value="{{$count}}"/>
                <input type="hidden" name="test" value="{{$test->id}}"/>

            </form>
            {{-- <div x-show="thumbs" class="flex">

                <div>
                    <x-thumb-link icon="up" :href="$href . '&' . http_build_query(['correct' => 1])" />
                </div>
                <div>
                    <x-thumb-link icon="down" :href="$href . '&' . http_build_query(['correct' => 0])" />
                </div>

            </div> --}}


        </div>
    </div>


