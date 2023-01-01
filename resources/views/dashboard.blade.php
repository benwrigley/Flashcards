<x-layout>
    <div class="items-center h-screen flex justify-center">
        <div class="mt-8 md:mt-0 ">
            @auth
                <span class="text-xs font-bold uppercase"> Welcome, {{ auth()->user()->name }} </span>
                <form method="POST" action="/logout" class="text-xs font-semibold text-blue-500 ml-6 uppercase">
                    @csrf
                    <button type="submit">Log Out</button>
                </form>

            @else
                <div class="bg-gray-400 max-w-max p-4 rounded text-center">
                    Welcome to Flashcards
                </div>
                <div class="text-center text-sm p-2">
                    <a href="/register" class="">Register</a>
                    <a href="/login" class="ml-3">Login</a>
                </div>
            @endauth
        </div>
    </div>

</x-layout>
