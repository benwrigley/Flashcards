<x-layout>

    <x-form.layout title="Welcome to Flashcards!" method="POST" action="/login">
        <div class="mb-4 w-4/6">
            <x-form.field type="test" id="email" :value="old('email')" placeholder="Email" required="required"/>
        </div>
        <div class="mb-4 w-4/6">
            <x-form.field type="password" id="password" value="" placeholder="Password" required="required"/>
        </div>
        <div class="mb-4 w-4/6 text-center flex justify-between">
            <div class="mb-4 w-4/6 text-left">
                <a href="{{route('password.request')}}">
                    <button type="button" class="bg-gray-900 text-gray-500 rounded py-2 px-4 hover:animate-pulse hover:bg-blue-500 hover:text-white hover:scale-110 duration-500">
                        Forgot Password
                    </button>
                </a>
            </div>
            <div class="text-right">
                <x-form.submit label="Login"/>
            </div>
        </div>

    </x-form.layout>
</x-layout>
