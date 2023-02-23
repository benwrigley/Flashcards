<nav class="bg-gray-800 p-2 flex  items-center justify-between fixed w-screen left-0 top-0">

    @auth
        <div class="flex items-center text-sm lg:text-xl">
            <div>
                Streak days!
            </div>
            <div class="bg-green-600 text-center  ml-2 pl-2 pr-2 rounded-full text-2xl">
                {{ auth()->user()->streak }}
            </div>
        </div>
        <x-topic.breadcrumb :topic="isset($topic) ? $topic : null" :ancestors="isset($topic) ? $topic->getAncestors() : null"/>
    @else
        <div class="flex items-center "></div>
    @endauth

    {{-- Register-Login / Scoreboard-Account  --}}
    <div class="flex items-center pr-2 uppercase text-sm lg:text-xl">
        @auth
            <div x-on:click="scoreboard = ! scoreboard"> {{ auth()->user()->name }} </div>
            <div x-on:click="scoreboard = ! scoreboard" class="ml-2"> @include('icons/chevrondown',['width' => 15, 'height' => 15]) </div>

            <form method="GET" action="/logout" class="font-semibold text-blue-500 ml-6">
                <button type="submit">Log Out</button>
            </form>

        @else
            {{-- <a class="lg:invisible mr-2" href="{{route('password.request')}}">Forgotten Password</a> --}}
            <a href="{{route('register.create')}}">Register</a>
            <a href="/login" class="ml-3">Login</a>
        @endauth
    </div>
</nav>
