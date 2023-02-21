<x-layout :topic="$test->topic">

    <main class="max-w-6xl mx-auto mt-12 md:mt-6 lg:mt-20 space-y-6 flex justify-center">
    <div class="text-7xl md:text-9xl text-center {{$test->getResult() == 100 ? 'bg-yellow-500' : 'bg-blue-400' }} w-1/2 p-12 rounded-3xl {{$test->getResult() == 100 ? 'animate-bounce' : '' }}">

        {{ $test->getResult() }}% !

    </div>
    </main>

</x-layout>
