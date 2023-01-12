<x-layout>


    <div x-data="{topicForm:true}">
        @auth
            <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

                @if ($topics->count())

                    <x-subtopics-grid :topics="$topics"/>

                @else

                    <p class="text-center mb-10"> Hey {{ Auth::user()->name }}, I can see you are new here. Welcome! </p>
                    <p class="w-1/2"> To get started, you'll want to add some top level topics like 'Maths' or 'History'. Then you can create sub-topics like 'Algebra' or 'Modern History'</p>
                    <p class="w-2/3"> Keep adding as many subtopics as you need, and when you are ready you can create your flashcards. </p>

                @endif


            </main>
            <div>
                @include ('topics/_create-form')
            </div>
        @else

            <div class="h-96 flex justify-center items-center">
                <div class="mt-8 md:mt-0 ">
                    <div class="bg-gray-400 p-4 rounded text-center text-2xl">
                        Welcome to Flashcards
                    </div>
                    <div class="text-center p-2 mt-2 text-xl">
                        <a href="/login">Login</a> or <a href="/register">Register</a> to get started
                    </div>
                </div>
            </div>

        @endauth

    </div>


</x-layout>
