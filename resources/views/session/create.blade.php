<x-layout>
    <section class="px-6 py-8">

        <main class="max-w-lg mx-auto bg-gray-400 p-6 rounded-xl">
            <h1 class="text-center text-gray-700 font-bold text-xl">Log in<h1>
            <form method="POST" action="/login" class="mt-10">
                @csrf

                <div class="mb-6">
                    <label class="block mb-2 font-bold text-vs text-gray-700"
                        for="email"
                    >
                        Email
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                            type="text"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                    >
                </div>

                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror


                <div class="mb-6">
                    <label class="block mb-2 font-bold text-vs text-gray-700"
                        for="password"
                    >
                        Password
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                            type="password"
                            name="password"
                            id="password"
                            required
                    >
                </div>

                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <div class="mb-6">
                    <button type="submit"
                            class="bg-gray-900 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
                    Submit
                </button>
            </form>
        </main>
    </section>
</x-layout>
