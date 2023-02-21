<x-layout>
    <x-form-layout title="Register" method="Post" action="/register">
        <x-form-field type="text" id="name" :value="old('name')" required="required" placeholder="Name" />
        <x-form-field type="text" id="email" :value="old('email')" required="required" placeholder="Email" />
        <x-form-field type="password" id="password" value="" required="required" placeholder="Password" />
        <x-form-submit label="Register" />

    </x-form-layout>
</x-layout>
