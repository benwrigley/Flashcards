<!doctype html>

<title>Flashcards</title>
{{-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> --}}
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
{{-- <link rel="stylesheet" href="{{ url('app.css') }}"> --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<body style="font-family: Open Sans, sans-serif" class="bg-gray-900 text-gray-300">
    <section class="px-6 py-8" x-data="{scoreboard:false}">
        @auth
            <x-scoreboard />
        @endauth
        <nav class="bg-gray-800 p-2 flex  items-center justify-between fixed w-screen left-0 top-0">
            <div class="flex items-center ">
                @auth
                    <div>
                        Streak days!
                    </div>
                    <div class="bg-green-600 text-center  ml-2 pl-2 pr-2 rounded-full text-2xl">
                        {{ auth()->user()->streak }}
                    </div>
                @endauth
            </div>

            @auth
                <x-topics-breadcrumb :topic="isset($topic) ? $topic : null" />
            @endauth

            <div class="mt-8 md:mt-0 flex items-center pr-2 uppercase">
                @auth
                    <div x-on:click="scoreboard = ! scoreboard"> {{ auth()->user()->name }} </div>
                    <div x-on:click="scoreboard = ! scoreboard" class="ml-2"> @include('icons/chevrondown',['width' => 15, 'height' => 15]) </div>

                    <form method="GET" action="/logout" class="font-semibold text-blue-500 ml-6">
                        <button type="submit">Log Out</button>
                    </form>

                @else
                    <a href="/register">Register</a>
                    <a href="/login" class="ml-3">Login</a>
                @endauth
            </div>
        </nav>

        {{ $slot }}

    </section>

    @if (session()->has('success'))
        <x-flash color="bg-blue-500">
            {{ session()->get('success') }}
        </x-flash>
    @endif

    @if (session()->has('error'))
    <x-flash color="bg-red-500">
        {{ session()->get('error') }}
    </x-flash>
@endif
</body>
