<x-layout :topic="$test->topic">

    <main class="flex h-screen justify-center items-center">
    <div class="text-7xl lg:text-9xl text-center {{$test->getResult() == 100 ? 'bg-yellow-500' : 'bg-blue-400' }} p-12 rounded-3xl {{$test->getResult() == 100 ? 'animate-bounce' : '' }}">

        {{ $test->getResult() }}% !

    </div>
    </main>

</x-layout>
