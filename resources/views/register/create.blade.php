<x-layout>
    <x-form.layout title="Register" method="Post" action="/register">
        <div class="mb-4 w-4/6">
            <x-form.field type="text" id="name" :value="old('name')" required="required" placeholder="Name" />
        </div>
        <div class="mb-4 w-4/6">
            <x-form.field type="text" id="email" :value="old('email')" required="required" placeholder="Email" />
        </div>
        <div class="mb-4 w-4/6">
            <x-form.field type="password" id="password" value="" required="required" placeholder="Password" />
        </div>
        <x-form.submit label="Register" />

    </x-form.layout>
</x-layout>
