<!doctype html>

<title>Flashcards</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<body style="font-family: Open Sans, sans-serif" class="bg-gray-900 text-white">
    <section class="px-6 py-8" x-data="{scoreboard:false}">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    FLASHCARDS
                </a>
            </div>

            @auth
                <div class="w-2/3"> <x-topics-breadcrumb :topic="isset($topic) ? $topic : null" /> </div>
                <x-user-stats />
            @endauth

            <div class="mt-8 md:mt-0 flex items-center">
                @auth
                    <span x-on:click="scoreboard = ! scoreboard"> {{ auth()->user()->name }}  - Streak: {{ auth()->user()->streak }} </span>

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
