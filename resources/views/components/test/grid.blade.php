@props(['topic'])
<div class="bg-gray-800 p-5 rounded w-56 lg:w-80 border-gray-900 border-4 z-50">
    <div class="text-xl lg:text-3xl text-center mb-2">
        Test Me!
    </div>
    <div class="text-sm lg:text-xl text-center ">
        In this topic and it's subtopics, test me on...
    </div>
    <a href="{{ route('test.store',[$topic->id,'*']) }}">
        <div class="bg-blue-500 p-2 rounded-3xl m-3 text-center hover:bg-blue-400 uppercase lg:text-xl text-sm">
            Everything!
        </div >
    </a>
    <a href="{{ route('test.store',[$topic->id,'5']) }}">
        <div class="bg-blue-500 p-2 rounded-3xl m-3 text-center hover:bg-blue-400 uppercase lg:text-xl text-sm">
            My worst 5
        </div>
    </a>
    <a href="{{ route('test.store',[$topic->id,'10']) }}">
        <div class="bg-blue-500 p-2 rounded-3xl m-3 text-center hover:bg-blue-400 uppercase lg:text-xl text-sm">
            My worst 10
        </div>
    </a>
</div>
