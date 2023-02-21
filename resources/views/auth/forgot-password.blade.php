
<x-layout>

    <x-form-layout title="Enter your email to reset your password" method="post" :action="route('password.email')">

        <x-form-field id="email" type="text" placeholder="Enter email address" :value="old('email')" required="required" />

        <x-form-submit label="Reset" />

    </x-form-layout>

</x-layout>
