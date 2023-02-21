<x-layout>

    <x-form-layout title="Welcome to Flashcards!" method="POST" action="/login">
        <x-form-field type="test" id="email" :value="old('email')" placeholder="Email" required="required"/>
        <x-form-field type="password" id="password" value="" placeholder="Password" required="required"/>
        <x-form-submit label="Login"/>

    </x-form-layout>
</x-layout>
