<x-layout>

    <x-form-layout title="Create Topic" method="post" :action="route('topic.store')">

        <x-form-field type="text" id="name" placeholder="Topic Name" :value="old('name')" required="required" />

        <x-form-textarea type="textarea" id="description" placeholder="Description" :value="old('description')" required="required" rows="3" />

        <input
            type="hidden"
            name="topic_id"
            value="{{ $topic->id ?? ''}}"
        >

        <x-color-picker name="background" selected=""/>
        <x-form-submit label="Create" />


    </x-form-layout>

</x-layout>
