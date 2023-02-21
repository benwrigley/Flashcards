<!doctype html>

<title>Flashcards</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    [x-cloak] { display: none !important; }
</style>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<body style="font-family: Open Sans, sans-serif" class="bg-gray-900 text-gray-300">
    <div class="landscape:hidden text-4xl text-center p-4 bg-gray-500 m-4 rounded top-20 ">
        Please rotate your device to use flashcards
    </div>

    <section class="px-6 py-8 portrait:hidden" x-data="{scoreboard:false}">
        <x-nav :topic="isset($topic) ? $topic : null"/>
        @auth
            <x-scoreboard />
        @endauth

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
