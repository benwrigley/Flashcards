
<div x-show="flashcardForm" class="fixed bottom-10 w-full flex justify-center" style="display:none">
    <form method="POST" action="{{route('flashcard.store')}}" class="bg-gray-800 rounded p-4 w-10/12">
        @csrf

        <div class="lg:grid lg:grid-cols-5 items-center">
            <div class="text-right">
                <span class=" mr-4 align-middle"> New Flashcard: </span>
            </div>
            <div class="px-2" >
                <x-form.textarea type="textarea" name="question" id="question" placeholder="Question" required="required" :value="old('question')" rows="2" errorbag="flashcardCreate"/>
            </div>
            <div class="px-2" >
                <x-form.textarea type="textarea" name="answer" id="answer" placeholder="Answer" required="required" :value="old('answer')" rows="2" errorbag="flashcardCreate" />
            </div>




            <div class="ml-6 w-100 flex justify-center">
                <x-form.radio :list="range(1,5)" name="max_score" class=""/>

            </div>

            <input
                type="hidden"
                name="topic_id"
                value="{{ $topic->id ?? ''}}"
            >

            <div class="ml-6">
                <x-form.submit label="Create" />
            </div>
        </div>
    </form>
</div>
