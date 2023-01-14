<x-layout :topic="$test->topic">

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6 flex justify-center">
    <div class="text-9xl text-center bg-blue-400 w-1/2 p-12 rounded-3xl animate-pulse">

        {{ $test->getResult() }}% !

    </div>
    </main>

</x-layout>
