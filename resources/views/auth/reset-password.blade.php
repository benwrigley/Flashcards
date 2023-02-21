
<x-layout>

    <x-form-layout title="Choose a new password" method="post" :action="route('password.update')">

        <x-form-field id="email" type="text" placeholder="Enter email address" :value="old('email')" required="required" />

        <x-form-field id="password" type="password" placeholder="Enter password" value="" required="required" />

        <x-form-field id="password_confirmation" type="password" placeholder="Confirm password" value="" required="required" />

        <input type="hidden" name="token" value="{{$token}}">

        <x-form-submit label="Save" />
    </x-form-layout>


</x-layout>
