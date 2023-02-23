
<div x-show="topicForm" class="fixed bottom-0 lg:bottom-10 w-screen lg:w-full flex justify-center" style="display:none">

    <form method="POST" action="/topic" class="bg-gray-800 rounded p-4 w-10/12">
        @csrf
        <div class="flex justify-center items-center">

            <div class="w-1/4">
                <x-form.field type="text" id="name" placeholder="New Topic Name" :value="old('name')" />
            </div>

            <div class="ml-6 w-1/4">
                <x-form.field type="text" id="description" placeholder="Description" :value="old('description')" />
            </div>

            <x-form.color-picker name="background"/>

            <input
                type="hidden"
                name="topic_id"
                value="{{ $topic->id ?? ''}}"
            >

            <div class="ml-6">
                <x-form.submit label="Create" />
            </div>
        </div>
    </form>
</div>
