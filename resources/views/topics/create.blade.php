<x-layout>

    <x-form.layout title="Create Topic" method="post" :action="route('topic.store')">

        <div class="mb-4 w-5/6">
            <x-form.field type="text" id="name" placeholder="Topic Name" :value="old('name')" required="required" />
        </div>

        <div class="mb-4 w-5/6">
            <x-form.textarea type="textarea" id="description" placeholder="Description" :value="old('description')" required="required" rows="3" />
        </div>

        <input
            type="hidden"
            name="topic_id"
            value="{{ $topic->id ?? ''}}"
        >

        <x-form.color-picker name="background" selected=""/>
        <x-form.submit label="Create" />


    </x-form.layout>

</x-layout>
