
<x-layout>

    <x-form.layout title="Enter your email to reset your password" method="post" :action="route('password.email')">

        <div class="mb-4 w-4/6">
            <x-form.field id="email" type="text" placeholder="Enter email address" :value="old('email')" required="required" />
        </div>
        <div class="mb-4 w-4/6 text-center">
            <x-form.submit label="Reset" />
        </div>
    </x-form.layout>

</x-layout>
