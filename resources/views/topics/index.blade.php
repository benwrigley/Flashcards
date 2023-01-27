<x-layout>


    <div x-data="{topicForm:true}">
            <main class="w-4/6 mx-auto mt-6 lg:mt-20 space-y-6 bg-gray-800 p-3 rounded">

                @if ($topics->count())

                    <x-subtopics-grid :topics="$topics"/>

                @else

                    <div class="rounded-3xl bg-gray-700 p-2 text-3xl text-center m-4"> Hey {{ Auth::user()->name }}, I can see you are new to Flashcards. Welcome! </div>
                    <div class=" text-xl p-2  pl-4 ml-14 inline-block space-y-6">
                         <p>1. Start by adding a top-level topic like 'Maths' or 'History' at the bottom of this page.</p>
                         <p>2. Then you can create more top-level topics or click a the topic you just made to add sub-topics like 'Algebra' or 'Modern History'.</p>
                         <p>3. Keep adding as many topics/subtopics/subsubtopics and then add some flashcards.</p>
                         <p>4. At any point, visit a topic/subtopic that has flashcards and click the test me button!</p>
                    </div>

                @endif


            </main>
            <div>
                @include ('topics/_create-form')
            </div>

    </div>


</x-layout>
