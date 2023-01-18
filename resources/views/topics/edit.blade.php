<x-layout>

    <section class="px-6 py-8">

        <main class="w-1/2 mx-auto bg-gray-400 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl text-gray-900">Update Topic</h1>
            <form action="{{route('topic.update',$topic->id)}}" class="mt-10" method="POST">
                <input type="hidden" name="_method" value="PUT">
                @csrf


                <div class="mb-6">
                    <label class="block mb-2  font-bold text-vs text-gray-700"
                        for="question"
                    >
                        Question
                    </label>

                    <input class="border border-gray-400 p-2 w-full text-gray-700"
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Name"
                        value="{{ old('name',$topic->name) }}"
                        required
                    >
                    @error('name')
                        <p class="text-red-700 p-2 mb">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2  font-bold text-vs text-gray-700"
                        for="name"
                    >
                        Description
                    </label>

                    <textarea
                        class="border border-gray-400 p-2 w-full text-gray-700"
                        name="description"
                        id="description"
                        rows="10"
                    >{{ old('description',$topic->description) }}</textarea>
                    @error('description')
                        <p class="text-red-700 p-2 mb">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2  font-bold text-vs text-gray-700"
                        for="name"
                    >
                        Parent Topic
                    </label>
                    <select id="topic_id" name="topic_id" class="text-gray-900 rounded p-1.5">
                        <option value="{{ null }}">This is a main topic</option>
                        @foreach ($topics as $name => $id)
                            <option value="{{ $id }}" {{ ($id === $topic->topic_id) ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>





                <x-color-picker name="background" :selected="$topic->background"/>

                <div class="mb-6">
                    <button type="submit"
                            class="bg-gray-900 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
                    Update
                </button>
            </form>
        </main>
    </section>



</x-layout>