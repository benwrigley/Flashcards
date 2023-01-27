
<x-layout>

    <div>
        <main class="w-4/6 mx-auto mt-6 lg:mt-20 space-y-6 bg-gray-800 p-3 rounded flex flex-col items-center">

            <div class="text-3xl text-center w-2/3 mt-3 mb-3">
                Before continuing, please verify your account by clicking the link in the email we sent you
            </div>

            <div>
                <form method="post" action="{{route('verification.resend')}}" class="flex flex-col items-center">
                    @csrf
                    <input class="border border-gray-400 p-2 w-full text-gray-700"
                        type = "text"
                        id = "email"
                        name= "email"
                        placeholder = "Enter email address"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <p class="text-red-700 p-2 mb">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="bg-gray-700 hover:bg-gray-500 rounded-3xl p-3 text-xl mt-3"> Resend </button>
                </form>
            </div>
        </main>
    </div>

</x-layout>
