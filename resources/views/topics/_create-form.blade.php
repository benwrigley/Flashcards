
<div x-show="topicForm" class="fixed bottom-10 w-full flex justify-center">

    <form method="POST" action="/topic" class="bg-gray-800 rounded p-4 w-10/12">
        @csrf
        <div class="flex justify-center">
            <div class="pr-10">
                {{-- @include('icons/info',['width' => 30, 'height' => 30]) --}}
            </div>
            <div class="text-right">

                <span class=" mr-4 align-middle"> New Topic: </span>
            </div>
            <div class="w-1/4">

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

            <div class="ml-6 w-1/4">

                <input class="border border-gray-400 p-2 w-full text-gray-700"
                        type="textarea"
                        name="description"
                        placeholder="Description"
                        id="description"
                        value="{{ old('description') }}"
                >
                @error('description','topicCreate')
                    <p class="text-red-700 p-2 mb">{{ $message }}</p>
                @enderror
            </div>

            <x-color-picker name="background"/>

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
