@props(['flashcard','count','test'])


    <div class="bg-gray-800 flex flex-col items-center p-10 rounded-2xl text-5xl text-center border"
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


        <div x-show="!answershow" class="p-4 text-3xl bg-gray-700 rounded w-full">
            {{$flashcard->question}}
        </div>
        <div x-show="answershow" class="p-4 bg-gray-700 rounded text-3xl w-full">
            {{$flashcard->answer}}
        </div>
        <div x-show="answershow" x-text="ans" class="mt-4 text-3xl bg-gray-600 rounded text-3xl w-full p-4 ">
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
            <div x-show="reveal">
                <button class="text-2xl bg-gray-700 pt-3 pr-4 pl-4 pb-3 rounded-3xl hover:bg-gray-600" x-on:click="isAnswered">
                    Reveal answer ...
                </button>
            </div>

            <form method="POST" action="/answertest" x-data="{score : 1, answer : ''}" class="flex justify mt-10 text-3xl p-2" x-show="thumbs">
                @csrf
                <div>
                    Select score :
                </div>
                @for($i=0; $i < $flashcard->max_score + 1; $i++ )
                    <div class="ml-2 bg-gray-600 rounded-full pl-1 pr-1 hover:bg-gray-500">
                        <x-radio-element :value="$i" :label="$i" xdata="answer" />
                    </div>
                @endfor
                <input type="hidden" name="score" x-model="answer"/>
                <input type="hidden" name="count" value="{{$count}}"/>
                <input type="hidden" name="test" value="{{$test->id}}"/>

            </form>


        </div>
    </div>


