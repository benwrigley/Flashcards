<x-layout>


    <div x-data="{topicForm:true}">
            <main class="mt-10 lg:mt-20 space-y-6 bg-gray-800 p-3 rounded mx-auto w-auto lg:w-4/6">

                @if ($topics->count())

                    <x-subtopics-grid :topics="$topics"/>

                @else

                    <div class="rounded-3xl bg-gray-700 md:p-2 md:text-3xl text-center md:m-4 text-sm p-1"> Hey {{ Auth::user()->name }}, I can see you are new to Flashcards. Welcome! </div>
                    <div class="text-sm md:text-xl lg:p-2 pl-4 md:ml-14 inline-block lg:space-y-6 p-1 space-y-3">
                         <p>1. Start by adding a top-level topic like 'Maths' or 'History' at the bottom of this page.</p>
                         <p>2. Then you can create more top-level topics or click a the topic you just made to add sub-topics like 'Algebra' or 'Modern History'.</p>
                         <p>3. Keep adding as many topics/subtopics/subsubtopics and then add some flashcards.</p>
                         <p>4. At any point, visit a topic/subtopic that has flashcards and click the test me button!</p>
                    </div>

                @endif


            </main>
            <div class="hidden md:block">
                @include ('topics/_create-form')
            </div>
            <div class="block md:hidden fixed bottom-5">
                <a href="{{route('topic.create')}}">
                    <x-form-submit label="New Topic" />
                </a>
            </div>

    </div>


</x-layout>
