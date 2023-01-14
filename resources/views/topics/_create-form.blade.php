
<div x-show="topicForm" class="fixed bottom-10 w-full flex justify-center">
    <form method="POST" action="/topic/store" class="bg-gray-700 rounded p-4 w-10/12">
        @csrf

        <div class="lg:grid lg:grid-cols-4 items-baseline">
            <div class="text-right">
                <span class=" mr-4 align-middle"> New Topic: </span>
            </div>
            <div >

                <input class="border border-gray-400 p-2 w-full text-gray-700"
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Name"
                        value="{{ old('name') }}"
                        required
                >
                @error('name','topicCreate')
                    <p class="text-red-700 p-2 mb">{{ $message }}</p>
                @enderror
            </div>

            <div class="ml-6">

                <input class="border border-gray-400 p-2 w-full text-gray-700"
                        type="textarea"
                        name="description"
                        placeholder="Description"
                        id="description"
                        value="{{ old('description') }}"
                        required
                >
                @error('description','topicCreate')
                    <p class="text-red-700 p-2 mb">{{ $message }}</p>
                @enderror
            </div>

            <input
                type="hidden"
                name="topic_id"
                value="{{ $topic->id ?? ''}}"
            >

            <div class="ml-6">
                <button type="submit"
                        class="bg-gray-600 text-white rounded py-2 px-4 hover:bg-blue-500"
                >
                Create
                </button>
            </div>
        </div>
    </form>
</div>
