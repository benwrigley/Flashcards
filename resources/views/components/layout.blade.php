<!doctype html>

<title>Flashcards</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<body style="font-family: Open Sans, sans-serif" class="bg-gray-900 text-white">
    <section class="px-6 py-8">
        {{-- <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    Flashcards
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @auth
                    <span class="text-xs font-bold uppercase"> Welcome, {{ auth()->user()->name }} </span>
                    <form method="POST" action="/logout" class="text-xs font-semibold text-blue-500 ml-6 uppercase">
                        @csrf
                        <button type="submit">Log Out</button>
                    </form>

                @else
                    <a href="/register" class="text-xs font-bold">Register</a>
                    <a href="/login" class="ml-3 text-xs font-bold">Login</a>
                @endauth
            </div>
        </nav> --}}

        {{ $slot }}

    </section>
    @if (session()->has('success'))
        <x-flash>
            {{ session()->get('success') }}
        </x-flash>
    @endif
</body>
