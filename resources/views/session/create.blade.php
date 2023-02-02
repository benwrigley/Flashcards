<x-layout>
    <section class="px-6 py-8">

        <main class="max-w-lg m-auto bg-gray-800 p-6 rounded-xl mt-4">
            <h1 class="text-center text-2xl mb-2">Welcome to Flashcards!</h1>

            <form method="POST" action="/login" class="mt-10">
                @csrf

                <div class="mb-6">

                    <input class="border border-gray-400 text-gray-900 p-2 w-full rounded"
                            type="text"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="Email"
                            required
                    >
                </div>

                @error('email')
                    <p class="text-red-700 mt-1">{{ $message }}</p>
                @enderror


                <div class="mb-6">

                    <input class="border border-gray-400 p-2 w-full text-gray-900 rounded"
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Password"
                            required
                    >
                </div>

                @error('password')
                    <p class="text-red-700 mt-1">{{ $message }}</p>
                @enderror

                <div class="grid grid-cols-3">
                    <div class="col-span-1">
                    </div>
                    <div class="mb-6 text-center">
                        <button type="submit"
                                class="bg-gray-500 text-white rounded py-2 px-4 hover:animate-pulse hover:bg-blue-500 hover:scale-110 duration-500 "
                        >
                        Login
                        </button>
                    </div>
                    <div class="col-span-1">
                    </div>
                    <div>
                        <button
                            class="bg-gray-800 text-gray-400 rounded py-2 px-4 hover:bg-gray-700 ml-4 text-sm"
                        >
                            <a href="{{route('register.create')}}">Register</a>
                        </button>
                    </div>
                    <div class="col-span-2 text-right">
                        <button
                            class="bg-gray-800 text-blue-400 rounded py-2 px-4 hover:bg-gray-700 ml-4 text-sm"
                        >
                            <a href="{{route('password.request')}}">Forgotten Password</a>
                        </button>
                    </div>

                </div>
            </form>
        </main>
    </section>
</x-layout>
