
<x-layout>

    <x-form.layout title="Choose a new password" method="post" :action="route('password.update')">
        <div class="mb-4 w-4/6">
            <x-form.field id="email" type="text" placeholder="Enter email address" :value="old('email')" required="required" />
        </div>
        <div class="mb-4 w-4/6">
            <x-form.field id="password" type="password" placeholder="Enter password" value="" required="required" />
        </div>
        <div class="mb-4 w-4/6">
            <x-form.field id="password_confirmation" type="password" placeholder="Confirm password" value="" required="required" />
        </div>
        <input type="hidden" name="token" value="{{$token}}">

        <x-form.submit label="Save" />
    </x-form.layout>


</x-layout>
