<x-layout>
    <section class="px-6 py-8">

        <main class="max-w-lg mx-auto bg-gray-400 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl text-gray-900">Register!</h1>
            <form method="POST" action="/register" class="mt-10">
                @csrf

                <div class="mb-6">
                    <label class="block mb-2  font-bold text-vs text-gray-700"
                        for="name"
                    >
                        Name
                    </label>

                    <input class="border border-gray-400 p-2 w-full text-gray-700"
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required
                    >
                    @error('name')
                        <p class="text-red-700 p-2 mb">{{ $message }}</p>
                    @enderror
                </div>




                {{-- <div class="mb-6">
                    <label class="block mb-2  font-bold text-vs text-gray-700"
                        for="username"
                    >
                        Username
                    </label>

                    <input class="border border-gray-400 p-2 w-full text-gray-700"
                            type="text"
                            name="username"
                            id="username"
                            value="{{ old('username') }}"
                            required
                    >
                    @error('username')
                        <p class="text-red-700 p-2 mb">{{ $message }}</p>
                    @enderror
                </div> --}}



                <div class="mb-6">
                    <label class="block mb-2  font-bold text-vs text-gray-700"
                        for="email"
                    >
                        Email
                    </label>

                    <input class="border border-gray-400 p-2 w-full text-gray-700"
                            type="text"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                    >
                    @error('email')
                        <p class="text-red-700 p-2 mb">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label class="block mb-2 font-bold text-vs text-gray-700"
                        for="password"
                    >
                        Password
                    </label>

                    <input class="border border-gray-400 p-2 w-full text-gray-700"
                            type="password"
                            name="password"
                            id="password"
                            required
                    >
                    @error('password')
                        <p class="text-red-700 p-2 mb">{{ $message }}</p>
                    @enderror
                </div>

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
